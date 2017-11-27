<?php
include 'core/init.php';
if(!is_logged_in()){
	header('location:login.php');
}else{
	include 'includes/head.php';
	include 'includes/navigation.php';

	?>

	<div class="container">
		<?php echo $_SESSION['usercs'];


		?>
		<div class="row mt-5">
			<?php 
			include 'includes/sidebar.php';
			include 'includes/products.php';
			?>
		</div>
	</div>
	<?php 
	include 'includes/footer.php';
}
?>


