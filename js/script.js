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
      
      var data=$("#login_form").serialize();
      $.ajax({
            url: 'validation.php',
            type: "POST",
            dataType: "json",
            data : {
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
      var data=$("#registration_form").serialize();
      $.ajax({
            url: 'validation.php',
            type: "POST",
            dataType: "json",
            data : {
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