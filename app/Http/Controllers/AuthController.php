<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\UniqueId;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showCodeInput()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return view('code-input');
    }


    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'access_code' => 'required|string',
        ]);


        return response()->json([
            'success' => true,
            'redirect' => route('verifying', ['access_code' => $request->access_code]),
            'message' => 'Code entered successfully!'
        ], 200);
    }

    public function verifying($access_code)
    {

        return view('processing', compact('access_code'));
    }

    public function showNameInput($access_code)
    {
        // Check if the access_code exists in the unique_ids table
        $uniqueId = UniqueId::where('unique_id', $access_code)->first();

        if (!$uniqueId) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('connection.failed')->withErrors([
                'access_code' => 'Invalid access code. Please try again.'
            ]);
        }

        return view('name-input', compact('access_code'));
    }


    // public function showNameInput($access_code)
    // {
    //     // Assuming `access_code` is a unique field, not the primary key (id)
    //     $admin = Admin::where('unique_id', $access_code)->first();

    //     if (!$admin) {
    //         Auth::logout();
    //         request()->session()->invalidate();
    //         request()->session()->regenerateToken();

    //         return redirect()->route('connection.failed')->withErrors([
    //             'access_code' => 'Invalid access code. Please try again.'
    //         ]);
    //     }

    //     return view('name-input', compact('access_code'));
    // }

    public function connectionFailed()
    {
        return view('connection_failed');
    }


    public function processName(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u', // Allows letters, spaces, and hyphens
            ]);

            $user = User::where('name', $validated['name'])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => Str::slug($validated['name']) . '-' . uniqid() . '@example.com',
                    'password' => bcrypt(Str::random(16)),
                    'status' => 'pending',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Identity verified successfully',
                'redirect' => route('loading', ['user' => $user->id])
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showLoading(Request $request)
    {
        $userId = $request->user;
        $user = User::findOrFail($userId);

        return view('loading', [
            'user' => $user,
            'status' => $user->status
        ]);
    }

    public function verifyUser(Request $request, $user_id, $status)
    {
        $user = User::findOrFail($user_id);

        if ($user->status === 'active') {
            Auth::login($user);
            return redirect()->route('payment.portal')->with('success', 'Identity verified successfully!');
        }

        // If user is not active, redirect back with error message
        return redirect()->route('check.back.later')->with([
            'error' => 'Your account is still being verified. Please check back later.',
            'user_id' => $user_id
        ]);
    }


    public function showPaymentPortal()
    {
        $user = Auth::user();
        return view('check', compact('user'));
    }

    public function checkBackLater()
    {
        return view('check-back-later');
    }

    public function checkStatus()
    {
        // Get the current authenticated user
        $user = User::find(Auth::id());

        // Check both user status and transaction status if needed
        if ($user->status === 'active') {
            Auth::login($user);
            return response()->json([
                'completed' => true,
                'redirect' => route('payment.portal'),
                'message' => 'User is active and verified'
            ]);
        }

        return response()->json([
            'completed' => false,
            'message' => 'Pending verification',
            'current_status' => $user->status
        ]);
    }
}
