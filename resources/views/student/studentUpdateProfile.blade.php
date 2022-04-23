@extends('layout.master')

@php
$student = auth()->user();
@endphp

@section('content')
    <div class="account-register section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    @isset($saveError)
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $saveError }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endisset
                    <div class="update-form">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('StudentUpdateProfile') }}" id="form_update" novalidate>
                            <div class="title">
                                <h3 class="text-center">Chỉnh sửa thông tin sinh viên</h3>
                            </div>
                            <div class="button">
                                <a class="btn btn-primary" href="{{ route('StudentProfile') }}"><i class="fa-solid fa-angle-left"></i> Trở về</a>
                            </div>
                            @csrf

                            <div class="form-floating mb-3">
                                <input class="form-control @error('fullName') is-invalid @enderror" name="fullName"
                                    type="text" id="fullName" placeholder="Nhập họ và tên"
                                    value="{{ old('fullName') ?? $student->fullName }}" />
                                <label for="fullName">Họ tên</label>
                                <div class="form-message  @error('fullName') invalid-feedback @enderror">
                                    @error('fullName')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth"
                                    type="date" id="dateOfBirth" placeholder="Nhập ngày sinh"
                                    value="{{ old('dateOfBirth') ?? $student->dateOfBirth }}" />
                                <label for="dateOfBirth">Ngày sinh</label>
                                <div class="form-message  @error('dateOfBirth') invalid-feedback @enderror">
                                    @error('dateOfBirth')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="button">
                                <button class="btn btn-primary w-100" type="submit">Cập nhật thông tin sinh viên</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        Validator({
            form: '#form_update',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullName', 'Vui lòng nhập họ và tên'),

                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email', 'Email sai định dạng'),

                Validator.isDate('#dateOfBirth', 'Sai định dạng ngày tháng năm sinh')
            ]
        });
    </script>
@endsection
