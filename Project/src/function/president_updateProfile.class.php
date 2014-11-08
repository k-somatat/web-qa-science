<?php session_start();

include("president/commons/page-header1.0.php");

	class president_updateProfile {
		public function __construct() {

                        $userdao = new UserDAO();
                        $user = new User();

                        $upload = new UploadAction();
                        $path = $upload->UploadSingleFile('file', 'user');

                        $user->user_id = $_SESSION['USER']['user_id'][0];
                        $user->username = $_SESSION['USER']['username'][0];
                        $user->password = $_SESSION['USER']['password'][0];
                        $user->user_position = $_POST['position'];

                        if($_POST['first_name'] == ''){
                            $user->user_first_name = '';
                        }else{
                            $user->user_first_name = $_POST['academic_rank']." ".$_POST['first_name'];
                        }

                        $user->user_last_name = $_POST['last_name'];

                        if($_FILES['file']["size"] == 0){
                            $users = $userdao->findbyPK($user->user_id);

                            if($users['user_image'] != ''){
                                $user->user_image = $users['user_image'][0];
                            }
                        }else{
                            $user->user_image = $path['path'];
                        }

                        $user->major_id = $_POST['major'];
                        $user->user_tel = $_POST['tel'];
                        $user->time_create = $_SESSION['USER']['time_create'][0];
                        $user->time_update = date("Y-m-d H:i:s");

                        $userdao->update($user);

                        $_SESSION['USER']['user_first_name'][0] = $_POST['academic_rank'].$_POST['first_name'];
                        $_SESSION['USER']['user_last_name'][0] = $user->user_last_name;
                        $_SESSION['USER']['user_position'][0] = $user->user_position;
                        $_SESSION['USER']['user_image'][0] = $user->user_image;
                        $_SESSION['USER']['major_id'][0] = $user->major_id;
                        $_SESSION['USER']['user_tel'][0] = $user->user_tel;

//                        echo "<script type=\"text/javascript\"> alert('อัพเดทข้อมูลส่วนตัวเรียบร้อยแล้ว !')</script>";
//                        echo "<script type=\"text/javascript\">
//                            window.location=\"" . site_url . "profile.php?onMal=1\";
//                            </script>";

                        echo "<script type='text/javascript'>
                        bootbox.alert('อัพเดทข้อมูลส่วนตัวเรียบร้อยแล้ว',function(){
                            window.location=\"" . site_url . "president_profile.php?onMal=1\"
                        })
                        </script>";


	    }
    }
?>