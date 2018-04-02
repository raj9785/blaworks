$(document).ready(function () {
    var _URL = window.URL || window.webkitURL;
    $('#destination_image').change(function () {
        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function () {
                $('#destination_image_wt').val(this.width);
                $('#destination_image_ht').val(this.height);
                //alert(this.width + " " + this.height);
            };
            img.src = _URL.createObjectURL(file);
        }
    });
    $("#add_destination").click(function () {
        if ($.trim($("#destination_name").val()) == "") {
            $("#destination_name-error").html("Please enter destination name");
            $("#destination_name").parent('div').addClass('has-error');
            $("#destination_name").focus();
            return false;
        } else {
            $("#destination_name").parent('div').removeClass('has-error');
            $("#destination_name-error").html("");
        }

//        if ($.trim($("#description").val()) == "") {
//            $("#description-error").html("Please enter description");
//            $("#description").parent('div').addClass('has-error');
//            $("#description").focus();
//            return false;
//        } else {
//            $("#description").parent('div').removeClass('has-error');
//            $("#description-error").html("");
//        }

        if ($.trim($("#destination_image").val()) == "") {
            $("#destination_image-error").html("Please upload destination image");
            $("#destination_image").parent('div').addClass('has-error');
            $("#destination_image").focus();
            return false;
        } else {
            $("#destination_image").parent('div').removeClass('has-error');
            $("#destination_image-error").html("");
        }

        if ($.trim($("#destination_image_wt").val()) != "1600" && $.trim($("#destination_image_ht").val()) != "400") {
            $("#destination_image-error").html("Image width and height should be 1600px and 400px. please resize the image and try again.");
            $("#destination_image").parent('div').addClass('has-error');
            $("#destination_image").focus();
            return false;
        } else {
            $("#destination_image").parent('div').removeClass('has-error');
            $("#destination_image-error").html("");
        }


    });

    $("#edit_destination").click(function () {
        if ($.trim($("#destination_name").val()) == "") {
            $("#destination_name-error").html("Please enter destination name");
            $("#destination_name").parent('div').addClass('has-error');
            $("#destination_name").focus();
            return false;
        } else {
            $("#destination_name").parent('div').removeClass('has-error');
            $("#destination_name-error").html("");
        }

//        if ($.trim($("#description").val()) == "") {
//            $("#description-error").html("Please enter description");
//            $("#description").parent('div').addClass('has-error');
//            $("#description").focus();
//            return false;
//        } else {
//            $("#description").parent('div').removeClass('has-error');
//            $("#description-error").html("");
//        }

        if ($.trim($("#destination_image").val()) == "" && $.trim($("#destination_imgs").val()) == "") {
            $("#destination_image-error").html("Please upload destination image");
            $("#destination_image").parent('div').addClass('has-error');
            $("#destination_image").focus();
            return false;
        } else {
            $("#destination_image").parent('div').removeClass('has-error');
            $("#destination_image-error").html("");
        }

        if ($.trim($("#destination_image_wt").val()) != "1600" && $.trim($("#destination_image_ht").val()) != "400" && $.trim($("#destination_imgs").val()) == "") {
            $("#destination_image-error").html("Image width and height should be 1600px and 400px. please resize the image and try again.");
            $("#destination_image").parent('div').addClass('has-error');
            $("#destination_image").focus();
            return false;
        } else {
            $("#destination_image").parent('div').removeClass('has-error');
            $("#destination_image-error").html("");
        }


    });

});

