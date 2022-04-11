@extends('admin.admin')

@section('dashboard')
    <h2 class="dashboard-title text-center p-2">Quản lý quyền người dùng</h2>

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
            <form action="{{ isset($editRole) ? route('admin.editRole') : route('admin.addRole') }}" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Thêm phân quyền mới" aria-label="Role's name"
                        aria-describedby="button-addon2" name="name" value="{{ $editRole->name ?? old('name') }}">
                    <input type="text" class="form-control" placeholder="Thêm mô tả phân quyền"
                        aria-label="Role's description" aria-describedby="button-addon2" name="description"
                        value="{{ $editRole->description ?? old('description') }}">
                    @isset($editRole)
                        <input type="hidden" name="id" value="{{ $editRole->id }}">
                    @endisset
                    @csrf
                    <button class="btn btn-primary" type="submit" id="button-addon2">{{ isset($editRole) ? 'Chỉnh sửa' : 'Thêm' }}</button>
                </div>
            </form>
        </div>
    </div>

    @isset($editRole)
        <div class="col mb-3 action">
            <button type="button" class="btn btn-primary"><a href="{{ route('admin.showRole') }}">Thêm quyền <i
                        class="fa-solid fa-plus"></i></a></button>
        </div>
    @endisset
    <!-- Table -->
    <div class="list">
        @include('admin.role.role-table')
    </div>
    <!-- End table -->

@endsection
