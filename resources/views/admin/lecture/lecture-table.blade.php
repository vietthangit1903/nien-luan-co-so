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
            $start = ($lectures->currentPage() - 1) * $lectures->perPage() + 1;
        @endphp
        @foreach ($lectures as $item)
            <tr>
                <th scope="row">{{ $start++ }}</th>
                <td>{{ $item->id }}</td>
                <td>{{ $item->fullName }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->dateOfBirth }}</td>
                <td>{{ $item->subject->name }}</td>
                <td>
                    <a class="delete" href="#"
                        data-id="{{ $item->id }}" title="Xóa {{ $item->name }}" data-name="{{ $item->name }}"
                        data-csrf="{{ csrf_token() }}" data-return-url="">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<!-- Pagination -->
{{ $lectures->links() }}
<!-- End pagination -->
