<script>
    $(document).ready(function() {

        // Khi nhấn vào nút delete bất kỳ trên danh sách
        $(document).on('click', '.delete', function(event) {
            // stop chuyen link khi nhấn vào thẻ <a>
            event.preventDefault();
            // hiển thị Sweetalert2 và xoá bằng ajax 
            // hoặc uncomment showModalConfirm() để xoá theo kiểu bình thường
            showConfirm(event.currentTarget);
            // hoặc sử dụng Bootstrap Modal
            //showModalConfirm(event.currentTarget); // lấy phần tử <a> vừa được click
        })
    });

    // hàm hiển thị thông báo SweetAlert xác nhận xoá
    function showConfirm(e) {
        Swal.fire({
            title: 'Bạn chắc chắn?',
            html: "<p>Xóa <b>" + $(e).data('name') + "</b> có <b>ID = "+ $(e).data('id') +"</b></p> <p>Bạn sẽ không thể hoàn tác</p>",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#dc3545',
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#58bb43',
            confirmButtonText: 'Đồng ý'
        }).then((result) => {
            if (result.isConfirmed) {
                ajaxDelete(e);
                // console.log('Xác nhận ' + $(e).data('csrf'));
            }
        });
    }

    // hàm delete bằng Ajax
    function ajaxDelete(e) {
        var url = $(e).prop('href');
        var id = $(e).data('id');
        var csrf = $(e).data('csrf');
        $.ajax({
            method: "POST",
            url: url,
            data: {
                id : id,
                _token : csrf
            }
        }).done(function(response) { // nếu xoá thành công

            // delete dòng vừa xoá trên trang hoặc có thể
            // load lại danh sách theo cách bên dưới
            // $(e).closest('tr').remove();

            // Gọi hàm reloadWardList để load lại danh sách trên form
            let reload_url = $(e).data('return-url');
            // thẻ <div> chứa danh sách contact
            let target = $('.table');
            reloadList(reload_url, target);
            Swal.fire(
                'Deleted!',
                response.message,
                'success'
            );

        }).fail(function(response) { // nếu thất bại
            Swal.fire(
                'Error',
                response.responseJSON.message,
                'error'
            )
        });
    }

    // hàm load lại danh sách sau khi xoá
    function reloadList(url, target) {
        $.ajax({
            method: "GET",
            url: url
        }).done(function(response) {
            $(target).html(response.data);
        }).fail(function() {
            Swal.fire(
                'Error',
                'Unable to reload the contact list. Try again.',
                'error'
            )
        });
    }
</script>
