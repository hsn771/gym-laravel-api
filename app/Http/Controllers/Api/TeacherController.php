<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class TeacherController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT * FROM teacher");
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $requestdata = $request->all();

        // ✅ Image Upload Handling
        if ($request->hasFile('files')) {
    $uploadedFiles = $request->file('files');
    $filePaths = [];

    foreach ($uploadedFiles as $file) {
        $name = rand() . '_' . $file->getClientOriginalName(); // same naming style
        $file->move(public_path('teacher_file'), $name); // move to /public/teacher_file
        $filePaths = 'teacher_file/' . $name; // relative path
    }

    // Example: if you want to save as JSON array in DB
    $requestdata['timage'] = $filePaths;
}


        $user = Teacher::create($requestdata);
        return response()->json(['message' => 'User Created', 'user' => $user, 'error' => 0], 200);
    }

    public function show($id)
    {
        $user = Teacher::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        return response()->json(['user' => $user, 'error' => 0], 200);
    }

    public function update(Request $request, $id)
    {
        $user = Teacher::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }

        $requestdata = $request->all();

        // ✅ Image Upload Handling
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $requestdata['image'] = 'images/'.$imageName;
        }

        $user->update($requestdata);
        return response()->json(['message' => 'User Updated', 'user' => $user, 'error' => 0], 200);
    }

    public function destroy($id)
    {
        $user = Teacher::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User Deleted', 'error' => 0], 200);
    }
}
