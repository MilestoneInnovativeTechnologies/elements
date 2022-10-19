<?php
function threedigits($str){
    return number_format((float)$str, 3, '.', '');
}
