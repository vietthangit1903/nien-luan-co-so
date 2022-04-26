
function Validator(options) {

    var selectorRules = {};

    function validate(inputElement, rule) {
        var errorMessage;
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);

        // Lay ra cac rule cua selector
        var rules = selectorRules[rule.selector];

        // Lap qua tung rule va kiem tra
        // Neu co loi dung kiem tra va tra ve loi
        for (let index = 0; index < rules.length; index++) {
            errorMessage = rules[index](inputElement.value);
            if (errorMessage)
                break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            errorElement.classList.add('invalid-feedback');
            inputElement.classList.add('is-invalid');
        } else {
            errorElement.innerText = '';
            errorElement.classList.remove('invalid-feedback');
            inputElement.classList.remove('is-invalid');
            inputElement.classList.add('is-valid');

        }
    }
    // Lay form element
    var formElement = document.querySelector(options.form);

    if (formElement) {

        // Lap qua moi rule va xu ly
        options.rules.forEach(function (rule) {
            // Luu lai cac rule cho moi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else
                selectorRules[rule.selector] = [rule.test];


            var inputElement = formElement.querySelector(rule.selector);
            var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
            if (inputElement) {
                //Xu ly khi blur khoi input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }

                //Xu ly khi nguoi dung nhap
                inputElement.oninput = function () {
                    errorElement.innerText = '';
                    errorElement.classList.remove('invalid-feedback');
                    inputElement.classList.remove('is-invalid');
                    inputElement.classList.remove('is-valid');
                }

                inputElement.onfocus = function () {
                    errorElement.innerText = '';
                    errorElement.classList.remove('invalid-feedback');
                    inputElement.classList.remove('is-invalid');
                    inputElement.classList.remove('is-valid');
                }
            }
        });

        // console.log(selectorRules);
    }
}

// Dinh nghia cac rang buoc
// Nguyen tac cua rang buoc
/*
 1. Khi co loi => tra ve message loi
 2. Khi hop le tra ve undefined
 */

Validator.isRequired = function (selector, message = 'Vui lòng nhập trường này') {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : message;
        }
    };
};

Validator.isUsername = function (selector, message = 'Only letters, numbers, underscore and at least 6 characters and maximum 20 characters') {
    return {
        selector: selector,
        test: function (value) {
            var regexUsername = /^[a-zA-Z0-9_]{6,20}$/
            return regexUsername.test(value) ? undefined : message;
        }
    };
};

Validator.isEmail = function (selector, message = 'Email không đúng định dạng') {
    return {
        selector: selector,
        test: function (value) {
            var regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return regexEmail.test(value) ? undefined : message;
        }
    };
};

Validator.isPassword = function (selector, message = 'Mật khẩu phải chứa chữ cái IN HOA, số, ký tự đặc biệt và tối thiểu 8 ký tự') {
    return {
        selector: selector,
        test: function (value) {
            var regexPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/
            return regexPassword.test(value) ? undefined : message;
        }
    }
};

Validator.isConfirmed = function (selector, getConfirmValue, message = 'Giá trị nhập lại không khớp.') {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : message;
        }
    };
};

Validator.isPhoneNumber = function (selector, message = 'Sai định dạng số điện thoại') {
    return {
        selector: selector,
        test: function (value) {
            var regexVietnamPhoneNumber = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
            return regexVietnamPhoneNumber.test(value) ? undefined : message;
        }
    };
};


Validator.isYear = function (selector, message = 'Sai định dạng năm') {
    return {
        selector: selector,
        test: function (value) {
            var regexYear = /^(19|20)\d{2}$/;
            return regexYear.test(value) ? undefined : message;
        }
    }
};


// Kiem tra ngay theo dinh dang yyyy-mm-dd, co kiem tra nam nhuan va so ngay trong thang
Validator.isDate = function (selector, message = 'Sai định dạng ngày tháng năm') {
    return {
        selector: selector,
        test: function (value) {
            var regexDate = /^(?:(?:1[6-9]|[2-9]\d)?\d{2})(?:(?:(\/|-|\.)(?:0?[13578]|1[02])\1(?:31))|(?:(\/|-|\.)(?:0?[13-9]|1[0-2])\2(?:29|30)))$|^(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(\/|-|\.)0?2\3(?:29)$|^(?:(?:1[6-9]|[2-9]\d)?\d{2})(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:0?[1-9]|1\d|2[0-8])$/g;
            return regexDate.test(value) ? undefined : message;
        }
    }
};

Validator.max = function (selector, maxValue, message = 'Giá trị không được vượt quá ' + maxValue) {
    return {
        selector: selector,
        test: function (value) {
            return value <=  maxValue ? undefined : message;
        }
    };
};
