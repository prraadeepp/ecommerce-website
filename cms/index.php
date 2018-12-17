
    <?php
     require 'inc/header.php';
     getFlash();
     /*session check, session_id,
  cookie user_8, set, null, data=>db exists, exists=> user info similar to session login*/
      if(isset($_SESSION, $_SESSION['session_id']) && $_SESSION['session_id'] != "" && strlen($_SESSION['session_id']) == 30){
    setFlash('info', 'You are already logged in.');
    @header('location: dashboard');
    exit;
  } 
     ?>
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="process/login.php" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div class="pull-left">
                <input type="checkbox" name="remember_me" value="1">Remember Me
              </div>
              <div>
                <button class="btn btn-default submit" class="alert alert-success">Log in</button>
                
              </div>

            </form>
          </section>
        </div>
</div>
       
         
    </div>
 <?php include 'inc/footer.php';?>
