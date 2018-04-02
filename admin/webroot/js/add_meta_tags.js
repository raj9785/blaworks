$(document).ready(function () {
    $("#submit_button").click(function () {
        
        if ($.trim($("#city_id").val()) == "") {
            $("#city_id-error").html("Please select from city");
            $("#city_id").parent('div').addClass('has-error');
            $("#city_id").focus();
            return false;
        } else {
            $("#city_id").parent('div').removeClass('has-error');
            $("#city_id-error").html("");
        }

        if ($.trim($("#to_city_name").val()) == "") {
            $("#to_city_name-error").html("Please enter to city name");
            $("#to_city_name").parent('div').addClass('has-error');
            $("#to_city_name").focus();
            return false;
        } else {
            $("#to_city_name").parent('div').removeClass('has-error');
            $("#to_city_name-error").html("");
        }



        if ($.trim($("#meta_keywords").val()) == "") {
            $("#meta_keywords-error").html("Please enter meta keywords");
            $("#meta_keywords").parent('div').addClass('has-error');
            $("#meta_keywords").focus();
            return false;
        } else {
            $("#meta_keywords").parent('div').removeClass('has-error');
            $("#meta_keywords-error").html("");
        }
        
        


    });

});

