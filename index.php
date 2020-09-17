<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["account"] === "admin"){
        header("location: admin-panel.php");
    }else{
        header("location: welcome.php");
    }
}
else{
    header("location: auth.php");
}
 

?>
<!DOCTYPE html>
<html>

</html>