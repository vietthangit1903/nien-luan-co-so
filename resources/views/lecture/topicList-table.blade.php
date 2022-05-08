<table class="table table-striped">
    @if ($topics->count() == 0)
        <h3 class="text-center">Không có thông tin về niên luận trong học kỳ</h3>
    @else
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Tên niên luận</th>
                <th scope="col">Số lượng sinh viên tối đa</th>
                <th scope="col">Số lượng sinh viên đã đăng ký</th>
                <th scope="col">Loại niên luận</th>
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
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->number }} sinh viên</td>
                    <td>{{ $item->registered_number }} sinh viên</td>
                    <td>{{ $item->topic_type->name }}</td>
                    <td>
                        @if ($item->semester_id == $current_semester->id)
                            <a href="{{ route('lecture.editTopic', ['id' => $item->id]) }}" class="me-3"
                                title="Chỉnh sửa niên luận"><i class="fa-solid fa-pen"></i></a>
                            <a class="delete me-3" href="{{ route('lecture.deleteTopic') }}"
                                data-id="{{ $item->id }}" title="Xóa {{ $item->name }}"
                                data-name="{{ $item->name }}" data-csrf="{{ csrf_token() }}"
                                data-return-url="{{ route('lecture.topicList') }}"><i
                                    class="fa-solid fa-xmark"></i></a>
                        @endif
                        <a href="{{ route('lecture.topicDetail', ['id'=>$item->id]) }}" title="Xem danh sách sinh viên"><i class="fa-solid fa-circle-info"></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    @endif

</table>

<!-- Pagination -->
{{ $topics->links() }}
<!-- End pagination -->
