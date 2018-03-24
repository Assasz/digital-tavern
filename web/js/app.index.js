$(document).ready(function () {
    loadIndexActions();
});

$(document).on('pjax:end', function () {
    loadIndexActions();
});

function loadIndexActions() {
    $(document).on('keyup', '.form-control', function () {
        $(this).parent().find('.floating-label').toggleClass('float', $(this).val().length > 0);
    });

    $(document).on('focus', '.form-control', function () {
        $(this).removeAttr('readonly');
    });

    $('[data-action="show-password"]').click(function () {
        if($('#password').attr('type') == 'password'){
            $('#password').attr('type', 'text');
            $(this).html('<span class="fa fa-fw fa-eye-slash" aria-hidden="true"></span>\n' +
                '<span class="offscreen">Hide password</span>');
        } else {
            $('#password').attr('type', 'password');
            $(this).html('<span class="fa fa-fw fa-eye" aria-hidden="true"></span>\n' +
                '<span class="offscreen">Show password</span>');
        }
    });

    $("#signup_form").validate({
        rules: {
            email: {
                remote: {
                    url: emailCheckRoute,
                    type: "post",
                    dataType: "json",
                    data: {
                        email: function () {
                            return $("#email").val();
                        }
                    },
                    dataFilter: function(data) {
                        var response = JSON.parse(data);
                        if(response === "true") {
                            return true;
                        }
                        return "\"" + response + "\"";
                    }
                },
                required: true,
                email: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            password: {
                required: true,
                minlength: 6,
                normalizer: function(value) {
                    return $.trim(value);
                }
            }
        },
        onkeyup: false,
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo( element.parent() );
        }
    });
}