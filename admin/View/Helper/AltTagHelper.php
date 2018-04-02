<?php

/*
 * Alt tag helper 3-8-13
 */

class AltTagHelper extends AppHelper {

    //var $image_name = "";

    function get_name($file_name) {
        $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);
        $image_name = explode("." . $imgExtension, $file_name);
        $file_array = explode('~@~', base64_decode($image_name[0]));
        $file_name = !empty($file_array[1]) ? $file_array[1] : $image_name[0];
        return $file_name;
    }

}

?>
