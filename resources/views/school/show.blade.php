@extends('layouts.app')

@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Detail School Data</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('school-help.index')}}">Home</a></li>
        <li class="breadcrumb-item">Detail School Data</li>
      </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>
                <div class="card-body">
                    <form>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="schoolName">School Name</label>
                            <span type="text" class="form-control aria-describedby="emailHelp" name="schoolName" >{{$school->schoolName}}</span>
                        </div>

                        <div class="form-group">
                            <label for="schoolAddress">School Address</label>
                            <span type="text" class="form-control">{{$school->schoolAddress}}</span>
                        </div>

                        <div class="form-group">
                            <label for="schoolCity">School City</label>
                            <span type="text" class="form-control">{{$school->schoolCity}}</span>
                        </div>
                        <a href="{{route('schools.index')}}" class="btn btn-primary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
