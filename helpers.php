<?php

require_once 'dbconfig.php';
require_once 'authentication.php';

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


//logout function
function logout(){
    session_start();
 
    // Unset all of the session variables
    $_SESSION = array();
    
    // Destroy the session.
    session_destroy();
    
    // Redirect to login page
    header("location: login-signup.php");
    exit;
}

?> 