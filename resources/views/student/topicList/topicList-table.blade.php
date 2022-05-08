<table class="table table-striped">
    @if ($topics->count() == 0)
        <h3 class="text-center">Không có thông tin về niên luận trong học kỳ</h3>
    @else
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên niên luận</th>
                <th scope="col">Tên giảng viên</th>
                <th scope="col">Email giảng viên</th>
                <th scope="col">Loại niên luận</th>
                <th scope="col">Trạng thái đánh giá</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php
                $start = ($topics->currentPage() - 1) * $topics->perPage() + 1;
            @endphp
            @foreach ($topics as $item)
                <tr>
                    <th scope="row">{{ $start++ }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->lecture->fullName }}</td>
                    <td>{{ $item->lecture->email }}</td>
                    <td>{{ $item->topic_type->name }}</td>
                    <td>Chưa có đánh giá</td>
                    <td>
                        @if ($item->semester_id == $current_semester->id)
                            <a href="{{ route('student.progressReport', ['topic_id'=>$item->id]) }}" class="me-3" title="Báo cáo tiến độ"><i class="fa-solid fa-bars-progress"></i></a>
                            <a class="me-3" href="#" title="Báo cáo chính"><i class="fa-solid fa-file"></i></a>
                        @endif
                        <a href="#" title="Xem đánh giá"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    @endif

</table>

<!-- Pagination -->
{{ $topics->links() }}
<!-- End pagination -->
