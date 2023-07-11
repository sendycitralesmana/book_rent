@extends('layouts/main')

@section('title', 'Book Return')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Book Return Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Book Return Page</li>
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
                <h3 class="card-title">Rent Logs Data</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('status'))
                <div class="alert {{ session('status') }}" role="alert">
                    <button type="button" class="btn {{ session('btn-class') }} close" data-dismiss="alert" sty>&times;</button>
                    {{Session::get('message')}}
                </div>
                @endif
                <form role="form" method="POST" action="/book-return/create">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>User</label>
                            <select name="user_id"class="form-control userbox">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value=" {{ $user->id }} "> {{ $user->username }} </option>
                                @endforeach
                            </select>
                            @if($errors->has('user_id'))
                            <span class="help-block" style="color: red">{{ $errors->first('user_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Book</label>
                            <select name="book_id"class="form-control">
                                <option value="">Select Book</option>
                                @foreach ($books as $book)
                                    <option value=" {{ $book->id }} ">  {{ $book->book_code }} {{ $book->title }} </option>
                                @endforeach
                            </select>
                            @if($errors->has('book_id'))
                            <span class="help-block" style="color: red">{{ $errors->first('book_id') }}</span>
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
