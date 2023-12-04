@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                @can('teachers_permissions')
                    @include('home.teacher-home')
                @endcan
                @can('students_permissions')
                    @include('home.students-home')
                @endcan
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#teacher-table').DataTable({
                order: [[0, "desc"]],
                info: false,
                bPaginate: false,
            });
        });
    </script>
@endsection
