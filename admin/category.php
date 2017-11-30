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
$errors = [];
$cat_query = $db->query("SELECT * FROM categories");
$category = (isset($_POST['category'])? sanitize($_POST['category']): '');
$icons = (isset($_POST['icons'])? sanitize($_POST['icons']): '');

if($_GET){
	if(isset($_GET['delete'])){
		$deleteID = (int)$_GET['delete'];
		$db->query("DELETE  FROM categories WHERE id = '$deleteID'");
		header('location:category.php');
	}

if(isset($_GET['edit'])){
	$editID = (int)$_GET['edit'];
	$ed_query = $db->query("SELECT * FROM categories WHERE id = '$editID'");
	$edit = mysqli_fetch_assoc($ed_query);
	$editCat = $edit['category'];
	$editIcon = $edit['icons'];
}

}



if($_POST){
	if(empty(trim($category)) || empty(trim($icons))){
		$errors[] = 'Input both Category and Icon.';
	}

	if(!empty($errors)){
		echo display_errors($errors);
	}else{
		if(isset($_GET['edit'])){
			$db->query("UPDATE categories SET category = '$category', icons = '$icons' WHERE id = '$editID'");
			header('location:category.php');
		}else{
		$db->query("INSERT INTO categories (category,icons) VALUES ('$category','$icons')");
		header('location:category.php');
		}
		
	}
}
?>
<div class="container">
	<h2 class="text-center">Category</h2>
	<div class="row category">
		
		<div class="col-md-4">
			<form method="post">
				<div class="form-group">
					<label for="category">Category</label>
					<input type="text" class="form-control" name="category" id="category" value="<?=isset($editCat)?$editCat : $category ?>">
				</div>
				<div class="form-group">
					<label for="icons">Icon</label>
					<input type="text" class="form-control" name ="icons" id="icons" value="<?=isset($editIcon)? $editIcon : $icons ?>">
				</div>
				<div class="form-group" style="display: inline-block;">
					<input type="submit" class="form-control btn-primary" value="<?=isset($_GET['edit'])?'Edit': 'Add'?> Category">
				</div>
				<?php if(isset($_GET['edit'])): ?>
				<a href="category.php" class="btn btn-default">Cancel</a>
			<?php endif; ?>
			</form>

		</div>
		<div class="col-md-8">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Category</th>
					<th>Icon</th>
					<th>Operation</th>
				</thead>
				<?php while($cat = mysqli_fetch_assoc($cat_query)): ?>
					<tr>
						<td><?=$cat['category']?></td>
						<td><?=$cat['icons']?></td>
						<td><a href="category.php?edit=<?=$cat['id']?>" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span></a>
							<a href="category.php?delete=<?=$cat['id']?>" class="btn btn-xs btn-default"><span class="fa fa-trash-o"></span></a></td>
						</tr>
					<?php endwhile; ?>
				</table>
			</div>

		</div>

	</div>