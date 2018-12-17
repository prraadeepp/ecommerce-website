<?php 
  if (!isset($_SESSION, $_SESSION['session_id']) || $_SESSION['session_id'] =="" || strlen($_SESSION['session_id']) != 30) {
  	setFlash('warning', 'Please login first.');
  	@header('location: ./');
  	exit();
  }

 ?>