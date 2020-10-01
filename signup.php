<?php

//---------------------------------------registration function start----------------------------------------------------
session_start();
    // Include config file
    require 'dbconfig.php';       
    //connection build

    // Define variables and initialize with empty values
    $name = $email = $password = $confirm_password = $mobile_number ="";
    $name_err = $email_err = $password_err = $confirm_password_err = $mobile_number_err ="";
    
    

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Validate name
        if(empty(trim($_POST["txtName"]))){
            $name_err = "Please enter a name.";
        } else{
            //name could be same email should be unique
            $name = trim($_POST["txtName"]);
        }

        // Validate email
        if(empty(trim($_POST["txtEmail"]))){
            $email_err = "Please enter a email.";
        } else{
            
            // Prepare a select statement
            $sql = "SELECT id FROM tbl_user WHERE email = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Set parameters
                $param_email = trim($_POST["txtEmail"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                            
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email_err = "This email is already registered .";
                    } else{
                        $email = trim($_POST["txtEmail"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Validate password
        if(empty(trim($_POST["txtPass"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["txtPass"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["txtPass"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["txt-confirm-pass"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["txt-confirm-pass"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        // Validate mobile number
        if(empty(trim($_POST["txt-mobile"]))){
            $mobile_number_err = "Please enter your number.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM tbl_user WHERE phone_number = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_mobile_number);
                
                // Set parameters
                $param_mobile_number = trim($_POST["txt-mobile"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $mobile_number_err = "The provided have an account already .";
                    } else{
                        
                        $mobile_number = trim($_POST["txt-mobile"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Check input errors before inserting in database
        if(empty($name_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($mobile_number_err) ){
        
            // Prepare an insert statement
            $sql = "INSERT INTO tbl_user (name, email, password , phone_number ,account_type) VALUES (?, ?, ?, ?, ?)";
            //$acc_type='user';
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $param_name,$param_email ,$param_password,$param_mobile_number, $param_acc_type);
                
                // Set parameters
                $param_name = $name;
                $param_password = $password;
                $param_email = $email;
                $param_mobile_number = $mobile_number;
                $param_acc_type = "user";
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page

                    header("location: index.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        else{
            $_POST["txt-email-error"]=$email_err;
        }
        
        // Close connection
        mysqli_close($conn);
}

//---------------------------------------registration function end----------------------------------------------------


?>