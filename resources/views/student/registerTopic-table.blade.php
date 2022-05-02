<table class="table table-striped">
    @if ($topics->count() == 0)
        <h3 class="text-center">Không có thông tin về niên luận trong học kỳ</h3>
    @else
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Tên niên luận</th>
                <th scope="col">Giảng viên</th>
                <th scope="col">Số lượng sinh viên tối đa</th>
                <th scope="col">Số lượng còn lại</th>
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
                    <td>{{ $item->lecture->fullName }}</td>
                    <td>{{ $item->number }} sinh viên</td>
                    <td>{{ $item->number - $item->registered_number }} sinh viên</td>
                    <td>{{ $item->topic_type->name }}</td>
                    <td>

                        @if ($item->id == $registered_topic_id)
                            <a href="{{ route('student.cancelRegisterTopic') }}" class="me-3 cancel_register_topic" data-id="{{ $item->id }}"
                                data-csrf="{{ csrf_token() }}"
                                data-return-url="{{ route('student.registerTopic') }}">
                                <i class="fa-solid fa-xmark"></i> Hủy đăng ký
                            </a>
                        @else
                            <a href="{{ route('student.registerTopic') }}" class="me-3 register_topic"
                                data-id="{{ $item->id }}" data-csrf="{{ csrf_token() }}"
                                data-return-url="{{ route('student.registerTopic') }}"
                                title="Đăng ký {{ $item->name }}"><i class="fa-solid fa-pen"></i> Đăng ký</a>
                        @endif


                    </td>
                </tr>
            @endforeach

        </tbody>
    @endif

</table>

<!-- Pagination -->
{{ $topics->links() }}
<!-- End pagination -->
