@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
            <div class="evaluation-form">
                <div class="title">
                    <h3 class="text-center">Đánh giá niên luận</h3>
                </div>
                <h5>Tên niên luận: <b>{{ $topic->name }}</b></h5>
                <h5>Tên sinh viên: <b>{{ $student->fullName }}</b></h5>
                <h5>Học kỳ: <b>{{ $topic->semester->semester_no }}</b>, Năm học:
                    <b>{{ $topic->semester->semester_name }}</b>
                </h5>
                <hr>
                @if ($report_id == null)
                    <h5 class="text-center">Không thể đánh giá vì sinh viên chưa nộp báo cáo chính</h5>
                @else
                    <form class="row g-3 needs-validation" method="POST" action="{{ isset($evaluation) ? route('lecture.editEvaluation') : route('lecture.evaluation') }}"
                        id="evaluation-form" novalidate>
                        <input type="hidden" name="report_id" value="{{ $report_id }}">
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        @csrf
                        <div class="form-floating mb-2">
                            <input class="form-control @error('marks') is-invalid @enderror" name="marks" type="number"
                                id="marks" placeholder="Nhập điểm"
                                value="{{ isset($evaluation) ? $evaluation->marks : old('marks') }}" />
                            <label for="marks">Điểm</label>
                            <div class="form-message  @error('marks') invalid-feedback @enderror">
                                @error('marks')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea name="evaluation_content" class="form-control @error('evaluation_content') is-invalid @enderror"
                                placeholder="Nhập đánh giá tại đây" id="evaluation_content"
                                style="height: 200px">{{ isset($evaluation) ? $evaluation->evaluation_content : old('evaluation_content') }}</textarea>
                            <label for="evaluation_content">Nội dung đánh giá</label>
                            <div class="form-message  @error('evaluation_content') invalid-feedback @enderror">
                                @error('evaluation_content')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="button">
                            @isset($evaluation)
                                <button class="btn btn-primary w-100" type="submit">Chỉnh sửa đánh giá <i
                                        class="fa-solid fa-pen-to-square"></i></button>
                            @else
                                <button class="btn btn-primary w-100" type="submit">Đánh giá <i
                                        class="fa-solid fa-pen-to-square"></i></button>
                            @endisset
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        Validator({
            form: '#evaluation-form',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#marks', 'Vui lòng nhập điểm'),
                Validator.isMarks('#marks'),
                Validator.isRequired('#evaluation_content', 'Vui lòng nhập nhận xét'),
                Validator.maxLength('#evaluation_content', 500, 'Nội dung nhận xét không quá 500 ký tự'),


            ]
        });
    </script>
@endsection
