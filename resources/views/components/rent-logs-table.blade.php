<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Book</th>
            <th>Rent Date</th>
            <th>Return Date</th>
            <th>Actual Return Date</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rent as $data)
        <tr class="{{ $data->actual_return_date == null ? '' : 
        ($data->return_date < $data->actual_return_date ? 'bg-danger' : 'bg-success')  }}">
            <td>{{ $data->id }}</td>
            <td>{{ $data->user->username }}</td>
            <td>{{ $data->book->title }}</td>
            <td>{{ $data->rent_date }}</td>
            <td>{{ $data->return_date }}</td>
            <td>{{ $data->actual_return_date }}</td>
            <td>
                <a class="btn btn-warning btn-sm" href="/books/{{ $data->slug }}/edit">Edit</a>
                <a class="btn btn-danger btn-sm" href="/books/{{ $data->slug }}/delete"
                onClick="return confirm('Anda Yakin ?')">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Book</th>
            <th>Rent Date</th>
            <th>Return Date</th>
            <th>Actual Return Date</th>
            <th>Option</th>
        </tr>
    </tfoot>
</table>