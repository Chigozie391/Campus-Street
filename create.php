<?php
include 'core/init.php';
if(isset($_SESSION['usercs'])){
	unset($_SESSION['usercs']);
}
include 'includes/head.php';
include 'includes/navigation.php';

$errors = array();
$required = array(
	'full_name' => 'Full Name',
	'email' => 'Email',
	'phone' => 'Phone',
	'campus' => 'Campus',
	'password' => 'Password',
);

$full_name = (isset($_POST['full_name'])? sanitize($_POST['full_name']) : '');
$email = (isset($_POST['email'])? sanitize($_POST['email']) : '');
$phone = (isset($_POST['phone'])? sanitize($_POST['phone']) : '');
$phone2 = (isset($_POST['phone2'])? sanitize($_POST['phone2']) : '');
$campus = (isset($_POST['campus'])? sanitize($_POST['campus']) : '');
$password = (isset($_POST['password'])? sanitize($_POST['password']) : '');
$confpass = (isset($_POST['confpass'])? sanitize($_POST['confpass']) : '');
$school = (isset($_POST['school'])? sanitize($_POST['school']) : '');


if($_POST){
	
	foreach ($required as $f => $d) {
		if(empty($_POST[$f]) || trim($_POST[$f]) == '' ){
			$errors[] = $d.' is Required.';
		}
	}
	//if all the elements are filled out, run this
	if(empty($errors)){
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$errors[] = 'Please enter a vaild Email Address.';
		}
		if(strlen($password) >= 6){
			if($password != $confpass){
				$errors[] = 'Your Password did not Match.';
			}
		}else{
			$errors[] = 'Password must be greater than 6 Characters';
		}
	}
		if(empty($errors)){
			$user_exist = $db->query("SELECT email FROM users WHERE email = '$email'");
			$count = mysqli_num_rows($user_exist);
			if($count > 0 ){
				$errors[] = 'User already exists';
			}
		}


	//display errors
	if(!empty($errors)){
		echo display_errors($errors);
	}else{
		$passwordhash = password_hash($password,PASSWORD_DEFAULT);
		$db->query( "INSERT INTO users (full_name,email,phone,phone2,school,campus,password) 
		VALUES ('$full_name','$email','$phone',$phone2,'$school','$campus','$passwordhash')");
		$userID = $db->insert_id;
		login($userID);
	}

}

?>

<div class="container">	
	<h2 class="text-center h2-responsive">WELCOME TO CAMPUS STREET</h2>
	<h3 class="text-center h3-resposive">Create Account</h3>
	<div class="form">
		<form method="post" id="create">
			<div class="md-form">
				<i class="fa fa-user prefix grey-text"></i>
				<input type="text" id="form1" class="form-control" name="full_name" value="<?=$full_name ?>">
				<label for="form1">Full Name</label>
			</div>

			<div class="md-form">
				<i class="fa fa-envelope prefix grey-text"></i>
				<input type="text" id="form2" class="form-control" name="email" value="<?=$email ?>">
				<label for="form2">Email</label>
			</div>

			<div class="md-form">
				<i class="fa fa-envelope prefix grey-text"></i>
				<input type="text" id="form3" class="form-control" name="phone" value="<?=$phone ?>">
				<label for="form3">Phone Number</label>
			</div>
			<div class="md-form">
				<i class="fa fa-envelope prefix grey-text"></i>
				<input type="text" id="form4" class="form-control" name="phone2" value="<?=$phone2 ?>">
				<label for="form4">Second Number (Optional)</label>
			</div>

			<div class="md-form">
				<?php $pQuery = $db->query("SELECT * FROM university WHERE parent = 0"); ?>
				<i class="fa fa-envelope prefix grey-text"></i>
				<select name="school" class="form-control" id="school">
					<option value="" selected disabled>Your School</option>
					<?php while($parent = mysqli_fetch_assoc($pQuery)):?>
					<option value="<?=$parent['id'];?>" <?=($school != '' && $school == $parent['id'])? 'selected' : '' ?>><?=$parent['school'] ?></option>
				<?php endwhile; ?>
				</select>
			</div>

			<div class="md-form">
				<i class="fa fa-envelope prefix grey-text"></i>
				<select name="campus" class="form-control" id="campus">
					<option value="" selected disabled>Choose Campus</option>
				</select>
			</div>

			<div class="md-form">
				<i class="fa fa-tag prefix grey-text"></i>
				<input type="password" id="form5" class="form-control" name="password" value="<?=$password ?>">
				<label for="form5">Password</label>
			</div>

			<div class="md-form">
				<i class="fa fa-tag prefix grey-text"></i>
				<input type="password" id="form6" class="form-control" name="confpass" value="<?=$confpass ?>">
				<label for="form6">Confirm Password</label>
			</div>

			<div class="text-center">
				<button  type="submit" class="btn btn-unique" value="submit"> Create Account <i class="fa fa-paper-plane-o ml-1"></i></button>
				Already have an Account ? <a href="login.php">Sign in</a>
			</div>
		</form>

	</div>
</div>

<?php 	include 'includes/footer.php' ?>

<?php 
if($campus != ''): ?>
<script>
		get_campus('<?=$campus?>');
</script>
<?php endif; ?>