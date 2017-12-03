<?php
include 'core/init.php';
if(!is_logged_in()){
	header('location:login.php');
}

include 'includes/head.php';
include 'includes/navigation.php';

?>
<div class="container m-nav">
	<h2 class="text-center h2-responsive">Post Your Ads</h2>
	<form method="post" class="form">
		
		<div class="md-form">
			<i class="fa fa-user prefix grey-text"></i>
			<input type="text" id="form1" class="form-control" name="title">
			<label for="form1">Item title</label>
		</div>
		<div class="md-form">
			<i class="fa fa-user prefix grey-text"></i>
			<input type="number" id="form2" class="form-control" name="price">
			<label for="form2">Price</label>
		</div>
		<div class="md-form">
			<i class="fa fa-user prefix grey-text"></i>
			<input type="text" id="form3" class="form-control" name="description">
			<label for="form3">Description</label>
		</div>

		<div class="md-form">
			<i class="fa fa-envelope prefix grey-text"></i>
			<select name="category" class="form-control" id="category">
				<option value="" disabled selected>Choose Category</option>
				<?php $cate_query = $db->query("SELECT * FROM categories"); 
				while($cat = mysqli_fetch_assoc($cate_query)):?>
				<option value="<?=$cat['id']?>"><?=$cat['category']?></option>
			<?php endwhile; ?>
		</select>
	</div>

	<div class="md-form">
		<?php $pQuery = $db->query("SELECT * FROM university WHERE parent = 0"); ?>
		<i class="fa fa-envelope prefix grey-text"></i>
		<select name="school" class="form-control" id="school">
			<option value="" disabled selected>Select University</option>
			<?php while($parent = mysqli_fetch_assoc($pQuery)):?>
				<option value="<?=$parent['id'];?>" ><?=$parent['school'] ?></option>
			<?php endwhile; ?>
		</select>
	</div>
	<div class="md-form">
		<i class="fa fa-envelope prefix grey-text"></i>
		<select name="campus" class="form-control" id="campus">
			<option value="" selected>Choose Campus</option>
		</select>
	</div>
	<div class="md-form">
		<i class="fa fa-user prefix grey-text"></i>
		<input type="file" id="form4" class="form-control" name="photo">
	</div>
	<div class="text-center">
		<button  type="submit" class="btn btn-success" value="submit"> Save<i class="fa fa-paper-plane-o ml-1"></i></button>
		<a href="index.php" class="btn btn-danger" > Cancel</a>
	</div>


</form>
</div>



<?php include 'includes/footer.php'; ?>