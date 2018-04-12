$(document).ready(function () {
    loadSessionCreateActions();
});

$(document).on('pjax:end', function () {
    loadSessionCreateActions();
});

function loadSessionCreateActions() {
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

    var width, height;

    $.validator.addMethod('imageSize', function (value, element) {
        return (width >= 1200 && height >= 400 && width/height === 3);
    }, 'This image is of invalid size.');

    $.validator.addMethod('greaterThan', function (value, element, param) {
        return (value > param);
    }, 'Must be greater than 1.');

    $("#session_form").validate({
        rules: {
            image: {
                extension: "jpg|jpeg|png",
                imageSize: {
                    depends: function(element) {
                        return ($('#image').val().length > 0);
                    }
                }
            },
            name: {
                required: true,
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            description: {
                required: true,
                maxlength: 300,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            plotBackground: {
                required: true,
                maxlength: 5000,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            location: {
                required: true,
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            token: {
                required: {
                    depends: function (element) {
                        return ($('#password').val().length > 0);
                    }
                },
                maxlength: 255,
                minlength: 6,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            password: {
                minlength: 6,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            playersLimit: {
                greaterThan: {
                    param: 1,
                    depends: function (element) {
                        return ($(element).val().length > 0);
                    }
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

    $(document).on('change', '#image', function () {
        $('.file-label').html($(this).val());

        if ($(this).prop('files') && $(this).prop('files')[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var image = new Image();

                image.src = e.target.result;
                image.onload = function () {
                    width = this.width;
                    height = this.height;

                    if($('#image').valid()){
                        $('label[for="image"]').removeClass('is-invalid').addClass('is-valid');
                        $('#image_preview').attr('src', e.target.result);
                    } else {
                        $('label[for="image"]').removeClass('is-valid').addClass('is-invalid');
                    }
                };
            };

            reader.readAsDataURL($(this).prop('files')[0]);
        }
    });
}