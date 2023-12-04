<div class="h1 d-inline">Grades for {{ $subject->name }}</div>
<a href="/" class="btn btn-outline-secondary ms-3 mb-3">
    Return
</a>
<table class="table">
    <thead>
    <tr>
        <th>Student</th>
        <th>Date</th>
        <th>Score</th>
    </tr>
    </thead>
    <tbody>
    @foreach($grades as $grade)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $grade->date }}</td>
            <td>{{ $grade->score }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@if($grades->isNotEmpty())
    <div class="text-end mt-4">
        <p>Average: {{ number_format($average, 2) }}</p>
    </div>
@endif
