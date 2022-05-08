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
                    <td>{{ $item->email }} sinh viên</td>
                    <td>0 báo cáo</td>
                    <td>Chưa nộp</td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach

        </tbody>
    @endif

</table>

<!-- Pagination -->
{{ $students->links() }}
<!-- End pagination -->
