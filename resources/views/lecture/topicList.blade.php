@extends('layout.master')

@section('content')
    <div class="row">
        <h2 class="text-center p-2">Danh sách niên luận</h2>
        <div class="col-5 mb-3 action w-100">
            <button type="button" class="btn btn-primary">
                <a href="{{ route('LecturePage') }}"><i class="fa-brands fa-leanpub"></i> Trang giảng viên </a>
            </button>
            <button type="button" class="btn btn-primary">
                <a href="{{ route('lecture.addTopic') }}"><i class="fa-solid fa-plus"></i> Thêm niên luận</a>
            </button>

        </div>
        <form action="/lecture/topic_list" class="row" id="semester_form">
            <div class="mb-3 col-2">
                <label for="semester_no">Học kỳ</label>
                <select name="semester_no" id="semester_no" class="form-select">
                    <option value="1" {{ $current_semester->semester_no == 1 ? 'selected' : '' }}>Học kỳ 1</option>
                    <option value="2" {{ $current_semester->semester_no == 2 ? 'selected' : '' }}>Học kỳ 2</option>
                </select>
            </div>
            <div class="mb-3 col-3">
                <label for="semester_name">Năm học</label>
                <select name="semester_name" id="semester_name" class="form-select">
                    @foreach ($semesters as $item)
                        <option value="{{ $item->semester_name }}" {{ $item->current == 1 ? 'selected' : '' }}>
                            {{ $item->semester_name }}</option>
                    @endforeach
                </select>
                <div class="form-message invalid-feedback">
                </div>
            </div>
        </form>
        <hr>

        @include('lecture.topicList-table')
    </div>
@endsection
