<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	//include'useraction.php';
	$type = $_GET['type'];
	if($type == 'user'){
			$action = $_GET['action'];
			require_once 'Data.php';
			require_once 'useraction.php';
			$dataobj = new Data;
			foreach ($_POST as $key => $value) {
			# code...
				$dataobj->setValue(strtolower($key),$value);
			}
			$dataobj->setValue(strtolower("type"),$type);
			$var = true;
			foreach ($dataobj->d as $key => $value) {
				# code...
				if($key == 'name' || $key == 'mobile' || $key == 'email'){
					if(!$dataobj->validate($key,$value)){
						$var = false;
						$dataobj->reason = ucfirst($key); 
						break;
					}	
				}
			}
			#'if block start'//
			if($var){
				$ua = new UserAction;
				if($action=="signup"){	
					$_SESSION['dataobj'] = serialize($dataobj);
					$result = $ua->insertData("user_info");	
					session_destroy();
					echo $result;
				}else if($action == "signin"){
					$_SESSION['dataobj'] = serialize($dataobj);
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					echo $ua->matchSigninData($conn, 'user_info');
				}else if($action == 'update'){
					$_SESSION['updataobj'] = serialize($dataobj);
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					$ua->updateData($conn, 'user_info');
				}else if($action == 'updatepass'){
					$_SESSION['updataobj'] = serialize($dataobj);
					$dataobj1 = new Data;
					$dataobj1 = unserialize($_SESSION['dataobj']);
					if($dataobj->getValue('oldpass') != $dataobj1->getValue('pass')){
						echo "Old Password is wrong.";
					}else if($dataobj->getValue('pass') == $dataobj1->getValue('pass')){
						echo "New Password is same as old.";
					}else{
						require_once('Connection.php');
						$c = new Connection;
						$c->set_pass("1234");
						$c->set_dbname("crud");
						$conn = $c->get_connection();
						$ua->updatePass($conn, 'user_info');
					}	
				}else if($action == 'deleteprofile'){
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					$ua->deleteData($conn, 'user_info');
				}else if($action == 'viewuserprofile'){
					include "../view/viewuserprofile.php";
				}else if($action == 'edituserprofile'){
					include "../view/edituserprofile.php";	
				}else if($action == 'changeuserpass'){
					include "../view/changeuserpass.php";	
				}else if($action == "logout"){
					session_destroy();
				//header("Location : http://localhost/TaskOne");
				}
			}else{
				echo $dataobj->reason." is not validated.";
			}#@'if ends with else'//
			
		}else if($type == 'admin'){
			$action = $_GET['action'];
			require_once 'Data.php';
			$dataobj = new Data;
			foreach ($_POST as $key => $value) {
			# code...
				$dataobj->setValue(strtolower($key),$value);
			}
			$var = true;
			foreach ($dataobj->d as $key => $value) {
				# code...
				if($key == 'name' || $key == 'mobile' || $key == 'email'){
					if(!$dataobj->validate($key,$value)){
						$var = false;
						$dataobj->reason = ucfirst($key); 
						break;
					}	
				}
			}
			if($var){
				require_once 'useraction.php';
				$ua = new UserAction;
				if($action == 'signup'){
					$dataobj->setValue(strtolower("type"),$type);
					$_SESSION['dataobj'] = serialize($dataobj);
					$result = $ua->insertData("user_info");	
					session_destroy();
					echo $result;
				}else if($action == "signin"){
					$dataobj->setValue(strtolower("type"),$type);
					$_SESSION['dataobj'] = serialize($dataobj);
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					echo $ua->matchSigninData($conn, 'user_info');
				}else if($action == 'update'){
					$dataobj->setValue(strtolower("type"),$type);
					$_SESSION['updataobj'] = serialize($dataobj);
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					$ua->updateData($conn, 'user_info');
				}else if($action == 'updatepass'){
					$dataobj->setValue(strtolower("type"),$type);
					$_SESSION['updataobj'] = serialize($dataobj);
					$dataobj1 = new Data;
					$dataobj1 = unserialize($_SESSION['dataobj']);
					if($dataobj->getValue('oldpass') != $dataobj1->getValue('pass')){
						echo "Old Password is wrong.";
					}else if($dataobj->getValue('pass') == $dataobj1->getValue('pass')){
						echo "New Password is same as old.";
					}else{
						require_once('Connection.php');
						$c = new Connection;
						$c->set_pass("1234");
						$c->set_dbname("crud");
						$conn = $c->get_connection();
						$ua->updatePass($conn, 'user_info');
					}	
				}else if($action == 'deleteprofile'){
					$dataobj->setValue(strtolower("type"),$type);
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					$ua->deleteData($conn, 'user_info');
				}elseif($action == 'adminupdate'){
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					$_SESSION['updataobj'] = serialize($dataobj);
					$dataobj1 = new Data;
					$dataobj1 = unserialize($_SESSION['updataobj']);
					$ua->adminUpdate($conn,'user_info');
				}else if($action == 'deleteuser'){
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					$ua->deleteAdminUser($conn, 'user_info', $_GET['id']);
				}else if($action == 'viewuserprofile'){
					include "../view/viewuserprofile.php";
				}else if($action == 'edituserprofile'){
					include "../view/edituserprofile.php";	
				}else if($action == 'changeuserpass'){
					include "../view/changeuserpass.php";	
				}else if($action == "logout"){
					session_destroy();
				//header("Location : http://localhost/TaskOne");
				}else if($action == 'viewallprofile'){
					//$ua->viewAll();
					include "../view/viewall.php";
				}else if($action == 'modalform'){
					require_once('Connection.php');
					$c = new Connection;
					$c->set_pass("1234");
					$c->set_dbname("crud");
					$conn = $c->get_connection();
					$ua->getModalForm($conn, $_GET['id'], 'user_info');	
				}	
			}	
			else
				echo $dataobj->reason." is not validated.";
			
	}
	
?>