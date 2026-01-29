<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    public function index()
    {
        return StudentResource::collection(Student::query()->orderBy('id')->paginate(15));
    }

    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        return (new StudentResource($student))
            ->response()
            ->setStatusCode(201)
            ->header('Location', url("/api/students/{$student->id}"));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->fill($request->validated());
        $student->save();
        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }
}
