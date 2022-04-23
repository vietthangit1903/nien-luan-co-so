<script>
    $(document).ready(function() {

        // Khi nhấn vào nút delete bất kỳ trên danh sách
        $(document).on('click', '#logout', function(event) {
            // stop chuyen link khi nhấn vào thẻ <a>
            event.preventDefault();
            // hiển thị Sweetalert2 và xoá bằng ajax 
            // hoặc uncomment showModalConfirm() để xoá theo kiểu bình thường
            showConfirmLogout(event.currentTarget);
            // hoặc sử dụng Bootstrap Modal
            //showModalConfirmLogout(event.currentTarget); // lấy phần tử <a> vừa được click
        })
    });

    // hàm hiển thị thông báo SweetAlert xác nhận xoá
    function showConfirmLogout(e) {
        Swal.fire({
            title: 'Đăng xuất khỏi hệ thống?',
            icon: 'question',
            iconColor: '#00b4d8',
            showCancelButton: true,
            cancelButtonColor: '#dc3545',
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#58bb43',
            confirmButtonText: 'Đồng ý'
        }).then((result) => {
            if (result.isConfirmed) {
                ajaxLogout(e);
                // console.log('Xác nhận ' + $(e).data('csrf'));
            }
        });
    }

    // hàm delete bằng Ajax
    function ajaxLogout(e) {
        var url = $(e).prop('href');
        var csrf = $(e).data('csrf');

        $.ajax({
            method: "POST",
            url: url,
            data: {
                _token: csrf
            }
        }).done(function(response) { // nếu đăng xuất thành công

            // delete dòng vừa xoá trên trang hoặc có thể
            // load lại danh sách theo cách bên dưới
            // $(e).closest('tr').remove();

            // Gọi hàm reloadWardList để load lại danh sách trên form

            Swal.fire({

                icon: 'info',
                title: 'Bye! Hẹn gặp lại bạn sớm',
                showConfirmButton: false,
                timer: 2000
            });
            let redirect_url = $(e).data('redirect');
            window.location.href = redirect_url;

        });
    }
</script>
