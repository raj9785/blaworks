$(document).ready(function() {
    $("#submit_button").click(function() {
        if ($.trim($("#name").val()) == "") {
            $("#name-error").html("Please specify name");
            $("#name").parent('div').addClass('has-error');
            $("#name").focus();
            return false;
        } else {
            $("#name").parent('div').removeClass('has-error');
            $("#name-error").html("");
        }
        if ($.trim($("#testimonial").val()) == "") {
            $("#testimonial-error").html("Please enter testimonial");
            $("#testimonial").parent('div').addClass('has-error');
            $("#testimonial").focus();
            return false;
        } else {
            $("#testimonial-error").html("");
            $("#testimonial").parent('div').removeClass('has-error');

        }        

    });
});