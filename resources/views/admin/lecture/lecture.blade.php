@extends('admin.admin')

@section('dashboard')
    <h2 class="dashboard-title text-center p-2">Quản lý giảng viên</h2>


    <div class="col mb-3 action">
        <button type="button" class="btn btn-primary">
            <a href="{{ route('admin.createLecture') }}">Thêm giảng viên <i class="fa-solid fa-plus"></i></a>
        </button>
    </div>
    <!-- Table -->
    <div class="list">
        @include('admin.lecture.lecture-table')
    </div>
    <!-- End table -->
@endsection
