<div class="h1 ms-4 mb-4 d-inline">{{ $student->name }} Subjects</div>
<a href="/" class="btn btn-outline-secondary ms-4 mb-3">Return</a>
<div class="row">
    @foreach($subjects as $subject)
        <div class="col-md-3 mb-5">
            <div class="card">
                <div class="card-body">
                    <i class="{{ $subject->description }} fs-1"> </i>
                    <a href="#" class="card-title h4 subject-link"
                       data-subject-id="{{ $subject->id }}"
                       data-subject-name="{{ $subject->name }}"
                       data-student-id="{{ $student->id }}">
                        {{ $subject->name }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div id="grade-title" class="d-inline"></div>
<div id="add-button" class="d-inline ms-3"></div>
<table id="grades-table" class="d-none table">
    <thead>
    <tr>
        <th>Date</th>
        <th>Score</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

