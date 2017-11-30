<?php
include '../core/init.php';
if(!is_logged_in()){
	header('location:login.php');
}
if(!is_admin()){
	not_admin();
}
include './includes/head.php';
include './includes/navigation.php';
?>

<h2 class="text-center">ADMIN</h2>





<?php 
include './includes/footer.php';
?>