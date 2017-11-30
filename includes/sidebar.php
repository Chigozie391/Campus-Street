<?php 
	$query = $db->query("SELECT * FROM categories");
 ?>
<div class="col-md-3 col-sm-3">
	<div class="mt-5"></div>
	<?php while($result = mysqli_fetch_assoc($query)): ?>
	<a href = "#" class="btn btn-primary category"><i class="fa fa-<?= $result['icons']?>"></i> <?=$result['category'] ?></a>
	<?php endwhile; ?>
</div>
	