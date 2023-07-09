@extends('layouts/main')

@section('title', 'Dashboard')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3> {{ $bookCount }} </h3>
  
                  <p>Books</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-book-outline"></i>
                </div>
                <a href="/books" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3> {{ $categoryCount }} </h3>
  
                  <p>Categories</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-list-outline"></i>
                </div>
                <a href="/categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3> {{ $userCount }} </h3>
  
                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-stalker"></i>
                </div>
                <a href="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rent Logs</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Users</th>
                            <th>Book Title</th>
                            <th>Rent Date</th>
                            <th>Return Date</th>
                            <th>Actual Return Date</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentLog as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->user_id }}</td>
                            <td>{{ $data->book_id }}</td>
                            <td>{{ $data->rent_date }}</td>
                            <td>{{ $data->return_date }}</td>
                            <td>{{ $data->actual_return_date }}</td>
                            <td>
                                    <a class="btn btn-info btn-sm" href="/students/{{ $data->id }}/detail">Detail</a>
                                    <a class="btn btn-warning btn-sm" href="/students/{{ $data->id }}/edit">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="/students/{{ $data->id }}/delete"
                                    onClick="return confirm('Anda Yakin ?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Users</th>
                            <th>Book Title</th>
                            <th>Rent Date</th>
                            <th>Return Date</th>
                            <th>Actual Return Date</th>
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
