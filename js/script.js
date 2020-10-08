//   funtion to switch forms start
$(function() {

    $('#login-form-link').click(function(e) {
        $('#error-alert').fadeOut(100);
        $("#login_form").delay(100).fadeIn(100);
        $("#registration_form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $('#error-alert').fadeOut(100);
        $("#registration_form").delay(100).fadeIn(100);
        $("#login_form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    });
//   function to switch forms end      

  //login  button validation   
  $(document).ready(function (){
    $("#login-btn").click(function(){
      // var email=$("#input-email").val();
      // var pwd =$('#input-pwd').val();
      var data=$("#login_form").serialize();
      $.ajax({
            url: 'validation.php',
            type: "POST",
            dataType: "json",
            data : {
              // "email" : email,
              // "password":pwd,
              "data":data,
              "email_validation" : "1"
            },
            success:function(data) {
                console.log(data.errors);

                $.each( data.errors, function( i, val ) {
                  $( "#" + i ).text( val );
                });
                
                
                if(data.status == 1){
                  $('#login_form').submit();  
                }
            
              },
              error : function(){
                alert("Request Failed");
              }
           });
      });
   });

   //registration 
   $(document).ready(function (){
    $("#register-btn").click(function(){
      // var name=$("#txt-name-register").val();
      // var email=$("#txt-email-register").val();
      // var pwd =$('#txt-pass-register').val();
      // var cnfrm_pwd =$('#txt-confirm-pass-register').val();
      // var number =$('#txt-phone-register').val();
      var data=$("#registration_form").serialize();
      //alert(email);
      $.ajax({
            url: 'validation.php',
            type: "POST",
            dataType: "json",
            data : {
              // "name" : name,
              // "email" : email,
              // "password" : pwd,
              // "confirm-password" : cnfrm_pwd,
              // "phone-number" : number,
              "data":data,
              "registration-validation" : "1"
            },
            success:function(data) {
              console.log(data.errors);
                console.log(data.status);

                $.each( data.errors, function( i, val ) {
                  $( "#" + i ).text( val );
                });
                if(data.status == 1){
                  $('#registration_form').submit();  
                }
               
              },
              error : function(){
                alert("Request Failed");
              }
           });
      });
   });