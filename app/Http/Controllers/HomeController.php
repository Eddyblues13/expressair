<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {

        return view('home.homepage');
    }

    public function about()
    {

        return view('home.about');
    }
    public function services()
    {

        return view('home.services');
    }
    public function contact()
    {

        return view('home.contact');
    }

    public function track()
    {

        return view('home.track');
    }

    public function how()
    {

        return view('home.how-to');
    }

    public function destinations()
    {

        return view('home.destination');
    }

    public function viewPackage(Request $request)
    {
        $search = $request->input('search');

        $package = Package::with(['trackingLocations' => function ($query) {
            $query->orderByDesc('arrival_time');
        }])->where('tracking_number', $search)->first();

        if ($package) {
            // Get current location
            $currentLocation = $package->trackingLocations->firstWhere('is_current', true);
            return view('package.view', compact('package', 'currentLocation'));
        } else {
            return back()->with('error', 'Incorrect Tracking Number');
        }
    }
}
