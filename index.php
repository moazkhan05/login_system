<?php
// Initialize the session
session_start();

require 'authentication.php';
// Check if the user is already logged in, if yes then redirect him to welcome page
//-----------------Authentication--------------------
if(auth_is_logged_in() === true){
    if(auth_is_admin()){
        header("location: admin-panel.php"); 
    }else{
        header("location: welcome.php");
    }
}
else{
    header("location: login-signup.php");
}
//----------------- ENDS Authentication -------------------- 

?>
<!DOCTYPE html>
<html>

</html>