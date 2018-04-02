$(document).ready(function () {
    $("#submit_button").click(function () {


        if ($.trim($("#company_name").val()) == "") {
            $("#company_name-error").html("Please enter Corporate name");
            $("#company_name").parent('div').addClass('has-error');
            $("#company_name").focus();
            return false;
        } else {
            $("#company_name").parent('div').removeClass('has-error');
            $("#company_name-error").html("");
        }
        if ($.trim($("#contact_person").val()) == "") {
            $("#contact_person-error").html("Please enter contact person");
            $("#contact_person").parent('div').addClass('has-error');
            $("#contact_person").focus();
            return false;
        } else {
            $("#contact_person").parent('div').removeClass('has-error');
            $("#contact_person-error").html("");
        }

        if ($.trim($("#mobile_number").val()) == "") {
            $("#mobile_number-error").html("Please enter mobile number");
            $("#mobile_number").parent('div').addClass('has-error');
            $("#mobile_number").focus();
            return false;
        } else {
            $("#mobile_number").parent('div').removeClass('has-error');
            $("#mobile_number-error").html("");
        }
        if (isNaN($.trim($("#mobile_number").val()))) {
            $("#mobile_number-error").html("Only numeric value is allowed");
            $("#mobile_number").parent('div').addClass('has-error');
            $("#mobile_number").focus();
            return false;
        } else {
            $("#mobile_number").parent('div').removeClass('has-error');
            $("#mobile_number-error").html("");
        }
        if ($("#mobile_number").val().length < 10 || $("#mobile_number").val().length > 10) {
            $("#mobile_number-error").html("Mobile number can be of 10 digits only ");
            $("#mobile_number").parent('div').addClass('has-error');
            $("#mobile_number").focus();
            return false;
        } else {
            $("#mobile_number").parent('div').removeClass('has-error');
            $("#mobile_number-error").html("");
        }


        if ($.trim($("#land_line_no").val()) == "") {
            $("#land_line_no-error").html("Please enter Landline number");
            $("#land_line_no").parent('div').addClass('has-error');
            $("#land_line_no").focus();
            return false;
        } else {
            $("#land_line_no").parent('div').removeClass('has-error');
            $("#land_line_no-error").html("");
        }


        if ($("#land_line_no").val()) {
            if (isNaN($.trim($("#land_line_no").val()))) {
                $("#land_line_no-error").html("Only numeric value is allowed");
                $("#land_line_no").parent('div').addClass('has-error');
                $("#land_line_no").focus();
                return false;
            } else {
                $("#land_line_no").parent('div').removeClass('has-error');
                $("#land_line_no-error").html("");
            }
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
        } else {
            $("#email-error").html('Please enter email address');
            $("#email").parent('div').addClass('has-error');
            $("#email").val("");
            $("#email").focus();
            return false
        }

        if ($.trim($("#corporate_type").val()) == "") {
            $("#corporate_type-error").html("Please select corporate type");
            $("#corporate_type").parent('div').addClass('has-error');
            $("#corporate_type").focus();
            return false;
        } else {
            $("#corporate_type").parent('div').removeClass('has-error');
            $("#corporate_type-error").html("");
        }



        if ($.trim($("#pan_no").val()) == "") {
            $("#pan_no-error").html("Please enter PAN No");
            $("#pan_no").parent('div').addClass('has-error');
            $("#pan_no").focus();
            return false;
        } else {
            $("#pan_no").parent('div').removeClass('has-error');
            $("#pan_no-error").html("");
        }


        if ($.trim($("#credit_limit").val()) == "") {
            $("#credit_limit-error").html("Please enter credit limit");
            $("#credit_limit").parent('div').addClass('has-error');
            $("#credit_limit").focus();
            return false;
        } else {
            $("#credit_limit").parent('div').removeClass('has-error');
            $("#credit_limit-error").html("");
        }


        if (isNaN($.trim($("#credit_limit").val()))) {
            $("#credit_limit-error").html("Only numeric value is allowed");
            $("#credit_limit").parent('div').addClass('has-error');
            $("#credit_limit").focus();
            return false;
        } else {
            $("#credit_limit").parent('div').removeClass('has-error');
            $("#credit_limit-error").html("");
        }

        if ($.trim($("#CorporateCompanyCityId").val()) == "") {
            $("#city_id-error").html("Please select city");
            $("#CorporateCompanyCityId").parent('div').addClass('has-error');
            $("#CorporateCompanyCityId").focus();
            return false;
        } else {
            $("#CorporateCompanyCityId").parent('div').removeClass('has-error');
            $("#city_id-error").html("");
        }


        if ($.trim($("#CorporateCompanyBillingType").val()) == "") {
            $("#billing_type-error").html("Please select billing type");
            $("#CorporateCompanyBillingType").parent('div').addClass('has-error');
            $("#CorporateCompanyBillingType").focus();
            return false;
        } else {
            $("#CorporateCompanyBillingType").parent('div').removeClass('has-error');
            $("#billing_type-error").html("");
        }
        if ($.trim($("#office_address").val()) == "") {
            $("#office_address-error").html("Please enter address limit");
            $("#office_address").parent('div').addClass('has-error');
            $("#office_address").focus();
            return false;
        } else {
            $("#office_address").parent('div').removeClass('has-error');
            $("#office_address-error").html("");
        }

        if ($("#agreement_document").val() == "") {
            $("#agreement_document-error").html("Please upload agreement");
            $("#agreement_document").parent('div').addClass('has-error');
            $("#agreement_document").focus();
            return false;
        } else {
            $("#adhaar_card").parent('div').removeClass('has-error');
            $("#adhaar_card-error").html("");
        }



        if ($("#purchase_order_document").val() == "") {
            $("#purchase_order_document-error").html("Please upload purchase order");
            $("#purchase_order_document").parent('div').addClass('has-error');
            $("#purchase_order_document").focus();
            return false;
        } else {
            $("#purchase_order_document").parent('div').removeClass('has-error');
            $("#purchase_order_document-error").html("");
        }



        if ($("#pan_card_copy").val() == "") {
            $("#pan_card_copy-error").html("Please upload pan card copy");
            $("#pan_card_copy").parent('div').addClass('has-error');
            $("#pan_card_copy").focus();
            return false;
        } else {
            $("#pan_card_copy").parent('div').removeClass('has-error');
            $("#pan_card_copy-error").html("");
        }



    });

});

