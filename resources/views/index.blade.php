@extends('layout.master')

@section('content')
<div class="row">
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
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="overlay-image" style="background-image: url(./assets/img/ctu-1.jpg);"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <h4>Ngày hội Tư vấn Tuyển sinh - Hướng nghiệp năm 2022</h4>
                        <p>Sáng 20/3/2022, tại Trường Đại học Cần Thơ, Ngày hội tư vấn tuyển sinh - hướng nghiệp
                            năm 2022 đã tưng bừng khai mạc.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="overlay-image" style="background-image: url(./assets/img/ctu-2.jpg);"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <h4>Sinh viên Đại học Cần Thơ đạt giải Nhất cuộc thi "Từ sáng tạo đến khởi nghiệp" do
                            USAID tổ chức</h4>
                        <p>Ngày 11/3/2022, trong cuộc thi "Từ sáng tạo đến khởi nghiệp" (Maker to Entrepreneur
                            Program - MEP) do Cơ quan Phát triển quốc tế Mỹ (USAID) tổ chức tại thành phố Hồ Chí
                            Minh, nhóm sinh viên thuộc Khoa Công nghệ do TS. Trần Thanh Hùng hướng dẫn đã đạt
                            giải Nhất với Hệ thống FMS.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="overlay-image" style="background-image: url(./assets/img/ctu-3.jpg);"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <h4>Ký kết hợp tác với APU, Malaysia về giáo dục khởi nghiệp</h4>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</div>
@endsection