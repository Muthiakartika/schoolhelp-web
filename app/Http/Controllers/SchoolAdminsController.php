<?php

namespace App\Http\Controllers;

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
            'position' => 'required',
            'rule' => 'required',
            'email_verified_at' => 'required'
        ]);
        $request['password'] = bcrypt($request->password);

        // menambahkan school admin baru di database user
        User::where('id', $request->user()['id'])->updateOrCreate([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'rule' => $request->rule,
            'email_verified_at' => $request->email_verified_at
        ]);

        // menambahkan school admin
        schoolAdmins::create([
            'fullname' => $request->fullname,
            'schoolID' => $request->schoolID,
            'position' => $request->position
        ]);
        return redirect()->route('school-admins.index')
            ->with('success', "Data have been created");

        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\schoolAdmins  $schoolAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(schoolAdmins $schoolAdmin)
    {
        $schoolAdmin->load('school');
        return view('school-admin.show', compact('schoolAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\schoolAdmins  $schoolAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(schoolAdmins $schoolAdmin)
    {
        $schoolName = DB::table('schools')->get();
        $userName = User::where('fullname', $schoolAdmin->pluck('fullname'))->get();
        return view('school-admin.edit', compact('schoolName', 'schoolAdmin', 'userName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\schoolAdmins  $schoolAdmins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //validasi
         $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'password' => ['Required', 'min:8', 'confirmed'],
            'schoolID' => 'required',
            'position' => 'required',
        ]);
        $request['password'] = bcrypt($request->password);

        $schoolAdmins = schoolAdmins::findOrFail($id);
        $user = User::where('fullname', $schoolAdmins->pluck('fullname'))->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'password' => $request->password
        ]);

        $schoolAdmins->fullname = $request->fullname;
        $schoolAdmins->schoolID = $request->schoolID;
        $schoolAdmins->position = $request->position;
        $schoolAdmins->timestamps;

        $schoolAdmins->save();
        return redirect()->route('school-admins.index')
        ->with('success', "Data have been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\schoolAdmins  $schoolAdmins
     * @return \Illuminate\Http\Response
     */
    public function destroy($fullname)
    {

        $schoolAdmins = schoolAdmins::findOrFail($fullname);
        $user = User::where('fullname', $schoolAdmins->fullname)->get();

        // MENGHAPUS DATA USER BERDASARKAN NAME YANG DIPILIH
        DB::table('users')->whereIn('fullname', $user->pluck('fullname'))->delete();
        // MENGHAPUS DATA STAFF BERDASARKAN NAME YANG DIPILIH
        schoolAdmins::where('fullname', $schoolAdmins->fullname)->delete();

        return redirect()->route('school-admins.index')
        ->with('success', "Data have been deleted");
    }
}
