jQuery(document).ready(function ($) {
    function validate(form) {
        var $elements = form.find('.js-validate'),
            $btn = form.find('button[type=submit]'),
            isValid = true,
            method = {};

        method.showError = function (el) {
            el.parents('.g-fieldset').addClass('error');
        };
        method.hideError = function (el) {
            el.parents('.g-fieldset').removeClass('error');
        }
        method.checkRequired = function (el, val) {
            if (val.length > 0) {
                method.hideError(el);
            } else {
                method.showError(el);
                isValid = false;
            }
        };
        method.checkEmail = function (el, val) {
            var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (reg.test(val)) {
                method.hideError(el);
            } else {
                method.showError(el);
                isValid = false;
            }
        };
        method.checkPhone = function (el, val) {
            var reg = /^[\d\+]+[\d\(\)\ -]{4,20}\d$/;
            if (reg.test(val) && val.length <= 20) {
                method.hideError(el);
            } else {
                method.showError(el);
                isValid = false;
            };
        };

        method.init = function () {
            $elements.each(function () {
                var $el = $(this),
                    $val = $el.val();
                if ($el.hasClass('js-validate--required')) {
                    method.checkRequired($el, $val);
                };
                if ($el.hasClass('js-validate--email')) {
                    method.checkEmail($el, $val);
                };
                if ($el.hasClass('js-validate--phone')) {
                    method.checkPhone($el, $val);
                };
            });
        }
        method.init();
        return isValid;
    };

    var $form = $('#cform');

    $form.on('click', '.g-alert__close', function () {
        $(this).parents('.g-alert').hide();
    });

    $form.on('submit', function (e) {
        e.preventDefault();
        var valid = validate($form);
        if (valid) {
            var cf_name = $('#cf_name').val(),
                cf_mail = $('#cf_mail').val(),
                cf_msg = $('#cf_msg').val();
            $.ajax({
                type: "POST",
                url: "/wp-content/themes/malteser/handlers/contact-form-handler.php",
                dataType: 'json',
                data: {
                    "cf_name": cf_name,
                    "cf_mail": cf_mail,
                    "cf_msg": cf_msg,
                    "captcha": grecaptcha.getResponse()
                },
                cache: false,
                beforeSend: function (data) {
                    $form.find('button[type=submit]').prop('disabled', true);
                },
                success: function(data){
                    if (data['error']) {
                        alert(data['error']);
                    } else {
                        $form.find('.g-input, .g-textarea').val('');
                        $form.find('.g-select option:first-child').attr('selected', true);
                        grecaptcha.reset();
                        $form.find('.g-alert--ok').show();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    $form.find('.g-alert--wrong').show();
                },
                complete: function (data) {
                    $form.find('button[type=submit]').prop('disabled', false);
                }
            });
        }
    });
});