<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>	
	<body>
<?php
	session_start();
	//session_destroy();	
	require_once('Controller/Data.php');
	$dataobj = new Data;
	if(isset($_SESSION['dataobj'])) {
		$dataobj = unserialize($_SESSION['dataobj']);
	}
?>
	<div id="headerdiv">	
	<?php	
		include("model/header.php");
	?>
	</div>	
<?php		
	include ("model/menu.php");
	include ("model/footer.php");	
?>
	</body>	
</html>