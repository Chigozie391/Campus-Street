<?php
include 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
?>

<?php

	if($_POST){
		$name = sanitize($_POST['name']);
		$email = sanitize($_POST['email']);
		$phone = sanitize($_POST['phone']);
		$campus = sanitize($_POST['campus']);
		$password = sanitize($_POST['password']);


	}


 ?>




<div class="container">	
	<h2 class="text-center h2-responsive">WELCOME TO CAMPUS STREET</h2>
	<h3 class="text-center h3-resposive">Create Account</h3>
	<div class="create-form">
		<form class="form" method="post" action="index.php" >
			<div class="md-form">
				<i class="fa fa-user prefix grey-text"></i>
				<input type="text" id="form1" class="form-control" name="full_name">
				<label for="form1">Full Name</label>
			</div>

			<div class="md-form">
				<i class="fa fa-envelope prefix grey-text"></i>
				<input type="text" id="form2" class="form-control" name="email">
				<label for="form2">Email</label>
			</div>

			<div class="md-form">
				<i class="fa fa-envelope prefix grey-text"></i>
				<input type="text" id="form3" class="form-control" name="phone">
				<label for="form3">Phone Number</label>
			</div>

			<div class="md-form">
				<i class="fa fa-envelope prefix grey-text"></i>
				<select name="campus" class="form-control">
					<option value="" disabled selected>Choose Size</option>
					<option value="main">Main Campus</option>
				</select>
			</div>

			<div class="md-form">
				<i class="fa fa-tag prefix grey-text"></i>
				<input type="password" id="form5" class="form-control" name="password">
				<label for="form5">Password</label>
			</div>

			<div class="md-form">
				<i class="fa fa-tag prefix grey-text"></i>
				<input type="password" id="form6" class="form-control" name="confpass">
				<label for="form6">Confirm Password</label>
			</div>

			<div class="text-center">
				<button  type="submit" class="btn btn-unique" value="submit"> Create Account <i class="fa fa-paper-plane-o ml-1"></i></button>
			</div>
		</form>

	</div>
</div>
<script>

	
</script>
<?php 	include 'includes/footer.php' ?>

