<?php 
	require_once(ABSPATH . 'src/DAO/UserDAO.class.php');
	require_once(ABSPATH . 'src/DAO/UserRoleDAO.class.php');
	require_once(ABSPATH . 'src/DAO/RoleDAO.class.php');
    include (ABSPATH. "commons/page-include.php");
	class LoginAction {
		public function __construct() {
			$userdao = new UserDAO();
			$username = $_POST['inputUsername'];
			$password = $_POST['inputPassword'];
			$user = $userdao->findbyUsername($username);
			if($user['password'][0] != $password){
				echo "<script type=\"text/javascript\"> alert('Incorrect Username or Password')</script>";
				echo "<script type=\"text/javascript\">
						window.location=\"" . site_url . "login.php\";
						</script>";
			}
			else{
				$_SESSION['USER'] = $user;
                $userRoleDAO = new UserRoleDAO();
                $userRole = new UserRole();
                $userRole = $userRoleDAO->findbyUserId($_SESSION['USER']['user_id'][0]);

                switch($userRole['role_id'][0]){
                    case 1 :
                        echo "<script type=\"text/javascript\">
						window.location=\"" . site_url . "admin_index.php\";
						</script>";
                        break;
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