<?php
include 'core/init.php';
if(isset($_SESSION['usercs'])){
	unset($_SESSION['usercs']);
}
include 'includes/head.php';
include 'includes/navigation.php';


$errors = array();
$email = (isset($_POST['email'])? sanitize($_POST['email']) : '');
$password = (isset($_POST['password'])? sanitize($_POST['password']) : '');


if($_POST){
	if(empty(trim($password))){
		$errors[] = 'Put in your Email and Password.';
	}else{
		$uSQL = $db->query("SELECT id,email,password FROM users WHERE email = '$email'");
		$count = mysqli_num_rows($uSQL);
		if($count < 1){
			$errors[] = 'Email or Password is not correct.';
		}else{
			$user = mysqli_fetch_assoc($uSQL);
			if(!password_verify($password,$user['password'])){
				$errors[] = 'Email or Password is not correct.';
			}
		}
	}
	if(!empty($errors)){
		echo display_errors($errors);
	}else{
		$userID = $user['id'];
		login($userID);
	}
}

?>
<div class="container">
	<section class="form-simple form">
		<div class="card">
			<div class="header pt-3 grey lighten-2">
			
				<div class="row">
					<h3 class="deep-grey-text mt-3 mb-4 pb-1 mx-5">Log in</h3>
				</div>

			</div>
			<div class="login-form">
				<form method="post" id="create">
					<div class="md-form">
						<input type="text" id="Form-email4" class="form-control" name="email" value="<?=$email?>">
						<label for="Form-email4">Your email</label>
					</div>

					<div class="md-form pb-3">
						<input type="password" id="Form-pass4" class="form-control" name="password" value="<?=$password?>">
						<label for="Form-pass4">Your password</label>
						<p class="font-small grey-text text-right">Forgot <a href="#" class="dark-grey-text font-bold ml-1"> Password?</a></p>
					</div>
					<div class="text-center mb-4">
						<button type="submit" class="btn btn-danger btn-block z-depth-2">Log in</button>
					</div>
					<p class="font-small grey-text text-center pt-5">Don't have an account? <a href="create.php" class="dark-grey-text font-bold ml-1"> Sign up</a></p>
				</form>
			</div>
		</div>
	</section>
</div>
<?php 	include 'includes/footer.php' ?>

