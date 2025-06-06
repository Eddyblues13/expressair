<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\TrackingLocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ManagePackageController extends Controller
{
    public function index()
    {
        try {
            $packages = Package::with('trackingLocations')
                ->latest()
                ->paginate(10);

            return view('admin.package.index', compact('packages'));
        } catch (\Exception $e) {
            Log::error('Error fetching packages: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching packages.');
        }
    }

    public function showIndex()
    {
        try {
            $packages = Package::with('trackingLocations')
                ->latest()
                ->paginate(10);

            return view('admin.package.show.index', compact('packages'));
        } catch (\Exception $e) {
            Log::error('Error fetching packages: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching packages.');
        }
    }

    public function create()
    {
        try {
            return view('admin.package.create');
        } catch (\Exception $e) {
            Log::error('Error loading package create form: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the form.');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'tracking_number' => 'required|string|unique:packages',
            'sender_email' => 'nullable|email',
            'receiver_email' => 'nullable|email',
            'declared_value' => 'nullable|numeric',
            'total_weight' => 'nullable|numeric',
            'estimated_delivery_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $package = Package::create($request->all());

            // Create initial tracking location
            TrackingLocation::create([
                'package_id' => $package->id,
                'location_name' => $request->shipping_from ?? 'Origin',
                'status' => 'Package received',
                'arrival_time' => now(),
                'is_current' => true,
            ]);

            Log::info('Package created successfully', ['package_id' => $package->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Package created successfully!',
                'redirect' => route('admin.packages.index')
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating package: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Error creating package: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Package $package)
    {
        try {
            $trackingLocations = $package->trackingLocations()
                ->orderBy('arrival_time', 'asc')
                ->get();

            return view('admin.package.edit', compact('package', 'trackingLocations'));
        } catch (\Exception $e) {
            Log::error('Error loading package edit form: ' . $e->getMessage(), ['package_id' => $package->id]);
            return back()->with('error', 'An error occurred while loading the edit form.');
        }
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        // Base validation rules
        $validator = Validator::make($request->all(), [
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'tracking_number' => 'required|string|unique:packages,tracking_number,' . $package->id,
            'sender_email' => 'nullable|email',
            'receiver_email' => 'nullable|email',
            'declared_value' => 'nullable|numeric',
            'total_weight' => 'nullable|numeric',
            'estimated_delivery_date' => 'nullable|date',

            // Add validation for tracking locations array
            'tracking_locations' => 'nullable|array',
            'tracking_locations.*.location_name' => 'required|string|max:255',
            'tracking_locations.*.status' => 'required|string|max:255',
            'tracking_locations.*.arrival_time' => 'required|date',
            'tracking_locations.*.is_current' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Update package details
            $package->update($request->except('tracking_locations'));

            // Handle tracking locations
            if ($request->has('tracking_locations')) {
                $currentIds = [];

                foreach ($request->tracking_locations as $index => $locationData) {
                    // If this location has an ID, it's an existing one
                    if (isset($locationData['id'])) {
                        $location = TrackingLocation::where('id', $locationData['id'])
                            ->where('package_id', $package->id)
                            ->first();

                        if ($location) {
                            $location->update([
                                'location_name' => $locationData['location_name'],
                                'status' => $locationData['status'],
                                'arrival_time' => $locationData['arrival_time'],
                                'is_current' => $locationData['is_current'] ?? false,
                            ]);
                            $currentIds[] = $location->id;
                        }
                    } else {
                        // Create new location
                        $location = $package->trackingLocations()->create([
                            'location_name' => $locationData['location_name'],
                            'status' => $locationData['status'],
                            'arrival_time' => $locationData['arrival_time'],
                            'is_current' => $locationData['is_current'] ?? false,
                        ]);
                        $currentIds[] = $location->id;
                    }
                }

                // Delete any locations that weren't included in the update
                $package->trackingLocations()
                    ->whereNotIn('id', $currentIds)
                    ->delete();
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Package updated successfully!',
                'redirect' => route('admin.packages.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating package: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Error updating package: ' . $e->getMessage()
            ], 500);
        }
    }


    public function show(Package $package)
    {
        try {
            $trackingLocations = $package->trackingLocations()
                ->orderBy('arrival_time', 'asc')
                ->get();

            return view('admin.packages.show', compact('package', 'trackingLocations'));
        } catch (\Exception $e) {
            Log::error('Error showing package: ' . $e->getMessage(), ['package_id' => $package->id]);
            return back()->with('error', 'An error occurred while loading the package details.');
        }
    }

    public function destroy(Package $package)
    {
        try {
            $package->trackingLocations()->delete();
            $package->delete();

            Log::info('Package deleted successfully', ['package_id' => $package->id]);

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
                'message' => 'Error deleting package: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function updateTrackingLocations(Package $package, $currentStep)
    {
        try {
            // Reset all current locations
            $package->trackingLocations()->update(['is_current' => false]);

            $stepName = $package->{'step' . $currentStep . '_name'};
            $stepDate = $package->{'step' . $currentStep . '_date'} ?? now();

            if ($stepName) {
                $location = $package->trackingLocations()
                    ->where('location_name', $stepName)
                    ->first();

                if (!$location) {
                    $package->trackingLocations()->create([
                        'location_name' => $stepName,
                        'status' => 'In Transit',
                        'arrival_time' => $stepDate,
                        'is_current' => true
                    ]);
                } else {
                    $location->update([
                        'arrival_time' => $stepDate,
                        'is_current' => true
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error updating tracking locations: ' . $e->getMessage(), [
                'package_id' => $package->id,
                'current_step' => $currentStep
            ]);
            throw $e;
        }
    }

    protected function processTrackingLocations(Package $package, array $trackingLocations)
    {
        try {
            $existingIds = [];

            foreach ($trackingLocations as $locationData) {
                if (isset($locationData['id'])) {
                    // Update existing location
                    $location = TrackingLocation::find($locationData['id']);
                    if ($location) {
                        $location->update([
                            'location_name' => $locationData['location_name'],
                            'status' => $locationData['status'],
                            'arrival_time' => $locationData['arrival_time'],
                            'is_current' => $locationData['is_current'] ?? false,
                        ]);
                        $existingIds[] = $location->id;
                    }
                } else {
                    // Create new location
                    $newLocation = $package->trackingLocations()->create([
                        'location_name' => $locationData['location_name'],
                        'status' => $locationData['status'],
                        'arrival_time' => $locationData['arrival_time'],
                        'is_current' => $locationData['is_current'] ?? false,
                    ]);
                    $existingIds[] = $newLocation->id;
                }
            }

            // Delete locations not in the submitted data
            $package->trackingLocations()
                ->whereNotIn('id', $existingIds)
                ->delete();
        } catch (\Exception $e) {
            Log::error('Error processing tracking locations: ' . $e->getMessage(), [
                'package_id' => $package->id,
                'locations_data' => $trackingLocations
            ]);
            throw $e;
        }
    }
}
