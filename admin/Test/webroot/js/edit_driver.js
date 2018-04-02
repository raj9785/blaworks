$(document).ready(function () {
    $("#submit_button").click(function () {
        function check_otp() {
            $(".otp_box").trigger("click");
            $.ajax({
                url: WEBSITE_URL + "admin/usermgmt/usermgmt/send_otp",
                data: {'mobile': $("#mobile").val()},
                type: 'post',
                //dataType: 'json',
                success: function (result) {
                    if (result) {
                        $("#UsermgmtOtp").val(result);
                    }
                }
            });

        }

        if ($.trim($("#UsermgmtCompanyId").val()) == "") {
            $("#company_id-error").html("Please select company");
            $("#UsermgmtCompanyId").parent('div').addClass('has-error');
            $("#UsermgmtCompanyId").focus();
            return false;
        } else {
            $("#UsermgmtCompanyId").parent('div').removeClass('has-error');
            $("#UsermgmtCompanyId-error").html("");
        }
        if ($.trim($("#firstname").val()) == "") {
            $("#firstname-error").html("Please specify first name of driver");
            $("#firstname").parent('div').addClass('has-error');
            $("#firstname").focus();
            return false;
        } else {
            $("#firstname").parent('div').removeClass('has-error');
            $("#firstname-error").html("");
        }
        if ($.trim($("#lastname").val()) == "") {
            $("#lastname-error").html("Please specify last name of driver");
            $("#lastname").parent('div').addClass('has-error');
            $("#lastname").focus();
            return false;
        } else {
            $("#lastname").parent('div').removeClass('has-error');
            $("#lastname-error").html("");
        }

        if ($.trim($("#email").val()) != "") {
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


        if ($.trim($("#dob").val()) == "") {
            $("#dob-error").html("Please select date of birth");
            $("#dob").parent('div').addClass('has-error');
            $("#dob").focus();
            return false;
        } else {
            $("#dob").parent('div').removeClass('has-error');
            $("#dob-error").html("");
        }

        if ($.trim($("#mobile").val()) == "") {
            $("#mobile-error").html("Please enter mobile number");
            $("#mobile").parent('div').addClass('has-error');
            $("#mobile").focus();
            return false;
        } else {
            $("#mobile").parent('div').removeClass('has-error');
            $("#mobile-error").html("");
        }
        if (isNaN($.trim($("#mobile").val()))) {
            $("#mobile-error").html("Only numeric value is allowed");
            $("#mobile").parent('div').addClass('has-error');
            $("#mobile").focus();
            return false;
        } else {
            $("#mobile").parent('div').removeClass('has-error');
            $("#mobile-error").html("");
        }
        if ($("#mobile").val().length < 10 || $("#mobile").val().length > 10) {
            $("#mobile-error").html("Mobile number can be of 10 digits only ");
            $("#mobile").parent('div').addClass('has-error');
            $("#mobile").focus();
            return false;
        } else {
            $("#mobile").parent('div').removeClass('has-error');
            $("#mobile-error").html("");
        }
        if ($.trim($("#address").val()) == "") {
            $("#address-error").html("Please enter address");
            $("#address").parent('div').addClass('has-error');
            $("#address").focus();
            return false;
        } else {
            $("#address").parent('div').removeClass('has-error');
            $("#address-error").html("");
        }

        if ($.trim($("#permanent_address").val()) == "") {
            $("#permanent_address-error").html("Please enter permanent address");
            $("#permanent_address").parent('div').addClass('has-error');
            $("#permanent_address").focus();
            return false;
        } else {
            $("#permanent_address").parent('div').removeClass('has-error');
            $("#permanent_address-error").html("");
        }

        if ($.trim($("#UsermgmtStateId").val()) == "") {
            $("#state_id-error").html("Please select state");
            $("#UsermgmtStateId").parent('div').addClass('has-error');
            $("#UsermgmtStateId").focus();
            return false;
        } else {
            $("#UsermgmtStateId").parent('div').removeClass('has-error');
            $("#state_id-error").html("");
        }
        if ($.trim($("#UsermgmtCityId").val()) == "") {
            $("#city_id-error").html("Please select city");
            $("#UsermgmtCityId").parent('div').addClass('has-error');
            $("#UsermgmtCityId").focus();
            return false;
        } else {
            $("#UsermgmtCityId").parent('div').removeClass('has-error');
            $("#city_id-error").html("");
        }

        if ($.trim($("#license_no").val()) == "") {
            $("#license_no-error").html("Please enter license number");
            $("#license_no").parent('div').addClass('has-error');
            $("#license_no").focus();
            return false;
        } else {
            $("#license_no").parent('div').removeClass('has-error');
            $("#license_no-error").html("");
        }
        if ($.trim($("#license_from").val()) == "") {
            $("#license_from-error").html("Please select license issue date");
            $("#license_from").parent('div').addClass('has-error');
            $("#license_from").focus();
            return false;
        } else {
            $("#license_from").parent('div').removeClass('has-error');
            $("#license_from-error").html("");
        }
        if ($.trim($("#license_to").val()) == "") {
            $("#license_to-error").html("Please select license expiry date");
            $("#license_to").parent('div').addClass('has-error');
            $("#license_to").focus();
            return false;
        } else {
            $("#license_to").parent('div').removeClass('has-error');
            $("#license_to-error").html("");
        }

        if ($("#mobile").val() != $("#UsermgmtOldMobile").val()) {
            if ($("#UsermgmtOtp").val() == '') {
                check_otp();
                return false;
            } else if ($("#UsermgmtOtpStatus").val() == '') {
                check_otp();
                return false;
            }
        }

    });
    $("#firstname,#lastname").on('keypress', function (e) {
        checkAlpha(e);
    });
});
function checkAlpha(e) {
    var KeyID = (window.event) ? event.keyCode : e.which;
    if (KeyID == 0 || KeyID == 8 || KeyID == 32 || KeyID == 38 || KeyID == 45 || KeyID == 46 || (KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122)) {
        return true;
    } else {
        e.preventDefault();
        return false;
    }
}
