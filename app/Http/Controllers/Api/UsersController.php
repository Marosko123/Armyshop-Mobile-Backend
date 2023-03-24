<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function get()
    {
        $users = User::all();

        if ($users->count() <= 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Users not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'users' => $users
        ], 200);
    }

    public function getById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'user' => $user
        ], 200);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'age' => 'required|integer',
            'address' => 'required|string|max:191',
            'avatar_url' => 'required|string|max:191',
            'has_license' => 'required|boolean|max:191'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'address' => $request->address,
            'avatar_url' => $request->avatar_url,
            'has_license' => $request->has_license
        ]);

        if (!$user) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => 'User created successfully'
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'age' => 'required|integer',
            'address' => 'required|string|max:191',
            'avatar_url' => 'required|string|max:191',
            'has_license' => 'required|boolean|max:191'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        $user->update([
            'email' => $request->email,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'address' => $request->address,
            'avatar_url' => $request->avatar_url,
            'has_license' => $request->has_license
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'User updated successfully'
        ], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully'
        ], 200);
    }
}