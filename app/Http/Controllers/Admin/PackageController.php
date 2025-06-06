<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\TrackingLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Sender info
                'sender_name' => 'required|string|max:255',
                'sender_email' => 'required|email|max:255',
                'sender_phone' => 'required|string|max:20',
                'sender_address' => 'required|string|max:255',
                'sender_city' => 'required|string|max:255',
                'sender_state' => 'required|string|max:255',
                'sender_zip' => 'required|string|max:20',
                'sender_country' => 'required|string|max:255',

                // Receiver info
                'receiver_name' => 'required|string|max:255',
                'receiver_email' => 'required|email|max:255',
                'receiver_phone' => 'required|string|max:20',
                'receiver_address' => 'required|string|max:255',
                'receiver_city' => 'required|string|max:255',
                'receiver_state' => 'required|string|max:255',
                'receiver_zip' => 'required|string|max:20',
                'receiver_country' => 'required|string|max:255',

                // Package details
                'tracking_number' => 'required|string|max:255|unique:packages',
                'item_description' => 'required|string|max:500',
                'item_quantity' => 'required|integer|min:1',
                'declared_value' => 'required|numeric|min:0',
                'total_weight' => 'required|numeric|min:0.1',
                'number_of_boxes' => 'required|integer|min:1',
                'box_weight' => 'required|numeric|min:0',

                // Shipping info
                'shipping_from' => 'required|string|max:255',
                'shipping_to' => 'required|string|max:255',
                'shipping_date' => 'required|date',
                'estimated_delivery_date' => 'required|date|after:shipping_date',
                'notes' => 'nullable|string',
            ]);

            // Generate tracking number if not provided
            if (empty($validated['tracking_number'])) {
                $validated['tracking_number'] = 'PKG-' . Str::upper(Str::random(10));
            }

            // Set initial tracking status
            $validated['current_step'] = 1;
            $validated['progress_percentage'] = 25;
            $validated['step1_name'] = 'Package Created';
            $validated['step1_date'] = now();

            $package = Package::create($validated);

            // Create initial tracking location
            TrackingLocation::create([
                'package_id' => $package->id,
                'location_name' => $validated['shipping_from'],
                'status' => 'Package Created',
                'arrival_time' => now(),
                'is_current' => true
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Package created successfully!',
                'redirect' => route('admin.packages.show', $package->id)
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating package: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create package. ' . $e->getMessage(),
                'errors' => $e instanceof \Illuminate\Validation\ValidationException ? $e->errors() : []
            ], 500);
        }
    }

    public function show(Package $package)
    {
        $trackingLocations = $package->trackingLocations()->orderBy('arrival_time', 'desc')->get();
        return view('admin.packages.show', compact('package', 'trackingLocations'));
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        try {
            $validated = $request->validate([
                // Similar validation as store
                // ...
            ]);

            $package->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Package updated successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating package: ' . $e->getMessage(), [
                'exception' => $e,
                'package_id' => $package->id,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update package. ' . $e->getMessage(),
                'errors' => $e instanceof \Illuminate\Validation\ValidationException ? $e->errors() : []
            ], 500);
        }
    }

    public function destroy(Package $package)
    {
        try {
            $package->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Package deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting package: ' . $e->getMessage(), [
                'exception' => $e,
                'package_id' => $package->id
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete package. ' . $e->getMessage()
            ], 500);
        }
    }

    public function addTrackingLocation(Request $request, Package $package)
    {
        try {
            $validated = $request->validate([
                'location_name' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'arrival_time' => 'required|date',
            ]);

            // Mark all previous locations as not current
            $package->trackingLocations()->update(['is_current' => false]);

            // Create new tracking location
            $trackingLocation = $package->trackingLocations()->create([
                'location_name' => $validated['location_name'],
                'status' => $validated['status'],
                'arrival_time' => $validated['arrival_time'],
                'is_current' => true
            ]);

            // Update package progress based on status
            $this->updatePackageProgress($package, $validated['status']);

            return response()->json([
                'status' => 'success',
                'message' => 'Tracking location added successfully!',
                'tracking_location' => $trackingLocation
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding tracking location: ' . $e->getMessage(), [
                'exception' => $e,
                'package_id' => $package->id,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add tracking location. ' . $e->getMessage()
            ], 500);
        }
    }

    protected function updatePackageProgress(Package $package, string $status)
    {
        // Update package progress based on status
        // You can customize this logic based on your workflow
        if (Str::contains($status, ['Processed', 'Shipped'])) {
            $package->updateProgress(2);
        } elseif (Str::contains($status, ['In Transit', 'On the Way'])) {
            $package->updateProgress(3);
        } elseif (Str::contains($status, ['Delivered', 'Completed'])) {
            $package->updateProgress(4);
        }
    }

    public function updateTrackingLocation(Request $request, TrackingLocation $trackingLocation)
    {
        try {
            $validated = $request->validate([
                'location_name' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'arrival_time' => 'required|date',
            ]);

            $trackingLocation->update($validated);

            // Update package progress if this is the current location
            if ($trackingLocation->is_current) {
                $this->updatePackageProgress($trackingLocation->package, $validated['status']);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Tracking location updated successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating tracking location: ' . $e->getMessage(), [
                'exception' => $e,
                'tracking_location_id' => $trackingLocation->id,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update tracking location. ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteTrackingLocation(TrackingLocation $trackingLocation)
    {
        try {
            $package = $trackingLocation->package;
            $trackingLocation->delete();

            // If we deleted the current location, set the most recent one as current
            if ($trackingLocation->is_current) {
                $latestLocation = $package->trackingLocations()->latest()->first();
                if ($latestLocation) {
                    $latestLocation->update(['is_current' => true]);
                    $this->updatePackageProgress($package, $latestLocation->status);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Tracking location deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting tracking location: ' . $e->getMessage(), [
                'exception' => $e,
                'tracking_location_id' => $trackingLocation->id
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete tracking location. ' . $e->getMessage()
            ], 500);
        }
    }
}
