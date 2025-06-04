<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\TrackingLocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManageUserController extends Controller
{
    public function index()
    {
        // Package statistics
        $totalPackagesCount = Package::count();
        $inTransitCount = Package::where('current_step', '>', 1)
            ->where('current_step', '<', 4)
            ->count();
        $deliveredCount = Package::where('current_step', 4)->count();
        $issuesCount = Package::whereHas('trackingLocations', function ($query) {
            $query->where('status', 'issue');
        })->count();

        // Recent data
        $recentPackages = Package::with('trackingLocations')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentTracking = TrackingLocation::with('package')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Analytics data (default to monthly)
        $analyticsData = $this->getAnalyticsData('month');

        return view('admin.home', [
            // Statistics
            'totalPackagesCount' => $totalPackagesCount,
            'inTransitCount' => $inTransitCount,
            'deliveredCount' => $deliveredCount,
            'issuesCount' => $issuesCount,

            // Recent data
            'recentPackages' => $recentPackages,
            'recentTracking' => $recentTracking,

            // Analytics
            'shipmentAnalytics' => [
                'labels' => $analyticsData['labels'],
                'data' => $analyticsData['data']
            ],
            'shipmentStatusData' => [
                $analyticsData['processing'],
                $analyticsData['in_transit'],
                $analyticsData['delivered'],
                $analyticsData['with_issues']
            ]
        ]);
    }

    public function getAnalytics(Request $request)
    {
        $period = $request->input('period', 'month');
        $data = $this->getAnalyticsData($period);

        return response()->json([
            'labels' => $data['labels'],
            'data' => $data['data']
        ]);
    }

    private function getAnalyticsData($period)
    {
        $now = Carbon::now();
        $labels = [];
        $data = [];

        // Initialize status counts
        $processing = 0;
        $in_transit = 0;
        $delivered = 0;
        $with_issues = 0;

        switch ($period) {
            case 'week':
                // Last 7 days
                for ($i = 6; $i >= 0; $i--) {
                    $date = $now->copy()->subDays($i);
                    $labels[] = $date->format('D');
                    $count = Package::whereDate('created_at', $date)->count();
                    $data[] = $count;
                }

                // Status counts for the week
                $processing = Package::where('current_step', 1)
                    ->whereBetween('created_at', [$now->subDays(6), $now])
                    ->count();
                $in_transit = Package::whereBetween('current_step', [2, 3])
                    ->whereBetween('created_at', [$now->subDays(6), $now])
                    ->count();
                $delivered = Package::where('current_step', 4)
                    ->whereBetween('created_at', [$now->subDays(6), $now])
                    ->count();
                $with_issues = Package::whereHas('trackingLocations', function ($query) use ($now) {
                    $query->where('status', 'issue')
                        ->whereBetween('created_at', [$now->subDays(6), $now]);
                })->count();
                break;

            case 'year':
                // Last 12 months
                for ($i = 11; $i >= 0; $i--) {
                    $date = $now->copy()->subMonths($i);
                    $labels[] = $date->format('M Y');
                    $count = Package::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count();
                    $data[] = $count;
                }

                // Status counts for the year
                $processing = Package::where('current_step', 1)
                    ->whereYear('created_at', $now->year)
                    ->count();
                $in_transit = Package::whereBetween('current_step', [2, 3])
                    ->whereYear('created_at', $now->year)
                    ->count();
                $delivered = Package::where('current_step', 4)
                    ->whereYear('created_at', $now->year)
                    ->count();
                $with_issues = Package::whereHas('trackingLocations', function ($query) use ($now) {
                    $query->where('status', 'issue')
                        ->whereYear('created_at', $now->year);
                })->count();
                break;

            case 'month':
            default:
                // Last 30 days
                for ($i = 29; $i >= 0; $i--) {
                    $date = $now->copy()->subDays($i);
                    $labels[] = $date->format('M d');
                    $count = Package::whereDate('created_at', $date)->count();
                    $data[] = $count;
                }

                // Status counts for the month
                $processing = Package::where('current_step', 1)
                    ->whereBetween('created_at', [$now->subDays(29), $now])
                    ->count();
                $in_transit = Package::whereBetween('current_step', [2, 3])
                    ->whereBetween('created_at', [$now->subDays(29), $now])
                    ->count();
                $delivered = Package::where('current_step', 4)
                    ->whereBetween('created_at', [$now->subDays(29), $now])
                    ->count();
                $with_issues = Package::whereHas('trackingLocations', function ($query) use ($now) {
                    $query->where('status', 'issue')
                        ->whereBetween('created_at', [$now->subDays(29), $now]);
                })->count();
                break;
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'processing' => $processing,
            'in_transit' => $in_transit,
            'delivered' => $delivered,
            'with_issues' => $with_issues
        ];
    }
}
