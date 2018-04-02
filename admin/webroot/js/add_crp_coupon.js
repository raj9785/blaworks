$(document).ready(function() {
    $("#submit_button").click(function() {
        if ($("input[id^=city_id]:checked").length == 0) {
            alert("Please select at least one city");
            return false;
        }

        if ($("input[id^=fare_category_id]:checked").length == 0) {
            alert("Please select at least one booking type");
            return false;
        }

        if ($("input[id^=cab_type]:checked").length == 0) {
            alert("Please select at least one vehicle type");
            return false;
        }

        if ($.trim($("#campaign_name").val()) == "") {
            alert("Please enter campaign name");
            $("#campaign_name").focus();
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
    });
});