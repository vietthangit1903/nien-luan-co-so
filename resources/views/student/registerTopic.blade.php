@extends('layout.master')

@section('content')
    <div class="row">
        <h2 class="text-center p-2">Danh sách niên luận</h2>
        <div class="col-5 mb-3 action w-100">
            <button type="button" class="btn btn-primary">
                <a href="{{ route('StudentPage') }}"><i class="fa-solid fa-book-open-reader"></i> Trang sinh viên </a>
            </button>

        </div>
        <h5>Học kỳ: <b>{{ $current_semester->semester_no }}</b>, Năm học: <b>{{ $current_semester->semester_name }}</b>
        </h5>
        <hr>

        @include('student.registerTopic-table')

    </div>
@endsection
