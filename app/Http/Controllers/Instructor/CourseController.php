<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Level;
use App\Models\Price;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('user_id', Auth::id())->paginate(6);
        return view('instructor.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $levels = Level::all();
        $prices = Price::all();

        return view('instructor.courses.create', compact('categories', 'levels', 'prices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:courses,slug'],
            'category_id' => ['required', 'exists:categories,id'],
            'level_id' => ['required', 'exists:levels,id'],
            'price_id' => ['required', 'exists:prices,id'],
        ]);

        $data['user_id'] = Auth::id();

        $course = Course::create($data);

        return redirect()->route('instructor.courses.index')->with('success', 'Curso creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('instructor.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $levels = Level::all();
        $prices = Price::all();

        return view('instructor.courses.edit', compact('course', 'categories', 'levels', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:courses,slug,' . $course->id],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'level_id' => ['required', 'exists:levels,id'],
            'price_id' => ['required', 'exists:prices,id'],
        ]);

        if($request->hasFile('image')){
           if($course->image_path){
               Storage::delete($course->image_path);
           }
           $data['image_path'] = Storage::put('courses/images', $request->file('image'));
        }

        $course->update($data);

        // session()
        session()->flash('flash.banner', 'Curso actualizado correctamente.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('instructor.courses.index')->with('success', 'Curso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('instructor.courses.index')->with('success', 'Curso eliminado correctamente.');
    }
}
