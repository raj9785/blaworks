$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#company_name").val()) == "") {
            $("#company_name-error").html("Please enter partner name");
            $("#company_name").parent('div').addClass('has-error');
            $("#company_name").focus();
            return false;
        } else {
            $("#company_name").parent('div').removeClass('has-error');
            $("#company_name-error").html("");
        }


        if ($.trim($("#contact_name").val()) == "") {
            $("#contact_name-error").html("Please enter contact person");
            $("#contact_name").parent('div').addClass('has-error');
            $("#contact_name").focus();
            return false;
        } else {
            $("#contact_name").parent('div').removeClass('has-error');
            $("#contact_name-error").html("");
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



        if ($.trim($("#email_id").val()) != "") {
            var string = $("#email_id").val()
            var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if (filter.test(string)) {
                testresult = true;
                $("#email_id-error").html("");
                $("#email_id").parent('div').removeClass('has-error');
            } else {
                $("#email_id-error").html('Please enter a valid email ID');
                $("#email_id").parent('div').addClass('has-error');
                $("#email_id").val("");
                $("#email_id").focus();
                return false
            }
        } else {
            $("#email_id-error").html('Please enter email ID');
            $("#email_id").parent('div').addClass('has-error');
            $("#email_id").val("");
            $("#email_id").focus();
            return false
        }



        if ($.trim($("#city_id").val()) == "") {
            $("#city_id-error").html("Please select city");
            $("#city_id").parent('div').addClass('has-error');
            $("#city_id").focus();
            return false;
        } else {
            $("#city_id").parent('div').removeClass('has-error');
            $("#city_id-error").html("");
        }



        if ($.trim($("#office_address").val()) == "") {
            $("#office_address-error").html("Please enter address");
            $("#office_address").parent('div').addClass('has-error');
            $("#office_address").focus();
            return false;
        } else {
            $("#office_address").parent('div').removeClass('has-error');
            $("#office_address-error").html("");
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

        if ($("#LeadCompanyServiceTaxRegistered1").is(':checked') || $("#LeadCompanyServiceTaxRegistered0").is(':checked')) {
            $("#LeadCompanyServiceTaxRegistered_").parent('div').removeClass('has-error');
            $("#service_tax_registered-error").html("");
            if ($("#LeadCompanyServiceTaxRegistered1").is(':checked')) {
                if ($.trim($("#service_tax_no").val()) == "") {
                    $("#service_tax_no-error").html("Please enter service tax registration no");
                    $("#service_tax_no").parent('div').addClass('has-error');
                    $("#service_tax_no").focus();
                    return false;
                } else {
                    $("#service_tax_no").parent('div').removeClass('has-error');
                    $("#service_tax_no-error").html("");
                }
            } else {
                $("#service_tax_no").parent('div').removeClass('has-error');
                $("#service_tax_no-error").html("");
            }

        } else {
            $("#service_tax_registered-error").html("Please select service tax registration");
            $("#LeadCompanyServiceTaxRegistered_").parent('div').addClass('has-error');
            $("#LeadCompanyServiceTaxRegistered_").focus();
            return false;
        }


        if ($.trim($("#LeadCompanyCompType").val()) == "") {
            $("#LeadCompanyCompType-error").html("Please select company type");
            $("#LeadCompanyCompType").parent('div').addClass('has-error');
            $("#LeadCompanyCompType").focus();
            return false;
        } else {
            $("#LeadCompanyCompType").parent('div').removeClass('has-error');
            $("#LeadCompanyCompType-error").html("");
        }

        if ($.trim($("#website_url").val())) {
            url = $("#website_url").val();
            var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

            if (RegExp.test(url)) {
                $("#website_url").parent('div').removeClass('has-error');
                $("#website_url-error").html("");
            } else {
                $("#website_url-error").html("Please enter correct website url");
                $("#website_url").parent('div').addClass('has-error');
                $("#website_url").focus();
                return false;
            }
        }


        if ($.trim($("#comp_share_type").val()) == "") {
            $("#comp_share_type-error").html("Please select company share type");
            $("#comp_share_type").parent('div').addClass('has-error');
            $("#comp_share_type").focus();
            return false;
        } else {
            $("#comp_share_type").parent('div').removeClass('has-error');
            $("#comp_share_type-error").html("");
        }


        if ($.trim($("#comp_share_type").val()) == 2 || $.trim($("#comp_share_type").val()) == 5) {


            if ($.trim($("#LeadCompanyPrice0Price").val()) == "") {
                $("#LeadCompanyPrice0Price-error").html("Please enter cost for one way");
                $("#LeadCompanyPrice0Price").parent('div').addClass('has-error');
                $("#LeadCompanyPrice0Price").focus();
                return false;
            } else {
                $("#LeadCompanyPrice0Price").parent('div').removeClass('has-error');
                $("#LeadCompanyPrice0Price-error").html("");
            }

            if ($.trim($("#LeadCompanyPrice1Price").val()) == "") {
                $("#LeadCompanyPrice1Price-error").html("Please enter cost for round trip");
                $("#LeadCompanyPrice1Price").parent('div').addClass('has-error');
                $("#LeadCompanyPrice1Price").focus();
                return false;
            } else {
                $("#LeadCompanyPrice1Price").parent('div').removeClass('has-error');
                $("#LeadCompanyPrice1Price-error").html("");
            }

            if ($.trim($("#LeadCompanyPrice2Price").val()) == "") {
                $("#LeadCompanyPrice2Price-error").html("Please enter cost for multi city");
                $("#LeadCompanyPrice2Price").parent('div').addClass('has-error');
                $("#LeadCompanyPrice2Price").focus();
                return false;
            } else {
                $("#LeadCompanyPrice2Price").parent('div').removeClass('has-error');
                $("#LeadCompanyPrice2Price-error").html("");
            }

            if ($.trim($("#LeadCompanyPrice3Price").val()) == "") {
                $("#LeadCompanyPrice3Price-error").html("Please enter cost for day package");
                $("#LeadCompanyPrice3Price").parent('div').addClass('has-error');
                $("#LeadCompanyPrice3Price").focus();
                return false;
            } else {
                $("#LeadCompanyPrice3Price").parent('div').removeClass('has-error');
                $("#LeadCompanyPrice3Price-error").html("");
            }

        }else if ($.trim($("#comp_share_type").val()) == 1){
            if ($.trim($("#LeadCompanyBlogPrice0PricePerShare").val()) == "") {
                $("#LeadCompanyBlogPrice0PricePerShare-error").html("Please enter cost for blog");
                $("#LeadCompanyBlogPrice0PricePerShare").parent('div').addClass('has-error');
                $("#LeadCompanyBlogPrice0PricePerShare").focus();
                return false;
            } else {
                $("#LeadCompanyBlogPrice0PricePerShare").parent('div').removeClass('has-error');
                $("#LeadCompanyBlogPrice0PricePerShare-error").html("");
            }

            if ($.trim($("#LeadCompanyBlogPrice1PricePerShare").val()) == "") {
                $("#LeadCompanyBlogPrice1PricePerShare-error").html("Please enter cost for video");
                $("#LeadCompanyBlogPrice1PricePerShare").parent('div').addClass('has-error');
                $("#LeadCompanyBlogPrice1PricePerShare").focus();
                return false;
            } else {
                $("#LeadCompanyBlogPrice1PricePerShare").parent('div').removeClass('has-error');
                $("#LeadCompanyBlogPrice1PricePerShare-error").html("");
            }
            
        }


        if ($.trim($("#ac_holder_name").val()) == "") {
            $("#ac_holder_name-error").html("Please enter account holder name");
            $("#ac_holder_name").parent('div').addClass('has-error');
            $("#ac_holder_name").focus();
            return false;
        } else {
            $("#ac_holder_name").parent('div').removeClass('has-error');
            $("#ac_holder_name-error").html("");
        }


        if ($.trim($("#bank_account_no").val()) == "") {
            $("#bank_account_no-error").html("Please enter account number");
            $("#bank_account_no").parent('div').addClass('has-error');
            $("#bank_account_no").focus();
            return false;
        } else {
            $("#bank_account_no").parent('div').removeClass('has-error');
            $("#bank_account_no-error").html("");
        }

        if ($.trim($("#bank_name").val()) == "") {
            $("#bank_name-error").html("Please enter bank name");
            $("#bank_name").parent('div').addClass('has-error');
            $("#bank_name").focus();
            return false;
        } else {
            $("#bank_name").parent('div').removeClass('has-error');
            $("#bank_name-error").html("");
        }

        if ($.trim($("#ifsc_code").val()) == "") {
            $("#ifsc_code-error").html("Please enter bank IFS code");
            $("#ifsc_code").parent('div').addClass('has-error');
            $("#ifsc_code").focus();
            return false;
        } else {
            $("#ifsc_code").parent('div').removeClass('has-error');
            $("#ifsc_code-error").html("");
        }



//        if ($("#agreement_document").val() == "") {
//            $("#agreement_document-error").html("Please upload agreement");
//            $("#agreement_document").parent('div').addClass('has-error');
//            $("#agreement_document").focus();
//            return false;
//        } else {
//            $("#adhaar_card").parent('div').removeClass('has-error');
//            $("#adhaar_card-error").html("");
//        }



//        if ($("#cancelled_cheque").val() == "") {
//            $("#cancelled_cheque-error").html("Please upload cancelled cheque");
//            $("#cancelled_cheque").parent('div').addClass('has-error');
//            $("#cancelled_cheque").focus();
//            return false;
//        } else {
//            $("#cancelled_cheque").parent('div').removeClass('has-error');
//            $("#cancelled_cheque-error").html("");
//        }


//
//        if ($("#pan_card_copy").val() == "") {
//            $("#pan_card_copy-error").html("Please upload pan card copy");
//            $("#pan_card_copy").parent('div').addClass('has-error');
//            $("#pan_card_copy").focus();
//            return false;
//        } else {
//            $("#pan_card_copy").parent('div').removeClass('has-error');
//            $("#pan_card_copy-error").html("");
//        }


//        if ($("#service_tax_registration").val() == "") {
//            $("#service_tax_registration-error").html("Please upload service tax registration certificate");
//            $("#service_tax_registration").parent('div').addClass('has-error');
//            $("#service_tax_registration").focus();
//            return false;
//        } else {
//            $("#service_tax_registration").parent('div').removeClass('has-error');
//            $("#service_tax_registration-error").html("");
//        }






    });

});

