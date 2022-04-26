@extends('layout.master')

@section('content')
    <div class="row">
        <h2 class="text-center p-2">Danh sách niên luận</h2>

        <form action="" class="row">
            <div class="mb-3 col-2">
                <label for="semester_no">Học kỳ</label>
                <select name="semester_no" id="semester_no" class="form-select" onchange="console.log('changed')">
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
        <div class="list">
            @include('lecture.topicList-table')
        </div>
    </div>
@endsection
