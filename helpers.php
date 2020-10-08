<?php
function dd($var){
    print_r($var);
    die;
}

function dump($var, $return = false){
    return print_r($var, $return);
}

function sanitize($var){
  return trim(htmlentities($var));
}
?> 