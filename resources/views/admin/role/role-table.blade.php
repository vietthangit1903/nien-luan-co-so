<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Tên</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @php
            $start = ($roles->currentPage() - 1) * $roles->perPage() + 1;
        @endphp
        @foreach ($roles as $item)
            <tr>
                <th scope="row">{{ $start++ }}</th>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="/admin/role/edit?id={{ $item->id }}" class="me-3"><i
                            class="fa-solid fa-pen"></i></a>
                    <a class="delete" href="{{ route('admin.deleteRole') }}"
                        data-id="{{ $item->id }}" title="Xóa {{ $item->name }}" data-name="{{ $item->name }}"
                        data-csrf="{{ csrf_token() }}" data-return-url="{{ route('admin.showRole') }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<!-- Pagination -->
{{ $roles->links() }}
<!-- End pagination -->
