<?php
	session_start();
	if(isset($_SESSION)){
		session_destroy();	
	}	
?>
<div class="">
	<div><h2 class="text-justify text-danger col-sm-offset-1">Be The Part Of Us:</h2></div>
	<div class="panel-body"> 
		<form class="form-horizontal" id="signupForm" >
    		<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="name">Name:</label>
      			<div class="col-sm-6">
        		<input type="text" class="form-control" id="uname" placeholder="Enter Your Good Name" 
					   name="name" required>
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="mobile">Mobile:</label>
      			<div class="col-sm-6">
        		<input type="text" class="form-control" id="umob" placeholder="Enter Mobile No" maxlength ="10"
					   name="mobile" required>	
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="name">email:</label>
      			<div class="col-sm-6">
        		<input type="email" class="form-control" id="uemail" placeholder="Enter your email" name="email"
					    required>
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="pass">Password:</label>
      			<div class="col-sm-6">
        		<input type="password" class="form-control" id="upass" placeholder="Enter your password" 
					   name="pass" required>
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="cpass">Confirm Password:</label>
      			<div class="col-sm-6">
        		<input type="password" class="form-control" id="ucpass" placeholder="Confirm your password" 
					   name="cpass"  required>
      			</div>
    		</div>
			<div class="form-group">
      			<label class="control-label col-sm-3 text-info" for="cpass">Select User Type:</label>
      			<div class="col-sm-6">
					<select name="type" id="usertype"class="form-control">
						<option value="">---Select User Type---</option>
						<option value="user">User</option>
						<option value="admin">Admin</option>
					</select>
      			</div>
    		</div>
			<div class="form-group">        
      			<div class="col-sm-offset-3 col-sm-6">
        			<button type="submit" class="btn btn-success">SignUp</button>
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
				$("#signupForm").submit(function(e) {
					if($("#usertype").val() == null || $("#usertype").val() == ""){						
						$('#formmsg').html("<div class='alert alert-danger'>Please Select User Type.</div>");
					}else if($('#upass').val() == $('#ucpass').val()){
    					var url = "./Controller/controlurl.php?type="+$("#usertype").val()+"&action=signup"; // the script where you handle the form input.
				    	$.ajax({
           					type: "POST",
           					url: url,
           					data: $("#signupForm").serialize(), // serializes the form's elements.
           					success: function(data)
           					{
								var msg;
								switch(data){
									case "0":	
										msg = "<div class='alert alert-danger'>Email is already registered" 
										+"with us.</div>";
										$("input[type='email']").val("");
										break;
									case "1":	
										msg = "<div class='alert alert-success'>Thanks for become part of us.</div>";
										$("input").val("");
										break;
									case "2":	
										msg = "<div class='alert alert-danger'>Email is already registered with us.</div>";
										$("input[type='email']").val("");
										break;
									default:	
										msg = "<div class='alert alert-danger'>"+data+"</div>";
										break;
								}
               					$("#formmsg").html(msg);
           					}
         				});
					}else{
						$('#formmsg').html("<div class='alert alert-danger'>Password Not Matches.</div>");
					}	
				    e.preventDefault(); // avoid to execute the actual submit of the form.
				});
			})	
		</script>
	</div>
</div>	