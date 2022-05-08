<table class="table table-striped">
    @if ($progressReports->count() == 0)
        <h3 class="text-center">Không có thông tin về báo cáo tiến độ</h3>
    @else
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Nội dung</th>
                <th scope="col" class="text-center">Hành động</th>
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
                    <td class="text-center">
                        <a class="delete" href="{{ route('student.deleteProgressReport') }}"
                            data-id="{{ $item->id }}" title="Xóa báo cáo tiến độ" data-csrf="{{ csrf_token() }}"
                            data-return-url="{{url()->full()}}"><i class="fa-solid fa-xmark"></i></a>
                            {{-- Đang dừng ở xóa niên luận, đã xong
                                Giảng viên xem được số lượng báo cáo tiến độ của từng sinh viên
                                Giảng viên xem được từng báo cáo của sinh viên --}}
                    </td>
                </tr>
            @endforeach

        </tbody>
    @endif

</table>

<!-- Pagination -->
{{ $progressReports->links() }}
<!-- End pagination -->
