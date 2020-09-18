<?php

require 'actions.php';


//-----------------Login In Click-----------------
if(isset($_POST['btn-login'])){
    login();
}

//-----------------Registration Click-----------------
if(isset($_POST['btn-register'])){
  registration();
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

    <div class="loginContainer row " >
                <div class="card-header col-md-4 col-sm-12 col-xs-12">
						
							<div class="col-xs-6">
								<a href="#login_form" class="active" id="login-form-link"><h3>Login</h3></a>
							</div>
							<div class="col-xs-6 active">
								<a href="#registration_form" id="register-form-link" ><h3>Register</h3></a>
							</div>
						
						
				</div>
                 
           
                <!-- login in form -->
                <form id="login_form" class="col-md-8 col-sm-12 col-xs-12" method="post" action="">
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control " 
                              id="exampleInputEmail1" 
                              placeholder="Enter email"
                              name="txt-email">
                      <span name="txt-email-error"><?php echo ($email_err); ?></span>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" 
                            class="form-control" 
                            id="exampleInputPassword1" 
                            name="txt-pass" 
                            placeholder="Password">
                            <small id="emailHelp" class="form-text text-muted ">We'll never share your password with anyone else.</small>     
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="btn-login">Login</button>
                    <div class="col-lg-12">
					    <div class="text-center">
								<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
						</div>
					</div>
                </form>
                <!-- registration form -->
                <form  id="registration_form"class="col-md-8 col-sm-12 col-xs-12" style="display:none;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                
                    <div class="form-group ">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="name" class="form-control " 
                            id="txt-name-register" 
                            placeholder="Enter Name"
                            name="txtName">
                    
                    </div>

                    <div class="form-group ">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control " 
                            id="txt-email-register" 
                            placeholder="abc@xyz.com"
                            name="txtEmail">
                            <small id="emailHelp" class="form-text text-muted ">We'll send a code to your Email for verification.</small>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" 
                            class="form-control" 
                            id="txt-pass-register" 
                            name="txtPass"
                            placeholder="Password">
                            
                    </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" 
                            class="form-control" 
                            id="txt-confirm-pass-register" 
                            name="txt-confirm-pass"
                            placeholder="Confirm Password">
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
                            <small id="numberlHelp" class="form-text text-muted ">Please provide valid number.</small>     
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="btn-register">Register</button>
                    <div class="col-lg-12">
					    <div class="text-center">
								<span>Already have Account?</span><a href="index.php" tabindex="5" class="forgot-password">Login In Here</a>
						</div>
					</div>
                </form>
            
        
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
  <script>
    //   funtion to switch forms start
            $(function() {

            $('#login-form-link').click(function(e) {
                $("#login_form").delay(100).fadeIn(100);
                $("#registration_form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
                $("#registration_form").delay(100).fadeIn(100);
                $("#login_form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            });
    //   funtion to switch forms end        
</script>


</body>
</html>