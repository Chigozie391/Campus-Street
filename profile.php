<?php
include 'core/init.php';
if(!is_logged_in()){
	header('location:login.php');
}else{
	include 'includes/head.php';
	include 'includes/navigation.php';
	$errors = [];
	$required = array(
		'full_name' => 'Full Name',
		'email' => 'Email',
		'phone' => 'Phone Number',
		'school' => 'School',
		'campus' => 'Campus'
	);


	$eSQL = $db->query("SELECT full_name,email,phone,phone2,school FROM users WHERE id = '$userID'");
	$edit  = mysqli_fetch_assoc($eSQL);
	$full_name = (isset($_POST['full_name'])? sanitize($_POST['full_name']) : $edit['full_name']);
	$email = (isset($_POST['email'])? sanitize($_POST['email']) : $edit['email']);
	$phone = (isset($_POST['phone'])? sanitize($_POST['phone']) : $edit['phone']);
	$phone2 = (isset($_POST['phone2'])? sanitize($_POST['phone2']) : $edit['phone2']);
	$school_id = (isset($_POST['school'])? sanitize($_POST['school']) : $edit['school']);
	$campus = (isset($_POST['campus'])? sanitize($_POST['campus']) : '');
	$school_sql = $db->query("SELECT id FROM university WHERE id = '$school_id'");
	$photopath = '';
	$sch = mysqli_fetch_assoc($school_sql);


	if($_POST){
		foreach ($required as $f => $d) {
			if(empty(trim($_POST[$f]))){
				$errors[] = $d.' is Required.';
			}
		}
		if(!empty($_FILES['photo']['size'])){
			$allowed_ext = array('png','jpg','jpeg');
			$photo = $_FILES['photo'];
			$nameArray = explode('.', $photo['name']);
			$fileExt = $nameArray[1];
			$mime = explode('/', $photo['type']);
			$mimeType = $mime[0];
			$mimeExt = $mime[1];
			$tmploc = $photo['tmp_name'];
			$fileSize = $photo['size'];
			$uploadName = md5(microtime()).'.'.$fileExt;
			$uploadPath = BASEURL.'img/ads/'.$uploadName;	
			$photopath = './img/ads/'.$uploadName;
			if($mimeType != 'image'){
				$errors[] = 'The file must be an Image';
			}
			if($fileSize > 4000000){
				$errors[] = 'The file must not be greater than 4MB';
			}
			if(!in_array($mimeExt, $allowed_ext)){
				$errors[] = 'The image must be a jpeg,png or jpg file';
			}
		}


	//if all the elements are filled out, run this
		if(empty($errors)){
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors[] = 'Please enter a vaild Email Address.';
			}
		}
		if(empty($errors)){
			$user_exist = $db->query("SELECT email FROM users WHERE id != '$userID' AND email = '$email'  LIMIT 1");
			$count = mysqli_num_rows($user_exist);
			if($count > 0 ){
				$errors[] = 'That email is already in use';
			}
		}
		
		if(!empty($errors)){
			echo display_errors($errors);
			
		}else{
			move_uploaded_file($tmploc, $uploadPath);
			$u_sql = $db->query("UPDATE users SET full_name = '$full_name', email = '$email',phone = '$phone',phone2 = '$phone2',campus = '$campus',school = '$school_id',photo = '$photopath' WHERE id = '$userID'");
			header('location:index.php');
		}
	}

	?>



	<div class="container">	
		<h2 class="text-center h2-responsive">Your Profile</h2>
		<div class="form">
			<form method="post" id="create" enctype="multipart/form-data"> 
				<div class="md-form">
					<input type="file" class="form-control" id="photo" name="photo">
				</div>
				<div class="md-form">
					<i class="fa fa-user prefix grey-text"></i>
					<input type="text" id="form1" class="form-control" name="full_name" value="<?=$full_name;?>">
					<label for="form1">Full Name</label>
				</div>

				<div class="md-form">
					<i class="fa fa-envelope prefix grey-text"></i>
					<input type="text" id="form2" class="form-control" name="email" value="<?=$email;?>">
					<label for="form2">Email</label>
				</div>

				<div class="md-form">
					<i class="fa fa-envelope prefix grey-text"></i>
					<input type="text" id="form3" class="form-control" name="phone" value="<?=$phone;?>">
					<label for="form3">Phone Number</label>
				</div>
				<div class="md-form">
					<i class="fa fa-envelope prefix grey-text"></i>
					<input type="text" id="form4" class="form-control" name="phone2" value="<?=$phone2;?>">
					<label for="form4">Second Number (Optional)</label>
				</div>

				<div class="md-form">
					<?php $pQuery = $db->query("SELECT * FROM university WHERE parent = 0"); ?>
					<i class="fa fa-envelope prefix grey-text"></i>
					<select name="school" class="form-control" id="school">
						<?php while($parent = mysqli_fetch_assoc($pQuery)):?>
							<option value="<?=$parent['id'];?>" <?=($parent['id'] == $sch['id'])? 'selected' : ''?> ><?=$parent['school'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>

				<div class="md-form">
					<i class="fa fa-envelope prefix grey-text"></i>
					<select name="campus" class="form-control" id="campus">
						<option value="" selected>Choose Campus</option>
					</select>
				</div>

				<div class="text-center">
					<button  type="submit" class="btn btn-unique" value="submit"> Save<i class="fa fa-paper-plane-o ml-1"></i></button>
					<a href="index.php" class="btn btn-unique" > Cancel</a>
				</div>

			</form>

		</div>
	</div>
	<?php 
}
include 'includes/footer.php'; ?>
<script>
	if ($('#school').val() != null) {
		get_campus('<?=$campus?>');
	}
</script>