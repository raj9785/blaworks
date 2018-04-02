$(document).ready(function () {
    $("#add_event").click(function () {
        if ($.trim($("#event_name").val()) == "") {
            $("#event_name-error").html("Please enter event name");
            $("#event_name").parent('div').addClass('has-error');
            $("#event_name").focus();
            return false;
        } else {
            $("#event_name").parent('div').removeClass('has-error');
            $("#event_name-error").html("");
        }
        if ($.trim($("#event_date_time").val()) == "") {
            $("#event_date_time-error").html("Please select event date and time");
            $("#event_date_time").parent('div').addClass('has-error');
            $("#event_date_time").focus();
            return false;
        } else {
            $("#event_date_time").parent('div').removeClass('has-error');
            $("#event_date_time-error").html("");
        }

        if ($.trim($("#city").val()) == "") {
            $("#city-error").html("Please enter city");
            $("#city").parent('div').addClass('has-error');
            $("#city").focus();
            return false;
        } else {
            $("#city").parent('div').removeClass('has-error');
            $("#city-error").html("");
        }
        if ($.trim($("#event_type").val()) == "") {
            $("#event_type-error").html("Please enter event type");
            $("#event_type").parent('div').addClass('has-error');
            $("#event_type").focus();
            return false;
        } else {
            $("#event_type").parent('div').removeClass('has-error');
            $("#event_type-error").html("");
        }

        if ($.trim($("#event_url").val()) == "") {
            $("#event_url-error").html("Please enter event url");
            $("#event_url").parent('div').addClass('has-error');
            $("#event_url").focus();
            return false;
        } else {
            $("#event_url").parent('div').removeClass('has-error');
            $("#event_url-error").html("");
        }
        if ($.trim($("#description").val()) == "") {
            $("#description-error").html("Please enter description");
            $("#description").parent('div').addClass('has-error');
            $("#description").focus();
            return false;
        } else {
            $("#description").parent('div').removeClass('has-error');
            $("#description-error").html("");
        }
        if ($.trim($("#event_image").val()) == "") {
            $("#event_image-error").html("Please upload event image");
            $("#event_image").parent('div').addClass('has-error');
            $("#event_image").focus();
            return false;
        } else {
            $("#event_image").parent('div').removeClass('has-error');
            $("#event_image-error").html("");
        }
    });
    $("#edit_event").click(function () {
        if ($.trim($("#event_name").val()) == "") {
            $("#event_name-error").html("Please enter event name");
            $("#event_name").parent('div').addClass('has-error');
            $("#event_name").focus();
            return false;
        } else {
            $("#event_name").parent('div').removeClass('has-error');
            $("#event_name-error").html("");
        }
        if ($.trim($("#event_date_time").val()) == "") {
            $("#event_date_time-error").html("Please select event date and time");
            $("#event_date_time").parent('div').addClass('has-error');
            $("#event_date_time").focus();
            return false;
        } else {
            $("#event_date_time").parent('div').removeClass('has-error');
            $("#event_date_time-error").html("");
        }

        if ($.trim($("#city").val()) == "") {
            $("#city-error").html("Please enter city");
            $("#city").parent('div').addClass('has-error');
            $("#city").focus();
            return false;
        } else {
            $("#city").parent('div').removeClass('has-error');
            $("#city-error").html("");
        }
        if ($.trim($("#event_type").val()) == "") {
            $("#event_type-error").html("Please enter event type");
            $("#event_type").parent('div').addClass('has-error');
            $("#event_type").focus();
            return false;
        } else {
            $("#event_type").parent('div').removeClass('has-error');
            $("#event_type-error").html("");
        }

        if ($.trim($("#event_url").val()) == "") {
            $("#event_url-error").html("Please enter event url");
            $("#event_url").parent('div').addClass('has-error');
            $("#event_url").focus();
            return false;
        } else {
            $("#event_url").parent('div').removeClass('has-error');
            $("#event_url-error").html("");
        }
        if ($.trim($("#description").val()) == "") {
            $("#description-error").html("Please enter description");
            $("#description").parent('div').addClass('has-error');
            $("#description").focus();
            return false;
        } else {
            $("#description").parent('div').removeClass('has-error');
            $("#description-error").html("");
        }
        if ($.trim($("#event_image").val()) == "" && $('#event_imgs').val() == "") {
            $("#event_image-error").html("Please upload event image");
            $("#event_image").parent('div').addClass('has-error');
            $("#event_image").focus();
            return false;
        } else {
            $("#event_image").parent('div').removeClass('has-error');
            $("#event_image-error").html("");
        }
    });

});

