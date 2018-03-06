<?php
	class Data{
		var $d=array();
		var $errors=array();
		var $reason = "";
		function setValue($k,$v){
			$this->d[$k]= $v;
		}
		function getValue($k){
			return $this->d[$k];
		}
		function getDataLength(){
			return count($this->d);
		}
		function validate($key, $value){
			$error = false;
			switch ($key) {
				case 'name':
					# code...
					$error = self::validateName($value); 
					break;
				case 'mobile':
					$error = self::validateMobile($value);
					break;
				case 'email':
					$error = self::validateEmail($value);
					break;			
			}
			return $error;
		}
		function validateName($val){
			$pattern = "/^[a-zA-Z ]+$/";
			if(!preg_match($pattern, $val)){
				return false;
			}
			return true;
		}

		function validateMobile($val){
			$pattern = "/^[789][0-9]{9}$/";
			if(!preg_match($pattern, $val)){
				return false;
			}
			return true;
		}

		function validateEmail($val){
			$pattern = "/^[a-zA-Z0-9._]+[@][a-z]+[.][a-z]+$/";
			if(!preg_match($pattern, $val)){
				return false;
			}
			return true;
		}
		function setSession($key, $value){
			if(!isset($_SESSION)){
				session_start();
			}
			$_SESSION[$key] = $value;			
		}	
	}
?>