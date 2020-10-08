<?php

session_start();
require 'helpers.php';
//require 'actions.php';
//require 'dbconfig.php';

//--------------Authentication-------------------------------
// Check if the user is already logged in, if yes then redirect him to welcome page
if(auth_is_logged_in()===true){
    if(auth_is_admin()===false){
        error403();
    }
}
else{
    error401();
}
//--------------Ends Authentication------------------------------- 

//------------page load------------------------------

  $admin_id=$_SESSION["id"];
  $param_account='user';
  // Prepare a select statement
  $sql = "SELECT id,name,email, phone_number, isActive FROM tbl_user WHERE account_type = '$param_account'";

  $rows=$conn->query($sql);
  $row= mysqli_fetch_all($rows);
  foreach ($row as $r ) {
    $id=($r[0]);
  }
          
//------------page load end------------------------------


//-----------Logging out-------------
if(isset($_POST['btn-log-out'])){
    echo "I'm here in btn-login";
    logout();
}
//-----------END Logging out-------------


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
        <link rel="stylesheet" href="./css/styles.css">
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

    <div id="main-content" class="container-fluid">
        <div class="row"><!-- row to distinguish side panel and center container start -->
        <div class="col-md-3 col-sm-3 col-xs-3 left-col" id="side-panel"> <!-- side panel start -->
            <h5>Admin</h5>

        </div> <!-- side panel end -->
        
        <!-- center table start -->
        <div class="right-col "> 
          <form action="" method="post" >

            <h2 class="text-center">User</h2>
              <table class="table" >
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Activate/Deactivate</th>
                    <th>Edit</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($row as $r ): ?>
                    <tr>
                      
                      <td name ="text-name">
                        <?php echo htmlspecialchars($r[1]) ?>
                      </td>
                      <td name ="text-email">
                        <?php echo htmlspecialchars($r[2]) ?>
                      </td>
                      <td name ="text-number">
                       <?php echo htmlspecialchars($r[3]) ?>
                      </td>
                      <td name ="text-status" style="text-align: center;">
                            <a href="deleteUser.php?del=<?php echo $r['0'];?>&status=<?php echo $r['4']?>" class="del-btn" >
                                <?php echo htmlspecialchars($r[4]) ?>
                            </a>
                      </td>
                      <td>
                            <a href="edit-user-details.php?edit-details=<?php echo $r['0']; ?>" class="edit_btn" name="btn-edit" style="color:green;">
                                Edit
                            </a>
                      </td>
                      
                      
                    </tr>
                  <?php endforeach; ?>
                    
                  </tbody>        
                </table>    
              
          </form>
        </div>    
        <!-- center table end -->
        </div> <!-- row to distinguish side panel and center container start -->   
        <div id="log-out" >
            <form action="" method="post">
              <button type="submit" class="btn btn-link" name="btn-log-out">Log Out</button>
            </form>
        </div> 
     </div> <!--main-content-container end -->

    <!-- main content  End   -->
        
    <footer class="panel-footer"> <!-- footet starts -->
    <div class="container"> 
      <div class="row">
        <section id="detail-user" class="col-sm-4">
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

