<?php 
 session_start();
 session_destroy();
 if (isset($_COOKIE, $_COOKIE['user_8'])) {
 	setcookie('user_8', '', time()-60);
 }

 @header('location: ./');
 ?>