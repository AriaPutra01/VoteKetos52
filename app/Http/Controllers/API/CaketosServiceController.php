<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Candidate;

class CaketosServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return self::candidate()
            ->join('student', function ($join) {
                $join->on('student.id', '=', 'candidates.student_id');
            })
            ->join('user_students', function ($join) {
                $join->on('student.id', '=', 'user_students.student_id');
            })
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        return self::candidate()->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, string $id)
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

    private function candidate()
    {
        return new Candidate;
    }
}
