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




 ?>