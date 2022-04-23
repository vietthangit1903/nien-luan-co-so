@extends('layout.master')

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
                    <div class="register-form">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('student.registerStudent') }}" id="form_register" novalidate>
                            <div class="title">
                                <h3 class="text-center">Đăng ký tài khoản sinh viên</h3>
                                <p class="text-center">Đăng ký tài khoản để có thể sử dụng các chức năng của hệ thống</p>
                            </div>
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control @error('fullName') is-invalid @enderror" name="fullName"
                                    type="text" id="fullName" placeholder="Nhập họ và tên"
                                    value="{{ old('fullName') }}" />
                                <label for="fullName">Họ tên</label>
                                <div class="form-message  @error('fullName') invalid-feedback @enderror">
                                    @error('fullName')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                                    id="email" placeholder="Nhập email" value="{{ old('email') }}" />
                                <label for="email">Email</label>
                                <div class="form-message  @error('email') invalid-feedback @enderror">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth"
                                    type="date" id="dateOfBirth" placeholder="Nhập ngày sinh"
                                    value="{{ old('dateOfBirth') }}" />
                                <label for="dateOfBirth">Ngày sinh</label>
                                <div class="form-message  @error('dateOfBirth') invalid-feedback @enderror">
                                    @error('dateOfBirth')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="subject_id" id="subject"
                                    class="form-control @error('subject_id') is-invalid @enderror">
                                    <option value="" selected>Chọn bộ môn</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                <label for="subject">Bộ môn</label>
                                <div class="form-message @error('subject_id') invalid-feedback @enderror">
                                    @error('subject_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    name="password" id="password" placeholder="Nhập mật khẩu"
                                    value="{{ old('password') }}" />
                                <label for="password">Mật khẩu</label>
                                <div class="form-message @error('password') invalid-feedback @enderror ">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                    type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Nhập lại mật khẩu" value="{{ old('password_confirmation') }}" />
                                <label for="password">Nhập lại mật khẩu</label>
                                <div class="form-message @error('password_confirmation') invalid-feedback @enderror ">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="button">
                                <button class="btn btn-primary w-100" type="submit">Đăng ký tài khoản</button>
                            </div>

                            <p class="outer-link">
                                Đã có tài khoản? <a href="#">Đăng nhập ngay</a>
                            </p>
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
            form: '#form_register',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullName', 'Vui lòng nhập họ và tên'),

                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email', 'Email sai định dạng'),

                Validator.isDate('#dateOfBirth', 'Sai định dạng ngày tháng năm sinh'),

                Validator.isRequired('#subject', 'Vui lòng chọn bộ môn'),

                Validator.isRequired('#password', 'Vui lòng nhập mật khẩu mới'),
                Validator.isPassword('#password'),

                Validator.isRequired('#password_confirmation', 'Vui lòng lại nhập mật khẩu mới'),
                Validator.isConfirmed('#password_confirmation', function() {
                    return document.querySelector('#form_register #password').value;
                }, 'Mật khẩu nhập lại không chính xác')
            ]
        });
    </script>
@endsection
