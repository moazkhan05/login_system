<?php

require_once 'dbconfig.php';
require_once 'authentication.php';
//function to check and die
    function dd($var){
        print_r($var);
        die;
    }

    function dump($var, $return = false){
        return print_r($var, $return);
    }
//function to check and die end

//filter function
    function sanitize($var){
    return trim(htmlentities($var));
    }
//filter function end 

//----------logout function
    function logout(){
        session_start();
    
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();
        
        // Redirect to login page
        header("location: login-signup.php");
        exit;
    }
//----------Logout  function end

//----------Name validation function 
    function validName($var){
    return preg_match("/^([A-Za-z' ]+)$/",$var);
    }
//----------Name function end

//----------Password Validation function
    function validPassword($var){
        return preg_match("/^([A-Za-z0-9]{5,})$/",$var);
    }
//----------Password Validation function end

//----------Number Validation function 
    function validNumber($var){
        return preg_match("/^([\d]{11})$/",$var);
    }
//----------Number Validation function end

//----------Email  Existing function 
    function email_exist($var,$conn){
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_user WHERE email = ?";
                
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $var;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                return mysqli_stmt_num_rows($stmt);            
            }
            else {
                mysqli_close($conn);
                error("statment failed");
            }
        }
        else{
            mysqli_close($conn);
            error("Conncetion lost");
        }
    }
//----------Email  Existing function end

//----------Number  Existing function 
    function number_exist($var,$conn){
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_user WHERE phone_number = ?";
                
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobile_number);          
            // Set parameters
            $param_mobile_number = $var;          
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                return mysqli_stmt_num_rows($stmt);            
            }
            else {
                mysqli_close($conn);
                error("statment failed");
            }
        }
        else{
            mysqli_close($conn);
            error("Conncetion lost");
        }
    }
//----------Number  Existing function end

//---------redirecting function
    function redirect($var,$status, $msg){
        if($var == "error"){
                $_SESSION["error-status"]=$status;
                $_SESSION["error"]=$msg;
                header("location: login-signup.php");
            }
        else if($var=="success"){
                $_SESSION["success-status"]=$status;
                $_SESSION["success"]=$msg;
                header("location: index.php");
        }
    }
//------redirecting funciton end
?> 