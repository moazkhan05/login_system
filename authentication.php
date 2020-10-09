<?php
session_start();
//-------------ERRORS---------------------------
function error401(){
  echo  ("Error 401: Unauthorized");
  die();
}
function error403(){
  echo ("Error 403: You do  not have authorization for this page");
  die();
}
function error($var){
  echo $var;
  die();
}
//-------------END Errors---------------------------

//-------------Authentication functions---------------------------
function auth_is_logged_in(){
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      return true;
    }
    else 
      return false;
}

function auth_is_admin(){
  if($_SESSION["account"] == "admin"){
    return true;
  }
  else{
    return false;
  }
}

function auth_is_user(){
  if($_SESSION["account"] =="user"){
    return true;
  }
  else{
    return false;
  }
}
//-------------END Authentication functions---------------------------
?>
