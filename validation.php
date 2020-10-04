<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// print_r($_POST); die;
   if(isset($_POST['email_validation']) && $_POST['email_validation']==1){
    $jsonCheck = new \Exception();                                            // remove this excwption object. I wrote this just for example. No need to hve object in his scenario, use $_POST array.
        $email=$_POST['email'];
        $password=$_POST['password'];
        $jsonCheck->status=0;
        $jsonCheck->errors=null;
        $error = ['is_email' => null,'is_pwd' => null];
        
        /*
        Loop through $_POST and remove redundant duplicated code.
        */
        if (empty($email)){   
            $error['is_email']="Enter Email to proceed";
        }
        
        else{
        //    header('content-type: application/json; charset=utf-8');
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['is_email']="Invalid Email Address";
            }
        }

        if( empty($password)){
            $error['is_pwd']="Enter Password to proceed";
        }
        else{
            if(!preg_match("/^([A-Za-z0-9]{5,})$/",$password)){
                $error['is_pwd']="Invalid! ";
            }
        }
        
        if(($error['is_email'] === null) && ($error['is_pwd'] === null)){
            $jsonCheck->status=1;
        }
        $jsonCheck->errors=$error;
        echo json_encode($jsonCheck);
   }

   if(isset($_POST['registration-validation']) && $_POST['registration-validation']==1){
    $jsonCheck = new \Exception();
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $cnfrm_pass=$_POST['confirm-password'];
        $number=$_POST['phone-number'];
        $jsonCheck->status=0;
        $jsonCheck->errors=null;
        $error = ['name_check' => null,'email_check' => null,
        'pwd_check' => null,'cnfrm_pwd_check' => null , 'number_check'=>null];
        
        //name validation
        if(empty($name)){
            $error['name_check']="Enter Name";
        }
        else{
            if(!preg_match("/^([A-Za-z' ]+)$/",$name)){
                $error['name_check']="Invalid! Name must have alphabets only";
            }
            
        }
        //name validation ends

        //email validation 
        if (empty($email)){   
            $error['email_check']="Enter Email";
        }
        
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email_check']="Invalid Email Address";
            }
        }
        //email validation ends

        //pwd validation
        if( empty($pass)){
            $error['pwd_check']="Enter Password";
        }
        else{
            if(!preg_match("/^([A-Za-z0-9]{5,})$/",$pass)){
                $error['pwd_check']="Password must contains atleast 5 alphanumeric characters";
            }
            
        }
        //pwd validation ends


        //confirm pwd validation
        if( empty($cnfrm_pass)){
            $error['cnfrm_pwd_check']="Enter Confirm Password";
        }
        else{
            if($cnfrm_pass !== $pass){
                $error['cnfrm_pwd_check']="Password not match";
            }
            
        }
        //confirm pwd validation ends

        //phone validation
        if( empty($number)){
            $error['number_check']="Enter Number";
        }
        else{
            if(!preg_match("/^([\d]{11})$/",$number)){
                $error['number_check']="Invalid Phone Number";
            }
            
        }
        //phone validation ends
// no need to write such a big condition if you iterate on $_POST in a loop
        if(($error['name_check'] === null) && ($error['pwd_check'] === null)
            && ($error['email_check'] === null) && ($error['cnfrm_pwd_check'] === null)
            && ($error['number_check'] === null)
        ){
            $jsonCheck->status=1;
        }
        $jsonCheck->errors=$error;
        echo json_encode($jsonCheck);

    }
  
    
?>