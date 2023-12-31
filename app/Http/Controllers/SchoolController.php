<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = School::all();
        return view('school.index', compact('school'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'schoolName' => ['required', 'max:100'],
            'schoolAddress' => ['required', 'max:100'],
            'schoolCity' => ['required', 'max:20']
        ]);

        School::create($request->all());

        return redirect()->route('schools.index')
        ->with('success', 'School data have been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('school.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('school.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'schoolName' => ['required', 'max:100'],
            'schoolAddress' => ['required', 'max:100'],
            'schoolCity' => ['required', 'max:20']
        ]);

        $school->update($request->all());
        return redirect()->route('schools.index')
        ->with('success', 'School data have been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the school
        $school = School::findOrFail($id);

        // Delete the school
        $school->delete();

        // Redirect or perform additional actions
        return redirect()->route('schools.index')
        ->with('success', 'School data have been deleted');
    }
}
