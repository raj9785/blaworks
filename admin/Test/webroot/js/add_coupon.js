$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#cat_type").val()) == "0") {
            alert("Please select type");
            $("#cat_type").focus();
            return false;
        }
        var type_id = $("#cat_type").val();
        if ($("input[id^=type" + type_id + "]:checked").length == 0) {
            alert("Please select types");
            $("#type" + type_id).focus();
            return false;
        }

        if ($("input[id^=city_id]:checked").length == 0) {
            alert("Please select at least one city");
            return false;
        }

        if ($("input[id^=offer_days]:checked").length == 0) {
            alert("Please select at least one offer days");
            $("#offer_days").focus();
            return false;
        }
        if ($.trim($("#payment_type").val()) == "") {
            alert("Please select payment type");
            $("#payment_type").focus();
            return false;
        }
        if ($.trim($("#payment_type").val()) == "1" && $.trim($("#advance_payment").val()) == "") {
            alert("Please enter advance payment");
            $("#advance_payment").focus();
            return false;
        }

        if ($("input[id^=cab_type]:checked").length == 0) {
            alert("Please select at least one vehicle type");
            return false;
        }

        if ($.trim($("#coupon_code").val()) == "") {
            alert("Please enter coupon code");
            $("#coupon_code").focus();
            return false;
        }

        if ($.trim($("#title").val()) == "") {
            alert("Please enter coupon title");
            $("#title").focus();
            return false;
        }

        if ($.trim($("#discount").val()) == "") {
            alert("Please enter discount");
            $("#discount").focus();
            return false;
        }

        if ($.trim($("#type").val()) == 1) {
            if ($.trim($("#maximum_apply").val()) == "") {
                alert("Please enter Maximum Discount applicable");
                $("#maximum_apply").focus();
                return false;
            }
        }

        if ($.trim($("#maximum_num_of_apply").val()) == "") {
            alert("Please enter Total Count of Codes");
            $("#maximum_num_of_apply").focus();
            return false;
        }

        if ($.trim($("#description").val()) == "") {
            alert("Please enter coupon description");
            $("#description").focus();
            return false;
        }
        if ($.trim($("#from_date").val()) == "") {
            alert("Please select coupon offer start date");
            $("#from_date").focus();
            return false;
        }
        if ($.trim($("#end_date").val()) == "") {
            alert("Please select coupon offer end date");
            $("#end_date").focus();
            return false;
        }
//        if ($.trim($("#image").val()) == "") {
//            alert("Please upload image");
//            $("#image").focus();
//            return false;
//        }
    });

    $("#edit_submit_button").click(function () {
        if ($.trim($("#cat_type").val()) == "0") {
            alert("Please select type");
            $("#cat_type").focus();
            return false;
        }
        var type_id = $("#cat_type").val();
        if ($("input[id^=type" + type_id + "]:checked").length == 0) {
            alert("Please select types");
            $("#type" + type_id).focus();
            return false;
        }

        if ($("input[id^=city_id]:checked").length == 0) {
            alert("Please select at least one city");
            return false;
        }

        if ($("input[id^=offer_days]:checked").length == 0) {
            alert("Please select at least one offer days");
            $("#offer_days").focus();
            return false;
        }
        
        if ($.trim($("#payment_type").val()) == "") {
            alert("Please select payment type");
            $("#payment_type").focus();
            return false;
        }
        if ($.trim($("#payment_type").val()) == "1" && $.trim($("#advance_payment").val()) == "") {
            alert("Please enter advance payment");
            $("#advance_payment").focus();
            return false;
        }

        if ($("input[id^=cab_type]:checked").length == 0) {
            alert("Please select at least one vehicle type");
            return false;
        }

        if ($.trim($("#coupon_code").val()) == "") {
            alert("Please enter coupon code");
            $("#coupon_code").focus();
            return false;
        }

        if ($.trim($("#title").val()) == "") {
            alert("Please enter coupon title");
            $("#title").focus();
            return false;
        }

        if ($.trim($("#discount").val()) == "") {
            alert("Please enter discount");
            $("#discount").focus();
            return false;
        }

        if ($.trim($("#type").val()) == 1) {
            if ($.trim($("#maximum_apply").val()) == "") {
                alert("Please enter Maximum Discount applicable");
                $("#maximum_apply").focus();
                return false;
            }
        }

        if ($.trim($("#maximum_num_of_apply").val()) == "") {
            alert("Please enter Total Count of Codes");
            $("#maximum_num_of_apply").focus();
            return false;
        }

        if ($.trim($("#description").val()) == "") {
            alert("Please enter coupon description");
            $("#description").focus();
            return false;
        }
        if ($.trim($("#from_date").val()) == "") {
            alert("Please select coupon offer start date");
            $("#from_date").focus();
            return false;
        }
        if ($.trim($("#end_date").val()) == "") {
            alert("Please select coupon offer end date");
            $("#end_date").focus();
            return false;
        }
//        if ($.trim($("#image").val()) == "" && $('#offer_imgs').val() == "") {
//            alert("Please upload image");
//            $("#image").focus();
//            return false;
//        }
    });
});