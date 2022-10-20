<?php
function threedigits($str){
    return number_format((float)$str, 3, '.', '');
}
function twodigits($str){
    return number_format((float)$str, 2, '.', '');
}
