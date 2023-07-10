@extends('layouts/main')

@section('title', 'Book')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Book Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Book Page</li>
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
                <h3 class="card-title">Book Data</h3>
                <div class="card-tools">
                    <a href="/books/add" class="btn btn-primary">Add Data</a>
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
                            <th>Book Code</th>
                            <th>Title</th>
                            <th>Cover</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->book_code }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->cover }}</td>
                            <td>
                                @foreach ($data->categories as $category)
                                    - {{ $category->name }} <br>
                                @endforeach
                            </td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="/books/{{ $data->slug }}/restore"
                                onClick="return confirm('Anda Yakin ?')">Restore</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Book Code</th>
                            <th>Title</th>
                            <th>Cover</th>
                            <th>Category</th>
                            <th>Status</th>
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
