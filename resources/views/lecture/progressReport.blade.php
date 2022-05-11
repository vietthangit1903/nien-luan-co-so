@extends('layout.master')

@section('content')
    <div class="row">
        <h2 class="text-center p-2">Danh sách báo cáo tiến độ của sinh viên</h2>
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
        <h5>Học kỳ: <b>{{ $topic->semester->semester_no }}</b>, Năm học: <b>{{ $topic->semester->semester_name }}</b></h5>

        <hr>

        <table class="table table-striped">
            @if ($progressReports->count() == 0)
                <h3 class="text-center">Không có thông tin về báo cáo tiến độ</h3>
            @else
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Nội dung</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $start = ($progressReports->currentPage() - 1) * $progressReports->perPage() + 1;
                    @endphp
                    @foreach ($progressReports as $item)
                        <tr>
                            <th scope="row">{{ $start++ }}</th>
                            <td>{{ $item->content }}</td>
                        </tr>
                    @endforeach
        
                </tbody>
            @endif
        
        </table>
        
        <!-- Pagination -->
        {{ $progressReports->links() }}
        <!-- End pagination -->
        
    </div>
@endsection
