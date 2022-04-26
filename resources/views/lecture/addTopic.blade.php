@extends('layout.master')

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="update-form">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('lecture.addTopic') }}" id="form_update" novalidate>
                            <div class="title">
                                <h3 class="text-center">Thêm niên luận</h3>
                            </div>
                            <div class="col-5 mb-3 action w-100">
                                <button type="button" class="btn btn-primary">
                                    <a href="{{ route('LecturePage') }}"><i class="fa-solid fa-chevron-left"></i> Trở
                                        về</a>
                                </button>
                                <button type="button" class="btn btn-primary">
                                    <a href="{{ route('lecture.topicList') }}">Xem danh sách niên luận <i class="fa-solid fa-list"></i></a>
                                </button>

                            </div>
                            @csrf
                            <h5>Học kỳ: <b>{{ $semester->semester_no }}</b></h5>
                            <h5>Năm học: <b>{{ $semester->semester_name }}</b></h5>
                            <h6>Ngày giảng viên bắt đầu nhập niên luận: <b>{{ date('d/m/Y', strtotime($semester->time_start_give_topic)) }}</b></h6>
                            <h6>Ngày giảng viên kết thúc nhập niên luận: <b>{{ date('d/m/Y', strtotime($semester->time_end_give_topic)) }}</b></h6>

                            <div class="form-floating mb-3">
                                <select name="topic_type_id" id="topic_type"
                                    class="form-control @error('topic_type') is-invalid @enderror">
                                    <option value="" selected>Chọn loại niên luận</option>
                                    @foreach ($topic_types as $topic_type)
                                        <option value="{{ $topic_type->id }}">
                                            {{ $topic_type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="topic_type">Loại niên luận</label>
                                <div class="form-message @error('topic_type') invalid-feedback @enderror">
                                    @error('topic_type')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                                    id="name" placeholder="Nhập tên niên luận" value="{{ old('name') }}" />
                                <label for="name">Tên niên luận</label>
                                <div class="form-message  @error('name') invalid-feedback @enderror">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="number" id="number"
                                    class="form-control @error('number') is-invalid @enderror">
                                    <option value="" selected>Chọn số lượng sinh viên tối đa</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">
                                            {{ $i }} sinh viên</option>
                                    @endfor

                                </select>
                                <label for="number">Số lượng sinh viên tối đa</label>
                                <div class="form-message @error('number') invalid-feedback @enderror">
                                    @error('number')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>




                            <div class="button">
                                <button class="btn btn-primary w-100" type="submit"><i class="fa-solid fa-plus"></i> Thêm niên luận</button>
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
                Validator.isRequired('#topic_type', 'Vui lòng chọn loại niên luận'),

                Validator.isRequired('#name', 'Vui lòng nhập tên niên luận'),

                Validator.isRequired('#number', 'Vui lòng chọn số lượng sinh viên tối đa'),
            ]
        });
    </script>
@endsection
