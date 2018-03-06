<?php
	session_start();
	if(isset($_SESSION)){
		session_destroy();	
	}
?>
<div class="">
	<div><h2 class="text-justify text-danger col-sm-offset-1">Move to your profile:</h2></div>
	<div class="panel-body"> 
		<form class="form-horizontal" id="signinForm" >
    		<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="email">Email:</label>
      			<div class="col-sm-6">
        		<input type="email" class="form-control" id="uemail" placeholder="Enter Your Registered Email" 
					   name="email" required>
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="type">Select User Type:</label>
      			<div class="col-sm-6">
					<select name="type" id="usertype"class="form-control">
						<option value="">---Select User Type---</option>
						<option value="user">User</option>
						<option value="admin">Admin</option>
					</select>
      			</div>
				<span id="cpassmsg" class="col-sm-offset-3 col-sm-9"></span>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="pass">Password:</label>
      			<div class="col-sm-6">
        		<input type="password" class="form-control" id="upass" placeholder="Enter Your Password" name="pass"
					    required>	
      			</div>
    		</div>
			<div class="form-group">        
      			<div class="col-sm-offset-3 col-sm-6">
        			<button type="submit" class="btn btn-success">SignIn</button>
      			</div>
    		</div>
			<div class="col-sm-offset-3 col-sm-6" id="formmsg">
			</div>
		</form>
		<script>
			$("document").ready(function(){
				$("input").focus(function(){
					$("#formmsg").html("");
				});
				$("#signinForm").submit(function(e) {
					$("#formmsg").html("Please Wait...");
					var url = "./Controller/controlurl.php?type="+$("#usertype").val()+"&action=signin"; // the script where you handle the form input.
					$.ajax({
           				type: "POST",
           				url: url,
           				data: $("#signinForm").serialize(), // serializes the form's elements.
           				success: function(data)
           				{
							if(data == "0"){
								$("#formmsg").html("<div class='alert alert-danger'>login Failed...</div>");	
							}else if(data == "1"){
								window.location.href="http://localhost/TaskOne/";
							}
							else{
								$("#formmsg").html("<div class='alert alert-danger'>"+data+"</div>");
							}	
           				}
         			});
					e.preventDefault(); // avoid to execute the actual submit of the form.
				});
			})	
		</script>
	</div>
</div>