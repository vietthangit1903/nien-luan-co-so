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
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.createLecture') }}" id="form_register" novalidate>
                            <div class="title">
                                <h3 class="text-center">Tạo giảng viên mới</h3>
                            </div>
                            <div class="col-5 mb-3 action">
                                <button type="button" class="btn btn-primary">
                                    <a href="{{ route('admin.showLectureList') }}">Xem danh sách giảng viên <i class="fa-solid fa-list"></i></a>
                                </button>
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
                                <select name="subject" id="subject"
                                    class="form-control @error('subject') is-invalid @enderror">
                                    <option value="" selected>Chọn bộ môn</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                <label for="subject">Bộ môn</label>
                                <div class="form-message @error('subject') invalid-feedback @enderror">
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="academic" id="academic"
                                    class="form-control @error('academic') is-invalid @enderror">
                                    <option value="" selected>Chọn học hàm</option>
                                    @foreach ($academics as $academic)
                                        <option value="{{ $academic->id }}">{{ $academic->name }}</option>
                                    @endforeach
                                </select>
                                <label for="academic">Học hàm</label>
                                <div class="form-message @error('academic') invalid-feedback @enderror">
                                    @error('academic')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="position" id="position"
                                    class="form-control @error('position') is-invalid @enderror">
                                    <option value="" selected>Chọn chức vụ</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                <label for="position">Chức vụ</label>
                                <div class="form-message @error('position') invalid-feedback @enderror">
                                    @error('position')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div class="button">
                                <button class="btn btn-primary w-100" type="submit"><i class="fa-solid fa-plus"></i> Tạo giảng viên mới</button>
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
            form: '#form_register',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullName', 'Vui lòng nhập họ và tên'),

                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email', 'Email sai định dạng'),

                Validator.isDate('#dateOfBirth', 'Sai định dạng ngày tháng năm sinh'),

                Validator.isRequired('#subject', 'Vui lòng chọn bộ môn'),

                Validator.isRequired('#academic', 'Vui lòng chọn học hàm'),

                Validator.isRequired('#position', 'Vui lòng chọn chức vụ')
            ]
        });
    </script>
@endsection
