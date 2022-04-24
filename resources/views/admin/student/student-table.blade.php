<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Họ và Tên</th>
            <th scope="col">Email</th>
            <th scope="col">Ngày sinh</th>
            <th scope="col">Bộ môn</th>
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
                <td>{{ date('d/m/Y', strtotime($item->dateOfBirth)) }}</td>
                <td>{{ $item->subject->name }}</td>
                <td>
                    <a href="/admin/student/edit?id={{ $item->id }}" class="me-3"><i
                        class="fa-solid fa-pen"></i></a>
                    <a class="delete" href="{{ route('admin.deleteStudent') }}"
                        data-id="{{ $item->id }}" title="Xóa {{ $item->fullName }}" data-name="{{ $item->fullName }}"
                        data-csrf="{{ csrf_token() }}" data-return-url="{{ route('admin.studentList') }}">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<!-- Pagination -->
{{ $students->links() }}
<!-- End pagination -->
