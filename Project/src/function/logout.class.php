<?php 
	session_start();
	
	class LogoutAction{
		public function __construct() {
			session_destroy();
			echo "<script type=\"text/javascript\">
					window.location=\"" . site_url . "login.php\";
					</script>";
			exit;
		}
	}

?>