$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#UsermgmtFirstname").val()) == "") {
            alert("Please specify first name of corporate business");
            $("#UsermgmtFirstname").focus();
            return false;
        }
        if ($.trim($("#UsermgmtLastname").val()) == "") {
            alert("Please specify last name of corporate business");
            $("#UsermgmtLastname").focus();
            return false;
        }
//        if ($("input[name='data[Usermgmt][gender]']:checked").length == 0) {
//            alert("Please select gender of driver");
//            $("#UsermgmtGender1").focus();
//            return false;
//        }

        if ($.trim($("#UsermgmtMobile").val()) == "") {
            alert("Please enter mobile number");
            $("#UsermgmtMobile").focus();
            return false;
        }
        if (isNaN($.trim($("#UsermgmtMobile").val()))) {
            alert("Only numeric value is allowed");
            $("#UsermgmtMobile").focus();
            return false;
        }
        if ($("#UsermgmtMobile").val().length < 10 || $("#UsermgmtMobile").val().length > 10) {
            alert("Mobile number can be of 10 digits only ");
            $("#UsermgmtMobile").focus();
            return false;
        }
//        if ($.trim($("#UsermgmtPassword").val()) == "") {
//            alert("Please specify password");
//            $("#UsermgmtPassword").focus();
//            return false;
//        }
//        if ($.trim($("#UsermgmtPassword").val()).length < 6 || $.trim($("#UsermgmtPassword").val()).length > 20) {
//            alert("Password should be between 6 to 20 characters only");
//            $("#UsermgmtPassword").focus();
//            return false;
//        }

        if ($.trim($("#CompanyBank").val()) == "") {
            $("#CompanyBank-error").html("Please specify Account Number");
            $("#CompanyBank").parent('div').addClass('has-error');
            $("#CompanyBank").focus();
            return false;
        } else {
            $("#CompanyBank").parent('div').removeClass('has-error');
            $("#CompanyBank-error").html("");
        }

        if ($.trim($("#CompanyVrerifyBank").val()) == "") {
            $("#CompanyVrerifyBank-error").html("Please Verify Account Number");
            $("#CompanyVrerifyBank").parent('div').addClass('has-error');
            $("#CompanyVrerifyBank").focus();
            return false;
        } else {
            $("#CompanyVrerifyBank").parent('div').removeClass('has-error');
            $("#CompanyVrerifyBank-error").html("");
        }

        if ($.trim($("#CompanyVrerifyBank").val()) != $.trim($("#CompanyBank").val())) {
            $("#CompanyVrerifyBank-error").html("Account Number or Verify Account Number Do not match");
            alert("Account Number or Verify Account Number Do not match");
            $("#CompanyVrerifyBank").parent('div').addClass('has-error');
            $("#CompanyVrerifyBank").focus();
            return false;
        } else {
            $("#CompanyVrerifyBank").parent('div').removeClass('has-error');
            $("#CompanyVrerifyBank-error").html("");
        }




//        if ($.trim($("#uploadimage").val()) == "") {
//            alert("Please Upload Image");
//            $("#uploadimage").focus();
//            return false;
//        }
//        if ($.trim($("#passport_proof_img").val()) == "" && $.trim($("#identity_proof_img").val()) == "" && $.trim($("#aadhar_proof_img").val()) == "" && $.trim($("#license_proof_img").val()) == "") {
//            alert("Please Upload Aleast One Identity Proof");
//            $("#identity_proof_img").focus();
//            return false;
//        }
        if ($.trim($("#UsermgmtAddress").val()) == "") {
            alert("Please enter address");
            $("#UsermgmtAddress").focus();
            return false;
        }
        if ($.trim($("#UsermgmtResidenceAddress").val()) == "") {
            alert("Please enter residence address");
            $("#UsermgmtResidenceAddress").focus();
            return false;
        }
        if ($.trim($("#UsermgmtPenCard").val()) == "") {
            alert("Please enter pen card number");
            $("#UsermgmtPenCard").focus();
            return false;
        }

        if ($.trim($("#CompanyName").val()) == "") {
            alert("Please enter company name");
            $("#CompanyName").focus();
            return false;
        }

        if ($.trim($("#CompanyAddress").val()) == "") {
            alert("Please enter company address");
            $("#CompanyAddress").focus();
            return false;
        }
        if ($.trim($("#CompanyBank").val()) == "") {
            alert("Please enter Bank Account Number");
            $("#CompanyBank").focus();
            return false;
        }
        if (isNaN($.trim($("#CompanyBank").val()))) {
            alert("Only numeric value is allowed");
            $("#CompanyBank").focus();
            return false;
        }

        if ($.trim($("#CompanyBankName").val()) == "") {
            alert("Please enter bank name");
            $("#CompanyBankName").focus();
            return false;
        }
        if ($.trim($("#CompanyIfscCode").val()) == "") {
            alert("Please enter IFSC Code");
            $("#CompanyIfscCode").focus();
            return false;
        }
        //if (isNaN($.trim($("#CompanyIfscCode").val()))) {
        if (!($.trim($("#CompanyIfscCode").val())).match(/^(?=.*[a-zA-Z])(?=.*[0-9])/)) {
            alert("Bank IFS Code Only alphanumeric value is allowed");
            $("#CompanyIfscCode").focus();
            return false;
        }
		
		
		if ($("#CompanyIfscCode").val().length < 11 || $("#CompanyIfscCode").val().length > 11) {
            alert("Bank IFS Code should be of 11 digits only ");
            $("#CompanyIfscCode").focus();
            return false;
        }
		var alphanumers = /^[a-zA-Z0-9]+$/;
		if(!alphanumers.test($("#CompanyIfscCode").val())){
			alert("Bank IFS Code should not contain any special character or whitespace");
			$("#CompanyIfscCode").focus();
            return false;
		}
		
		
		
        /* if ($.trim($("#CompanyCountryId").val()) == "") {
         alert("Please select company country");
         $("#CompanyCountryId").focus();
         return false;
         } */
//        if ($.trim($("#CompanyCompType").val()) == "") {
//            alert("Please select company type");
//            $("#CompanyCompType").focus();
//            return false;
//        }

        var comp_type = parseInt($(this).val());
        if (comp_type == 2 || comp_type == 3) {
            if ($.trim($("#CompanyCompPenCard").val()) == "") {
                alert("Please enter company pen card number");
                $("#CompanyCompPenCard").focus();
                return false;
            }
        }

//        if ($("input[name='data[Company][stime]']:checked").length == 0) {
//            alert("Please select search time");
//            $("#CompanyStime1").focus();
//            return false;
//        }
        if ($.trim($("#CompanyStateId").val()) == "") {
            alert("Please select company state");
            $("#CompanyStateId").focus();
            return false;
        }
        if ($.trim($("#CompanyCityId").val()) == "") {
            alert("Please select company city");
            $("#CompanyCityId").focus();
            return false;
        }
        /* if ($.trim($("#CompanyDesc").val()) == "") {
         alert("Please enter company description");
         $("#CompanyDesc").focus();
         return false;
         }*/

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
