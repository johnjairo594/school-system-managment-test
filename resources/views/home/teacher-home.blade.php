<h1 class="ms-4 mb-4">Student list</h1>
<table id="teacher-table" class="table">
    <thead>
    <tr>
        <th>Student</th>
        <th>Email</th>
        <th>Average</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->average }}</td>
            <td>@include('home.dt-action')</td>
        </tr>
    @endforeach
    </tbody>
</table>
