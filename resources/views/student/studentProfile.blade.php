@extends('layout.master')

@section('custom_css')
    <link rel="stylesheet" href="{{ url('') }}/assets/css/profile.css">
@endsection

@php
$student = auth()->user();
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
                    <h2 class="profile-name">{{ $student->fullName }}</h2>
                    <h4 class="profile-major">{{ $student->subject->name }}</h4>
                </div>
                <div class="profile-content mb-3">
                    <ul class="profile-detail">
                        <li><span class="profile-label">Email: </span> {{ $student->email }}</li>
                        <li><span class="profile-label">Ngày sinh: </span> {{ date('d/m/Y', strtotime($student->dateOfBirth)) }}</li>

                    </ul>
                </div>

                <div class="button">
                    <a class="btn btn-primary w-50" href="{{ route('StudentUpdateProfile') }}" >Chỉnh sửa thông tin sinh viên </a>
                </div>

            </div>

        </div>

    </div>
@endsection
