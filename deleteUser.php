<?php
// Initialize the session
session_start();
require 'helpers.php'; 
//require 'authentication.php'; 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(auth_is_logged_in()===true){
    if(auth_is_admin()!==true){
        error403();
    }
}
else{
    error401();
}

$id=$_GET["del"];
$status=$_GET["status"];


	

	$sql = "update tbl_user set isActive = ? WHERE id = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_status , $param_id);
            
            // Set parameters
            $param_status  =($status == 0) ? 1 : 0; //if user active so deactivate him ,else active him
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