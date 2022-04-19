@extends('layout.master')

@section('content')
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        @isset($url)
                            <form class="row g-3 needs-validation" method="POST" action="{{ route('LectureChangePassword') }}" id="change_password_form" novalidate>
                            @else
                                <form class="row g-3 needs-validation" method="POST" action="#" id="change_password_form"
                                    novalidate>
                                @endisset
                                <div class="title">
                                    <h3 class="text-center">Đổi mật khẩu</h3>
                                </div>
                                @if(Session::has('firstLogin'))
                                    <p class="text-center">
                                        Bạn cần đổi mật khẩu để tăng độ bảo mật cho tài khoản
                                    </p>
                                @endif
                                @csrf

                                <div class="form-floating mb-3">
                                    <input class="form-control @error('current_password') is-invalid @enderror"
                                        type="password" name="current_password" id="current_password"
                                        placeholder="Nhập mật khẩu hiện tại" value="{{ old('current_password') }}" />
                                    <label for="current_password">Mật khẩu hiện tại</label>
                                    <div class="form-message @error('current_password') invalid-feedback @enderror ">
                                        @error('current_password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" id="password" placeholder="Nhập mật khẩu mới"
                                        value="{{ old('password') }}" />
                                    <label for="password">Mật khẩu mới</label>
                                    <div class="form-message @error('password') invalid-feedback @enderror ">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                        type="password" name="password_confirmation" id="password_confirmation"
                                        placeholder="Nhập mật khẩu" value="{{ old('password_confirmation') }}" />
                                    <label for="password">Nhập lại mật khẩu mới</label>
                                    <div class="form-message @error('password_confirmation') invalid-feedback @enderror ">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="button">
                                    <button class="btn btn-primary w-100" type="submit">Đổi mật khẩu</button>
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
            form: '#change_password_form',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#current_password', 'Vui lòng nhập mật khẩu hiện tại'),

                Validator.isRequired('#password', 'Vui lòng nhập mật khẩu mới'),
                Validator.isPassword('#password'),

                Validator.isRequired('#password_confirmation', 'Vui lòng lại nhập mật khẩu mới'),
                Validator.isConfirmed('#password_confirmation', function() {
                    return document.querySelector('#change_password_form #password').value;
                }, 'Mật khẩu nhập lại không chính xác')
            ]
        });
    </script>
@endsection
