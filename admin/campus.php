<?php
require_once '../core/init.php';
if(!is_logged_in()){
	header('location:login.php');
}
if(!is_admin()){
	not_admin();
}
include './includes/head.php';
include './includes/navigation.php';
$parent = [];
$errors = [];
$p_query = $db->query("SELECT id,school FROM university WHERE parent = 0");
while($row = $p_query->fetch_array()){
	$parent[] = $row;
}


$schoolID = (isset($_POST['schoolID'])? sanitize($_POST['schoolID']) : '');
$school = (isset($_POST['school'])? sanitize($_POST['school']) : '');

if($_GET){
	if(isset($_GET['delete'])){
		$deleteID = (int)$_GET['delete'];
		$db->query("DELETE FROM university WHERE id = '$deleteID' OR parent = $deleteID");
		header('location:campus.php');
	}

	if(isset($_GET['edit'])){
		$editID = (int)$_GET['edit'];
		$e_query = $db->query("SELECT * FROM university WHERE id = '$editID'");
		$e_result = mysqli_fetch_assoc($e_query);
		$edit_school = $e_result['school'];
		$schoolID = $e_result['parent'];

	}

}


if($_POST){
	if(empty(trim($school))){
		$errors[] = 'Input the University or Campus';
	}
	if(!empty($errors)){
		?>
		<script>
			$(function(){
				$('#errors').html('<?= display_errors($errors)?>');
			});

		</script>
		<?php }else{
			if(isset($_GET['edit'])){
				$query = "UPDATE university SET school = '$school' , parent = '$schoolID' WHERE id = $editID";
			}else{
				$query = "INSERT INTO university (school,parent) VALUES ('$school','$schoolID')";
			}
			$db->query($query);
			header('location:campus.php');


		}
	}


	?>
	<div class="container">
		<div style="margin-bottom: 50px;"><h2 class="text-center">University and Campus</h2></div>
		<div class="col-md-6 ">
			<h3 class="text-center"><?=(isset($_GET['edit'])?' Edit': ' Add' ) ?> University and Campus</h3><hr>
			<div id="errors"></div>
			<form  method="post">
				<div class="form-group">
					<label for="school">Universities</label>
					<select name="schoolID" id="school" class="form-control">
						<option value="0" selected>University</option>
						<?php foreach($parent as $p):?>
							<option value="<?=$p['id']?>" <?=($p['id'] == $schoolID)? 'selected': '' ?>><?=$p['school'];?></option>
						<?php endforeach;; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="child">University/Campus</label>
					<input type="text" id = "child" class="form-control" name="school" value="<?=(isset($edit_school)?$edit_school: $school);?>">
				</div>
				<div class="form-group" style="display: inline-block;">
					<input type="submit" class="btn btn-primary" value="<?=(isset($_GET['edit'])?' Edit': ' Add' ) ?> University &amp; Campus">
				</div>
				<?php if(isset($_GET['edit'])): ?>
					<a href="campus.php" class="btn btn-default">Cancel </a>
			<?php endif; ?>
			</form>
		</div>

		<div class="col-md-6">
			<table class="table table-bordered">
				<thead>
					<th>Campus</th>
					<th>University</th>
					<th></th>
				</thead>
				<?php foreach($parent as $p):?>
					<tr class="bg-primary">
						<td>Campus </td>
						<td><?=$p['school'];?></td>
						<td><a href="campus.php?edit=<?=$p['id'];?>" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span></a>
							<a href="campus.php?delete=<?=$p['id'];?>" class="btn btn-xs btn-default"><span class="fa fa-trash-o"></span></a>
						</td>
					</tr>
					<?php
					$parentID = $p['id'];
					$c_query= $db->query("SELECT id,school FROM university WHERE parent = '$parentID'");
					while($child = mysqli_fetch_assoc($c_query)):
						?>
						<tr class="bg-info">
							<td><?=$child['school'];?></td>
							<td><?=$p['school'];?></td>
							<td><a href="campus.php?edit=<?=$child['id'];?>" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span></a>
								<a href="campus.php?delete=<?=$child['id'];?>" class="btn btn-xs btn-default"><span class="fa fa-trash-o"></span></a>
							</td>
						</tr>
					<?php endwhile; ?>
				<?php endforeach;; ?>
			</table>
		</div>
	</div>


















	<?php 
	include './includes/footer.php';
	?>