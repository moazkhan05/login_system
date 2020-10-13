<?php
//---------------------------------------login function start----------------------------------------------------

  
  session_start();
    //configuring data base
    require 'helpers.php';
    //if connection build


    
    // Define variables and initialize with empty values
    $email = sanitize($_POST["txt-email"]);
    $password = sanitize($_POST["txt-pass"]);
    $error_flag=1;
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Check if email is empty
        if(empty($email)){
            mysqli_close($conn);
            $error_flag=0; 
            redirect("error",true, "Please enter email.");
            
        } 
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                mysqli_close($conn);
                $error_flag=0; 
                redirect("error",true, "Invalid Email Address");
            }
        }
        
        // Check if password is empty
        if(empty($password)){
            mysqli_close($conn);
            $error_flag=0; 
            redirect("error",true, "Please enter your password.");   
        }
        
        
        // Validate credentials
        if($error_flag==1){

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
                            mysqli_close($conn);
                            redirect("error",true, "Incorrect Password");
                           }
                          
                        }
                    } else{
                        // Display an error message if email doesn't exist             
                        mysqli_close($conn);
                        redirect("error",true, "No account found with that email.");
                    }
                } 
                else{
                    mysqli_close($conn);
                    redirect("error",true, "Error 500! Something went wrong. Please try again later.");
                }

                
            }
        }

    }
    
//---------------------------------------login function end----------------------------------------------------
?>