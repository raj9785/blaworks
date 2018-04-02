$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#heading").val()) == "") {
            $("#heading-error").html("Please enter heading");
            $("#heading").parent('div').addClass('has-error');
            $("#heading").focus();
            return false;
        } else {
            $("#heading").parent('div').removeClass('has-error');
            $("#heading-error").html("");
        }

        if ($.trim($("#blog_type").val()) == "") {
            $("#blog_type-error").html("Please select blog type");
            $("#blog_type").parent('div').addClass('has-error');
            $("#blog_type").focus();
            return false;
        } else {
            $("#blog_type").parent('div').removeClass('has-error');
            $("#blog_type-error").html("");
        }
        
        
         if ($.trim($("#city_id").val()) == "") {
            $("#city_id-error").html("Please select from city");
            $("#city_id").parent('div').addClass('has-error');
            $("#city_id").focus();
            return false;
        } else {
            $("#city_id").parent('div').removeClass('has-error');
            $("#city_id-error").html("");
        }
        
        
         if ($.trim($("#to_city_name").val()) == "") {
            $("#to_city_name-error").html("Please select to city");
            $("#to_city_name").parent('div').addClass('has-error');
            $("#to_city_name").focus();
            return false;
        } else {
            $("#to_city_name").parent('div').removeClass('has-error');
            $("#to_city_name-error").html("");
        }
        
        
        
        


        if ($.trim($("#blog_type").val()) == 1) {
            if ($.trim($("#video_path").val()) == "") {
                $("#video_path-error").html("Please enter youtube video url");
                $("#video_path").parent('div').addClass('has-error');
                $("#video_path").focus();
                return false;
            } else {
                var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
                var matches = $('#video_path').val().match(p);
                if (matches) {
                    $("#video_path").parent('div').removeClass('has-error');
                    $("#video_path-error").html("");
                } else {
                    $("#video_path-error").html("Please enter a valid youtube video url");
                    $("#video_path").parent('div').addClass('has-error');
                    $("#video_path").focus();
                    return false;
                }
            }
        } else {
            if ($.trim($("#image").val()) == "") {
                $("#image-error").html("Please select image");
                $("#image").parent('div').addClass('has-error');
                $("#image").focus();
                return false;
            } else {
                $("#image").parent('div').removeClass('has-error');
                $("#image-error").html("");
            }
        }




    });

});

