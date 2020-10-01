<?php
session_start();
require 'authentication.php';
require 'dbconfig.php';
require 'actions.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if(auth_is_logged_in()===false){
    error401();
}
else if(auth_is_user()){
        if($_SESSION["id"]!=$_GET["edit-details"]){
            error403();
        }
}   






//------------page load------------------------------

    //if connection build
 
    // Check if the user is already logged in, if yes then redirect him to welcome page
    
    $user_id=$_SESSION["id"];
    $edit_details_id=$_GET['edit-details'];
 
    // Prepare a select statement
    $sql = "SELECT  name, phone_number FROM tbl_user WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_id);
        
        // Set parameters
        $param_id = $edit_details_id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
           
            mysqli_stmt_store_result($stmt);
                              
            // Check if email exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){  
                 
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $name, $mobile_number);             
                //fetching data ($stmt);                  
                mysqli_stmt_fetch($stmt);
            } 
            
        } 
        else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }    
    
//------------page load end------------------------------

            //update function
if(isset($_POST['btn-update'])){
 // Include config file

//  Define variables and initialize with empty values
      
$name = $email = $mobile_number ="";
$name_err = $email_err = $mobile_number_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    if(empty(trim($_POST["txt-name"]))){
        $name_err = "Please enter your name.";
    } 
    else{

       $name = trim($_POST["txt-name"]); 
    }
    
    // Validate mobile number
    if(empty(trim($_POST["txt-number"]))){
        $mobile_number_err = "Please enter your number.";
    } 
    //-----------------No Input Errors fetching data 
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_user WHERE phone_number = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobile_number);
            
            // Set parameters
            $param_mobile_number = $_POST["txt-number"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                   mysqli_stmt_bind_result($stmt, $id);
                   mysqli_stmt_fetch($stmt);
                }
                else{
                    if (strlen(trim($_POST["txt-number"]))===11){
                      $mobile_number = $_POST["txt-number"];  
                    }else{
                      $mobile_number_err= "Number is not valid";
                    }
                }
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
  }
  //-----------------ENDS No Input Errors fetching data

  //-----------Update Details--------------------- 
  if(empty($name_err) && empty($mobile_number_err) ){
    
        // Prepare an insert statement
        $sql = "update tbl_user set name =?, phone_number=? where id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_name , $param_mobile_number, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_mobile_number = $mobile_number;
            $param_id = $edit_details_id;
    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                if(auth_is_admin()){
                  header("location: admin-panel.php");
                }
                else{
                  header("location: welcome.php");  
                }
                
            } 
            else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //----------- END Update Details---------------------
    
    // Close connection
    mysqli_close($conn);
  }

}        
// Close connection
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Portal</title>
       
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/jquery-3.5.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body >

    <header>
    <nav id="header-nav" class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a href="index.html" class="pull-left visible-md visible-lg">
          </a>

          <div class="navbar-brand">
            <a href="index.php"><h1>User Management System</h1></a>
            <p>
              
              <span>Learning PHP</span>
            </p>
          </div>
          
      </div><!-- .container -->
    </nav><!-- #header-nav -->
    </header>
          
    <!-- main content  start   -->
    <form method="post" action="">
    <div id="main-content" class="container" style="border-radius: 10px;  padding: 10px 15px 10px 15px;">
        <div class="row" style="box-sizing: border-box; "><!-- row to distinguish side panel and center container start -->
             
              <!-- center table start -->
              <div style="width:85vw; box-sizing:border-box; margin: 10px auto 10px auto; padding: 10px 15px; position: relative; border-radius: 10px;">
                  <div class="row" style="margin-bottom: 5px;">
                    <label class="col-sm-4">Name</label>
                    <input class="col-sm-8" type="text" name="txt-name" style="border-radius: inherit; width: 80%;" value="<?php echo htmlspecialchars($name) ?>">
                    
                  </div>
                 
                  <div class="row" style="margin-bottom: 5px;">
                    <label class="col-sm-4">Phone Number</label>
                    <input class="col-sm-8" type="text" name="txt-number" style="border-radius: inherit; width: 90%;" value="<?php echo htmlspecialchars($mobile_number) ?>">
                    
                  </div>
                  <div style="margin-top: 10px;">
                    <button style="float: right; background-color: green; color: white;" class="btn btn-secondary" name="btn-update" type="submit">Update
                    </button>
                  </div>                  
              </div>    
              <!-- center table end -->
              
        </div> <!-- row to distinguish side panel and center container start -->   
         
    </div> <!--main-content-container end -->
    </form>
    <!-- main content  End   -->
        
    <footer class="panel-footer"> <!-- footet starts -->
    <div class="container"> 
      <div class="row">
        <section id="hours" class="col-sm-4">
          <span>User Portal:</span><br>
          Registration<br>
          Login<br>
          User Panel
          <hr class="visible-xs">
        </section>
        <section id="address" class="col-sm-4">
          <span>Admin Panel:</span><br>
          Login<br>
          Admin Portal
          <p>* Where Admin can view all the users and update/delete informations of users.</p>
          <hr class="visible-xs">
        </section>
        <section id="testimonials" class="col-sm-4">
          <p>"Tools & Techs for implementing this web"</p>
          <p>"HTML , CSS , JavaScript , Bootstrap , MySql , PHP"</p>
        </section>
      </div>
      <div class="text-center">&copy; Copyright Reserved By Learning PHP</div>
    </div>
    </footer>  <!-- footet ends -->

  <!-- jQuery (Bootstrap JS plugins depend on it) -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>>
  <!-- <script src="js/ajax-utils.js"></script>-->
  <script src="js/script.js"></script> 
</body>
</html>
