<?php
require_once 'helpers.php';

   if(isset($_POST['email_validation']) && $_POST['email_validation']==1){
        
        parse_str($_POST['data'], $data);
        $email=sanitize($data['txt-email']);
        $password=sanitize($data['txt-pass']);
        $jsonCheck['status']=1;
        $jsonCheck['errors']=null;
        $error = ['is_email' => null,'is_pwd' => null];
        
        if (empty($email)){   
            $error['is_email']="Enter Email to proceed";
            $jsonCheck['status']=0;
        }
        
        else{
        //    header('content-type: application/json; charset=utf-8');
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['is_email']="Invalid Email Address";
                $jsonCheck['status']=0;
            }
        }

        if( empty($password)){
            $error['is_pwd']="Enter Password to proceed";
        }
        else{
            if(!preg_match("/^([A-Za-z0-9]{5,})$/",$password)){
                $error['is_pwd']="Invalid! ";
                $jsonCheck['status']=0;
            }
        }
        
        
        $jsonCheck['errors']=$error;
        
        echo json_encode($jsonCheck);
   }

   if(isset($_POST['registration-validation']) && $_POST['registration-validation']==1){
   
        parse_str($_POST['data'], $data);
        $name=sanitize($data['txtName']);
        $email=sanitizie($data['txtEmail']);
        $pass=sanitizie($data['txtPass']);
        $cnfrm_pass=sanitizie($data['txt-confirm-pass']);
        $number=sanitizie($data['txt-mobile']);
        $jsonCheck['status']=1;
        $jsonCheck['errors']=null;
        $error = ['name_check' => null,'email_check' => null,
        'pwd_check' => null,'cnfrm_pwd_check' => null , 'number_check'=>null];
        
        //name validation
        if(empty($name)){
            $error['name_check']="Enter Name";
            $jsonCheck['status']=0;
        }
        else{
            if(!preg_match("/^([A-Za-z' ]+)$/",$name)){
                $error['name_check']="Invalid! Name must have alphabets only";
                $jsonCheck['status']=0;
            }
            
        }
        //name validation ends

        //email validation 
        if (empty($email)){   
            $error['email_check']="Enter Email";
            $jsonCheck['status']=0;
        }
        
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email_check']="Invalid Email Address";
                $jsonCheck['status']=0;
            }
        }
        //email validation ends

        //pwd validation
        if( empty($pass)){
            $error['pwd_check']="Enter Password";
            $jsonCheck['status']=0;
        }
        else{
            if(!preg_match("/^([A-Za-z0-9]{5,})$/",$pass)){
                $error['pwd_check']="Password must contains atleast 5 alphanumeric characters";
                $jsonCheck['status']=0;
            }
            
        }
        //pwd validation ends


        //confirm pwd validation
        if( empty($cnfrm_pass)){
            $error['cnfrm_pwd_check']="Enter Confirm Password";
            $jsonCheck['status']=0;
        }
        else{
            if($cnfrm_pass !== $pass){
                $error['cnfrm_pwd_check']="Password not match";
                $jsonCheck['status']=0;
            }
            
        }
        //confirm pwd validation ends

        //phone validation
        if( empty($number)){
            $error['number_check']="Enter Number";
            $jsonCheck['status']=0;
        }
        else{
            if(!preg_match("/^([\d]{11})$/",$number)){
                $error['number_check']="Invalid Phone Number";
                $jsonCheck['status']=0;
            }
            
        }
        //phone validation ends

       
        $jsonCheck['errors']=$error;
        echo json_encode($jsonCheck);

    }
  
    
?>