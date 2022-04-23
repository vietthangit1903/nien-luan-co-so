@extends('admin.admin')

@section('dashboard')
    <h2 class="dashboard-title text-center p-2">Quản lý thời gian trong học kỳ</h2>

    <!-- Table -->
    <div class="list">
        @include('admin.semester.semester-table')
    </div>
    <!-- End table -->

@endsection
