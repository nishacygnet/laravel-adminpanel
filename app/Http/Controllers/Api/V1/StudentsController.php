<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\StudentsResource;
use App\Models\Student\Student;
use App\Repositories\Backend\Student\StudentRepository;
use Illuminate\Http\Request;
use Validator;

class StudentsController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the Students.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        return StudentsResource::collection(
            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param student
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Student $student)
    {
        return new StudentsResource($student);
    }

    /**
     * Creates the Resource for Student.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validation = $this->validateStudent($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
         //dd($request->token);
        $this->repository->create($request->all());

        return new StudentsResource(Student::orderBy('created_at', 'desc')->first());
    }

    /**
     * Update Student.
     *
     * @param student
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Student $student)
    {
        $validation = $this->validateStudent($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($student, $request->all());

        $student = Student::findOrfail($student->id);

        return new StudentsResource($student);
    }

    /**
     * Delete Student.
     *
     * @param Student     $student
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Student $student, Request $request)
    {
        $this->repository->delete($student);

        return $this->respond([
            'message' => trans('alerts.backend.students.deleted'),
        ]);
    }

    /**
     * validate Student.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateStudent(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'gender'     => 'required',
            'standard'   => 'required'  
        ]);

        return $validation;
    }
}
