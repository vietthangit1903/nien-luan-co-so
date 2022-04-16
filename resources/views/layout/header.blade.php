<div class="container-fluid header">
    <div class="logo">
        <a href="/">
            <img src="{{ url('') }}/assets/img/logo1.png" alt="">

        </a>
    </div>
    <div class="title">Hệ thống đăng ký và quản lý niên luận</div>
    <div class="auth">



        @auth('lecture')
            <div class="dropdown user">
                <img class="rounded-circle align-middle" src="{{ url('') }}/assets/img/default-user-image.png"
                    role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" alt="User picture">


                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-plus"></i> Trang giảng viên</a></li>
                    <li><a class="dropdown-item" href="{{ route('LectureProfile') }}"><i class="fa-regular fa-pen-to-square"></i> Thông tin giảng
                            viên</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i> Đổi mật khẩu</a></li>
                    <li><a class="dropdown-item" href="{{ route('LectureLogout') }}" id="logout" data-redirect="/lecture/login" data-csrf="{{ csrf_token() }}"><i
                                class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>
        @endauth

        @guest('lecture')
            <a href="{{ route('LectureLoginView') }}">Đăng nhập</a>
        @endguest

    </div>
</div>
