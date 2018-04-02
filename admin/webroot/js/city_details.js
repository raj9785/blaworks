$(document).ready(function () {
    $("#city_details").click(function () {
//        if ($.trim($("#city_color_code").val()) == "") {
//            $("#city_color_code-error").html("Please enter city color code");
//            $("#city_color_code").parent('div').addClass('has-error');
//            $("#city_color_code").focus();
//            return false;
//        } else {
//            $("#city_color_code").parent('div').removeClass('has-error');
//            $("#city_color_code-error").html("");
//        }

//        if ($.trim($("#tag_line").val()) == "") {
//            $("#tag_line-error").html("Please enter tag line");
//            $("#tag_line").parent('div').addClass('has-error');
//            $("#tag_line").focus();
//            return false;
//        } else {
//            $("#tag_line").parent('div').removeClass('has-error');
//            $("#tag_line-error").html("");
//        }

//        if ($.trim($("#video_url").val()) == "") {
//            $("#video_url-error").html("Please enter video url");
//            $("#video_url").parent('div').addClass('has-error');
//            $("#video_url").focus();
//            return false;
//        } else {
//            $("#video_url").parent('div').removeClass('has-error');
//            $("#video_url-error").html("");
//        }

        if ($.trim($("#heading_first").val()) == "") {
            $("#heading_first-error").html("Please select");
            $("#heading_first").parent('div').addClass('has-error');
            $("#heading_first").focus();
            return false;
        } else {
            $("#heading_first").parent('div').removeClass('has-error');
            $("#heading_first-error").html("");
        }
        if ($.trim($("#heading_second").val()) == "") {
            $("#heading_second-error").html("Please select");
            $("#heading_second").parent('div').addClass('has-error');
            $("#heading_second").focus();
            return false;
        } else {
            $("#heading_second").parent('div').removeClass('has-error');
            $("#heading_second-error").html("");
        }



        if ($.trim($("#value_first").val()) == "") {
            $("#value_first-error").html("Please enter value for first heading");
            $("#value_first").parent('div').addClass('has-error');
            $("#value_first").focus();
            return false;
        } else {
            $("#value_first").parent('div').removeClass('has-error');
            $("#value_first-error").html("");
        }

        if ($.trim($("#value_second").val()) == "") {
            $("#value_second-error").html("Please enter value for second heading");
            $("#value_second").parent('div').addClass('has-error');
            $("#value_second").focus();
            return false;
        } else {
            $("#value_second").parent('div').removeClass('has-error');
            $("#value_second-error").html("");
        }




        var description = CKEDITOR.instances.description.document.getBody().getChild(0).getText();

        if ($.trim(description) == "") {
            $("#description-error").html("Please enter description").css('color','red');
            $(description).parent('div').addClass('has-error');
            $(description).focus();
            return false;
        } else {
            $(description).parent('div').removeClass('has-error');
            $("#description-error").html("");
        }
//        if ($.trim($("#header_image").val()) == "" && $.trim($("#header_imgs").val()) == "") {
//            $("#header_image-error").html("Please upload left header image");
//            $("#header_image").parent('div').addClass('has-error');
//            $("#header_image").focus();
//            return false;
//        } else {
//            $("#header_image").parent('div').removeClass('has-error');
//            $("#header_image-error").html("");
//        }
//         if ($.trim($("#header_image_right").val()) == "" && $.trim($("#header_imgs_rt").val()) == "") {
//            $("#header_image_right-error").html("Please upload right header image");
//            $("#header_image_right").parent('div').addClass('has-error');
//            $("#header_image_right").focus();
//            return false;
//        } else {
//            $("#header_image_right").parent('div').removeClass('has-error');
//            $("#header_image_right-error").html("");
//        }
//        if ($.trim($("#footer_image").val()) == ""&& $.trim($("#footer_imgs").val()) == "") {
//            $("#footer_image-error").html("Please upload footer image");
//            $("#footer_image").parent('div').addClass('has-error');
//            $("#footer_image").focus();
//            return false;
//        } else {
//            $("#footer_image").parent('div').removeClass('has-error');
//            $("#footer_image-error").html("");
//        }
    });

});

