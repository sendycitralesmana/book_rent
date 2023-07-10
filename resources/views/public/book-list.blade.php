@extends('layouts/main')

@section('title', 'Blank')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blank Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <form action="" method="GET" class="mb-2">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="input-group mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Search title's book">
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Default box -->
        <div class="">
            <div class="row">

                @foreach ($book as $data)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title"> {{ $data->book_code }} </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($data->cover != null)
                                <img src="{{ asset('storage/cover/'.$data->cover ) }}" draggable="false" style="width: 200px; margin: auto;
                                display: block; height:250px; align-items: center; justify-content: center;">
                                @else
                                <img src="{{ asset('images/no-cover.jpg' ) }}" draggable="false" style="width: 200px; margin: auto;
                                display: block; height:250px; align-items: center; justify-content: center;">
                                @endif
                                <p>{{ $data->title }}</p>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <p class="card-text text-right {{ $data->status == 'in stock' ? 'text-success' : 'text-danger' }}">{{ $data->status }}</p>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
