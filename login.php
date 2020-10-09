<?php
//---------------------------------------login function start----------------------------------------------------

  
  session_start();
    //configuring data base
    require 'helpers.php';
    //if connection build


    
    // Define variables and initialize with empty values
    $email = sanitize($_POST["txt-email"]);
    $password = sanitize($_POST["txt-pass"]);
    $email_err = $password_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Check if email is empty
        if(empty($email)){
            $email_err = "Please enter email.";
            
        } 
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err="Invalid Email Address";
            }
        }
        
        // Check if password is empty
        if(empty($password)){
            $password_err = "Please enter your password.";   
        }
        
        
        // Validate credentials
        if(empty($email_err) && empty($password_err)){

            // Prepare a select statement
            $sql = "SELECT  id,email, password,account_type FROM tbl_user WHERE email = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Set parameters
                $param_email = $email;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                   
                    mysqli_stmt_store_result($stmt);
                                      
                    // Check if email exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){  
                         
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $email, $pass_check,$acc_type);
                                          
                        if(mysqli_stmt_fetch($stmt)){
        
                           if($password===$pass_check){
                                //if password matches now create session

                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["account"] = $acc_type;                            
                                
                               if($acc_type === 'admin'){
                                header("location: admin-panel.php");
                               }else{
                                header("location: welcome.php");
                               }

                           }
                           else{
                            $_SESSION["error-status"]=true;
                            $_SESSION["error"]="Incorrect Password";
                           // $password_err="Incorrect Password";
                            mysqli_close($conn);
                            header("location: login-signup.php");
                           }
                          
                        }
                    } else{
                        // Display an error message if email doesn't exist

                        $_SESSION["error-status"]=true;
                        $_SESSION["error"]="No account found with that email.";
                        //$email_err = "No account found with that email.";
                        mysqli_close($conn);
                        header("location: login-signup.php");
                    }
                } 
                else{
                    $_SESSION["error-status"]=true;
                    $_SESSION["error"]="Error 500! Something went wrong. Please try again later.";
                   
                    mysqli_close($conn);
                    header("location: login-signup.php");
                }

                
            }
        }

    }
    
//---------------------------------------login function end----------------------------------------------------
?>