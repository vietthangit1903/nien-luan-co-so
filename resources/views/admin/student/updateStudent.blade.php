@extends('layout.master')

@section('content')
    <div class="account-register section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="update-form">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.updateStudent') }}" id="form_update" novalidate>
                            <div class="title">
                                <h3 class="text-center">Chỉnh sửa thông tin sinh viên</h3>
                            </div>
                            <div class="col-5 mb-3 action">
                                <button type="button" class="btn btn-primary">
                                    <a href="{{ route('admin.studentList') }}">Xem danh sách sinh viên <i
                                            class="fa-solid fa-list"></i></a>
                                </button>
                            </div>
                            @csrf
                            <h5>Họ và tên: <b>{{ $student->fullName }}</b></h5>
                            <h5>Email: <b>{{ $student->email }}</b></h5>

                            <input type="hidden" name="id" value="{{ $student->id }}">

                            <div class="form-floating mb-3">
                                <select name="subject_id" id="subject"
                                    class="form-control @error('subject') is-invalid @enderror">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ $student->subject_id == $subject->id ? 'selected' : '' }}>
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

