<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {

        $registerUserData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:3',
            'contact_no' => 'nullable|string'
        ]);
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'contact_no' => $registerUserData['contact_no'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return response()->json(['message' => 'User Created ', 'user' => $user, 'error' => 0], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        return response()->json(['user' => $user, 'error' => 0], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }


        $updatedata = [
            'name' => $request['name'],
            'email' => $request['email'],
            'contact_no' => $request['contact_no'],
        ];
        if ($request->has('password') && !empty($request->password)) {
            $updatedata['password'] = Hash::make($request->password);
        }
        $user->update($updatedata);
        return response()->json(['message' => 'User Updated ', 'user' => $user, 'error' => 0], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User Deleted ', 'error' => 0], 200);
    }


}