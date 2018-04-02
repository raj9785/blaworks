$(document).ready(function () {
    $("#add_cashback").click(function () {

        if ($.trim($("#type").val()) == "0") {
            $("#type-error").html("Please select type");
            $("#type").parent('div').addClass('has-error');
            $("#type").focus();
            return false;
        } else {
            $("#type").parent('div').removeClass('has-error');
            $("#type-error").html("");
        }
        var type_id = $("#type").val();
        if ($("input[id^=type" + type_id + "]:checked").length == 0) {
            $("#type" + type_id + "-error").html("Please select types");
            $("#type" + type_id).parent('div').addClass('has-error');
            $("#type" + type_id).focus();
            return false;
        } else {
            $("#type" + type_id).parent('div').removeClass('has-error');
            $("#type" + type_id + "-error").html("");
        }
        if ($("input[id^=city_id]:checked").length == 0) {
            $("#city-error").html("Please select at least one city");
            $("#city").parent('div').addClass('has-error');
            $("#city").focus();
            return false;
        } else {
            $("#city").parent('div').removeClass('has-error');
            $("#city-error").html("");
        }
        if ($("input[id^=offer_days]:checked").length == 0) {
            $("#offer_days-error").html("Please select at least one offer days");
            $("#offer_days").parent('div').addClass('has-error');
            $("#offer_days").focus();
            return false;
        } else {
            $("#offer_days").parent('div').removeClass('has-error');
            $("#offer_days-error").html("");
        }
        if ($.trim($("#payment_type").val()) == "") {
            $("#payment_type-error").html("Please select payment type");
            $("#payment_type").parent('div').addClass('has-error');
            $("#payment_type").focus();
            return false;
        } else {
            $("#payment_type").parent('div').removeClass('has-error');
            $("#payment_type-error").html("");
        }
        if ($.trim($("#payment_type").val()) == "1" && $.trim($("#cashback_amount_type").val()) == "0") {
            $("#cashback_amount_type-error").html("Please enter cashback amount type");
            $("#cashback_amount_type").parent('div').addClass('has-error');
            $("#cashback_amount_type").focus();
            return false;
        } else {
            $("#cashback_amount_type").parent('div').removeClass('has-error');
            $("#cashback_amount_type-error").html("");
        }
        if ($.trim($("#payment_type").val()) == "1" && $.trim($("#cashback_amount_type").val()) != "0" && $.trim($("#advance_payment").val()) == "") {
            $("#advance_payment-error").html("Please enter advance payment");
            $("#advance_payment").parent('div').addClass('has-error');
            $("#advance_payment").focus();
            return false;
        } else {
            $("#advance_payment").parent('div').removeClass('has-error');
            $("#advance_payment-error").html("");
        }

        if ($.trim($("#cashback_amount").val()) == "") {
            $("#cashback_amount-error").html("Please enter cashback amount");
            $("#cashback_amount").parent('div').addClass('has-error');
            $("#cashback_amount").focus();
            return false;
        } else {
            $("#cashback_amount").parent('div').removeClass('has-error');
            $("#cashback_amount-error").html("");
        }
        if ($("input[id^=cab_type]:checked").length == 0) {
            $("#cab_type-error").html("Please select at least one vehicle type");
            $("#cab_type").parent('div').addClass('has-error');
            $("#cab_type").focus();
            return false;
        } else {
            $("#cab_type").parent('div').removeClass('has-error');
            $("#cab_type-error").html("");
        }
        if ($.trim($("#name").val()) == "") {
            $("#name-error").html("Please enter unique code");
            $("#name").parent('div').addClass('has-error');
            $("#name").focus();
            return false;
        } else {
            $("#name").parent('div').removeClass('has-error');
            $("#name-error").html("");
        }
        if ($.trim($("#from_date").val()) == "") {
            $("#from_date-error").html("Please enter from date");
            $("#from_date").parent('div').addClass('has-error');
            $("#from_date").focus();
            return false;
        } else {
            $("#from_date").parent('div').removeClass('has-error');
            $("#from_date-error").html("");
        }

        if ($.trim($("#end_date").val()) == "") {
            $("#end_date-error").html("Please enter to date");
            $("#end_date").parent('div').addClass('has-error');
            $("#end_date").focus();
            return false;
        } else {
            $("#end_date").parent('div').removeClass('has-error');
            $("#end_date-error").html("");
        }

        if ($.trim($("#image").val()) == "") {
            $("#image-error").html("Please upload image");
            $("#image").parent('div').addClass('has-error');
            $("#image").focus();
            return false;
        } else {
            $("#image").parent('div').removeClass('has-error');
            $("#image-error").html("");
        }

    });
    $("#edit_cashback").click(function () {

        if ($.trim($("#type").val()) == "0") {
            $("#type-error").html("Please select type");
            $("#type").parent('div').addClass('has-error');
            $("#type").focus();
            return false;
        } else {
            $("#type").parent('div').removeClass('has-error');
            $("#type-error").html("");
        }
        var type_id = $("#type").val();
        if ($("input[id^=type" + type_id + "]:checked").length == 0) {
            $("#type" + type_id + "-error").html("Please select types");
            $("#type" + type_id).parent('div').addClass('has-error');
            $("#type" + type_id).focus();
            return false;
        } else {
            $("#type" + type_id).parent('div').removeClass('has-error');
            $("#type" + type_id + "-error").html("");
        }
        if ($("input[id^=city_id]:checked").length == 0) {
            $("#city-error").html("Please select at least one city");
            $("#city").parent('div').addClass('has-error');
            $("#city").focus();
            return false;
        } else {
            $("#city").parent('div').removeClass('has-error');
            $("#city-error").html("");
        }
        if ($("input[id^=offer_days]:checked").length == 0) {
            $("#offer_days-error").html("Please select at least one offer days");
            $("#offer_days").parent('div').addClass('has-error');
            $("#offer_days").focus();
            return false;
        } else {
            $("#offer_days").parent('div').removeClass('has-error');
            $("#offer_days-error").html("");
        }
        
        if ($.trim($("#payment_type").val()) == "") {
            $("#payment_type-error").html("Please select payment type");
            $("#payment_type").parent('div').addClass('has-error');
            $("#payment_type").focus();
            return false;
        } else {
            $("#payment_type").parent('div').removeClass('has-error');
            $("#payment_type-error").html("");
        }

        if ($.trim($("#payment_type").val()) == "1" && $.trim($("#cashback_amount_type").val()) == "0") {
            $("#cashback_amount_type-error").html("Please enter cashback amount type");
            $("#cashback_amount_type").parent('div').addClass('has-error');
            $("#cashback_amount_type").focus();
            return false;
        } else {
            $("#cashback_amount_type").parent('div').removeClass('has-error');
            $("#cashback_amount_type-error").html("");
        }
        if ($.trim($("#payment_type").val()) == "1" && $.trim($("#cashback_amount_type").val()) != "0" && $.trim($("#advance_payment").val()) == "") {
            $("#advance_payment-error").html("Please enter advance payment");
            $("#advance_payment").parent('div').addClass('has-error');
            $("#advance_payment").focus();
            return false;
        } else {
            $("#advance_payment").parent('div').removeClass('has-error');
            $("#advance_payment-error").html("");
        }

        if ($.trim($("#cashback_amount").val()) == "") {
            $("#cashback_amount-error").html("Please enter cashback amount");
            $("#cashback_amount").parent('div').addClass('has-error');
            $("#cashback_amount").focus();
            return false;
        } else {
            $("#cashback_amount").parent('div').removeClass('has-error');
            $("#cashback_amount-error").html("");
        }
        
        if ($("input[id^=cab_type]:checked").length == 0) {
            $("#cab_type-error").html("Please select at least one vehicle type");
            $("#cab_type").parent('div').addClass('has-error');
            $("#cab_type").focus();
            return false;
        } else {
            $("#cab_type").parent('div').removeClass('has-error');
            $("#cab_type-error").html("");
        }
        
        if ($.trim($("#name").val()) == "") {
            $("#name-error").html("Please enter unique code");
            $("#name").parent('div').addClass('has-error');
            $("#name").focus();
            return false;
        } else {
            $("#name").parent('div').removeClass('has-error');
            $("#name-error").html("");
        }
        
        if ($.trim($("#from_date").val()) == "") {
            $("#from_date-error").html("Please enter from date");
            $("#from_date").parent('div').addClass('has-error');
            $("#from_date").focus();
            return false;
        } else {
            $("#from_date").parent('div').removeClass('has-error');
            $("#from_date-error").html("");
        }

        if ($.trim($("#end_date").val()) == "") {
            $("#end_date-error").html("Please enter to date");
            $("#end_date").parent('div').addClass('has-error');
            $("#end_date").focus();
            return false;
        } else {
            $("#end_date").parent('div').removeClass('has-error');
            $("#end_date-error").html("");
        }

//        if ($.trim($("#image").val()) == "" && $('#offer_imgs').val() == "") {
//            $("#image-error").html("Please upload image");
//            $("#image").parent('div').addClass('has-error');
//            $("#image").focus();
//            return false;
//        } else {
//            $("#image").parent('div').removeClass('has-error');
//            $("#image-error").html("");
//        }

    });

    
});