<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\CourseController;

/* Route::get('/', function () {
    return view('instructor.dashboard');
})->name('instructor.dashboard'); */

Route::redirect('/', '/instructor/courses')->name('home');

Route::resource('courses', CourseController::class, ['names' => [
    'index' => 'instructor.courses.index',
    'create' => 'instructor.courses.create',
    'store' => 'instructor.courses.store',
    'show' => 'instructor.courses.show',
    'edit' => 'instructor.courses.edit',
    'update' => 'instructor.courses.update',
    'destroy' => 'instructor.courses.destroy',
]]);