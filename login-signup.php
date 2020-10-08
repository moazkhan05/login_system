<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Portal</title>
       
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" >
        <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
        <link type="text/css" rel="stylesheet" href="./css/styles.css">
        <script src="js/jquery-3.5.1.js"></script>
    </head>
    <body >
      
<?php



session_start();

// Close connection
?>
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

    <div class="loginContainer row " >
          <!-- login-signup tabs links -->
          <div class="card-header col-md-4 col-sm-12 col-xs-12">
						
							<div class="col-xs-6">
								<a href="#login_form" class="active" id="login-form-link"><h3>Login</h3></a>
							</div>
							<div class="col-xs-6 active">
								<a href="#registration_form" id="register-form-link" ><h3>Register</h3></a>
							</div>
						
						
				  </div>

          <!-- forms        -->
          <div class="col-md-8 col-sm-12 col-xs-12">
                 <!-- login in form -->

                <?php if(isset($_SESSION['error-status']) && $_SESSION['error-status']==true ){?>
                  <div id="error-alert" class="alert alert-danger alert-dismissible" style="display:block;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?php echo htmlspecialchars($_SESSION['error']) ?> </strong>
                  </div>
                <?php }?>
                  
                    
                <form id="login_form" method="post" action="login.php">
                    
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control " 
                              id="input-email" 
                              placeholder="Enter email"
                              name="txt-email"
                              >
                      <span class="form-error">
                            <p id="is_email"></p>
                      </span>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" 
                            class="form-control" 
                            id="input-pwd" 
                            name="txt-pass" 
                            placeholder="Password">
                            <small id="pwd-msg" class="form-text text-muted ">We'll never share your password with anyone else.</small>     
                        <span class="form-error">
                          <p id="is_pwd"></p>
                        </span>
                    </div>
                    
                    <button   class="btn btn-primary" 
                              style="width: 100%;" 
                              name="btn-login" 
                              id="login-btn" 
                              type="button"
                              >Login
                    </button>
                    
                    <div class="col-lg-12">
                        <div class="text-center">
                          <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                         </div>
					          </div>
                </form>
                <!-- registration form -->
                <form  id="registration_form" style="display:none;" method="post" action="signup.php">
                
                    <div class="form-group ">
                     <label for="exampleInputEmail1">Name</label>
                      <input type="name" class="form-control " 
                              id="txt-name-register" 
                              
                              placeholder="Enter Name"
                              name="txtName">
                              <span class="form-error">
                                <p id="name_check"></p></span>
                    </div>

                    <div class="form-group ">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control " 
                              id="txt-email-register" 
                              placeholder="abc@xyz.com"
                              name="txtEmail">
                              <span class="form-error">
                                <p id="email_check"></p></span>
                              <small id="emailHelp" class="form-text text-muted ">We'll send a code to your Email for verification.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" 
                              class="form-control" 
                              id="txt-pass-register" 
                              name="txtPass"
                              placeholder="Password">
                              <span class="form-error">
                                <p id="pwd_check"></p></span>
                            
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" 
                              class="form-control" 
                              id="txt-confirm-pass-register" 
                              name="txt-confirm-pass"
                              placeholder="Confirm Password">
                              
                              <span class="form-error">
                                <p id="cnfrm_pwd_check"></p></span>
                              
                              <small id="passHelp" class="form-text text-muted ">Please make sure your password match.</small>     
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Mobile Number</label>
                      <input type="text"
                              maxlength="11" 
                              class="form-control" 
                              id="txt-phone-register" 
                              name="txt-mobile"
                              placeholder="03001234567">
                              
                              <span class="form-error">
                                <p id="number_check"></p></span>
                              
                              <small id="numberlHelp" class="form-text text-muted ">Please provide valid number.</small>     
                    </div>
                    
                    <button class="btn btn-primary" 
                            style="width: 100%;" 
                            name="btn-register" 
                            id="register-btn"
                            type="button"
                            >Register</button>
                    <div class="col-lg-12">
                        <div class="text-center">
                          <span>Already have Account?</span><a href="index.php" tabindex="5" class="forgot-password">Login In Here</a>
                        </div>
                    </div>
                </form>

          </div> 
          <!-- forms end      -->
            
        
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
  
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ajax-utils.js"></script>
  <script src="./js/script.js"></script> 
  
   
</body>
</html>