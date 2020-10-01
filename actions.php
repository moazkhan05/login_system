
<?php


//---------------------------------------logout function start----------------------------------------------------

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

//---------------------------------------welocme function end----------------------------------------------------



?>