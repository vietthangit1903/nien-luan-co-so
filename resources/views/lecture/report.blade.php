@extends('layout.master')

@section('content')
    <div class="row">
        <h2 class="text-center p-2">Báo cáo chính của sinh viên</h2>
        <div class="col-5 mb-3 action w-100">

            <button type="button" class="btn btn-primary">
                <a href="{{ url()->previous() }}"><i class="fa-solid fa-chevron-left"></i> Trở về </a>
            </button>
            <button type="button" class="btn btn-primary">
                <a href="{{ route('LecturePage') }}"><i class="fa-brands fa-leanpub"></i> Trang giảng viên </a>
            </button>

        </div>
        <h5>Tên niên luận: <b>{{ $topic->name }}</b></h5>
        <h5>Tên sinh viên: <b>{{ $student->fullName }}</b></h5>
        <h5>Học kỳ: <b>{{ $topic->semester->semester_no }}</b>, Năm học: <b>{{ $topic->semester->semester_name }}</b>
        </h5>
        @if (!$report)
            <h5 class="text-center">Không có thông tin về báo cáo chính của sinh viên</h5>
        @else
            <h5><i class="fa-solid fa-file-word"></i> File word: {{ $report->word_name }} <a href="{{ route('lecture.downloadReport', ['report-id'=>$report->id, 'type'=>'word']) }}"
                    class="btn btn-primary">Tải xuống <i class="fa-solid fa-download"></i></a></h5>
            <h5><i class="fa-solid fa-file-powerpoint"></i> File powerpoint: {{ $report->power_point_name }} <a href="{{ route('lecture.downloadReport', ['report-id'=>$report->id, 'type'=>'powerpoint']) }}"
                    class="btn btn-primary">Tải xuống <i class="fa-solid fa-download"></i></a></h5>
        @endif

    </div>
@endsection
