<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["account"] != "admin"){
        echo ("Error 403: You do  not have authorization for this page");
        die();
    }
}
else{
    echo ("Error 401: Unauthorized");
    die();
}

$id=$_GET["del"];
require 'dbconfig.php';

	$conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "update tbl_user set isActive = ? WHERE id = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_status , $param_id);
            
            // Set parameters
            $param_status  = 0;
            $param_id = $id;
    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               
                header("location: admin-panel.php");
             
            } 
            else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

		$conn->Close();

?>
<!DOCTYPE html>
<html>

</html>