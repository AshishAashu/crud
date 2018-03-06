<?php
	require_once('../Controller/Data.php');
	$dataobj = new Data;
	if(isset($_SESSION['dataobj'])) {
		$dataobj = unserialize($_SESSION['dataobj']);
	}
?>
	<div>
		<h2 class="text-danger"> You Can Change Your Password : </h2>
		<form class="form-horizontal" id="updatepassForm" >
    		<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="name">Old Password:</label>
      			<div class="col-sm-6">
        		<input type="password" class="form-control" id="oldpass" name="oldpass" 
					   placeholder="Enter your old password" required>
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="mobile">New Password:</label>
      			<div class="col-sm-6">
        		<input type="password" class="form-control" id="newpass" placeholder="Enter new password" 
					   name ="pass" required>	
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="name">Confirm Your New Password:</label>
      			<div class="col-sm-6">
        		<input type="password" class="form-control" id="cnewpass" name="cnewpass" 
					   placeholder="Re-enter your new password" required>
      			</div>
    		</div>
			<div class="form-group">        
      			<div class="col-sm-offset-3 col-sm-6">
        			<button type="submit" class="btn btn-success">Change My Password</button>
      			</div>
    		</div>
			<div class="col-sm-offset-3 col-sm-6" id="formmsg">
			</div>
		</form>	
	<div>	
	<script>
		$("document").ready(function(){
			$("input").focus(function(){
				$("#formmsg").html("");
			});	
			$("#updatepassForm").submit(function(e){
				if($('#newpass').val()!=$('#cnewpass').val()){
					$("#formmsg").html("<div class='alert alert-danger'>Mismatch New password.</div>");
				}
				else{
				$.ajax({
					type: "POST",
					url: "./Controller/controlurl.php?type=user&&action=updatepass",
					data: $("#updatepassForm").serialize(), // serializes the form's elements.
           			success: function(data)
           			{
						alert(data);
						//$("#formmsg").html("<div class='alert alert-success'>"+data+"</div>");
						/*if(parseInt(data) == 1){
							$("#formmsg").html("<div class='alert alert-success'>"+Password Updated+"</div>");
						}else if(parseInt(data) == 2){
							$("#formmsg").html("<div class='alert alert-danger'>"+Old Password Not Matches+"</div>");
						}else{
							$("#formmsg").html("<div class='alert alert-warning'>"+Not Updated+"</div>");
						}*/
						$("input").val("");
					}	
				});	
				}	
				e.preventDefault();
			});	
		});	
	</script>	