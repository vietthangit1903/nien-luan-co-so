@extends('layout.master')

@section('custom_css')
    <link rel="stylesheet" href="{{ url('') }}/assets/css/profile.css">
@endsection

@php
$lecture = auth('lecture')->user();
@endphp

@section('content')
    <div class="col-lg-8 offset-lg-2">
        <div class="row">
            <div class="profile-img col-5">
                {{-- <form action=""> --}}
                <img src="{{ url('') }}/assets/img/default-user-image.png" alt="">
                {{-- <div class="file btn btn-lg btn-primary">
                        Đổi hình ảnh
                        <input type="file" name="file" />
                    </div> --}}
                {{-- </form> --}}
            </div>
            <div class="profile-content col-7">
                <div class="profile-info mb-3">
                    <h2 class="profile-name">{{ $lecture->fullName }}</h2>
                    <h4 class="profile-major">{{ $lecture->subject->name }}</h4>
                </div>
                <div class="profile-content mb-3">
                    <ul class="profile-detail">
                        <li><span class="profile-label">Email: </span> {{ $lecture->email }}</li>
                        <li><span class="profile-label">Học hàm: </span> {{ $lecture->academic->name }}</li>
                        <li><span class="profile-label">Chức vụ: </span> {{ $lecture->position->name }}</li>
                    </ul>
                </div>

                <div class="button">
                    <a class="btn btn-primary w-50" href="#" >Cập nhật thông tin giảng viên </a>
                </div>

            </div>

        </div>

    </div>
@endsection
