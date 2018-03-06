<?php
	if(!isset($_SESSION))
		session_start();	
?>
<div class="container">
      <div class="row">
        <div class="col-sm-3 sidebar" style="background: #6e7075;">
          <ul class="nav nav-sidebar" > 
          	<?php
				$usertype = $dataobj->getValue('type');
			?>
			  <li><a onclick="sendReq('vp');"><i class="fa fa-user-o" aria-hidden="true"></i> 
				  View My Profile</a></li>
			<?php
				if($usertype == 'admin'){
			?>	
			  <li><a onclick="sendReq('vap');"><i class="fa fa-users" aria-hidden="true"></i> 
				  View User's Profile</a></li>
			<?php
				}	
			?>		
			  <li><a onclick="sendReq('ep');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
				  Edit Profile</a></li>
			  <li><a onclick="sendReq('cp');"><i class="fa fa-key" aria-hidden="true"></i> 
				  Change Password</a></li>
			  <li><a onclick="sendReq('dp');"><i class="fa fa-trash-o" aria-hidden="true"></i> 
				  Delete My Profile</a></li>
			  <li><a onclick="sendReq('logout');"><i class="fa fa-sign-out" aria-hidden="true"></i>
				  Logout</a></li>
			 </ul>
		</div>
		<div class="col-sm-9 container">
			<div id="contentdiv" >
				
			</div>
		</div>	
	</div>			
</div>
	
	<script>
		$("document").ready(function(){
			$.ajax({
				url: "./Controller/controlurl.php?type=<?php echo $usertype; ?>&action=viewuserprofile",
				success: function(result){
					$("#contentdiv").html(result);	
				}	
			});	
			sendReq = function(x){
				var goto = './Controller/controlurl.php?type=<?php echo $usertype; ?>&action='
				switch(x){
					case "logout":
						goto += "logout";
						break;
					case 'vp':
						goto += 'viewuserprofile';
						break;
					case 'vap':
						goto += 'viewallprofile';
						break;
					case 'ep':
						goto += 'edituserprofile';
						break;
					case 'cp':
						goto += 'changeuserpass';
						break;
					case 'dp':
						goto += 'deleteprofile';
						break;
				}
				if(x=='logout'){
					$.ajax({
						url: goto,
						success: function(result){
							window.location.href="http://localhost/TaskOne/";	
						}	
					});	
				}else if(x=='dp'){
					if(confirm("Are you sure to delete your profile:")){
						$.ajax({
							url: goto,
							success: function(result){								
								if(result == 1 || result == '1'){
									window.location.href="http://localhost/TaskOne/";
								}else{
									alert("Some error occured.Try it Later.");	
								}	
							}	
						});
					}	
				}else if(x == 'ep'){
					$.ajax({
						url: goto,
						success: function(result){
							$("#contentdiv").html(result);
						}	
					});
				}else{
					$.ajax({
						url: goto,
						success: function(result){
							$("#contentdiv").html(result);
						}	
					});
				}
			}
		});	
	</script>
	<style>
		a{
			cursor: hand;
			color: white;
			text-align: center;
			font-weight: bold;
			font-size: 1.2em;
			margin: 5px 0px;
		}
		#contentdiv{
			padding: 10px;
		}
		
	</style>