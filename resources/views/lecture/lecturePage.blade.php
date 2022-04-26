@extends('layout.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="notification">
                <div class="noti-header">
                    <p>Thông báo</p>
                </div>
                <div class="noti-body">
                    <ol>
                        <li><a href="#">Thông báo xóa lớp học phần HK2, năm học 2021-2022.</a></li>
                        <li><a href="#">Thông báo mở lại website nhập KHHT.</a></li>
                        <li><a href="#">Thông báo kế hoạch giảng dạy và đăng ký học phần HK2, 2021-2022.</a></li>
                        <li><a href="#">Kế hoạch xét và phát bằng tốt nghiệp năm 2022.</a></li>
                        <li><a href="#">Sơ đồ nhà học - Ký hiệu phòng học.</a></li>
                        <li><a href="#">Lịch học GDQP Khóa 47 HK1 2021-2022.</a></li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="col-8">
            <div class="function">
                <div>
                    <a class="btn btn-primary action-btn  my-2 mx-2" href="{{ route('lecture.addTopic') }}">
                        <div class="action-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        Thêm niên luận
                    </a>
                    <a class="btn btn-primary action-btn  my-2 me-2" href="{{ route('lecture.topicList') }}">
                        <div class="action-icon">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        Danh sách niên luận
                    </a>

                </div>



            </div>

        </div>
    </div>
@endsection
