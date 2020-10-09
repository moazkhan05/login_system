<?php

//---------------------------------------registration function start----------------------------------------------------
session_start();
    // Include config file
    require 'helpers.php';       
   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = sanitize($_POST["txtName"]);
        $email = sanitize($_POST["txtEmail"]);
        $password = sanitize($_POST["txtPass"]);
        $confirm_password = sanitize($_POST["txt-confirm-pass"]);
        $mobile_number =sanitize($_POST["txt-mobile"]);
        $error_flag=1;
       
        // Validate name
        if(empty($name)){  //sanitize this function is present in helpers file 
            mysqli_close($conn);
            $error_flag=0; 
            redirect("error",true, "Name field is empty");
        }
        else if(! validName($name)){
            $error_flag=0;
            mysqli_close($conn);
            redirect("error",true, "Enter Valid Name");
        }

        // Validate email
        if(empty($email)){ 
            $error_flag=0;
            mysqli_close($conn);
            redirect("error",true, "Email Field is empty.");
        } 
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_flag=0;
                mysqli_close($conn);
                redirect("error",true, "Invalid email.");
            }             
                if(email_exist($email,$conn) >=1){
                    $error_flag=0; 
                    mysqli_close($conn);
                    redirect("error",true, "This email is already registered.");
                }
            
            }
        
        
        // Validate password
        if(empty($password)){  
            $error_flag=0; 
            mysqli_close($conn);
            redirect("error",true, "Password Field is empty.");
        } 
        elseif(!validPassword($password)){
            $error_flag=0;
            mysqli_close($conn);
            redirect("error",true, "Password must have atleast 5 characters.");
        }

        // Validate confirm password
        if(empty($confirm_password)){
            $error_flag=0;
            mysqli_close($conn);
            redirect("error",true, "Enter Confirm Password.");
        } else{
            if(empty($password_err) && ($password != $confirm_password)){
                $error_flag=0;
                mysqli_close($conn);
                redirect("error",true, "Password did not match.");
            }
        }

        // Validate mobile number
        if(empty($mobile_number)){
            $error_flag=0;
            mysqli_close($conn);
            redirect("error",true, "Enter your Number.");  
        } 
        else if(!validNumber($mobile_number)){
            $error_flag=0; 
            mysqli_close($conn);
            redirect("error",true, "Enter Valid Number");
        }
        else if(number_exist($mobile_number,$conn) >= 1){
            $error_flag=0;    
            mysqli_close($conn);
            redirect("error",true, "The provided Number have an account already .");
        }
        
        
        // Check input errors before inserting in database
        
        if($error_flag==1){
            // Prepare an insert statement
            $sql = "INSERT INTO tbl_user (name, email, password , phone_number ,account_type, isActive) VALUES (?, ?, ?, ?, ?, ?)";
            //$acc_type='user';
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssi", $param_name,$param_email ,$param_password,$param_mobile_number, $param_acc_type, $is_active) ;
                
                // Set parameters
                $param_name = $name;
                $param_password = $password;
                $param_email = $email;
                $param_mobile_number = $mobile_number;
                $param_acc_type = "user";
                $is_active=1;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    mysqli_close($conn);
                    redirect("success",true, "Successfully Registered!");
                } else{
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        
        }
        // Close connection
        mysqli_close($conn);
}

//---------------------------------------registration function end----------------------------------------------------


?>