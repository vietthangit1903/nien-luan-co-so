<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Tên niên luận</th>
            <th scope="col">Số lượng sinh viên tối đa</th>
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
                <td>{{ $item->topic_type->name }}</td>
                <td>
                    <a href="#" class="me-3"><i class="fa-solid fa-pen"></i></a>
                    <a class="delete" href="#" data-id="{{ $item->id }}" title="Xóa {{ $item->name }}"
                        data-name="{{ $item->name }}" data-csrf="{{ csrf_token() }}" data-return-url="#">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<!-- Pagination -->
{{ $topics->links() }}
<!-- End pagination -->
