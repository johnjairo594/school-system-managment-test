<h1 class="ms-4 mb-4">Student Subjects</h1>
<div class="row">
    @foreach($subjects as $subject)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <i class="{{ $subject->description }} fs-1"> </i>
                    <a href="{{ route('subject.show', ['subjectId' => $subject->id]) }}" class="card-title h4">{{ $subject->name }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
