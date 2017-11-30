<?php 
$db = mysqli_connect('127.0.0.1','root','','campst');

if(mysqli_connect_errno()){
	echo "Database Connection Failed with the following error: ". mysqli_connect_errno();
	die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/campustreet/config.php';
require_once BASEURL.'helpers/helpers.php';



if(isset($_SESSION['usercs'])){
	$userID = $_SESSION['usercs'];
	$query = $db->query("SELECT full_name,admin FROM users WHERE id = '$userID'");
	$userData = mysqli_fetch_assoc($query);
	$fn = explode(' ',$userData['full_name']);
	$userData['first'] = $fn[0];
	//if last name exist
	if(count($fn) > 1){
		$userData['last'] = $fn[1];
	}

}






?>
