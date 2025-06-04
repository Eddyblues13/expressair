<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function editUniqueId(Admin $admin)
    {
        return view('admin.edit-unique-id', compact('admin'));
    }

    public function updateUniqueId(Request $request, $unique_id)
    {
        $admin = Auth::guard('admin')->user();
    
        if ($admin->unique_id !== $unique_id) {
            return response()->json(['message' => 'Unauthorized request.'], 403);
        }
    
        $validator = Validator::make($request->all(), [
            'unique_id' => 'required|string|unique:admins,unique_id,' . $admin->id,
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
    
        $admin->unique_id = $request->unique_id;
        $admin->save();
    
        return response()->json(['message' => 'Unique ID updated successfully.']);
    }
}
