@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                @can('teachers_permissions')
                    @include('grades.teacher-grades')
                @endcan
                @can('students_permissions')
                    @include('grades.student-grades')
                @endcan
            </div>
        </div>
    </div>
@endsection
@can('teachers_permissions')
@section('js')
    <script>
        $(document).ready(function () {
            $('.subject-link').on('click', function (e) {
                e.preventDefault();

                let subjectId = $(this).data('subject-id');
                let subjectName = $(this).data('subject-name');
                let studentId = $(this).data('student-id');

                $.ajax({
                    url: '/api/get-grades',
                    type: 'GET',
                    data: {subject_id: subjectId, subject_name: subjectName, student_id: studentId},
                    success: function (data) {
                        renderDataTable(data, subjectName, subjectId);
                    },
                    error: function (error) {
                        console.error('Error en la solicitud AJAX', error);
                    }
                });
            });

            function renderDataTable(data, subjectName, subjectId) {
                $('#grade-title')
                    .empty()
                    .html('<div class="h3 d-inline">' + subjectName + ' Grades</div>');
                $('#add-button')
                    .empty()
                    .html('<button class="btn btn-primary btn-create mb-2" data-subject-id="' + subjectId + '" data-subject-name="' + subjectName + '"><i class="ri-add-circle-line"></i> Add a new grade</button>');

                $('#grades-table')
                    .removeClass('d-none')
                    .DataTable({
                        data: data,
                        info: false,
                        bPaginate: false,
                        destroy: true,
                        columns: [
                            {data: 'date', name: 'Date'},
                            {data: 'score', name: 'Score'},
                            {data: 'actions', name: 'actions', className: 'text-right'}
                        ],
                    });
            }

            $(document).on('click', '.btn-edit', function () {
                let gradeId = $(this).data('id');
                let gradeScore = $(this).data('score');

                Swal.fire({
                    title: 'Edit Grade',
                    html:
                        '<input id="swal-input" class="swal2-input" placeholder="New Score" value="' + gradeScore + '">',
                    showCancelButton: true,
                    confirmButtonText: 'Save Changes',
                    preConfirm: () => {
                        var newScore = $('#swal-input').val();
                        $.ajax({
                            url: '/grades/' + gradeId,
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                score: newScore,
                            },
                            success: function (response) {
                                var subjectName = response[0].subject_name;
                                var subjectId = response[0].subject_id;

                                renderDataTable(response, subjectName, subjectId);
                            },
                            error: function (error) {
                                console.error('Error en la solicitud AJAX', error);
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.btn-delete', function () {
                var gradeId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/delete-grades/' + gradeId,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                var subjectName = response[0].subject_name;
                                var subjectId = response[0].subject_id;


                                renderDataTable(response, subjectName, subjectId);
                            },
                            error: function (error) {
                                console.error('Error en la solicitud AJAX', error);
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.btn-create', function () {
                Swal.fire({
                    title: 'Add a New Grade',
                    html: '<input type="text" id="scoreInput" name="score" placeholder="Score" class="form-control" required>' +
                        '<input type="hidden" id="studentIdInput" value="{{ $student->id }}" >' +
                        '<input type="hidden" id="subjectIdInput" value="' + $(this).data('subject-id') + '">' +
                        '<input type="hidden" id="subjectNameInput" value="' + $(this).data('subject-name') + '">',

                    showCancelButton: true,
                    confirmButtonText: 'Create',
                    preConfirm: () => {
                        let score = $('#scoreInput').val();
                        let studentId = $('#studentIdInput').val();
                        let subjectId = $('#subjectIdInput').val();
                        let subjectName = $('#subjectNameInput').val();
                        return $.ajax({
                            url: '/grades',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                score: score,
                                student_id: studentId,
                                subject_id: subjectId
                            },
                            success: function (response) {
                                renderDataTable(response, subjectName, subjectId);
                            },
                            error: function (error) {
                                console.error('Error en la solicitud AJAX', error);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
@endcan

