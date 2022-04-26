var loader = document.querySelector('#preloader');
window.addEventListener('load', function () {
    loader.style.display = "none";
});

$(document).ready(function () {

    // Khi nhấn vào nút delete bất kỳ trên danh sách
    $(document).on('click', '.delete', function (event) {
        // stop chuyen link khi nhấn vào thẻ <a>
        event.preventDefault();
        // hiển thị Sweetalert2 và xoá bằng ajax 
        // hoặc uncomment showModalConfirm() để xoá theo kiểu bình thường
        showConfirm(event.currentTarget);
        // hoặc sử dụng Bootstrap Modal
        //showModalConfirm(event.currentTarget); // lấy phần tử <a> vừa được click
    })


    $(document).on('click', '#logout', function (event) {
        // stop chuyen link khi nhấn vào thẻ <a>
        event.preventDefault();
        // hiển thị Sweetalert2 và xoá bằng ajax 
        // hoặc uncomment showModalConfirm() để xoá theo kiểu bình thường
        showConfirmLogout(event.currentTarget);
        // hoặc sử dụng Bootstrap Modal
        //showModalConfirmLogout(event.currentTarget); // lấy phần tử <a> vừa được click
    })
});

// hàm hiển thị thông báo SweetAlert xác nhận đăng xuất
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
        }
    });
};

// hàm logout bằng Ajax
function ajaxLogout(e) {
    var url = $(e).prop('href');
    var csrf = $(e).data('csrf');

    $.ajax({
        method: "POST",
        url: url,
        data: {
            _token: csrf
        }
    }).done(function (response) { // nếu đăng xuất thành công

        // Show thông báo tạm biệt và redirect đến trang trong redirect attribute

        Swal.fire({

            icon: 'info',
            title: 'Bye! Hẹn gặp lại bạn sớm',
            showConfirmButton: false,
            timer: 2000
        });
        let redirect_url = $(e).data('redirect');
        window.location.href = redirect_url;

    });
};

// hàm hiển thị thông báo SweetAlert xác nhận xoá
function showConfirm(e) {
    Swal.fire({
        title: 'Bạn chắc chắn?',
        html: "<p>Xóa <b>" + $(e).data('name') + "</b> có <b>ID = " + $(e).data('id') + "</b></p> <p>Bạn sẽ không thể hoàn tác</p>",
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
            id: id,
            _token: csrf
        }
    }).done(function (response) { // nếu xoá thành công

        // Gọi hàm reloadList để load lại danh sách trên form
        let reload_url = $(e).data('return-url');
        // thẻ <div> chứa danh sách các thông tin
        let target = $('.table');
        reloadList(reload_url, target);
        Swal.fire(
            'Deleted!',
            response.message,
            'success'
        );

    }).fail(function (response) { // nếu thất bại
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
    }).done(function (response) {
        $(target).html(response.data);
    }).fail(function () {
        Swal.fire(
            'Error',
            'Unable to reload the contact list. Try again.',
            'error'
        )
    });
}


