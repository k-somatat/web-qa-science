<?php 
	class CheckLoginAdmin{
		public function __construct(){
			if($_SESSION['USER']['user_id'][0] == ''){
				echo "<script type=\"text/javascript\">
						window.location=\"" . site_url . "login.php\";
						</script>";
				exit;
			}

            $userRoleDAO = new UserRoleDAO();
            $userRole = new UserRole();
            $userRole = $userRoleDAO->findbyUserId($_SESSION['USER']['user_id'][0]);

            if($userRole['role_id'][0] != 1){

                switch($userRole['role_id'][0]){
                    case 3 :

                        echo "<script type=\"text/javascript\">
						window.location=\"" . site_url . "president_index.php\";
						</script>";
                        break;

                    case 5 :

                        echo "<script type=\"text/javascript\">
						window.location=\"" . site_url . "president_index.php\";
						</script>";
                        break;

                    default :
                        echo "<script type=\"text/javascript\">
						window.location=\"" . site_url . "index.php\";
						</script>";
                        break;
                }
                exit;
            }
		}
	}

?>