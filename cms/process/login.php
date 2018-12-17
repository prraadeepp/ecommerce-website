<?php 
require '../../config/config.php';
require '../../config/function.php';
require '../../class/database.php';
require '../../class/user.php';
//debugger($_POST,true);

$user= new User();
if(isset($_POST) && !empty($_POST)){
	$username = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	
	if(!$username){
		setFlash('warning', 'Invalid Username');
		@header('location: ../');
		exit();
	}
	//$username= $_POST['username'];
	//echo $username;
	//exit();
	$user_info= $user->getUserByUsername($username);
//debugger($user_info,true);

	$enc_password=sha1($username.$_POST['password']);
	if ($user_info) {
		if ($user_info[0]->password == $enc_password) {
			if ($user_info[0]->status==1) {
				setFlash('success','Welcome to Admin Pannel.');
				$_SESSION['user_id']=$user_info[0]->id;
				$_SESSION['name']=$user_info[0]->full_name;
				$_SESSION['role_id']=$user_info[0]->role_id;
				$token= generateRandomString(30);
				$_SESSION['session_id']= $token;
				if (isset($_POST['remember_me']) && $_POST['remember_me']==1) {
					setcookie('user_8',$token,(time()+(86400*365)));
				}
				@header('location: ../dashboard.php');
				exit();
			}else {
					setFlash('warning','User not activated or disabled by administrator. Please contact our admin.');
					@header('location: ../');
					exit;
		}
	}else{
			setFlash('warning','Password does not match.');
			@header('location: ../');
					exit;	
		}
	}else{
		setFlash('error','User not Found.');
		@header('location: ../');
		exit();
	}
}else{
	setFlash('error','Unauthorised Access.');
	@header('location: ../');

}





 ?>