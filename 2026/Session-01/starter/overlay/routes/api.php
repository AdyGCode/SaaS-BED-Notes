<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;

Route::apiResource('courses', CourseController::class);
Route::apiResource('students', StudentController::class);
