<table class="table table-striped">
    @if ($students->count() == 0){{-- Số lượng sinh viên --}}
        <h3 class="text-center">Không có thông tin về sinh viên của niên luận {{ $topic->name }}</h3>
    @else
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID sinh viên</th>
                <th scope="col">Tên sinh viên</th>
                <th scope="col">Email sinh viên</th>
                <th scope="col">Số lượng báo cáo tiến độ</th>
                <th scope="col">Trạng thái báo cáo</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php
                $start = ($students->currentPage() - 1) * $students->perPage() + 1;
            @endphp
            @foreach ($students as $item)
                <tr>
                    <th scope="row">{{ $start++ }}</th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->fullName }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->progressReportNumber }} báo cáo</td>
                    <td>
                        @if ($item->reportNumber != 0)
                            {{ 'Đã nộp' }}
                        @else
                            {{ 'Chưa nộp' }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('lecture.progressReport', ['student-id' => $item->id, 'topic-id' => $topic->id]) }}"
                            class="me-3" title="Xem báo cáo tiến độ"><i
                                class="fa-solid fa-bars-progress"></i></a>
                        <a href="{{ route('lecture.report', ['student-id' => $item->id, 'topic-id' => $topic->id]) }}" class="me-3" title="Xem báo cáo chính"><i class="fa-solid fa-file"></i></a>
                        <a href="{{ route('lecture.evaluation', ['student-id' => $item->id, 'topic-id' => $topic->id]) }}" title="Đánh giá niên luận"><i class="fa-solid fa-pen-to-square"></i></a>


                    </td>
                </tr>
            @endforeach

        </tbody>
    @endif

</table>

<!-- Pagination -->
{{ $students->links() }}
<!-- End pagination -->
