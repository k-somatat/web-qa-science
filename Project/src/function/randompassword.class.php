<?php 
	class randomPassword{
		public function __construct(){
		    $this->rand(8);
		}
		public function rand($number){
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$output = substr(str_shuffle($alphabet),0,$number);
			return $output;
		}
	}
?>