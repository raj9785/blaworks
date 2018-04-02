jQuery(document).ready(function () {
    $("#check_all_ofr").on("click", function () {
        $("input[id^=offer_days]").each(function () {
            $("#" + $(this).attr('id')).prop('checked', 'checked');
        });
    });
    $("#uncheck_all_ofr").on("click", function () {
        $("input[id^=offer_days]").each(function () {
            $("#" + $(this).attr('id')).removeAttr('checked');
        });
    });


    $("#add_slider").click(function () {
        if ($.trim($("#slider_image").val()) == "") {
            $("#slider_image-error").html("Please upload image");
            $("#slider_image").parent('div').addClass('has-error');
            $("#slider_image").focus();
            return false;
        } else {
            $("#slider_image").parent('div').removeClass('has-error');
            $("#slider_image-error").html("");
        }
        if ($.trim($("#slider_width").val()) != "1438" && $.trim($("#slider_height").val()) != "544") {
            $("#slider_image-error").html("Please upload 1438 X 544 size image");
            $("#slider_image").parent('div').addClass('has-error');
            $("#slider_image").focus();
            return false;
        } else {
            $("#slider_image").parent('div').removeClass('has-error');
            $("#slider_image-error").html("");
        }
        if ($("input[id^=offer_days]:checked").length == 0) {
            $("#offer_days-error").html("Please Select days");
            $("#offer_days").parent('div').addClass('has-error');
            $("#offer_days").focus();
            return false;
        } else {
            $("#offer_days").parent('div').removeClass('has-error');
            $("#offer_days-error").html("");
        }


    });

    $('#slider_width').val('');
    $('#slider_height').val('');
    $("#slider_image").change(function () {
        var file = this.files[0];
        displayPreview(file);
    });

    $(".popup").fancybox({
        helpers: {
            title: {
                type: 'float'
            }
        }
    });

    $("#edit_slider").click(function () {
        
        if ($("input[id^=offer_days]:checked").length == 0) {
            $("#offer_days-error").html("Please Select days");
            $("#offer_days").parent('div').addClass('has-error');
            $("#offer_days").focus();
            return false;
        } else {
            $("#offer_days").parent('div').removeClass('has-error');
            $("#offer_days-error").html("");
        }
    });
});

function displayPreview(files) {
    var reader = new FileReader();
    var img = new Image();
    reader.onload = function (e) {
        img.src = e.target.result;
        fileSize = Math.round(files.size / 1024);
        //alert("File size is " + fileSize + " kb");

        img.onload = function () {
            var height = this.height;
            var width = this.width;
            $('#slider_width').val(width);
            $('#slider_height').val(height);
        };
    };
    reader.readAsDataURL(files);

}