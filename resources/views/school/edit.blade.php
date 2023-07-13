@extends('layouts.app')

@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Update School Form</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('school-help.index')}}">Home</a></li>
        <li class="breadcrumb-item">Update School Form</li>
      </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('schools.update', $school->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="schoolName">School Name</label>
                            <input type="text" class="form-control @error('schoolName') is-invalid @enderror"
                            id="exampleInputEmail1" aria-describedby="emailHelp" name="schoolName" value="{{$school->schoolName}}">

                            @error('schoolName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="schoolAddress">School Address</label>
                            <input type="text" class="form-control @error('schoolAddress') is-invalid @enderror"
                            id="exampleInputPassword1" name="schoolAddress" value="{{$school->schoolAddress}}">

                            @error('schoolAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="schoolCity">School City</label>
                            <input type="text" class="form-control" class="form-control @error('schoolCity') is-invalid @enderror"
                            id="exampleInputPassword1" name="schoolCity" value="{{$school->schoolCity}}">

                            @error('schoolCity')
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
