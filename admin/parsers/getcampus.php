<?php  
require_once $_SERVER['DOCUMENT_ROOT'].'/campustreet/core/init.php';
$parentID = (int)$_POST['parentID'];
$cQuery = $db->query("SELECT * FROM university WHERE parent = '$parentID'");
if(isset($_POST['selected'])){
	$c_selected = (int)$_POST['selected'];
}else{
	if(isset($userID)){
	$campus_query = $db->query("SELECT campus FROM users WHERE id = '$userID' LIMIT 1");
	$cResult = mysqli_fetch_assoc($campus_query);
	$sel_campus = $cResult['campus'];
}
}



ob_start();

?>
<option value="">Choose Campus</option>
<?php while($child = mysqli_fetch_assoc($cQuery)): ?>
	<option value="<?=$child['id']; ?>" <?= (!isset($c_selected) && isset($sel_campus) && $child['id'] == $sel_campus)? 'selected': '' ?> <?= (isset($c_selected) && $child['id'] == $c_selected)? 'selected' : '' ?> ><?=$child['school'];?></option>
<?php endwhile; ?>
<?php echo ob_get_clean(); ?>


