<?php

$str_to_search_inside = "This is a string of characters to match are";
$str_to_find = "some string"

function doesStringMatch ($str_to_search_inside,$str_to_find)
if (strpos($str_to_search_inside,$str_to_find) !== false) {
    return 'true';
}
else{return false;}

?>
