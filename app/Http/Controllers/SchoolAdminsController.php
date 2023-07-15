<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\schoolAdmins;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $schoolAdmin = schoolAdmins::with('school')->get();

        return view('school-admin.index', compact('schoolAdmin'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schoolName = DB::table('schools')->get();
        return view('school-admin.create', compact('schoolName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validasi
         $request->validate([
            'username' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'Required',
            'password' => ['Required', 'min:8', 'confirmed'],
            'schoolID' => 'required',
            'position' => 'required'
        ]);
        $request['password'] = bcrypt($request->password);

        // menambahkan staff baru di database user
        User::where('id', $request->user()['id'])->updateOrCreate([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'rule' => $request->rule,
            'email_verified_at' => $request->email_verified_at,
        ]);

        // menambahkan staff
        schoolAdmins::create([
            'fullname' => $request->fullname,
            'schoolID' => $request->schoolID,
            'position' => $request->position,
        ]);
        return redirect()->route('school-admins.index')
            ->with('success', "Congrats.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\schoolAdmins  $schoolAdmins
     * @return \Illuminate\Http\Response
     */
    public function show(schoolAdmins $schoolAdmins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\schoolAdmins  $schoolAdmins
     * @return \Illuminate\Http\Response
     */
    public function edit(schoolAdmins $schoolAdmins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\schoolAdmins  $schoolAdmins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, schoolAdmins $schoolAdmins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\schoolAdmins  $schoolAdmins
     * @return \Illuminate\Http\Response
     */
    public function destroy(schoolAdmins $schoolAdmins)
    {
        //
    }
}
