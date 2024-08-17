<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use App\Models\User;
use App\Models\Student;
use App\Models\Classes;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = StudentResource::collection(Student::paginate(10));
        //Resource classes are used to transform data from your models into a consistent and customizable JSON format before sending it as a response.
        // This helps ensure that your API returns data in a way that’s easy to consume by frontend applications or other services.

        //StudentResource::collection()
        // Transforming Collections: StudentResource::collection(...) wraps the collection of Student models (in this case, a paginated collection) in the StudentResource class.
        // This means each Student model in the collection will be transformed using the toArray method defined in the StudentResource class.

        return inertia('Students/Index', [
            'students' => $students,
        ]);
        //Laravel’s pagination method automatically includes metadata in the response,
        //such as the total number of pages, the current page, and links to the next/previous pages.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
