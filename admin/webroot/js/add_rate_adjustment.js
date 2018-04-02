$(document).ready(function () {
    $("#submit_button").click(function () {

        if ($("input[id^=city_ids]:checked").length == 0) {
            alert("Please select at least one city");
            return false;
        }

//        if ($("input[id^=fare_category_id]:checked").length == 0) {
//            alert("Please select at least one booking type");
//            return false;
//        }

        if ($.trim($("#farecategory_id").val()) == "") {
            alert("Please select booking type");
            $("#farecategory_id").focus();
            return false;
        }



        if ($.trim($("#adjustment_type").val()) == "") {
            alert("Please select adjustment type");
            $("#adjustment_type").focus();
            return false;
        }

        if ($.trim($("#amount_type").val()) == "") {
            alert("Please select amouunt type");
            $("#amount_type").focus();
            return false;
        }


        if ($.trim($("#start_date").val()) == "") {
            alert("Please select start date");
            $("#start_date").focus();
            return false;
        }
        if ($.trim($("#end_date").val()) == "") {
            alert("Please select end date");
            $("#end_date").focus();
            return false;
        }
        if ($.trim($("#destination").val()) == "") {
            alert("Please enter destination");
            $("#destination").focus();
            return false;
        }
        var chks = 0
            $(".rate_inputs_b").each(function () {
                if ($(this).val() != '' && $(this).val() != 0) {
                    chks++;
                }

            });
            if (chks == 0) {
                alert("Please insert rate for atleast one Vehicle Category");
                return false;
            }
    });
});