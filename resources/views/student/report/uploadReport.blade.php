@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
            <div class="upload-report-form">

                <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" action="{{ route('student.uploadReport') }}"
                    id="upload-report-form" novalidate>

                    <div class="title">
                        <h3 class="text-center">Nộp báo cáo chính</h3>
                    </div>
                    <h5>Tên niên luận: <b>{{ $topic->name }}</b></h5>
                    <h5>Học kỳ: <b>{{ $topic->semester->semester_no }}</b>, Năm
                        học:<b>{{ $topic->semester->semester_name }}</b></h5>
                    @csrf
                    <input type="hidden" name="topic_id" value="{{$topic->id}}">
                    <div class="mb-3">
                        <label for="formFile" class="form-label"><i class="fa-solid fa-file-word"></i> Tải file word </label>
                        <input class="form-control" type="file" id="wordFile" name="wordFile" accept=".doc,.docx">
                        <div class="form-message  @error('wordFile') invalid-feedback @enderror">
                            @error('wordFile')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label"><i class="fa-solid fa-file-powerpoint"></i> Tải file PowerPoint </label>
                        <input class="form-control" type="file" id="powerPointFile" name="powerPointFile" accept=".ppt,.pptx">
                        <div class="form-message  @error('powerPointFile') invalid-feedback @enderror">
                            @error('powerPointFile')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="button">
                        <button class="btn btn-primary w-100" type="submit">Nộp báo cáo chính</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        Validator({
            form: '#upload-report-form',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#wordFile', 'Vui lòng chọn file word'),
                Validator.isRequired('#powerPointFile', 'Vui lòng chọn file PowerPoint'),
            ]
        });
    </script>
@endsection
