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


        if ($.trim($("#video_path").val())) {
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




    });

});

