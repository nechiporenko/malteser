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

    var $form = $('#oform');
    var request;

    $form.on('click', '.g-alert__close', function () {
        $(this).parents('.g-alert').hide();
    });

    $form.on('submit', function (e) {
        e.preventDefault();
        var valid = validate($form);
        if (valid) {
            var of_name = $('#of_name').val(),
                of_mail = $('#of_mail').val(),
                of_service = $('#of_service').val(),
                of_phone = $('#of_phone').val(),
                of_msg = $('#of_msg').val();
            $.ajax({
                type: "POST",
                url: "/wp-content/themes/malteser/handlers/order-form-handler.php",
                dataType: 'json',
                data: {
                    "of_name": of_name,
                    "of_mail": of_mail,
                    "of_service": of_service,
                    "of_phone": of_phone,
                    "of_msg": of_msg,
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
                        $form.find('.g-select').prop('selectedIndex', 0);
                        grecaptcha.reset();
                        $form.find('.g-alert--ok').show();
                        postToGoogle(of_name, of_mail, of_service, of_phone, of_msg);
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

    function postToGoogle(name, mail, service, phone, msg) {
        // Abort any pending request
        if (request) {
            request.abort();
        }
        // Fire off the request to /form.php
        request = $.ajax({
            url: "https://script.google.com/macros/s/AKfycbw2i9YRLKVGqeNDiuRze0Da4_eYE4fqYu8CM83Y4LTVbvKiwpq4/exec",
            type: "POST",
            data: {
                "name": name,
                "mail": mail,
                "service": service,
                "phone": phone,
                "msg": msg
            }
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            console.log("Hooray, it worked!");
            console.log(response);
            console.log(textStatus);
            console.log(jqXHR);
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });
    }
});