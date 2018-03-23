$(document).ready(function () {
    loadProfileCreateActions();
});

$(document).on('pjax:end', function () {
    loadProfileCreateActions();
});

function loadProfileCreateActions() {
    $(document).on('keyup', '.form-control', function () {
        $(this).parent().find('.floating-label').toggleClass('float', $(this).val().length > 0);
    });

    $(document).on('focus', '.form-control', function () {
        $(this).removeAttr('readonly');
    });

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
                    } else {
                        $('label[for="avatar"]').removeClass('is-valid').addClass('is-invalid');
                    }

                    if(this.height >= 300 && this.width >= 300 && this.height/this.width === 1){
                        $('#avatar_preview').attr('src', e.target.result);
                    }
                };
            };

            reader.readAsDataURL($(this).prop('files')[0]);
        }
    });

    CKEDITOR.replace('profile', {
        toolbar :
            [
                ['Bold','Italic','Underline','Strike','RemoveFormat'],
                ['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                ['Link','Unlink','Anchor'],
                ['Image','Table','HorizontalRule','SpecialChar'],
                ['Format','FontSize','TextColor']
            ],
    });
}