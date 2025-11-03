<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Course::with('category')->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $input = $validated;

        // Handle image upload
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/courses'), $fileName);
            $input['image'] = $fileName;
        }

        $course = Course::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Course created successfully',
            'data' => $course
        ], 201);
    }

    /**
     * Display the specified course.
     */
    public function show($id)
    {
        $course = Course::with('category')->find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $course
        ], 200);
    }

    /**
     * Update the specified course.
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'title'       => 'sometimes|string|max:255',
            'price'       => 'sometimes|numeric|min:0',
            'capacity'    => 'sometimes|integer|min:1',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $validated;

        // Handle image replacement
        if ($request->hasFile('image')) {
            if ($course->image && file_exists(public_path('uploads/courses/' . $course->image))) {
                unlink(public_path('uploads/courses/' . $course->image));
            }

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/courses'), $fileName);
            $data['image'] = $fileName;
        }

        $course->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Course updated successfully',
            'data' => $course
        ], 200);
    }

    /**
     * Remove the specified course.
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        if ($course->image && file_exists(public_path('uploads/courses/' . $course->image))) {
            unlink(public_path('uploads/courses/' . $course->image));
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully'
        ], 200);
    }
}
