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
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.editSemester') }}" id="form_update" novalidate>
                            <div class="title">
                                <h3 class="text-center">Chỉnh sửa thông tin học kỳ</h3>
                            </div>
                            <div class="col-5 mb-3 action">
                                <button type="button" class="btn btn-primary">
                                    <a href="{{ route('admin.showSemester') }}">Xem danh sách học kỳ <i
                                            class="fa-solid fa-list"></i></a>
                                </button>
                            </div>
                            @csrf
                            <h5>Học kỳ: <b>{{ $semester->semester_no }}</b></h5>
                            <h5>Năm học: <b>{{ $semester->semester_name }}</b></h5>

                            <input type="hidden" name="id" value="{{ $semester->id }}">

                            <div class="form-floating mb-3">
                                <input class="form-control @error('time_start_give_topic') is-invalid @enderror"
                                    name="time_start_give_topic" type="date" id="time_start_give_topic"
                                    placeholder="Thời gian giảng viên bắt đầu nhập niên luận"
                                    value="{{ old('time_start_give_topic') ?? isset($semester->time_start_give_topic) ? date('Y-m-d', strtotime($semester->time_start_give_topic)) : '' }}" />
                                <label for="time_start_give_topic">Thời gian giảng viên bắt đầu nhập niên luận</label>
                                <div class="form-message  @error('time_start_give_topic') invalid-feedback @enderror">
                                    @error('time_start_give_topic')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('time_end_give_topic') is-invalid @enderror"
                                    name="time_end_give_topic" type="date" id="time_end_give_topic"
                                    placeholder="Thời gian giảng viên kết thúc nhập niên luận"
                                    value="{{ old('time_end_give_topic') ?? isset($semester->time_end_give_topic) ? date('Y-m-d', strtotime($semester->time_end_give_topic)) : ''  }}" />
                                <label for="time_end_give_topic">Thời gian giảng viên kết thúc nhập niên luận</label>
                                <div class="form-message  @error('time_end_give_topic') invalid-feedback @enderror">
                                    @error('time_end_give_topic')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('time_start_reg_topic') is-invalid @enderror"
                                    name="time_start_reg_topic" type="date" id="time_start_reg_topic"
                                    placeholder="Thời gian sinh viên bắt đầu đăng ký niên luận"
                                    value="{{ old('time_start_reg_topic') ?? isset($semester->time_start_reg_topic) ? date('Y-m-d', strtotime($semester->time_start_reg_topic)) : ''  }}" />
                                <label for="time_start_reg_topic">Thời gian sinh viên bắt đầu đăng ký niên luận</label>
                                <div class="form-message  @error('time_start_reg_topic') invalid-feedback @enderror">
                                    @error('time_start_reg_topic')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('time_end_reg_topic') is-invalid @enderror"
                                    name="time_end_reg_topic" type="date" id="time_end_reg_topic"
                                    placeholder="Thời gian sinh viên kết thúc đăng ký niên luận"
                                    value="{{ old('time_end_reg_topic') ?? isset($semester->time_end_reg_topic) ? date('Y-m-d', strtotime($semester->time_end_reg_topic)) : ''  }}" />
                                <label for="time_end_reg_topic">Thời gian sinh viên kết thúc đăng ký niên luận</label>
                                <div class="form-message  @error('time_end_reg_topic') invalid-feedback @enderror">
                                    @error('time_end_reg_topic')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div class="button">
                                <button class="btn btn-primary w-100" type="submit">Chỉnh sửa thông tin học kỳ</button>
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

                Validator.isDate('#time_start_give_topic', 'Ngày sai định dạng'),
                Validator.isDate('#time_end_give_topic', 'Ngày sai định dạng'),
                Validator.isDate('#time_start_reg_topic', 'Ngày sai định dạng'),
                Validator.isDate('#time_end_reg_topic', 'Ngày sai định dạng'),
            ]
        });
    </script>
@endsection
