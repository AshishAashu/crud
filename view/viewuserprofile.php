<?php
	require_once('../Controller/Data.php');
	$dataobj = new Data;
	if(isset($_SESSION['dataobj'])) {
		$dataobj = unserialize($_SESSION['dataobj']);
	}
?>
<div>
	<h2 class="text-danger"> Your Profile : </h2>
		<table class="table table-responsive col-sm-6">
			<tr class="form-group">
				<td class="control-label col-sm-3 text-info text-right">
					Name:
				</td>
				<td class="col-sm-6 text-success">
					<strong><?php
						echo $dataobj->getValue('name');
						?></strong>
				</td>
			</tr>
			<tr class="form-group">
				<td class="control-label col-sm-3 text-info text-right">
					Mobile :
				</td>
				<td class="col-sm-6 text-success">
					<strong><?php
						echo $dataobj->getValue('mobile');
						?></strong>
				</td>
			</tr>
			
			<tr class="form-group">
				<td class="control-label col-sm-3 text-info text-right">
					Registered Email:
				</td>
				<td class="col-sm-6 text-success">
					<strong><?php
						echo $dataobj->getValue('email');
						?></strong>
				</td>
			</tr>
			<tr class="form-group">
				<td class="control-label col-sm-3 text-info text-right">
					User Type:
				</td>
				<td class="col-sm-6 text-success">
					<strong><?php
						echo $dataobj->getValue('type');
						?></strong>
				</td>
			</tr>
		</table>	
	<div>	