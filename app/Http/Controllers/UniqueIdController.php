<?php

namespace App\Http\Controllers;

use App\Models\UniqueId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniqueIdController extends Controller
{
    public function index()
    {
        $uniqueIds = UniqueId::latest()->paginate(10); // Changed from extremely large number to reasonable pagination
        return view('admin.unique-ids.index', compact('uniqueIds'));
    }

    public function create()
    {
        return view('admin.unique-ids.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unique_id' => 'required|string|max:255|unique:unique_ids,unique_id', // Fixed unique validation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $uniqueId = UniqueId::create($validator->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Unique ID created successfully',
            'data' => $uniqueId
        ]);
    }

    public function edit($id)
    {
        $uniqueId = UniqueId::findOrFail($id);
        return response()->json($uniqueId); // Changed to return JSON for AJAX handling
    }

    public function update(Request $request, $id)
    {
        $uniqueId = UniqueId::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'unique_id' => 'required|string|max:255|unique:unique_ids,unique_id,' . $id, // Fixed unique validation syntax
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $uniqueId->update($validator->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Unique ID updated successfully',
            'data' => $uniqueId
        ]);
    }

    public function destroy($id)
    {
        $uniqueId = UniqueId::findOrFail($id);
        $uniqueId->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Unique ID deleted successfully'
        ]);
    }
}
