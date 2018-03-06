<?php
	if(!isset($_SESSION['dataobj'])){
		require $_SERVER['DOCUMENT_ROOT']."/TaskOne/view/nonsessionmenu.php";
	}
	else{
		require $_SERVER['DOCUMENT_ROOT']."/TaskOne/view/dashboard.php";
	}	
?>