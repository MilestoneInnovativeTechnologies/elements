<?php
function threedigits($str){
    return number_format((float)$str, 3, '.', '');
}
function twodigits($str){
    return number_format((float)$str, 2, '.', '');
}
function mydate($value)
{
    return \Illuminate\Support\Carbon::parse($value)->format('d-m-Y H:i A');
}
