<?php
include 'core/init.php';
if(!is_logged_in()){
	header('location:login.php');
}else{
	include 'includes/head.php';
	include 'includes/navigation.php';
	$errors = [];
	$oldpass = (isset($_POST['oldpass'])? sanitize($_POST['oldpass']): '');
	$password = (isset($_POST['password'])? sanitize($_POST['password']): '');
	$confpass = (isset($_POST['confpass'])? sanitize($_POST['confpass']): '');
	

	if($_POST){
		if(empty(trim($oldpass)) || empty(trim($oldpass)) || empty(trim($oldpass))){
			$errors[] = 'Please fill out all the fields.';
		}
		if(empty($errors)){
			$p_query = $db->query("SELECT password FROM users WHERE id = '$userID'");
			$p_result = mysqli_fetch_assoc($p_query);
			
			if(!password_verify($oldpass,$p_result['password'])){
				$errors[] = 'Your old password is incorrect.';
			}else if(strlen($password) < 6){
				$errors[] = 'Password must be atleast 6 characters.';
			}else if($password != $confpass){
				$errors[] = 'Your new password does not match.';
			}
		}

		if(!empty($errors)){
			echo display_errors($errors);
		}else{
			$hashed = password_hash($password,PASSWORD_DEFAULT);
			$u_query = $db->query("UPDATE users SET password = '$hashed' WHERE id = '$userID'");
			header('location:index.php');
		}

	}


	?>

	<div class="container">
		<section class="form-simple form">
			<div class="card">
				<div class="header pt-3 grey lighten-2">
					<div class="row">
						<h3 class="deep-grey-text mt-3 mb-4 pb-1 mx-5">Change Password</h3>
					</div>
				</div>
				<div class="login-form">
					<form method="post" id="create">
						<div class="md-form pb-3">
							<input type="password" id="Form-pass3" class="form-control" name="oldpass" value="<?=$oldpass?>">
							<label for="Form-pass3">Old password</label>
						</div>
						<div class="md-form pb-3">
							<input type="password" id="Form-pass4" class="form-control" name="password" value="<?=$password?>">
							<label for="Form-pass4">New password</label>
						</div>
						<div class="md-form pb-3">
							<input type="password" id="Form-pass5" class="form-control" name="confpass" value="<?=$confpass?>">
							<label for="Form-pass5">Confirm password</label>
						</div>
						<div class="text-center mb-4">
							<button type="submit" class="btn btn-success z-depth-2"> Change</button>
							<a href="index.php" class="btn btn-danger z-depth-2">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>

	<?php
}
include 'includes/footer.php'; ?>