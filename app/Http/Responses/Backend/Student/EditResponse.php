<?php

namespace App\Http\Responses\Backend\Student;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Student\Student
     */
    protected $students;
     protected $standard;
    /**
     * @param App\Models\Student\Student $students
     */
    public function __construct($students,$standard)
    {
        $this->students = $students;
         $this->standard = $standard;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        //dd("here");
        return view('backend.students.edit')->with([
            'students' => $this->students,
            'standard' => $this->standard,
        ]);
    }
}