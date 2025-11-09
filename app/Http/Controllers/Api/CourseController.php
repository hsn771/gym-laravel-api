<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class CourseController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT courses.*,categories.name as cat_name,teacher.tname FROM `courses` left JOIN categories on categories.id=courses.category_id left JOIN teacher on teacher.id=courses.teacher_id ");
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
        $file->move(public_path('course_file'), $name); // move to /public/teacher_file
        $filePaths = 'course_file/' . $name; // relative path
    }

    // Example: if you want to save as JSON array in DB
    $requestdata['image'] = $filePaths;
}


        $user = Course::create($requestdata);
        return response()->json(['message' => 'User Created', 'user' => $user, 'error' => 0], 200);
    }

    public function show($id)
    {
        $user = Course::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        return response()->json(['user' => $user, 'error' => 0], 200);
    }

    public function update(Request $request, $id)
    {
        $user = Course::find($id);
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
        $user = Course::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found', 'error' => 1], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User Deleted', 'error' => 0], 200);
    }

}