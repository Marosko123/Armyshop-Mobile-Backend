<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginRegisterController extends Controller
{

     public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();

            $user->chat_rooms = ChatRoom::where('members', 'LIKE', '%' . $user->id . '%')
                ->orWhere('creator_id', $user->id)
                ->distinct()
                ->get();

            $path = 'militaryPassports/militaryPassportOfUserWithId_' . $user->id . '.png';
            $file = file_get_contents($path);
            $data = base64_encode($file);
            $user->license_picture = $data;

            $token = $user->createToken('access_token')->plainTextToken;

            $response = response()->json([
                'status' => 200,
                'token' => $token,
                'user' => $user,
            ], 200);
            
            return $response->withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                'Access-Control-Allow-Headers' => 'Authorization, Content-Type, X-Requested-With'
            ]);
        } else {
            // Authentication failed
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password1' => 'required',
            'password2' => 'required|same:password1',
            'license_picture' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new user record
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_license_valid = $request->license_picture !== null;
        $user->save();
        $user = User::where('id', $user->id)->first();
        $user->chat_rooms = [];

        if ($request->license_picture) {
            try {
                $data = $request->license_picture;

                $data = base64_decode($data);

                $path = 'militaryPassports/militaryPassportOfUserWithId_' . $user->id . '.png';
                file_put_contents($path, $data);

                $file = file_get_contents($path);
                $data = base64_encode($file);

                $user->license_picture = $data;
            } catch (\Exception $e) {
                $errMessage = 'Our apologies.. Image was not uploaded successfully. Try reuploading it in your profile or contact our support.';

                // Authenticate the user and generate an access token
                $token = $user->createToken('access_token')->accessToken;
                $user->license_picture = $errMessage;

                return response()->json([
                    'status' => 409,
                    'token' => $token,
                    'user' => $user,
                    'message' => $errMessage,
                ], 409);
            }
        }

        // Authenticate the user and generate an access token
        $token = $user->createToken('access_token')->plainTextToken;

        // Return response
        return response()->json([
            'status' => 200,
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function getLogin() {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized',
        ], 401);
    }
}