<table class="table table-striped text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">STT học kỳ</th>
            <th scope="col">Năm học</th>
            <th scope="col">Thời gian giảng viên <br>bắt đầu nhập niên luận</th>
            <th scope="col">Thời gian giảng viên <br>kết thúc nhập niên luận </th>
            <th scope="col">Thời gian sinh viên <br>bắt đầu đăng ký niên luận</th>
            <th scope="col">Thời gian sinh viên <br>kết thúc đăng ký niên luận </th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @php
            $start = ($semesters->currentPage() - 1) * $semesters->perPage() + 1;
        @endphp
        @foreach ($semesters as $item)
            <tr>
                <th scope="row">{{ $start++ }}</th>
                <td>{{ $item->semester_no }}</td>
                <td>{{ $item->semester_name }}</td>
                <td>{{ isset($item->time_start_give_topic) ? date('d/m/Y', strtotime($item->time_start_give_topic)) : '' }}</td>
                <td>{{ isset($item->time_end_give_topic) ? date('d/m/Y', strtotime($item->time_end_give_topic)) : '' }}</td>
                <td>{{ isset($item->time_start_reg_topic) ? date('d/m/Y', strtotime($item->time_start_reg_topic)) : '' }}</td>
                <td>{{ isset($item->time_end_reg_topic) ? date('d/m/Y', strtotime($item->time_end_reg_topic)) : '' }}</td>
                <td>
                    <a href="/admin/semester/edit?id={{ $item->id }}" class="me-3"
                        title="Chỉnh sửa thời gian"><i class="fa-solid fa-calendar"></i></a>
                    {{-- <a class="delete" href="{{ route('admin.deleteRole') }}"
                        data-id="{{ $item->id }}" title="Xóa {{ $item->name }}" data-name="{{ $item->name }}"
                        data-csrf="{{ csrf_token() }}" data-return-url="{{ route('admin.showRole') }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </a> --}}
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<!-- Pagination -->
{{ $semesters->links() }}
<!-- End pagination -->
