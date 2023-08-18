@extends('layouts.app')

@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Edit School Administrator Form</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('school-help.index')}}">Home</a></li>
        <li class="breadcrumb-item">Edit School Administrator Form</li>
      </ol>
    </div>

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('school-admins.update', $schoolAdmin->id)}}">
                        @csrf
                        @method('PUT')

                        @php
                            use Carbon\Carbon;
                            $now = Carbon::now();
                        @endphp
                        <input name="email_verified_at" value="{{$now->toDateTimeString()}}" type="hidden">

                        @foreach($userName  as $users)
                            <div class="form-group">
                                <label for="fullname">Username</label>
                                <span type="text" class="form-control">{{$users->username}}</span>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                            id="exampleInputEmail1" aria-describedby="emailHelp" name="fullname" value="{{$schoolAdmin->fullname}}">

                            @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @foreach($userName  as $users)
                            <div class="form-group">
                                <label for="fullname">Phone</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" value="{{$users->phone}}">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="fullname">Email</label>
                                <span type="text" class="form-control">{{$users->email}}</span>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="fullname">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="exampleInputEmail1" aria-describedby="emailHelp" name="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fullname">Retype Passowrd</label>
                            <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation">
                        </div>

                        {{-- Masih Belum Nemu --}}
                        <div class="form-group">
                            <label for="schoolAddress">School Name</label>
                            <select class="select2-single form-control @error('schoolID') is-invalid @enderror"
                                name="schoolID" id="select2Single">>
                                <option value="">Select School</option>
                                @foreach($schoolName as $school)
                                    {{-- <option value="{{$school->id}}">{{$school->schoolName}}</option> --}}
                                    <option {{old('schoolID', $schoolAdmin->schoolID) == $school->id ? 'selected' : ''}}
                                        value="{{$school->id}}">{{$school->schoolName}}</option>
                                @endforeach
                            </select>

                            @error('schoolID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" class="form-control @error('position') is-invalid @enderror"
                            id="exampleInputPassword1" name="position" value="{{$schoolAdmin->position}}">

                            @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input class="btn btn-success" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
