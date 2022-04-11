<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Tên</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @php
            $start = ($subjects->currentPage() - 1) * $subjects->perPage() + 1;
        @endphp
        @foreach ($subjects as $item)
            <tr>
                <th scope="row">{{ $start++ }}</th>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="/admin/subject/edit?id={{ $item->id }}" class="me-3"><i
                            class="fa-solid fa-pen"></i></a>
                    <a class="delete" href="{{ route('admin.deleteSubject')}}"
                        data-id="{{ $item->id }}" title="Xóa {{ $item->name }}" data-name="{{ $item->name }}"
                        data-csrf="{{csrf_token()}}" data-return-url="{{ route('admin.showSubject') }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<!-- Pagination -->
{{ $subjects->links() }}
<!-- End pagination -->