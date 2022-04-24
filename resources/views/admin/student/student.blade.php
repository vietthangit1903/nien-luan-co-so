@extends('admin.admin')

@section('dashboard')
    <h2 class="dashboard-title text-center p-2">Quản lý sinh viên</h2>

    <!-- Table -->
    <div class="list">
        @include('admin.student.student-table')
    </div>
    <!-- End table -->
@endsection
