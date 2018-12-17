<?php 
require '../config/config.php';
require '../config/function.php';

//debugger($_GET['act'],true);
 ?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href="css/fonts_googleapis.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type='text/css' href="css/normalize.min.css">

  <link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS;?>bootstrap.min.css" >
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <h2 align="center"><a href="../" style="text-decoration-line: none;">OnlineShop.com</a></h2>
  <div class="form" >

   
      <h2 id="heading" style="color: red;">If already have an account you can Login.</h2>
      <span  style="color: red;" class="msg"><?php getFlash(); ?></span>
      <ul class="tab-group">
        <li class="tab active"><a onclick="add_heading();"  href="#signup">Sign Up</a></li>
        <li class="tab "><a onclick="remove_heading();"  href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
        <form action="../login_register.php?act=register" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input name="first_name" type="text" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input name="last_name" type="text"required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="email_address" type="email"required autocomplete="off"/>
          </div>
          
           <div class="field-wrap">
           
               <select name="gender" style="width:100%; color: black;"  name="Country">
                <option  value="" selected disabled>-- Select Your Gender--</option>
      <option  value="M">Male</option>
      <option  value="F">Female</option>
     
    </select>

          </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input id="password" name="password" type="password" required autocomplete="off"/>
          </div>
          
          <button id="submit" type="submit" class="button button-block">Create Account</button>
          
        </form>
          
        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="../login_register.php?act=login" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="e_address" type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input name="p_word" type="password"required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- 'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js' -->
  <script src='http://localhost/ecommerce/form/js/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>
<script type="text/javascript">
  setTimeout(function(){
    $('.alert').slideUp('slow');
    }, 5000);
  function remove_heading(){
    $('#heading').html('If no account please Signup first.');
    //$('#heading').addClass('hidden');
  }
  function add_heading(){
    $('#heading').html('If already have an account you can Login.');
  }
/*
   $('#submit').click(function(e){
        e.preventDefault();
        // $('.msg').html('');
        // $('.msg').addClass('hidden');
        
        var first_name = $('#f_name').val();
        var last_name = $('#l_name').val();
        var email = $('#email_address').val();
        var password = $('$password').val();
       
         
        $.post('inc/api.php', {first_name:first_name, last_name: last_name, email: email, password:password, act: 'register'}, function(res){
          //alert(res);
          if (res > 0) {
            $('.msg').html('Thank You for your enquiry.You will get response soon.');
          }else{
            $('.msg').html('Sorry! There was problem while redirecting your enquiry.');
          }
          
           $('#f_name').val('');
         $('#l_name').val('');
        $('#email_address').val('');
        $('#password').val('');
        $('.msg').removeClass('hidden');
        
        });
      
      setTimeout(function(){
        $('.msg').slideUp('slow');
        $('.msg').html('');
        $('.msg').addClass('hidden');
      },4000);
     });
*/
</script>



</body>

</html>
