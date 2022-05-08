@extends('layout.master')

@section('content')
    <div class="row">
        <h2 class="text-center p-2">Báo cáo tiến độ</h2>
        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
            <div class="proress-report">
                <form class="row g-3 needs-validation" method="POST" action="{{url()->full()}}" id="progress_report_form" novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        <textarea name="progress-report-content" class="form-control @error('progress-report-content') is-invalid @enderror"
                            placeholder="Nhập cáo cáo tiến độ tại đây" id="progress-report-content"
                            style="height: 200px">{{ old('progress-report-content') ?? '' }}</textarea>
                        <label for="progress-report-content">Nội dung</label>
                        <div class="form-message  @error('progress-report-content') invalid-feedback @enderror">
                            @error('progress-report-content')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="button text-center">
                        <a href="{{url()->previous()}}" class="btn btn-primary"> <i class="fa-solid fa-chevron-left"></i> Trở về </a>
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Báo cáo tiến độ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h2 class="text-center p-2">Danh sách báo cáo tiến độ của niên luận</h2>
        @include('student.progressReport.progressReport-table')
    </div>
@endsection

@section('custom_js')
    <script>
        Validator({
            form: '#progress_report_form',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#progress-report-content', 'Vui lòng nhập nội dung báo cáo tiến độ'),
                Validator.maxLength('#progress-report-content', 250 ,'Nội dung không quá 250 ký tự'),
            ]
        });
    </script>
@endsection
