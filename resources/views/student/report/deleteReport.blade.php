@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">

            <div class="title">
                <h3 class="text-center">Báo cáo chính</h3>
            </div>
            <h5>Tên niên luận: <b>{{ $topic->name }}</b></h5>
            <h5>Học kỳ: <b>{{ $topic->semester->semester_no }}</b>, Năm
                học:<b>{{ $topic->semester->semester_name }}</b></h5>

            <p><i class="fa-solid fa-file-word"></i> File Word: {{ $report->word_name }}</p>
            <p><i class="fa-solid fa-file-powerpoint"></i> File PowerPoint: {{ $report->power_point_name }}</p>


            <div class="button">
                <a class="btn btn-primary w-100 cancel_report_submission"
                    href="{{ route('student.cancelReportSubmission') }}" data-id="{{ $report->id }}"
                    data-csrf="{{ csrf_token() }}"
                    data-redirect="{{ route('student.topicList') }}"><i class="fa-solid fa-xmark"></i> Hủy nộp báo cáo</a>
            </div>

        </div>
    </div>
@endsection
