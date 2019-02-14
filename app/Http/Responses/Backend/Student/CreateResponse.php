<?php

namespace App\Http\Responses\Backend\Student;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 
     */
     protected $standard;

    public function __construct($standard)
    {
        $this->standard = $standard;
    }

    public function toResponse($request)
    {
        return view('backend.students.create')->with([
            'standard' => $this->standard,
        ]);
    }
}