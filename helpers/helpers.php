<?php 	
function sanitize($dirt){
		return htmlentities($dirt,ENT_QUOTES,"UTF-8");
}

function display_errors($errors){
	$display = '<ul class = "bg-danger red lighten-5">';
	foreach($errors as $error){
		$display .= '<li class = "text-danger">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}

function login($userID){
	$_SESSION['usercs'] = $userID;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE users SET last_login = '$date' WHERE id = '$userID'");
	header('location:index.php');
}

//checks if the user is logged in
	function is_logged_in(){
		global $userID;
		if(isset($_SESSION['usercs']) && $_SESSION['usercs'] == $userID){
			return true;
		}
		return false;
	}

	function is_admin(){
		global $userData;
		if($userData['admin'] == 1){
			return true;
		}
		
	}

	function not_admin($url = '../login.php'){
	header('location:'.$url);
}
	 ?>
