@extends('admin.admin')

@section('dashboard')
    <h2 class="dashboard-title text-center p-2">Quản lý bộ môn</h2>

    <!-- Simple form -->
    <div class="row justify-content-center">
        <div class="col-6 justify-content-center">
            @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endforeach
            @endif
            @isset($saveError)
                    <div class="row">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $saveError }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
            @endisset
            <form action="{{ isset($editSubject) ? route('admin.editSubject') : route('admin.addSubject') }}"
                method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Thêm bộ môn mới" aria-label="Tên bộ môn"
                        aria-describedby="button-addon2" name="name"
                        value="{{ $editSubject->name ?? old('name') }}">
                    @isset($editSubject)
                        <input type="hidden" name="id" value="{{ $editSubject->id }}">
                    @endisset
                    @csrf
                    <button class="btn btn-primary" type="submit"
                        id="button-addon2">{{ isset($editSubject) ? 'Chỉnh sửa' : 'Thêm' }}</button>
                </div>
            </form>
        </div>
    </div>
    @isset($editSubject)
        <div class="col mb-3 action">
            <button type="button" class="btn btn-primary"><a href="{{ route('admin.showSubject') }}">Thêm bộ môn <i
                        class="fa-solid fa-plus"></i></a></button>
        </div>
    @endisset

    <!-- Table -->
    <div class="list">
        @include('admin.subject.subject-table')
    </div>
    <!-- End table -->


@endsection
