<?php
	require_once('../Controller/Data.php');
	$dataobj = new Data;
	if(isset($_SESSION['dataobj'])) {
		$dataobj = unserialize($_SESSION['dataobj']);
	}
?>
	<div>
		<h2 class="text-danger"> You Can Edit Your Profile : </h2>
		<form class="form-horizontal" id="updationForm" >
    		<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="name">Change Your Name:</label>
      			<div class="col-sm-6">
        		<input type="text" class="form-control" id="uname" name="name" value="<?php
					   		echo $dataobj->getValue('name');
					    ?>"  required>
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="mobile">change Your Mobile:</label>
      			<div class="col-sm-6">
        		<input type="text" class="form-control" id="umob" placeholder="Enter Mobile No" name ="mobile"
					   value="<?php
					   		echo $dataobj->getValue('mobile');
					    ?>"
					    required>	
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="name">email:</label>
      			<div class="col-sm-6">
        		<input type="email" class="form-control" id="uemail" value="<?php
					   		echo $dataobj->getValue('email');
					    ?>"
					 name="email"   readonly>
      			</div>
    		</div>
			<div class="form-group">        
      			<div class="col-sm-offset-3 col-sm-6">
        			<button type="submit" class="btn btn-success">Make Change</button>
      			</div>
    		</div>
			<div class="col-sm-offset-3 col-sm-6" id="formmsg">
			</div>
		</form>	
	</div>	
	<script>
		$("document").ready(function(){
			$("#updationForm").submit(function(e){
				$.ajax({
					type: "POST",
					url: "./Controller/controlurl.php?type=<?php echo $dataobj->getValue('type');?>"
					+"&action=update",
					data: $("#updationForm").serialize(), // serializes the form's elements.
           			success: function(data)
           			{
						alert(data);//$("#formmsg").html("<div class='alert alert-success'"+data+"</div>);
						location.reload();
					}	
				});	
				e.preventDefault();
			});	
		});	
	</script>	
	
		
		
		