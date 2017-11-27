<?php 
	require_once 'core/init.php';
	unset($_SESSION['usercs']);
	header('Location:login.php');
	
?>