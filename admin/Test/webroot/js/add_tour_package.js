$(document).ready(function () {
    if ($("#type").val() == 0) {
        $('.package_div').show();
        $('.gataway_div').hide();
        $('.hotels').hide();
    } else if ($("#type").val() == 1) {
        $('.package_div').hide();
        $('.gataway_div').show();
        $('.hotels').show();
    } else {
        $('.package_div').show();
        $('.gataway_div').hide();
        $('.hotels').hide();
    }
    $("#type").change(function () {
        if ($("#type").val() == 0) {
            $('.package_div').show();
            $('.gataway_div').hide();
            $('.hotels').hide();
        } else if ($("#type").val() == 1) {
            $('.package_div').hide();
            $('.gataway_div').show();
            $('.hotels').show();
        } else {
            $('.package_div').show();
            $('.gataway_div').hide();
            $('.hotels').hide();
        }
    });
    $("#add_package").click(function () {
        if ($.trim($("#type").val()) == "") {
            $("#type-error").html("Please select type");
            $("#type").parent('div').addClass('has-error');
            $("#type").focus();
            return false;
        } else {
            $("#type").parent('div').removeClass('has-error');
            $("#type-error").html("");
        }
        if ($.trim($("#package_name").val()) == "") {
            $("#package_name-error").html("Please enter package name");
            $("#package_name").parent('div').addClass('has-error');
            $("#package_name").focus();
            return false;
        } else {
            $("#package_name").parent('div').removeClass('has-error');
            $("#package_name-error").html("");
        }

        if ($.trim($("#no_of_days").val()) == "") {
            $("#no_of_days-error").html("Please enter no of days");
            $("#no_of_days").parent('div').addClass('has-error');
            $("#no_of_days").focus();
            return false;
        } else {
            $("#no_of_days").parent('div').removeClass('has-error');
            $("#no_of_days-error").html("");
        }
        if ($.trim($("#no_of_nights").val()) == "") {
            $("#no_of_nights-error").html("Please enter no of nights");
            $("#no_of_nights").parent('div').addClass('has-error');
            $("#no_of_nights").focus();
            return false;
        } else {
            $("#no_of_nights").parent('div').removeClass('has-error');
            $("#no_of_nights-error").html("");
        }

        if ($.trim($("#city").val()) == "") {
            $("#city-error").html("Please select city");
            $("#city").parent('div').addClass('has-error');
            $("#city").focus();
            return false;
        } else {
            $("#city").parent('div').removeClass('has-error');
            $("#city-error").html("");
        }
        if ($.trim($("#destination_0").val()) == "") {
            $("#destination-error").html("Please enter destination");
            $("#destination").parent('div').addClass('has-error');
            $("#destination").focus();
            return false;
        } else {
            $("#destination").parent('div').removeClass('has-error');
            $("#destination-error").html("");
        }
        if ($('input[name="data[TourPackage][inclusions][]"]:checked').length == 0) {
            $("#inclusions-error").html("Please select inclusions");
            $("#inclusions").parent('div').addClass('has-error');
            $("#inclusions").focus();
            return false;
        } else {
            $("#inclusions").parent('div').removeClass('has-error');
            $("#inclusions-error").html("");
        }
        if ($('input[name="data[TourPackage][exclusions][]"]:checked').length == 0) {
            $("#exclusions-error").html("Please select exclusions");
            $("#exclusions").parent('div').addClass('has-error');
            $("#exclusions").focus();
            return false;
        } else {
            $("#exclusions").parent('div').removeClass('has-error');
            $("#exclusions-error").html("");
        }
        if ($.trim($("#type").val()) == "1" && $('input[name="data[TourPackage][gataway_type][]"]:checked').length == 0) {
            $("#gataway_type-error").html("Please select Getaway type");
            $("#gataway_type").parent('div').addClass('has-error');
            $("#gataway_type").focus();
            return false;
        } else {
            $("#gataway_type").parent('div').removeClass('has-error');
            $("#gataway_type-error").html("");
        }
        
        if ($.trim($("#type").val()) == "0" && $('input[name="data[TourPackage][package_type][]"]:checked').length == 0) {
            $("#package_type-error").html("Please select package type");
            $("#package_type").parent('div').addClass('has-error');
            $("#package_type").focus();
            return false;
        } else {
            $("#package_type").parent('div').removeClass('has-error');
            $("#package_type-error").html("");
        }
        if ($('input[name="data[TourPackage][vacation_type][]"]:checked').length == 0) {
            $("#vacation_type-error").html("Please select vacation type");
            $("#vacation_type").parent('div').addClass('has-error');
            $("#vacation_type").focus();
            return false;
        } else {
            $("#vacation_type").parent('div').removeClass('has-error');
            $("#vacation_type-error").html("");
        }
        if ($('input[name="data[TourPackage][best_time_to_visit][]"]:checked').length == 0) {
            $("#best_time_to_visit-error").html("Please select best time to visit");
            $("#best_time_to_visit").parent('div').addClass('has-error');
            $("#best_time_to_visit").focus();
            return false;
        } else {
            $("#best_time_to_visit").parent('div').removeClass('has-error');
            $("#best_time_to_visit-error").html("");
        }

        if ($('input[name="data[TourPackage][things_to_remember][]"]:checked').length == 0) {
            $("#things_to_remember-error").html("Please select things to remember");
            $("#things_to_remember").parent('div').addClass('has-error');
            $("#things_to_remember").focus();
            return false;
        } else {
            $("#things_to_remember").parent('div').removeClass('has-error');
            $("#things_to_remember-error").html("");
        }
        if ($.trim($("#type").val()) == "1" && $.trim($("#hotel_id").val()) == "") {
            $("#hotel_id-error").html("Please select hotel");
            $("#hotel_id").parent('div').addClass('has-error');
            $("#hotel_id").focus();
            return false;
        } else {
            $("#hotel_id").parent('div').removeClass('has-error');
            $("#hotel_id-error").html("");
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
        
        if ($.trim($("#list_package_image").val()) == "") {
            $("#list_package_image-error").html("Please upload image for List page");
            $("#list_package_image").parent('div').addClass('has-error');
            $("#list_package_image").focus();
            return false;
        } else {
            $("#list_package_image").parent('div').removeClass('has-error');
            $("#list_package_image-error").html("");
        }
        if ($.trim($("#detail_package_image").val()) == "") {
            $("#detail_package_image-error").html("Please upload image for Detail page");
            $("#detail_package_image").parent('div').addClass('has-error');
            $("#detail_package_image").focus();
            return false;
        } else {
            $("#detail_package_image").parent('div').removeClass('has-error');
            $("#detail_package_image-error").html("");
        }
//        var count_img = $(".package_images").length;
//        var c1 = new Array();
//        var total = 0;
//        for (var k = 0; k < count_img; k++) {
//            c1[k] = $(".package_images")[k].files.length;
//            total += c1[k];
//        }
//        if (total < 4) {
//            $("#package_images-error").html("Please upload minimum 4 images");
//            $("#package_images").parent('div').addClass('has-error');
//            $("#package_images").focus();
//            return false;
//        } else {
//            $("#package_images").parent('div').removeClass('has-error');
//            $("#package_images-error").html("");
//        }

        if ($.trim($("#day_points_0").val()) == "") {
            $("#days-error").html("Please enter day point");
            $("#days").parent('div').addClass('has-error');
            $("#days").focus();
            return false;
        } else {
            $("#days").parent('div').removeClass('has-error');
            $("#days-error").html("");
        }



    });

//    $("#add_activity").click(function () {
//        if ($.trim($("#type").val()) == "") {
//            $("#type-error").html("Please Select type");
//            $("#type").parent('div').addClass('has-error');
//            $("#type").focus();
//            return false;
//        } else {
//            $("#type").parent('div').removeClass('has-error');
//            $("#type-error").html("");
//        }
//
//        if ($.trim($("#heading").val()) == "") {
//            $("#heading-error").html("Please enter heading");
//            $("#heading").parent('div').addClass('has-error');
//            $("#heading").focus();
//            return false;
//        } else {
//            $("#heading").parent('div').removeClass('has-error');
//            $("#heading-error").html("");
//        }
//
//        if ($.trim($("#description").val()) == "") {
//            $("#description-error").html("Please enter description");
//            $("#description").parent('div').addClass('has-error');
//            $("#description").focus();
//            return false;
//        } else {
//            $("#description").parent('div').removeClass('has-error');
//            $("#description-error").html("");
//        }
//
//        if ($.trim($("#activities_image").val()) == "") {
//            $("#activities_image-error").html("Please upload image");
//            $("#activities_image").parent('div').addClass('has-error');
//            $("#activities_image").focus();
//            return false;
//        } else {
//            $("#activities_image").parent('div').removeClass('has-error');
//            $("#activities_image-error").html("");
//        }
//        for (var i = 2; i <= 4; i++) {
//            if (($.trim($("#activities_image" + i).val()) != "" && $.trim($("#heading" + i).val()) == "" && $.trim($("#description" + i).val()) == "") || ($.trim($("#activities_image" + i).val()) == "" && $.trim($("#heading" + i).val()) != "" && $.trim($("#description" + i).val()) == "") || ($.trim($("#activities_image" + i).val()) == "" && $.trim($("#heading" + i).val()) == "" && $.trim($("#description" + i).val()) != "") || ($.trim($("#activities_image" + i).val()) != "" && $.trim($("#heading" + i).val()) == "" && $.trim($("#description" + i).val()) != "") || ($.trim($("#activities_image" + i).val()) == "" && $.trim($("#heading" + i).val()) != "" && $.trim($("#description" + i).val()) != "")) {
//                $("#activities_image" + i + "-error").html("Please fill all fields of Activity " + i);
//                //$("#activities_image2").parent('div').addClass('has-error');
//                //$("#activities_image2").focus();
//                return false;
//            } else {
//                $("#activities_image" + i).parent('div').removeClass('has-error');
//                $("#activities_image" + i + "-error").html("");
//            }
//        }
//
//    });


    $("#edit_package").click(function () {
        if ($.trim($("#type").val()) == "") {
            $("#type-error").html("Please select type");
            $("#type").parent('div').addClass('has-error');
            $("#type").focus();
            return false;
        } else {
            $("#type").parent('div').removeClass('has-error');
            $("#type-error").html("");
        }
        if ($.trim($("#package_name").val()) == "") {
            $("#package_name-error").html("Please enter package name");
            $("#package_name").parent('div').addClass('has-error');
            $("#package_name").focus();
            return false;
        } else {
            $("#package_name").parent('div').removeClass('has-error');
            $("#package_name-error").html("");
        }

        if ($.trim($("#no_of_days").val()) == "") {
            $("#no_of_days-error").html("Please enter no of days");
            $("#no_of_days").parent('div').addClass('has-error');
            $("#no_of_days").focus();
            return false;
        } else {
            $("#no_of_days").parent('div').removeClass('has-error');
            $("#no_of_days-error").html("");
        }
        if ($.trim($("#no_of_nights").val()) == "") {
            $("#no_of_nights-error").html("Please enter no of nights");
            $("#no_of_nights").parent('div').addClass('has-error');
            $("#no_of_nights").focus();
            return false;
        } else {
            $("#no_of_nights").parent('div').removeClass('has-error');
            $("#no_of_nights-error").html("");
        }

        if ($.trim($("#city").val()) == "") {
            $("#city-error").html("Please select city");
            $("#city").parent('div').addClass('has-error');
            $("#city").focus();
            return false;
        } else {
            $("#city").parent('div').removeClass('has-error');
            $("#city-error").html("");
        }
        if ($.trim($("#destination_0").val()) == "") {
            $("#destination-error").html("Please enter destination");
            $("#destination").parent('div').addClass('has-error');
            $("#destination").focus();
            return false;
        } else {
            $("#destination").parent('div').removeClass('has-error');
            $("#destination-error").html("");
        }
        if ($('input[name="data[TourPackage][inclusions][]"]:checked').length == 0) {
            $("#inclusions-error").html("Please select inclusions");
            $("#inclusions").parent('div').addClass('has-error');
            $("#inclusions").focus();
            return false;
        } else {
            $("#inclusions").parent('div').removeClass('has-error');
            $("#inclusions-error").html("");
        }
        if ($('input[name="data[TourPackage][exclusions][]"]:checked').length == 0) {
            $("#exclusions-error").html("Please select exclusions");
            $("#exclusions").parent('div').addClass('has-error');
            $("#exclusions").focus();
            return false;
        } else {
            $("#exclusions").parent('div').removeClass('has-error');
            $("#exclusions-error").html("");
        }
        if ($.trim($("#type").val()) == "1" && $('input[name="data[TourPackage][gataway_type][]"]:checked').length == 0) {
            $("#gataway_type-error").html("Please select Getaway type");
            $("#gataway_type").parent('div').addClass('has-error');
            $("#gataway_type").focus();
            return false;
        } else {
            $("#gataway_type").parent('div').removeClass('has-error');
            $("#gataway_type-error").html("");
        }
        
        if ($.trim($("#type").val()) == "0" && $('input[name="data[TourPackage][package_type][]"]:checked').length == 0) {
            $("#package_type-error").html("Please select package type");
            $("#package_type").parent('div').addClass('has-error');
            $("#package_type").focus();
            return false;
        } else {
            $("#package_type").parent('div').removeClass('has-error');
            $("#package_type-error").html("");
        }
        if ($('input[name="data[TourPackage][vacation_type][]"]:checked').length == 0) {
            $("#vacation_type-error").html("Please select vacation type");
            $("#vacation_type").parent('div').addClass('has-error');
            $("#vacation_type").focus();
            return false;
        } else {
            $("#vacation_type").parent('div').removeClass('has-error');
            $("#vacation_type-error").html("");
        }
        if ($('input[name="data[TourPackage][best_time_to_visit][]"]:checked').length == 0) {
            $("#best_time_to_visit-error").html("Please select best time to visit");
            $("#best_time_to_visit").parent('div').addClass('has-error');
            $("#best_time_to_visit").focus();
            return false;
        } else {
            $("#best_time_to_visit").parent('div').removeClass('has-error');
            $("#best_time_to_visit-error").html("");
        }
        if ($('input[name="data[TourPackage][things_to_remember][]"]:checked').length == 0) {
            $("#things_to_remember-error").html("Please select things to remember");
            $("#things_to_remember").parent('div').addClass('has-error');
            $("#things_to_remember").focus();
            return false;
        } else {
            $("#things_to_remember").parent('div').removeClass('has-error');
            $("#things_to_remember-error").html("");
        }
        if ($.trim($("#type").val()) == "1" && $.trim($("#hotel_id").val()) == "") {
            $("#hotel_id-error").html("Please select hotel");
            $("#hotel_id").parent('div').addClass('has-error');
            $("#hotel_id").focus();
            return false;
        } else {
            $("#hotel_id").parent('div').removeClass('has-error');
            $("#hotel_id-error").html("");
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
//        if ($.trim($("#list_package_image").val()) == "" && $("#list_package_imgs").val() != "0") {
//            $("#list_package_image-error").html("Please upload image for List page");
//            $("#list_package_image").parent('div').addClass('has-error');
//            $("#list_package_image").focus();
//            return false;
//        } else {
//            $("#list_package_image").parent('div').removeClass('has-error');
//            $("#list_package_image-error").html("");
//        }
//        if ($.trim($("#detail_package_image").val()) == "" && $("#detail_package_imgs").val() != "1") {
//            $("#detail_package_image-error").html("Please upload image for Detail page");
//            $("#detail_package_image").parent('div').addClass('has-error');
//            $("#detail_package_image").focus();
//            return false;
//        } else {
//            $("#detail_package_image").parent('div').removeClass('has-error');
//            $("#detail_package_image-error").html("");
//        }
//        if (($.trim($("#package_images").val()) == "") && ($("#package_imgs").val() == "0")) {
//            $("#package_images-error").html("Please upload package images");
//            $("#package_images").parent('div').addClass('has-error');
//            $("#package_images").focus();
//            return false;
//        } else {
//            $("#package_images").parent('div').removeClass('has-error');
//            $("#package_images-error").html("");
//        }
//        //
//        var count = $(".package_images").length;
//        var c1 = new Array();
//        var sum = 0;
//        for (var k = 0; k < count; k++) {
//            c1[k] = $(".package_images")[k].files.length;
//            sum += c1[k];
//        }
//        var c2 = $("#package_imgs").val();
//        var total_img = parseInt(sum) + parseInt(c2);
//
//        if (total_img < 4) {
//            $("#package_images-error").html("Please upload minimum 4 images");
//            $("#package_images").parent('div').addClass('has-error');
//            $("#package_images").focus();
//            return false;
//        } else {
//            $("#package_images").parent('div').removeClass('has-error');
//            $("#package_images-error").html("");
//        }


        if ($.trim($("#day_points_0").val()) == "") {
            $("#days-error").html("Please enter day point");
            $("#days").parent('div').addClass('has-error');
            $("#days").focus();
            return false;
        } else {
            $("#days").parent('div').removeClass('has-error');
            $("#days-error").html("");
        }

    });

//    $("#edit_activities").click(function () {
//
//        if ($.trim($("#heading").val()) == "") {
//            $("#heading-error").html("Please enter heading");
//            $("#heading").parent('div').addClass('has-error');
//            $("#heading").focus();
//            return false;
//        } else {
//            $("#heading").parent('div').removeClass('has-error');
//            $("#heading-error").html("");
//        }
//
//        if ($.trim($("#description").val()) == "") {
//            $("#description-error").html("Please enter description");
//            $("#description").parent('div').addClass('has-error');
//            $("#description").focus();
//            return false;
//        } else {
//            $("#description").parent('div').removeClass('has-error');
//            $("#description-error").html("");
//        }
//
//        if (($.trim($("#activities_image").val()) == "") && ($("#activity_imgs").val() == "")) {
//            $("#activities_image-error").html("Please upload image");
//            $("#activities_image").parent('div').addClass('has-error');
//            $("#activities_image").focus();
//            return false;
//        } else {
//            $("#activities_image").parent('div').removeClass('has-error');
//            $("#activities_image-error").html("");
//        }
//    });

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

    $("#add_vacation_type").click(function () {
        if ($.trim($("#vacation_type").val()) == "") {
            $("#vacation_type-error").html("Please enter vacation type");
            $("#vacation_type").parent('div').addClass('has-error');
            $("#vacation_type").focus();
            return false;
        } else {
            $("#vacation_type").parent('div').removeClass('has-error');
            $("#vacation_type-error").html("");
        }
    });
    $("#add_package_type").click(function () {
        if ($.trim($("#package_type").val()) == "") {
            $("#package_type-error").html("Please enter package type");
            $("#package_type").parent('div').addClass('has-error');
            $("#package_type").focus();
            return false;
        } else {
            $("#package_type").parent('div').removeClass('has-error');
            $("#package_type-error").html("");
        }
    });
    $("#add_cancel_policy").click(function () {
        if ($.trim($("#policy").val()) == "") {
            $("#policy-error").html("Please enter policy");
            $("#policy").parent('div').addClass('has-error');
            $("#policy").focus();
            return false;
        } else {
            $("#policy").parent('div').removeClass('has-error');
            $("#policy-error").html("");
        }
    });
    $("#add_thing").click(function () {
        if ($.trim($("#thing").val()) == "") {
            $("#thing-error").html("Please enter thing");
            $("#thing").parent('div').addClass('has-error');
            $("#thing").focus();
            return false;
        } else {
            $("#thing").parent('div').removeClass('has-error');
            $("#thing-error").html("");
        }
    });
    $("#add_best_time").click(function () {
        if ($.trim($("#time").val()) == "") {
            $("#time-error").html("Please enter best time");
            $("#time").parent('div').addClass('has-error');
            $("#time").focus();
            return false;
        } else {
            $("#time").parent('div').removeClass('has-error');
            $("#time-error").html("");
        }
    });
    $("#add_inclusion").click(function () {
        if ($.trim($("#title").val()) == "") {
            $("#title-error").html("Please enter inclusion");
            $("#title").parent('div').addClass('has-error');
            $("#title").focus();
            return false;
        } else {
            $("#title").parent('div').removeClass('has-error');
            $("#title-error").html("");
        }
    });
    $("#add_exclusion").click(function () {
        if ($.trim($("#title").val()) == "") {
            $("#title-error").html("Please enter exclusion");
            $("#title").parent('div').addClass('has-error');
            $("#title").focus();
            return false;
        } else {
            $("#title").parent('div').removeClass('has-error');
            $("#title-error").html("");
        }
    });
    
    $("#updation").click(function () {
        if ($.trim($("#name").val()) == "") {
            $("#name-error").html("Please enter name");
            $("#name").parent('div').addClass('has-error');
            $("#name").focus();
            return false;
        } else {
            $("#name").parent('div').removeClass('has-error');
            $("#name-error").html("");
        }
    });
});

