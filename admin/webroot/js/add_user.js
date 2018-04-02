$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#firstname").val()) == "") {
            $("#firstname-error").html("Please specify first name of user");
            $("#firstname").parent('div').addClass('has-error');
            $("#firstname").focus();
            return false;
        } else {
            $("#firstname").parent('div').removeClass('has-error');
            $("#firstname-error").html("");
        }
        if ($.trim($("#lastname").val()) == "") {
            $("#lastname-error").html("Please specify last name of user");
            $("#lastname").parent('div').addClass('has-error');
            $("#lastname").focus();
            return false;
        } else {
            $("#lastname").parent('div').removeClass('has-error');
            $("#lastname-error").html("");
        }
        if ($.trim($("#email").val()) == "") {
            $("#email-error").html("Please specify email address");
            $("#email").parent('div').addClass('has-error');
            $("#email").focus();
            return false;
        } else {
            var string = $("#email").val()
            var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if (filter.test(string)) {
                testresult = true;
                $("#email-error").html("");
                $("#email").parent('div').removeClass('has-error');
            } else {
                $("#email-error").html('Please enter a valid email address');
                $("#email").parent('div').addClass('has-error');
                $("#email").val("");
                $("#email").focus();
                return false
            }
        }
        if ($.trim($("#mobile").val()) == "") {
            $("#phone_no-error").html("Please specify mobile number");
            $("#mobile").parent('div').addClass('has-error');
            $("#mobile").focus();
            return false;
        } else {
            $("#mobile").parent('div').removeClass('has-error');
            $("#phone_no-error").html("");
        }
        if ($.trim($("#user_password").val()) == "") {
            $("#user_password-error").html("Please specify password");
            $("#user_password").parent('div').addClass('has-error');
            $("#user_password").focus();
            return false;
        } else {
            $("#user_password").parent('div').removeClass('has-error');
            $("#user_password-error").html("");
        }
        if ($.trim($("#confirm_password").val()) == "") {
            $("#confirm_password-error").html("Please confirm password");
            $("#confirm_password").parent('div').addClass('has-error');
            $("#confirm_password").focus();
            return false;
        } else {
            $("#confirm_password").parent('div').removeClass('has-error');
            $("#confirm_password-error").html("");
        }

        if ($.trim($("#confirm_password").val()) != $.trim($("#user_password").val())) {
            $("#confirm_password-error").html("Both passwords do not match");
            $("#confirm_password").parent('div').addClass('has-error');
            $("#confirm_password").focus();
            return false;
        } else {
            $("#confirm_password").parent('div').removeClass('has-error');
            $("#confirm_password-error").html("");
        }

    });
});