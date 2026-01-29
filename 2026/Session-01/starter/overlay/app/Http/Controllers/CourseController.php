<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        return CourseResource::collection(Course::query()->orderBy('id')->paginate(15));
    }

    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
        return (new CourseResource($course))
            ->response()
            ->setStatusCode(201)
            ->header('Location', url("/api/courses/{$course->id}"));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->fill($request->validated());
        $course->save();
        return new CourseResource($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->noContent();
    }
}
