@extends('layouts.app')

@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Schools Table</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('school-help.index')}}">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">Schools Table</li>
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

    <!-- Row -->
    <div class="row">
      <!-- DataTable with Hover -->
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a class="btn btn-success btn-sm" href="{{route('schools.create')}}">Add School</a>
          </div>
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                  <th>School Name</th>
                  <th>School Address</th>
                  <th>School City</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>School Name</th>
                    <th>School Address</th>
                    <th>School City</th>
                    <th>Option</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($school as $dataSchool)
                    <tr>
                        <td>{{$dataSchool->schoolName}}</td>
                        <td>{{$dataSchool->schoolAddress}}</td>
                        <td>{{$dataSchool->schoolCity}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route('schools.show', $dataSchool->id)}}"><i class="nav-icon fas fa-eye"></i></a>
                            <a class="btn btn-warning btn-sm" href=""><i class="nav-icon fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="nav-icon fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--Row-->

@endsection
