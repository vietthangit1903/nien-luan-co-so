@extends('layout.admin')

@section('dashboard')
    <h2 class="dashboard-title text-center p-2">Quản lý bộ môn</h2>

    <!-- Simple form -->
    <div class="row justify-content-center">
        <div class="col-6 justify-content-center">
            @isset($errors)
                @foreach ($errors as $error)
                    <div class="row">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endforeach
            @endisset
            <form action="{{isset($editSubject) ? route('admin.editSubject') : route('admin.addSubject')}}" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Thêm bộ môn mới" aria-label="Subject's name"
                        aria-describedby="button-addon2" name="subject_name"
                        value="{{$editSubject->name ?? old('subject_name')}}">
                    @isset($editSubject)
                        <input type="hidden" name="id" value="{{$editSubject->id}}">
                    @endisset
                    @csrf
                    <button class="btn btn-primary" type="submit" id="button-addon2">{{isset($editSubject) ? 'Chỉnh sửa' : 'Thêm'}}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
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
                $start = 1;
            @endphp
            @foreach ($subjects as $item)
                <tr>
                    <th scope="row">{{ $start++ }}</th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="/admin/subject/edit?id={{ $item->id }}" class="me-3"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="#"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <!-- End table -->


    <!-- Pagination -->
    {{ $subjects->links() }}
    <!-- End pagination -->
@endsection
