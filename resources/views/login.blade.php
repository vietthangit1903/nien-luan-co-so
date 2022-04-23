@extends('layout.master')

@section('content')
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        @isset($url)
                            <form class="row g-3 needs-validation" method="POST" action="{{ route('LectureLogin') }}"
                                id="login_form" novalidate>
                            @else
                                <form class="row g-3 needs-validation" method="POST" action="{{ route('student.studentLogin') }}" id="login_form" novalidate>
                                @endisset
                                <div class="title">
                                    <h3 class="text-center">Đăng nhập</h3>
                                    <p class="text-center">
                                        Đăng nhập tài khoản để có thể sử dụng chức năng của hệ thống
                                    </p>
                                </div>
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        type="email" id="email" placeholder="Nhập email" value="{{ old('email') }}" />
                                    <label for="email">Email</label>
                                    <div class="form-message  @error('email') invalid-feedback @enderror">
                                        @error('email')
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

                                <div class="form-check mb-3 ms-2">
                                    <input class="form-check-input" type="checkbox" value="true" name="remember"
                                        id="remember">
                                    <label class="form-check-label" for="remember">
                                        Nhớ tài khoản
                                    </label>
                                </div>

                                <div class="button">
                                    <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
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
            form: '#login_form',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email', 'Email sai định dạng'),

                Validator.isRequired('#password', 'Vui lòng nhập mật khẩu')
            ]
        });
    </script>
@endsection
