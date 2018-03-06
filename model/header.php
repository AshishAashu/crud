<?php
	if(!isset($_SESSION)){
		session_start();
	}	
?>
	<header class="container panel panel-danger">
		<div class="panel-header">
			<div class="pull-left" >
				<h2 style="display: inline-block;" class="text-info">
					<a href="index.php" style="display: inline-block;">
						<i class="fa fa-home text-danger" aria-hidden="true"></i></a>
					CRUD</h2>	
			</div>
			<div class="pull-right">
				<h3 class="text-success">Welcome <?php
					if(isset($_SESSION['dataobj'])){
						echo "(".$dataobj->getValue('type').")";						
					}
					?>
				<?php
					$user = "Guest";
					if(isset($_SESSION['dataobj'])){
						$user = $dataobj->getValue('name');						
					}
						echo " : ".$user;
				?>
				</h3>
			</div>	
		</div>
	</header>
