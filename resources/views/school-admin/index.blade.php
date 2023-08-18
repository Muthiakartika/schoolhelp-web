@extends('layouts.app')

@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">School Admins Table</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('school-help.index')}}">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">School Admins Table</li>
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
                    <a class="btn btn-success btn-sm" href="{{route('school-admins.create')}}">Register School Administrator</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>School Name</th>
                                <th>Position</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>School Name</th>
                                <th>Position</th>
                                <th>Option</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($schoolAdmin as $schoolAdm)
                                <tr>
                                    <td>{{$schoolAdm->fullname}}</td>
                                    <td>{{ $schoolAdm->school ? $schoolAdm->school->schoolName : 'N/A' }}</td>
                                    <td>{{$schoolAdm->position}}</td>
                                    <td>
                                        <a class="btn btn-sm" href="{{route('school-admins.show', $schoolAdm->id)}}" title="Show Admin"><i class="nav-icon fas fa-eye text-primary"></i></a>
                                        <a class="btn btn-sm" href="{{route('school-admins.edit', $schoolAdm->id)}}" title="Edit School"><i class="nav-icon fas fa-edit text-warning"></i></a>
                                        <form method="POST" id="delete-form" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm" onclick="showDeleteConfirmation('{{ route('school-admins.destroy', $schoolAdm->id)}}')">
                                                <i class="nav-icon fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--Row-->
<!-- Sweet Alert Modal -->
<script type="text/javascript">
    function showDeleteConfirmation(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this data!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                // Submit the delete form
                document.getElementById('delete-form').action = url;
                document.getElementById('delete-form').submit();
                resolve();
            });
        }
    });
}
</script>
@endsection
