@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">

            <div class="title">
                <h3 class="text-center">Đánh giá</h3>
            </div>
            <h5>Tên niên luận: <b>{{ $topic->name }}</b></h5>
            <h5>Học kỳ: <b>{{ $topic->semester->semester_no }}</b>, Năm
                học:<b>{{ $topic->semester->semester_name }}</b></h5>
            <hr>
            @isset($evaluation)
                <p>Điểm: <b>{{ $evaluation->marks }}</b></p>
                <p><b>Nhận xét:</b> {{ $evaluation->evaluation_content }}</p>
            @else
                <h5 class="text-center">Không có thông tin về đánh giá của niên luận</h5>
            @endisset


        </div>
    </div>
@endsection
