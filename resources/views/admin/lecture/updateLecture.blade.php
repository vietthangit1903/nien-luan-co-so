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
                    <div class="update-form">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.updateLecture') }}" id="form_update" novalidate>
                            <div class="title">
                                <h3 class="text-center">Chỉnh sửa thông tin giảng viên</h3>
                            </div>
                            <div class="col-5 mb-3 action">
                                <button type="button" class="btn btn-primary">
                                    <a href="{{ route('admin.showLectureList') }}">Xem danh sách giảng viên <i
                                            class="fa-solid fa-list"></i></a>
                                </button>
                            </div>
                            @csrf
                            <h5>Họ và tên: <b>{{ $lecture->fullName }}</b></h5>
                            <h5>Email: <b>{{ $lecture->email }}</b></h5>

                            <input type="hidden" name="id" value="{{ $lecture->id }}">

                            <div class="form-floating mb-3">
                                <select name="subject" id="subject"
                                    class="form-control @error('subject') is-invalid @enderror">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ $lecture->subject_id == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}</option>
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
                                    @foreach ($academics as $academic)
                                        <option value="{{ $academic->id }}"
                                            {{ $lecture->academic_id == $academic->id ? 'selected' : '' }}>
                                            {{ $academic->name }}</option>
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
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}"
                                            {{ $lecture->position_id == $position->id ? 'selected' : '' }}>
                                            {{ $position->name }}</option>
                                    @endforeach
                                </select>
                                <label for="position">Chức vụ</label>
                                <div class="form-message @error('position') invalid-feedback @enderror">
                                    @error('position')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $lecture->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="role">Phân quyền</label>
                                <div class="form-message @error('role') invalid-feedback @enderror">
                                    @error('role')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div class="button">
                                <button class="btn btn-primary w-100" type="submit">Cập nhật thông tin giảng viên</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ url('') }}/assets/js/validator.js"></script>
    <script>
        Validator({
            form: '#form_update',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#subject', 'Vui lòng chọn bộ môn'),

                Validator.isRequired('#academic', 'Vui lòng chọn học hàm'),

                Validator.isRequired('#position', 'Vui lòng chọn chức vụ'),

                Validator.isRequired('#role', 'Vui lòng chọn phân quyền')
            ]
        });
    </script>
@endsection
