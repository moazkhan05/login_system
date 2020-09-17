
<?php
// Initialize the session
// session_start();
 
// // Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: welcome.php");
//     exit;
// }
 


//---------------------------------------registration function start----------------------------------------------------
function registration(){
        // Include config file
        require 'dbconfig.php';
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //if connection build

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
            
            // Close connection
            mysqli_close($conn);
    }
}
//---------------------------------------registration function end----------------------------------------------------

//***************************************************************************************************************/

//---------------------------------------login function start----------------------------------------------------
function login(){
    session_start();
    //configuring data base
    require 'dbconfig.php';
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //if connection build


    
    // Define variables and initialize with empty values
    $email = $password = "";
    $email_err = $password_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Check if email is empty
        if(empty(trim($_POST["txt-email"]))){
            $_POST['txt-email-error']=$email_err = "Please enter email.";
            
        } else{
            $email = trim($_POST["txt-email"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["txt-pass"]))){
            $password_err = "Please enter your password.";
            
        } else{
            $password = trim($_POST["txt-pass"]);
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
                          
                        }
                    } else{
                        // Display an error message if email doesn't exist
                        $email_err = "No account found with that email.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
    
        // Close connection
        mysqli_close($conn);
    }
}
//---------------------------------------login function end----------------------------------------------------

//***************************************************************************************************************/

//---------------------------------------logout function start----------------------------------------------------

function logout(){
    session_start();
 
    // Unset all of the session variables
    $_SESSION = array();
    
    // Destroy the session.
    session_destroy();
    
    // Redirect to login page
    header("location: auth.php");
    exit;
}

//---------------------------------------welocme function end----------------------------------------------------



?>