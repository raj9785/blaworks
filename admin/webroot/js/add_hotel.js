$(document).ready(function () {
    $("#add_hotel").click(function () {
        if ($.trim($("#hotel_name").val()) == "") {
            $("#hotel_name-error").html("Please enter hotel name");
            $("#hotel_name").parent('div').addClass('has-error');
            $("#hotel_name").focus();
            return false;
        } else {
            $("#hotel_name").parent('div').removeClass('has-error');
            $("#hotel_name-error").html("");
        }

        if ($.trim($("#rating").val()) == "") {
            $("#rating-error").html("Please select hotel category");
            $("#rating").parent('div').addClass('has-error');
            $("#rating").focus();
            return false;
        } else {
            $("#rating").parent('div').removeClass('has-error');
            $("#rating-error").html("");
        }

        if ($.trim($("#location").val()) == "") {
            $("#location-error").html("Please enter location");
            $("#location").parent('div').addClass('has-error');
            $("#location").focus();
            return false;
        } else {
            $("#location").parent('div').removeClass('has-error');
            $("#location-error").html("");
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
//        if ($.trim($("#overview").val()) == "") {
//            $("#overview-error").html("Please enter overview");
//            $("#overview").parent('div').addClass('has-error');
//            $("#overview").focus();
//            return false;
//        } else {
//            $("#overview").parent('div').removeClass('has-error');
//            $("#overview-error").html("");
//        }
        if ($('input[name="data[Hotel][facilities][]"]:checked').length == 0) {
            $("#facility-error").html("Please select hotel facilities");
            $("#facilities").parent('div').addClass('has-error');
            $("#facilities").focus();
            return false;
        } else {
            $("#facilities").parent('div').removeClass('has-error');
            $("#facility-error").html("");
        }

//        if ($('input[name="data[Hotel][activities][]"]:checked').length == 0) {
//            $("#activity-error").html("Please select hotel activities");
//            $("#activities").parent('div').addClass('has-error');
//            $("#activities").focus();
//            return false;
//        } else {
//            $("#activities").parent('div').removeClass('has-error');
//            $("#activity-error").html("");
//        }

        if ($.trim($("#super_destination_id").val()) == "") {
            $("#super_destination_id-error").html("Please select destination");
            $("#super_destination_id").parent('div').addClass('has-error');
            $("#super_destination_id").focus();
            return false;
        } else {
            $("#super_destination_id").parent('div').removeClass('has-error');
            $("#super_destination_id-error").html("");
        }

        if ($.trim($("#hotel_images1").val()) == "") {
            $("#hotel_images1-error").html("Please upload all desktop images");
            $("#hotel_images1").parent('div').addClass('has-error');
            $("#hotel_images1").focus();
            return false;
        } else {
            $("#hotel_images1").parent('div').removeClass('has-error');
            $("#hotel_images1-error").html("");
        }
        var count_img = $(".hotel_images1").length;
        var c1 = new Array();
        var total = 0;
        for (var k = 0; k < count_img; k++) {
            c1[k] = $(".hotel_images1")[k].files.length;
            total += c1[k];
        }
        if (total < 1) {
            $("#hotel_images1-error").html("Please upload minimum 1 images");
            $("#hotel_images1").parent('div').addClass('has-error');
            $("#hotel_images1").focus();
            return false;
        } else {
            $("#hotel_images1").parent('div').removeClass('has-error');
            $("#hotel_images1-error").html("");
        }
        
        if ($.trim($("#hotel_images2").val()) == "") {
            $("#hotel_images2-error").html("Please upload featured desktop image");
            $("#hotel_images2").parent('div').addClass('has-error');
            $("#hotel_images2").focus();
            return false;
        } else {
            $("#hotel_images2").parent('div').removeClass('has-error');
            $("#hotel_images2-error").html("");
        }
        
        if ($.trim($("#hotel_images3").val()) == "") {
            $("#hotel_images3-error").html("Please upload all mobile images");
            $("#hotel_images3").parent('div').addClass('has-error');
            $("#hotel_images3").focus();
            return false;
        } else {
            $("#hotel_images3").parent('div').removeClass('has-error');
            $("#hotel_images3-error").html("");
        }
        var count_img = $(".hotel_images3").length;
        var c1 = new Array();
        var total = 0;
        for (var k = 0; k < count_img; k++) {
            c1[k] = $(".hotel_images3")[k].files.length;
            total += c1[k];
        }
        if (total < 1) {
            $("#hotel_images3-error").html("Please upload minimum 1 images");
            $("#hotel_images3").parent('div').addClass('has-error');
            $("#hotel_images3").focus();
            return false;
        } else {
            $("#hotel_images3").parent('div').removeClass('has-error');
            $("#hotel_images3-error").html("");
        }
        
        if ($.trim($("#hotel_images4").val()) == "") {
            $("#hotel_images4-error").html("Please upload featured mobile image");
            $("#hotel_images4").parent('div').addClass('has-error');
            $("#hotel_images4").focus();
            return false;
        } else {
            $("#hotel_images4").parent('div').removeClass('has-error');
            $("#hotel_images4-error").html("");
        }
        /*if ($('input[name="data[Hotel][activities][]"]:checked').length == 0) {
         $("#activity-error").html("Please select hotel activities");
         $("#activities").parent('div').addClass('has-error');
         $("#activities").focus();
         return false;
         } else {
         $("#activities").parent('div').removeClass('has-error');
         $("#activity-error").html("");
         }*/

//        if ($.trim($("#hotel_email_0").val()) == "") {
//            $("#hotel_email_id-error").html("Please enter email id");
//            $("#hotel_email_0").parent('div').addClass('has-error');
//            $("#hotel_email_0").focus();
//            return false;
//        } else {
//            $("#hotel_email_0").parent('div').removeClass('has-error');
//            $("#hotel_email_id-error").html("");
//        }

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "text" && inputs[i].className.indexOf("email") != -1) {
                var email = inputs[i].value;
                if (email == "") {
                    $("#hotel_email_id-error").html("Please enter email id");
                    $("#hotel_email_" + i).parent('div').addClass('has-error');
                    $("#hotel_email_" + i).focus();
                    return false;
                } else {
                    $("#hotel_email_" + i).parent('div').removeClass('has-error');
                    $("#hotel_email_id-error").html("");
                }
                if (IsValidEmail(email)) {
                    $("#hotel_email_" + i).parent('div').removeClass('has-error');
                    $("#hotel_email_id-error").html("");
                } else {
                    $("#hotel_email_id-error").html("Please enter valid email id");
                    $("#hotel_email_" + i).parent('div').addClass('has-error');
                    $("#hotel_email_" + i).focus();
                    return false;
                }
            }
        }
//        if ($.trim($("#hotel_contact_0").val()) == "") {
//            $("#hotel_contact_no-error").html("Please enter contact number");
//            $("#hotel_contact_0").parent('div').addClass('has-error');
//            $("#hotel_contact_0").focus();
//            return false;
//        } else {
//            $("#hotel_contact_0").parent('div').removeClass('has-error');
//            $("#hotel_contact_no-error").html("");
//        }
        for (var j = 0; j < inputs.length; j++) {
            if (inputs[j].className.indexOf("mobile") != -1) {
                var contact = inputs[j].value;
                if (contact == "") {
                    $("#hotel_contact_no-error").html("Please enter contact number");
                    $("#hotel_contact_" + j).parent('div').addClass('has-error');
                    $("#hotel_contact_" + j).focus();
                    return false;
                } else {
                    $("#hotel_contact_" + j).parent('div').removeClass('has-error');
                    $("#hotel_contact_no-error").html("");
                }
                if (isNaN($.trim(contact))) {
                    $("#hotel_contact_no-error").html("Please enter valid contact no");
                    $("#hotel_contact_" + j).parent('div').addClass('has-error');
                    $("#hotel_contact_" + j).focus();
                    return false;
                } else {
                    $("#hotel_contact_" + j).parent('div').removeClass('has-error');
                    $("#hotel_contact_no-error").html("");
                }
                if (contact.length < 10 || contact.length > 10) {
                    $("#hotel_contact_no-error").html("Please enter valid contact number");
                    $("#hotel_contact_" + j).parent('div').addClass('has-error');
                    $("#hotel_contact_" + j).focus();
                    return false;
                } else {
                    $("#hotel_contact_" + j).parent('div').removeClass('has-error');
                    $("#hotel_contact_no-error").html("");
                }
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
        if ($.trim($("#bank_account_number").val()) == "") {
            $("#bank_account_number-error").html("Please enter account number");
            $("#bank_account_number").parent('div').addClass('has-error');
            $("#bank_account_number").focus();
            return false;
        } else {
            $("#bank_account_number").parent('div').removeClass('has-error');
            $("#bank_account_number-error").html("");
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
            $("#ifsc_code-error").html("Please enter ifsc code");
            $("#ifsc_code").parent('div').addClass('has-error');
            $("#ifsc_code").focus();
            return false;
        } else {
            $("#ifsc_code").parent('div').removeClass('has-error');
            $("#ifsc_code-error").html("");
        }
        if ($.trim($("#rate_contract_type").val()) == "") {
            $("#rate_contract_type-error").html("Please select rate contract type");
            $("#rate_contract_type").parent('div').addClass('has-error');
            $("#rate_contract_type").focus();
            return false;
        } else {
            $("#rate_contract_type").parent('div').removeClass('has-error');
            $("#rate_contract_type-error").html("");
        }

        if ($.trim($("#contract_expiry_date").val()) == "") {
            $("#contract_expiry_date-error").html("Please enter contract expiry date");
            $("#contract_expiry_date").parent('div').addClass('has-error');
            $("#contract_expiry_date").focus();
            return false;
        } else {
            $("#contract_expiry_date").parent('div').removeClass('has-error');
            $("#contract_expiry_date-error").html("");
        }

        if ($.trim($("#credit_cycle").val()) == "") {
            $("#credit_cycle-error").html("Please select credit cycle");
            $("#credit_cycle").parent('div').addClass('has-error');
            $("#credit_cycle").focus();
            return false;
        } else {
            $("#credit_cycle").parent('div').removeClass('has-error');
            $("#credit_cycle-error").html("");
        }

        if ($.trim($("#hotel_policy").val()) == "") {
            $("#hotel_policy-error").html("Please enter policy");
            $("#hotel_policy").parent('div').addClass('has-error');
            $("#hotel_policy").focus();
            return false;
        } else {
            $("#hotel_policy").parent('div').removeClass('has-error');
            $("#hotel_policy-error").html("");
        }


    });

    $("#edit_hotel").click(function () {
        if ($.trim($("#hotel_name").val()) == "") {
            $("#hotel_name-error").html("Please enter hotel name");
            $("#hotel_name").parent('div').addClass('has-error');
            $("#hotel_name").focus();
            return false;
        } else {
            $("#hotel_name").parent('div').removeClass('has-error');
            $("#hotel_name-error").html("");
        }

        if ($.trim($("#super_destination_id").val()) == "") {
            $("#super_destination_id-error").html("Please select destination");
            $("#super_destination_id").parent('div').addClass('has-error');
            $("#super_destination_id").focus();
            return false;
        } else {
            $("#super_destination_id").parent('div').removeClass('has-error');
            $("#super_destination_id-error").html("");
        }

        if ($.trim($("#rating").val()) == "") {
            $("#rating-error").html("Please select hotel category");
            $("#rating").parent('div').addClass('has-error');
            $("#rating").focus();
            return false;
        } else {
            $("#rating").parent('div').removeClass('has-error');
            $("#rating-error").html("");
        }

        if ($.trim($("#location").val()) == "") {
            $("#location-error").html("Please enter location");
            $("#location").parent('div').addClass('has-error');
            $("#location").focus();
            return false;
        } else {
            $("#location").parent('div').removeClass('has-error');
            $("#location-error").html("");
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
//        if ($.trim($("#overview").val()) == "") {
//            $("#overview-error").html("Please enter overview");
//            $("#overview").parent('div').addClass('has-error');
//            $("#overview").focus();
//            return false;
//        } else {
//            $("#overview").parent('div').removeClass('has-error');
//            $("#overview-error").html("");
//        }

        if ($('input[name="data[Hotel][facilities][]"]:checked').length == 0) {
            $("#facility-error").html("Please select hotel facilities");
            $("#facilities").parent('div').addClass('has-error');
            $("#facilities").focus();
            return false;
        } else {
            $("#facilities").parent('div').removeClass('has-error');
            $("#facility-error").html("");
        }
//        if ($('input[name="data[Hotel][activities][]"]:checked').length == 0) {
//            $("#activity-error").html("Please select hotel activities");
//            $("#activities").parent('div').addClass('has-error');
//            $("#activities").focus();
//            return false;
//        } else {
//            $("#activities").parent('div').removeClass('has-error');
//            $("#activity-error").html("");
//        }

        if (($.trim($("#hotel_images1").val()) == "") && ($("#hotel_imgs1").val() == "0")) {
            $("#hotel_images1-error").html("Please upload desktop all image");
            $("#hotel_images1").parent('div').addClass('has-error');
            $("#hotel_images1").focus();
            return false;
        } else {
            $("#hotel_images1").parent('div').removeClass('has-error');
            $("#hotel_images1-error").html("");
        }

        var count = $(".hotel_images1").length;
        var count1 = new Array();
        var sum = 0;
        for (var k = 0; k < count; k++) {
            count1[k] = $(".hotel_images1")[k].files.length;
            sum += count1[k];
        }
        var count2 = $("#hotel_imgs1").val();
        var total_hotel_img = parseInt(sum) + parseInt(count2);

        if (total_hotel_img < 1) {
            $("#hotel_images1-error").html("Please upload minimum 1 image");
            $("#hotel_images1").parent('div').addClass('has-error');
            $("#hotel_images1").focus();
            return false;
        } else {
            $("#hotel_images1").parent('div').removeClass('has-error');
            $("#hotel_images1-error").html("");
        }
        if (($.trim($("#hotel_images2").val()) == "") && ($("#hotel_imgs2").val() == "0")) {
            $("#hotel_images2-error").html("Please upload desktop featured image");
            $("#hotel_images2").parent('div').addClass('has-error');
            $("#hotel_images2").focus();
            return false;
        } else {
            $("#hotel_images2").parent('div').removeClass('has-error');
            $("#hotel_images2-error").html("");
        }
        if (($.trim($("#hotel_images3").val()) == "") && ($("#hotel_imgs1").val() == "0")) {
            $("#hotel_images3-error").html("Please upload desktop all images");
            $("#hotel_images3").parent('div').addClass('has-error');
            $("#hotel_images3").focus();
            return false;
        } else {
            $("#hotel_images3").parent('div').removeClass('has-error');
            $("#hotel_images3-error").html("");
        }

        var count = $(".hotel_images3").length;
        var count1 = new Array();
        var sum = 0;
        for (var k = 0; k < count; k++) {
            count1[k] = $(".hotel_images3")[k].files.length;
            sum += count1[k];
        }
        var count2 = $("#hotel_imgs1").val();
        var total_hotel_img = parseInt(sum) + parseInt(count2);

        if (total_hotel_img < 1) {
            $("#hotel_images3-error").html("Please upload minimum 1 image");
            $("#hotel_images3").parent('div').addClass('has-error');
            $("#hotel_images3").focus();
            return false;
        } else {
            $("#hotel_images3").parent('div').removeClass('has-error');
            $("#hotel_images3-error").html("");
        }
        if (($.trim($("#hotel_images4").val()) == "") && ($("#hotel_imgs4").val() == "0")) {
            $("#hotel_images4-error").html("Please upload mobile featured image");
            $("#hotel_images4").parent('div').addClass('has-error');
            $("#hotel_images4").focus();
            return false;
        } else {
            $("#hotel_images4").parent('div').removeClass('has-error');
            $("#hotel_images4-error").html("");
        }


//        if (($.trim($("#hotel_email_0").val()) == "" && ($("#emails").val() == "0")) || ($.trim($("#hotel_email_1").val()) == "")) {
//            $("#hotel_email_id-error").html("Please enter email id");
//            $("#hotel_email_0").parent('div').addClass('has-error');
//            $("#hotel_email_0").focus();
//            return false;
//        } else {
//            $("#hotel_email_0").parent('div').removeClass('has-error');
//            $("#hotel_email_id-error").html("");
//        }

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "text" && inputs[i].className.indexOf("email") != -1) {
                var email = inputs[i].value;
                if (email != "") {
                    if (IsValidEmail(email)) {
                        $("#hotel_email_" + i).parent('div').removeClass('has-error');
                        $("#hotel_email_id-error").html("");
                    } else {
                        $("#hotel_email_id-error").html("Please enter valid email id");
                        $("#hotel_email_" + i).parent('div').addClass('has-error');
                        $("#hotel_email_" + i).focus();
                        return false;
                    }
                }
            }
        }
//        if ($.trim($("#hotel_contact_0").val()) == "" || $.trim($("#hotel_contact_1").val()) == "") {
//            $("#hotel_contact_no-error").html("Please enter contact number");
//            $("#hotel_contact_0").parent('div').addClass('has-error');
//            $("#hotel_contact_0").focus();
//            return false;
//        } else {
//            $("#hotel_contact_0").parent('div').removeClass('has-error');
//            $("#hotel_contact_no-error").html("");
//        }
        
        for (var j = 0; j < inputs.length; j++) {
            if (inputs[j].className.indexOf("mobile") != -1) {
                var contact = inputs[j].value;
                if (contact != "") {
                    if (isNaN($.trim(contact))) {
                        $("#hotel_contact_no-error").html("Please enter valid contact no");
                        $("#hotel_contact_" + j).parent('div').addClass('has-error');
                        $("#hotel_contact_" + j).focus();
                        return false;
                    } else {
                        $("#hotel_contact_" + j).parent('div').removeClass('has-error');
                        $("#hotel_contact_no-error").html("");
                    }
                    if (contact.length < 10 || contact.length > 10) {
                        $("#hotel_contact_no-error").html("Please enter valid contact number");
                        $("#hotel_contact_" + j).parent('div').addClass('has-error');
                        $("#hotel_contact_" + j).focus();
                        return false;
                    } else {
                        $("#hotel_contact_" + j).parent('div').removeClass('has-error');
                        $("#hotel_contact_no-error").html("");
                    }
                }
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
        if ($.trim($("#bank_account_number").val()) == "") {
            $("#bank_account_number-error").html("Please enter account number");
            $("#bank_account_number").parent('div').addClass('has-error');
            $("#bank_account_number").focus();
            return false;
        } else {
            $("#bank_account_number").parent('div').removeClass('has-error');
            $("#bank_account_number-error").html("");
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
            $("#ifsc_code-error").html("Please enter ifsc code");
            $("#ifsc_code").parent('div').addClass('has-error');
            $("#ifsc_code").focus();
            return false;
        } else {
            $("#ifsc_code").parent('div').removeClass('has-error');
            $("#ifsc_code-error").html("");
        }

        if ($.trim($("#rate_contract_type").val()) == "") {
            $("#rate_contract_type-error").html("Please select rate contract type");
            $("#rate_contract_type").parent('div').addClass('has-error');
            $("#rate_contract_type").focus();
            return false;
        } else {
            $("#rate_contract_type").parent('div').removeClass('has-error');
            $("#rate_contract_type-error").html("");
        }

        if ($.trim($("#contract_expiry_date").val()) == "") {
            $("#contract_expiry_date-error").html("Please enter contract expiry date");
            $("#contract_expiry_date").parent('div').addClass('has-error');
            $("#contract_expiry_date").focus();
            return false;
        } else {
            $("#contract_expiry_date").parent('div').removeClass('has-error');
            $("#contract_expiry_date-error").html("");
        }

        if ($.trim($("#credit_cycle").val()) == "") {
            $("#credit_cycle-error").html("Please select credit cycle");
            $("#credit_cycle").parent('div').addClass('has-error');
            $("#credit_cycle").focus();
            return false;
        } else {
            $("#credit_cycle").parent('div').removeClass('has-error');
            $("#credit_cycle-error").html("");
        }

//        if (($.trim($("#hotel_policy").val()) == "") && ($("#policies").val() == "0")) {
//            $("#hotel_policy-error").html("Please enter policy");
//            $("#hotel_policy").parent('div').addClass('has-error');
//            $("#hotel_policy").focus();
//            return false;
//        } else {
//            $("#hotel_policy").parent('div').removeClass('has-error');
//            $("#hotel_policy-error").html("");
//        }
    });

    $("#add_hotel_room").click(function () {
        if ($.trim($("#room_title").val()) == "") {
            $("#room_title-error").html("Please enter room title");
            $("#room_title").parent('div').addClass('has-error');
            $("#room_title").focus();
            return false;
        } else {
            $("#room_title").parent('div').removeClass('has-error');
            $("#room_title-error").html("");
        }


        if ($.trim($("#room_type").val()) == "") {
            $("#room_type-error").html("Please select room type");
            $("#room_type").parent('div').addClass('has-error');
            $("#room_type").focus();
            return false;
        } else {
            $("#room_type").parent('div').removeClass('has-error');
            $("#room_type-error").html("");
        }
        if ($.trim($("#max_adults").val()) == "") {
            $("#max_adults-error").html("Please enter maximum no of adults");
            $("#max_adults").parent('div').addClass('has-error');
            $("#max_adults").focus();
            return false;
        } else {
            $("#max_adults").parent('div').removeClass('has-error');
            $("#max_adults-error").html("");
        }
        if ($.trim($("#max_childrens").val()) == "") {
            $("#max_childrens-error").html("Please enter maximum no of childrens");
            $("#max_childrens").parent('div').addClass('has-error');
            $("#max_childrens").focus();
            return false;
        } else {
            $("#max_childrens").parent('div').removeClass('has-error');
            $("#max_childrens-error").html("");
        }

        if ($('input[name="data[Hotel][facilities][]"]:checked').length == 0) {
            $("#facility-error").html("Please select room facilities");
            $("#facilities").parent('div').addClass('has-error');
            $("#facilities").focus();
            return false;
        } else {
            $("#facilities").parent('div').removeClass('has-error');
            $("#facility-error").html("");
        }
//        if ($.trim($("#room_description").val()) == "") {
//            $("#room_description-error").html("Please enter room description");
//            $("#room_description").parent('div').addClass('has-error');
//            $("#room_description").focus();
//            return false;
//        } else {
//            $("#room_description").parent('div').removeClass('has-error');
//            $("#room_description-error").html("");
//        }
        if ($.trim($("#room_images").val()) == "") {
            $("#room_images-error").html("Please upload room images");
            $("#room_images").parent('div').addClass('has-error');
            $("#room_images").focus();
            return false;
        } else {
            $("#room_images").parent('div').removeClass('has-error');
            $("#room_images-error").html("");
        }
        var count_img = $(".room_images").length;
        var c1 = new Array();
        var total = 0;
        for (var k = 0; k < count_img; k++) {
            c1[k] = $(".room_images")[k].files.length;
            total += c1[k];
        }
        if (total < 1) {
            $("#room_images-error").html("Please upload minimum 1 images");
            $("#room_images").parent('div').addClass('has-error');
            $("#room_images").focus();
            return false;
        } else {
            $("#room_images").parent('div').removeClass('has-error');
            $("#room_images-error").html("");
        }
        if ($.trim($("#room_category_id").val()) == "") {
            $("#room_category_id-error").html("Please select room category");
            $("#room_category_id").parent('div').addClass('has-error');
            $("#room_category_id").focus();
            return false;
        } else {
            $("#room_category_id").parent('div').removeClass('has-error');
            $("#room_category_id-error").html("");
        }
//        if ($.trim($("#customer_price").val()) == "" && $.trim($("#rate_contract_type").val()) == "1") {
//            $("#customer_price-error").html("Please enter customer price");
//            $("#customer_price").parent('div').addClass('has-error');
//            $("#customer_price").focus();
//            return false;
//        } else {
//            $("#customer_price").parent('div').removeClass('has-error');
//            $("#customer_price-error").html("");
//        }
//        if ($.trim($("#hotel_price").val()) == "" && $.trim($("#rate_contract_type").val()) == "1") {
//            $("#hotel_price-error").html("Please enter hotel price");
//            $("#hotel_price").parent('div').addClass('has-error');
//            $("#hotel_price").focus();
//            return false;
//        } else {
//            $("#hotel_price").parent('div').removeClass('has-error');
//            $("#hotel_price-error").html("");
//        }
//        if ($.trim($("#customer_price1").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#customer_price1-error").html("Please enter customer price");
//            $("#customer_price1").parent('div').addClass('has-error');
//            $("#customer_price1").focus();
//            return false;
//        } else {
//            $("#customer_price1").parent('div').removeClass('has-error');
//            $("#customer_price1-error").html("");
//        }
//        if ($.trim($("#hotel_price1").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#hotel_price1-error").html("Please enter hotel price");
//            $("#hotel_price1").parent('div').addClass('has-error');
//            $("#hotel_price1").focus();
//            return false;
//        } else {
//            $("#hotel_price1").parent('div').removeClass('has-error');
//            $("#hotel_price1-error").html("");
//        }
//        if ($.trim($("#customer_price2").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#customer_price2-error").html("Please enter customer price");
//            $("#customer_price2").parent('div').addClass('has-error');
//            $("#customer_price2").focus();
//            return false;
//        } else {
//            $("#customer_price2").parent('div').removeClass('has-error');
//            $("#customer_price2-error").html("");
//        }
//        if ($.trim($("#hotel_price2").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#hotel_price2-error").html("Please enter hotel price");
//            $("#hotel_price2").parent('div').addClass('has-error');
//            $("#hotel_price2").focus();
//            return false;
//        } else {
//            $("#hotel_price2").parent('div').removeClass('has-error');
//            $("#hotel_price2-error").html("");
//        }

    });

    $("#add_hotel_facility").click(function () {
        if ($.trim($("#hotel_facility").val()) == "") {
            $("#hotel_facility-error").html("Please enter facility");
            $("#hotel_facility").parent('div').addClass('has-error');
            $("#hotel_facility").focus();
            return false;
        } else {
            $("#hotel_facility").parent('div').removeClass('has-error');
            $("#hotel_facility-error").html("");
        }
    });


    $("#add_room_facility").click(function () {
        if ($.trim($("#room_facility").val()) == "") {
            $("#room_facility-error").html("Please enter facility");
            $("#room_facility").parent('div').addClass('has-error');
            $("#room_facility").focus();
            return false;
        } else {
            $("#room_facility").parent('div').removeClass('has-error');
            $("#room_facility-error").html("");
        }
    });

    $("#edit_hotel_room").click(function () {
        if ($.trim($("#room_title").val()) == "") {
            $("#room_title-error").html("Please enter room title");
            $("#room_title").parent('div').addClass('has-error');
            $("#room_title").focus();
            return false;
        } else {
            $("#room_title").parent('div').removeClass('has-error');
            $("#room_title-error").html("");
        }



        if ($.trim($("#room_type").val()) == "") {
            $("#room_type-error").html("Please select room type");
            $("#room_type").parent('div').addClass('has-error');
            $("#room_type").focus();
            return false;
        } else {
            $("#room_type").parent('div').removeClass('has-error');
            $("#room_type-error").html("");
        }

        if ($.trim($("#max_adults").val()) == "") {
            $("#max_adults-error").html("Please enter maximum no of adults");
            $("#max_adults").parent('div').addClass('has-error');
            $("#max_adults").focus();
            return false;
        } else {
            $("#max_adults").parent('div').removeClass('has-error');
            $("#max_adults-error").html("");
        }
        if ($.trim($("#max_childrens").val()) == "") {
            $("#max_childrens-error").html("Please enter maximum no of childrens");
            $("#max_childrens").parent('div').addClass('has-error');
            $("#max_childrens").focus();
            return false;
        } else {
            $("#max_childrens").parent('div').removeClass('has-error');
            $("#max_childrens-error").html("");
        }

        if ($('input[name="data[Hotel][facilities][]"]:checked').length == 0) {
            $("#facility-error").html("Please select room facilities");
            $("#facilities").parent('div').addClass('has-error');
            $("#facilities").focus();
            return false;
        } else {
            $("#facilities").parent('div').removeClass('has-error');
            $("#facility-error").html("");
        }
//        if ($.trim($("#room_description").val()) == "") {
//            $("#room_description-error").html("Please enter room description");
//            $("#room_description").parent('div').addClass('has-error');
//            $("#room_description").focus();
//            return false;
//        } else {
//            $("#room_description").parent('div').removeClass('has-error');
//            $("#room_description-error").html("");
//        }
        if (($.trim($("#room_images").val()) == "") && ($("#room_imgs").val() == "0")) {
            $("#room_images-error").html("Please upload room images");
            $("#room_images").parent('div').addClass('has-error');
            $("#room_images").focus();
            return false;
        } else {
            $("#room_images").parent('div').removeClass('has-error');
            $("#room_images-error").html("");
        }
        var count = $(".room_images").length;
        var c1 = new Array();
        var sum = 0;
        for (var k = 0; k < count; k++) {
            c1[k] = $(".room_images")[k].files.length;
            sum += c1[k];
        }
        var c2 = $("#room_imgs").val();
        var total_img = parseInt(sum) + parseInt(c2);

        if (total_img < 1) {
            $("#room_images-error").html("Please upload minimum 1 images");
            $("#room_images").parent('div').addClass('has-error');
            $("#room_images").focus();
            return false;
        } else {
            $("#room_images").parent('div').removeClass('has-error');
            $("#room_images-error").html("");
        }

        if ($.trim($("#room_category_id").val()) == "") {
            $("#room_category_id-error").html("Please select room category");
            $("#room_category_id").parent('div').addClass('has-error');
            $("#room_category_id").focus();
            return false;
        } else {
            $("#room_category_id").parent('div').removeClass('has-error');
            $("#room_category_id-error").html("");
        }
//        if ($.trim($("#customer_price").val()) == "" && $.trim($("#rate_contract_type").val()) == "1") {
//            $("#customer_price-error").html("Please enter customer price");
//            $("#customer_price").parent('div').addClass('has-error');
//            $("#customer_price").focus();
//            return false;
//        } else {
//            $("#customer_price").parent('div').removeClass('has-error');
//            $("#customer_price-error").html("");
//        }
//        if ($.trim($("#hotel_price").val()) == "" && $.trim($("#rate_contract_type").val()) == "1") {
//            $("#hotel_price-error").html("Please enter hotel price");
//            $("#hotel_price").parent('div').addClass('has-error');
//            $("#hotel_price").focus();
//            return false;
//        } else {
//            $("#hotel_price").parent('div').removeClass('has-error');
//            $("#hotel_price-error").html("");
//        }
//        if ($.trim($("#customer_price1").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#customer_price1-error").html("Please enter customer price");
//            $("#customer_price1").parent('div').addClass('has-error');
//            $("#customer_price1").focus();
//            return false;
//        } else {
//            $("#customer_price1").parent('div').removeClass('has-error');
//            $("#customer_price1-error").html("");
//        }
//        if ($.trim($("#hotel_price1").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#hotel_price1-error").html("Please enter hotel price");
//            $("#hotel_price1").parent('div').addClass('has-error');
//            $("#hotel_price1").focus();
//            return false;
//        } else {
//            $("#hotel_price1").parent('div').removeClass('has-error');
//            $("#hotel_price1-error").html("");
//        }
//        if ($.trim($("#customer_price2").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#customer_price2-error").html("Please enter customer price");
//            $("#customer_price2").parent('div').addClass('has-error');
//            $("#customer_price2").focus();
//            return false;
//        } else {
//            $("#customer_price2").parent('div').removeClass('has-error');
//            $("#customer_price2-error").html("");
//        }
//        if ($.trim($("#hotel_price2").val()) == "" && $.trim($("#rate_contract_type").val()) == "2") {
//            $("#hotel_price2-error").html("Please enter hotel price");
//            $("#hotel_price2").parent('div').addClass('has-error');
//            $("#hotel_price2").focus();
//            return false;
//        } else {
//            $("#hotel_price2").parent('div').removeClass('has-error');
//            $("#hotel_price2-error").html("");
//        }
    });

    $("#add_hotel_activity").click(function () {
        if ($.trim($("#hotel_activity").val()) == "") {
            $("#hotel_activity-error").html("Please enter activity");
            $("#hotel_activity").parent('div').addClass('has-error');
            $("#hotel_activity").focus();
            return false;
        } else {
            $("#hotel_activity").parent('div').removeClass('has-error');
            $("#hotel_activity-error").html("");
        }

        if ($.trim($("#activity_image").val()) == "") {
            $("#activity_image-error").html("Please upload activity image");
            $("#activity_image").parent('div').addClass('has-error');
            $("#activity_image").focus();
            return false;
        } else {
            $("#activity_image").parent('div').removeClass('has-error');
            $("#activity_image-error").html("");
        }
    });
    $("#edit_hotel_activity").click(function () {
        if ($.trim($("#hotel_activity").val()) == "") {
            $("#hotel_activity-error").html("Please enter activity");
            $("#hotel_activity").parent('div').addClass('has-error');
            $("#hotel_activity").focus();
            return false;
        } else {
            $("#hotel_activity").parent('div').removeClass('has-error');
            $("#hotel_activity-error").html("");
        }

        if ($.trim($("#activity_image").val()) == "" && $.trim($("#activity_imgs").val()) == "") {
            $("#activity_image-error").html("Please upload activity image");
            $("#activity_image").parent('div').addClass('has-error');
            $("#activity_image").focus();
            return false;
        } else {
            $("#activity_image").parent('div').removeClass('has-error');
            $("#activity_image-error").html("");
        }
    });



    jQuery('.dates').datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
    });

    $('.seasonal').hide();
    if ($('#rate_contract_type').val() == 2) {
        $('.seasonal').show();
    }
    $('#rate_contract_type').on('change', function () {
        if ($('#rate_contract_type').val() == 2) {
            $('.seasonal').show();
        } else {
            $('.seasonal').hide();
        }
    });

});

function IsValidEmail(email) {
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return expr.test(email);
}
;