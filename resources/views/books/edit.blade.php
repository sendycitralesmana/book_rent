@extends('layouts/main')

@section('title', 'Books')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Books Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Books Page</li>
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
                <h3 class="card-title">Books Edit Data</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="/books/{{ $book->slug }}/update" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Book Code</label>
                            <input type="text" name="book_code" class="form-control" placeholder="Enter Book Code" value="{{ $book->book_code }}">
                            @if($errors->has('book_code'))
                            <span class="help-block" style="color: red">{{ $errors->first('book_code') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ $book->title }}">
                            @if($errors->has('title'))
                            <span class="help-block" style="color: red">{{ $errors->first('title') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label style="display: block">Current Cover</label>
                            @if ($book->cover != '')
                                <img src="{{ asset('storage/cover/'.$book->cover) }}" style="width: 200px; height:250px">
                            @else
                                <img src="{{ asset('images/no-cover.jpg') }}" style="width: 200px; height:250px">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" name="cover" class="form-control" value="{{ $book->cover }}">
                            @if($errors->has('cover'))
                            <span class="help-block" style="color: red">{{ $errors->first('cover') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label>Current Category</label>
                            <ul>
                                @foreach ($book->categories as $item)
                                    <li> {{ $item->name }} </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            {{-- <select name="categories" class="form-control select-multiple" value="{{ old('categories') }}" multiple>
                                <option value="">Choose Category</option>
                                @foreach ($categories as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select> --}}
                            <div class="form-inline">
                            @foreach ($categories as $data)
                                <label class="mr-2 ml-2">{{ $data->name }}</label>
                                <input name="categories[]" type="checkbox" class="form-control mr-2" value="{{ $data->id }}"> |
                            @endforeach
                            <div>
                            @if($errors->has('categories'))
                            <span class="help-block" style="color: red">{{ $errors->first('categories') }}</span>
                            @endif
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
