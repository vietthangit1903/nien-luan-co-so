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
        showConfirm(event.currentTarget);
    })


    $(document).on('click', '#logout', function (event) {
        // stop chuyen link khi nhấn vào thẻ <a>
        event.preventDefault();
        // hiển thị Sweetalert2 và logout bằng ajax 
        showConfirmLogout(event.currentTarget);
    })

    $(document).on('change', '#semester_form', function (event) {
        var semester_no = document.querySelector('#semester_form #semester_no').value;
        var semester_name = document.querySelector('#semester_form #semester_name').value;
        var url = $(event).prop('action')
        $.ajax({
            method: "GET",
            url: url,
            data: {
                semester_no: semester_no,
                semester_name: semester_name,
            }
        }).done(function (response) {
            $('.table').html(response.data);
        }).fail(function () {
            Swal.fire(
                'Lỗi',
                'Không thể hiển thị view, thử lại.',
                'error'
            )
        });
    })

    $(document).on('click', '.register_topic', function (event) {
        // stop chuyen link khi nhấn vào thẻ <a>
        event.preventDefault();
        ajaxRegisterTopic(event.currentTarget);
    })

    $(document).on('click', '.cancel_register_topic', function (event) {
        // stop chuyen link khi nhấn vào thẻ <a>
        event.preventDefault();

        showConfirmCancelRegisterTopic(event.currentTarget);
    })

    $(document).on('click', '.cancel_report_submission', function (event) {
        // stop chuyen link khi nhấn vào thẻ <a>
        event.preventDefault();

        showConfirmCancelReportSubmission(event.currentTarget);
    })

});

function showConfirmCancelRegisterTopic(e) {
    Swal.fire({
        title: 'Bạn chắc chắn muốn hủy đăng ký niên luận này',
        icon: 'question',
        iconColor: '#00b4d8',
        showCancelButton: true,
        cancelButtonColor: '#dc3545',
        cancelButtonText: 'Hủy',
        confirmButtonColor: '#58bb43',
        confirmButtonText: 'Đồng ý'
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxRegisterTopic(e);
        }
    });
};

//Ajax register topic
function ajaxRegisterTopic(e) {
    var id = $(e).data('id')
    var csrf = $(e).data('csrf')
    var url = $(e).prop('href')
    var return_url = $(e).data('return-url')

    $.ajax({
        method: "POST",
        url: url,
        data: {
            _token: csrf,
            id: id
        }
    }).done(function (response) {
        //Hiện toastr message thành công
        toastr.success(response.message);
        //Reload lại trang
        reloadList(return_url, '.table');

    }).fail(function (response) {
        toastr.error(response.responseJSON.message);
    })

}

function showConfirmCancelReportSubmission(e) {
    Swal.fire({
        title: 'Bạn chắc chắn?',
        icon: 'question',
        html: "<p>Hủy nộp báo cáo chính của niên luận</p><p>Bạn sẽ không thể hoàn tác</p>",
        iconColor: '#00b4d8',
        showCancelButton: true,
        cancelButtonColor: '#dc3545',
        cancelButtonText: 'Hủy',
        confirmButtonColor: '#58bb43',
        confirmButtonText: 'Đồng ý'
    }).then((result) => {
        if (result.isConfirmed) {
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
            }).done(function (response) {
                var redirect_url = $(e).data('redirect');
                window.location.href = redirect_url;
                //Hiện toastr message thành công
                toastr.success(response.message);
        
            }).fail(function (response) {
                toastr.error(response.responseJSON.message);
            })
        }
    });
};


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
    var text
    if ($(e).data('name'))
        text = "<p>Xóa <b>" + $(e).data('name') + "</b> có <b>ID = " + $(e).data('id') + "</b></p> <p>Bạn sẽ không thể hoàn tác</p>"
    else
        text = "<p>Bạn sẽ không thể hoàn tác</p>"
    Swal.fire({
        title: 'Bạn chắc chắn?',
        html: text,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#dc3545',
        cancelButtonText: 'Hủy',
        confirmButtonColor: '#58bb43',
        confirmButtonText: 'Đồng ý'
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxDelete(e);
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
            'Đã xóa!',
            response.message,
            'success'
        );

    }).fail(function (response) { // nếu thất bại
        Swal.fire(
            'Lỗi',
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
            'Lỗi!',
            'Không thể tải lại danh sách. Thử lại.',
            'error'
        )
    });
}


