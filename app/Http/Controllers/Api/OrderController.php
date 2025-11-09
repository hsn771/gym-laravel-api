<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::select("SELECT * from orders");
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $user = Order::create($request->all());
        return response()->json(['message' => 'User Created ', 'user' => $user, 'error' => 0], 200);
    }

    public function show($id)
    {
        $user = Order::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        return response()->json(['user' => $user, 'error' => 0], 200);
    }

    public function update(Request $request, $id)
    {
        $user = Order::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }

        $user->update($request->all());
        return response()->json(['message' => 'User Updated ', 'user' => $user, 'error' => 0], 200);
    }

    public function destroy($id)
    {
        $user = Order::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User Deleted ', 'error' => 0], 200);
    }
}
