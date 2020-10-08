<?php



//------------page load------------------------------
require 'helpers.php'; 
session_start();



if(isset($_POST['btn-log-out'])){
    logout();
}
//authorization granted

// Check if the user is already logged in, if yes then redirect him to welcome page
if(auth_is_logged_in()===false){ // auth_is_logged_in() from authentication.php
  error401();
}


// Check if the user is already logged in, if yes then redirect him to welcome page
    
    $id=$_SESSION["id"];
    // Prepare a select statement
    $sql = "SELECT  id,name,email, phone_number FROM tbl_user WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_id);
        
        // Set parameters
        $param_id = $id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);   
            // Check if id exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){  
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $id,$name, $email, $mobile_number);
                //print_r ($stmt);                  
                mysqli_stmt_fetch($stmt);
            } 
            else{
                  // Display an error message if id doesn't exist
                  $id_err = "No account found with that email.";
            }
        } 
        else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }    
    
//------------page load end------------------------------

// Close connection
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Portal</title>
        <script> session_start();
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      die("You are not allowed to perform these funcions");
      
    } </script>   
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/styles.css">
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

    <div id="main-content" class="container-fluid">

            <h2 class="text-center">Welcome</h2>
            
            <!-- holding user personal data -->
            <form action="" method="post">
              <div class="information-container">
                  <div class = "row">
                      <label class=" col-md-4 col-sm-4 col-xs-3" >Name</label>
                      <hr class="visible-xs">
                      <label class=" col-md-8 col-sm-8 col-xs-9" name="txt-email" ><?php echo htmlspecialchars($name) ?></lable>
                  </div>    
                  <div class = "row">
                      <label class=" col-md-4 col-sm-4 col-xs-3">Email</label>
                      <hr class="visible-xs">
                      <label class=" col-md-8 col-sm-8 col-xs-9" name="txt-email" ><?php echo htmlspecialchars($email) ?></lable>
                  </div>    
                  <div class = "row">
                      <label class=" col-md-4 col-sm-4 col-xs-3">Phone Number</label>
                      <hr class="visible-xs">
                      <label class=" col-md-8 col-sm-8 col-xs-9" name="txt-email" ><?php echo htmlspecialchars($mobile_number) ?></lable>
                  </div>    
                  <div class = "row">
                      <label class=" col-md-4 col-sm-4 col-xs-12"><a href="edit-user-details.php?edit-details=<?php echo $id; ?>" class="edit_btn" name="btn-edit">Edit</a></label>
                      
                  </div>
              </div>
            </form>
                

             
            <div id="log-out" >
                <form action="" method="post">
                  <button type="submit" class="btn btn-link" name="btn-log-out">Log Out</button>
                </form>
            </div> 
    </div>

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
  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="js/ajax-utils.js"></script>-->
  <script src="js/script.js"></script> 
</body>
</html>



