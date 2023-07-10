@extends('layouts/main')

@section('title', 'Users')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registered User</h3>
                <div class="card-tools">
                    <a href="/users" class="btn btn-primary">Approved User</a>
                    <a href="/users/show-banned" class="btn btn-info">Show Banned User</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn btn-success close" data-dismiss="alert" sty>&times;</button>
                    {{Session::get('message')}}
                </div>
                @endif
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->username }}</td>
                            <td>
                                @if ($data->phone)
                                    {{ $data->phone }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="/users/{{ $data->slug }}/detail">Detail</a>
                                <a class="btn btn-danger btn-sm" href="/users/{{ $data->slug }}/banned"
                                onClick="return confirm('Anda Yakin ?')">Banned</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
