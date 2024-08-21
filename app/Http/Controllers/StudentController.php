<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\StudentResource;
use App\Http\Resources\ClassesResource;
use App\Http\Requests\StudentFormRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studentQuery = Student::query();
        $this->applySearch($studentQuery, $request->search);
        $students = StudentResource::collection($studentQuery->paginate(10));
        //Resource classes are used to transform data from your models into a consistent and customizable JSON format before sending it as a response.
        // This helps ensure that your API returns data in a way that’s easy to consume by frontend applications or other services.

        //StudentResource::collection()
        // Transforming Collections: StudentResource::collection(...) wraps the collection of Student models (in this case, a paginated collection) in the StudentResource class.
        // This means each Student model in the collection will be transformed using the toArray method defined in the StudentResource class.

        return inertia('Students/Index', [
            'students' => $students,
            'search' => $request->search ?? '',
        ]);
        //Laravel’s pagination method automatically includes metadata in the response,
        //such as the total number of pages, the current page, and links to the next/previous pages.
    }

    protected function applySearch(Builder $query, $search){
        return $query->when($search, function ($query, $search){
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
        });

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassesResource::collection(Classes::all());
        return inertia('Students/Create', [
            'classes' => $classes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentFormRequest $request)
    {
        $student = Student::create($request->validated());
        return redirect()->route('students.index');
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
        $student = Student::find($id);
        $classes = ClassesResource::collection(Classes::all());
        return inertia('Students/Edit', [
           'student' => $student,
            'classes' => $classes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}
