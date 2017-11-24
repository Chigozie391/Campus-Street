<?php 
$db = mysqli_connect('127.0.0.1','root','','campst');

if(mysqli_connect_errno()){
	echo "Database Connection Failed with the following error: ". mysqli_connect_errno();
	die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/campustreet/config.php';
require_once BASEURL.'helpers/helpers.php';
 ?>