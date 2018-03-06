<?php
	require "Connection.php";
	require_once('Data.php');
	class UserAction{
		
		function insertData($tablename){
			if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 
			$dataobj = new Data;
			$dataobj = unserialize($_SESSION['dataobj']);
			$c = new Connection;
			$c->set_pass("1234");
			$c->set_dbname("crud");
			$conn = $c->get_connection();	
			if($conn->connect_error)
				echo $conn->connect_error;
			else{
				//$indexs = array('name','mobile','email','pass');
				if(self::checkExistUser($conn, $dataobj->getValue('email'), $tablename)){
					$sql="insert into ".$tablename." (name,mobile,email,password,type) values ('".
						$dataobj->getValue('name')."','".$dataobj->getValue('mobile')."','".
						$dataobj->getValue('email')."','".$dataobj->getValue('pass')."','".
						$dataobj->getValue('type')."')";
					$result = $conn->query($sql);
					if($result){
						return 1;	
					}
					return 0;
				}
				return 2;
			}				
		}
		
		function adminUpdate($conn,$tn){
		if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 
			$dataobj = new Data;
			$dataobj = unserialize($_SESSION['updataobj']);
			if($conn->connect_error)
				echo $conn->connect_error;
			else{
				foreach($dataobj->d as $key => $val){
					if($key != 'email'){
						$sql="update $tn set $key='".$val."' where email='".$dataobj->d['email']."'";	
						if($conn->query($sql))
							echo ucfirst($key)." Updated ";
					}	
				}
			}
		}
		
		function updateData($conn, $tn){
			if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 
			$dataobj = new Data;
			$dataobj1 = new Data;
			$dataobj = unserialize($_SESSION['updataobj']);
			$dataobj1 = unserialize($_SESSION['dataobj']);
			if($conn->connect_error)
				echo $conn->connect_error;
			else{
				foreach($dataobj->d as $key => $val){
					if($key != 'email' && ($dataobj1->getValue($key) != $dataobj->getValue($key))){
						$sql="update $tn set $key='".$val."' where email='".$dataobj->d['email']."'";	
						if($conn->query($sql))
							echo ucfirst($key)." Updated";
					}	
				}
				self::updateSessionData();
			}
		}
		
		function updateSessionData(){
			$dataobj1 = new Data;
			$dataobj2 = new Data;
			$dataobj1 = unserialize($_SESSION['dataobj']);
			$dataobj2 = unserialize($_SESSION['updataobj']);
			foreach($dataobj2->d as $k => $v){
				if($k != 'email'){
					$dataobj1->setValue($k, $v);
				}	
			}
			$_SESSION['dataobj'] = serialize($dataobj1);
		}
		
		
		function updatePass($conn, $tn){
			if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 
			$dataobj = new Data;
			$dataobj1 = new Data;
			$dataobj = unserialize($_SESSION['updataobj']);
			$dataobj1 = unserialize($_SESSION['dataobj']);
			if($conn->connect_error)
				echo $conn->connect_error;
			else{
				$sql="update $tn set password='".$dataobj->getValue("pass")."' where email='".$dataobj1->d['email']."'";	
				if($conn->query($sql))
				echo "Password Updated";
				self::updateSessionPass();
				$dataobj1 = unserialize($_SESSION['dataobj']);
			}
		}
		
		
		
		function updateSessionPass(){
			$dataobj1 = new Data;
			$dataobj2 = new Data;
			$dataobj1 = unserialize($_SESSION['dataobj']);
			$dataobj2 = unserialize($_SESSION['updataobj']);
			$dataobj1->setValue("pass",$dataobj2->getValue("pass"));
			$_SESSION['dataobj'] = serialize($dataobj1);
		}	
		
		function deleteData($conn, $tn){
			if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 
			$dataobj = new Data;
			$dataobj = unserialize($_SESSION['dataobj']);
			if($conn->connect_error)
				echo $conn->connect_error;
			else{
				$sql="delete from $tn where email='".$dataobj->d['email']."'";	
				if($conn->query($sql)){
					session_destroy();
					echo "1";
				}	
				else
					echo "0";
			}
		}
		
		
		
		function checkExistUser($conn, $email, $tn){
			$sql = "select * from ".$tn." where email='".$email."'";
			$result = $conn->query($sql);
			if( $result->num_rows > 0)
				return false;
			else
				return true;
		}	
		
		
		
		
		function matchSigninData($conn, $tn){
			require_once('Data.php');
			$dataobj = new Data;
			$dataobj = unserialize($_SESSION['dataobj']);
			$sql = "select * from ".$tn." where email='".$dataobj->getValue('email')."' and password='".
				$dataobj->getValue('pass')."' and type='".$dataobj->getValue('type')."'";
			//echo $sql;
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$dataobj->setValue('name',$row['name']);
				$dataobj->setValue('mobile',$row['mobile']);
				$_SESSION['dataobj'] = serialize($dataobj);
				return 1;
			}	
			else{
				session_destroy();
				return 0;
			}	
		}	
		
		function deleteAdminUser($conn, $tn, $id){
			$sql = "delete from $tn where id=$id";
			if($conn->query($sql)){
				echo "1";
			}else{
				echo "0";	
			}
		}
		function getModalForm($conn, $x, $tn){
			$sql = "select * from $tn where id='$x'";
			$result = $conn->query($sql);
			if($result->num_rows==1){
				$row = $result->fetch_assoc();
				$msg = '<div class="modal-dialog">
						<!-- Modal content-->
    						<div class="modal-content">
      							<div class="modal-header">
        							<button onclick='."$('#formModal').hide();".' class="close">&times;</button>
        							<h4 class="modal-title">Modal Header</h4>
     	 						</div>
      							<div class="modal-body">
        							<form class="form-horizontal" id="adminEditForm" >
    									<div class="form-group">
      										<label class="control-label col-sm-4 text-info"
											for="name">Change User Name:</label>
      										<div class="col-sm-6">
        										<input type="text" class="form-control" id="uname" 
												name="name" value="'.$row['name'].'"  required>
      										</div>
    									</div>
										<div class="form-group">
      										<label class="control-label col-sm-4 text-info"
											for="mobile">Change Mobile of User:</label>
      										<div class="col-sm-6">
        										<input type="text" class="form-control" id="umob" 
												name="mobile" value="'.$row['mobile'].'" required>
      										</div>
    									</div>
										<input type="hidden" class="form-control" 
												name="email" value="'.$row['email'].'" required>
										<div class="form-group">
      										<label class="control-label col-sm-4 text-info" for="cpass">
											Change User Type:</label>
      										<div class="col-sm-6">
												<select name="type" id="usertype" class="form-control">
													<option value="">---Select User Type---</option>
													<option value="user">User</option>
													<option value="admin">Admin</option>
												</select>
      										</div>
    									</div>
										<div class="form-group">        
      										<div class="col-sm-offset-3 col-sm-6">
        										<button type="submit" class="btn btn-success">Make Change</button>
      										</div>
    									</div>
									</form>
      							</div>
      							<div id="formMsg" class="modal-footer">
									
						      	</div>
							</div>
							<script>
								$("#adminEditForm").submit(function(e){
									if($("#usertype").val() == ""||$("#usertype").val() == null){
										alert("Select User Type");
									}else{
										$.ajax({
											type: "POST",
											url: "./Controller/controlurl.php?type=admin&action=adminupdate",
											data: $("#adminEditForm").serialize(),
           									success: function(data)
           									{
												alert(data);
												$.ajax({
													url: "./Controller/controlurl.php?type=admin&action=viewallprofile",
													success: function(result){
														$("#contentdiv").html(result);
													}
												});
											}	
										});
									}
									e.preventDefault();
								});
							</script>
    					</div>';
				echo $msg;
			}else{
				echo "Something went wrong!";
			}
		}	
	}
?>