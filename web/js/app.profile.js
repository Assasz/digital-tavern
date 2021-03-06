$(document).ready(function () {
    var width, height;

    $.validator.addMethod('imageSize', function (value, element) {
        return (width >= 300 && height >= 300 && width/height === 1);
    }, 'This avatar is of invalid size.');

    $("#profile_form").validate({
        rules: {
            avatar: {
                extension: "jpg|jpeg|png",
                imageSize: {
                    depends: function(element) {
                        return ($('#avatar').val().length > 0);
                    }
                }
            },
            ign: {
                required: true,
                maxlength: 36,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            full: {
                maxlength: 20000,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            origin: {
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            race: {
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            age: {
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            occupation: {
                maxlength: 255,
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

    $(document).on('change', '#avatar', function () {
        $('.file-label').html($(this).val());

        if ($(this).prop('files') && $(this).prop('files')[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var image = new Image();

                image.src = e.target.result;
                image.onload = function () {
                    width = this.width;
                    height = this.height;

                    if($('#avatar').valid()){
                        $('label[for="avatar"]').removeClass('is-invalid').addClass('is-valid');
                        $('#avatar_preview').attr('src', e.target.result);
                    } else {
                        $('label[for="avatar"]').removeClass('is-valid').addClass('is-invalid');
                    }
                };
            };

            reader.readAsDataURL($(this).prop('files')[0]);
        }
    });

    CKEDITOR.replace('full', {
        toolbar :
            [
                ['Bold','Italic','Underline','Strike','RemoveFormat'],
                ['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                ['Link','Unlink','Anchor'],
                ['Image','Table','HorizontalRule','SpecialChar'],
                ['Format','FontSize','TextColor'],
                ['Maximize']
            ],
    });

    if(typeof fullValue !== 'undefined'){
        CKEDITOR.instances.full.setData(fullValue);
    }
});
