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
                    <li><a class="dropdown-item" href="{{ route('LecturePage') }}"><i class="fa-brands fa-leanpub"></i> Trang giảng viên</a></li>
                    @if (Session::has('isAdmin'))
                        <li><a class="dropdown-item" href="{{ route('admin.home') }}"><i class="fa-solid fa-gear"></i>
                                Trang quản lý</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{ route('LectureProfile') }}"><i
                                class="fa-regular fa-pen-to-square"></i> Thông tin giảng
                            viên</a></li>
                    <li><a class="dropdown-item" href="{{ route('LectureChangePassword') }}"><i
                                class="fa-solid fa-key"></i> Đổi mật khẩu</a></li>
                    <li><a class="dropdown-item" href="{{ route('LectureLogout') }}" id="logout"
                            data-redirect="/lecture/login" data-csrf="{{ csrf_token() }}"><i
                                class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>
        @endauth

        @auth('student')
            <div class="dropdown user">
                <img class="rounded-circle align-middle" src="{{ url('') }}/assets/img/default-user-image.png"
                    role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" alt="User picture">


                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-plus"></i> Trang sinh viên</a></li>
                    <li><a class="dropdown-item" href="{{ route('StudentProfile') }}"><i class="fa-regular fa-pen-to-square"></i> Thông tin sinh
                            viên</a></li>
                    <li><a class="dropdown-item" href="{{ route('StudentChangePassword') }}"><i class="fa-solid fa-key"></i> Đổi mật khẩu</a></li>
                    <li><a class="dropdown-item" href="{{ route('studentLogout') }}" id="logout" data-redirect="/student/login" data-csrf="{{ csrf_token() }}"><i
                                class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>

        @endauth

        @if (!auth()->check() && !auth('lecture')->check())
            <a href="{{ route('LectureLoginView') }}">Đăng nhập giảng viên</a>
            <a href="{{ route('student.studentLogin') }}">Đăng nhập sinh viên</a>
            <a href="{{ route('student.registerStudent') }}">Đăng ký sinh viên</a>
        @endif


    </div>
</div>
