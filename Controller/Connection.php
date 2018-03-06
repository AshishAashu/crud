<?php
	class Connection{
		private $server = "localhost";
		private $user = "root";
		private $pass, $dbname;
		private $con;
		public function set_pass($p){
			$this->pass = $p;	
		}	
		
		public function set_dbname($db){
			$this->dbname = $db;	
		}	
		
		public function get_connection(){
			$this -> con = new mysqli( $this -> server, $this -> user, $this -> pass, $this -> dbname );
			return $this -> con;	
		}	
	}
?>
