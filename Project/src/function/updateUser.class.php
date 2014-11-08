<?php session_start();

include("admin/commons/page-header1.0.php");

	class updateUser {
		public function __construct() {

            $userId = $_POST['userId'];

            if($_POST['inputUsername'] && $_POST['inputPassword'] && $_POST['faculty'] != ''){
                $user_email = $_POST['inputUsername']."@siam.edu";

                if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

                    $userDAO = new UserDAO();
                    $userEmail = $userDAO->findbyUsername($user_email);
                    $users = $userDAO->findbyUserId($_POST['userId']);

                    if(empty($userEmail['user_id'][0]) || $userEmail['username'][0] == $users['username'][0]){

                            if(  preg_match( '~[a-z]~', $_POST['inputPassword']) &&
                                preg_match( '~\d~', $_POST['inputPassword']) &&
                                (strlen( $_POST['inputPassword']) > 6)){

                                $user = new User();

                                $user->user_id  = $_POST['userId'];
                                $user->username = $user_email;
                                $user->password = $_POST['inputPassword'];

                                if($_POST['first_name'] == ''){
                                    $user->user_first_name = '';
                                }else{
                                    $user->user_first_name = $_POST['academic_rank']." ".$_POST['first_name'];
                                }

                                $user->user_last_name = $_POST['last_name'];
                                $user->user_position = $_POST['position'];

                                $upload = new UploadAction();
                                $path = $upload->UploadSingleFile('file', 'user');

                                if($_FILES['file']["size"] == 0){
                                    $users = $userDAO->findbyPK($user->user_id);
                                    if($users['user_image'] != ''){
                                        $user->user_image = $users['user_image'][0];
                                    }
                                }else{
                                    $user->user_image = $path['path'];
                                }

                                $user->user_tel = $_POST['tel'];
                                $user->major_id = $_POST['major'];
                                $users = $userDAO->findbyPK($user->user_id);
                                $user->time_create = $users['time_create'][0];
                                $user->time_update = date("Y-m-d H:i:s");

                                $userDAO->update($user);


                                echo "<script type='text/javascript'>
                                bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว !',function(){
                                    window.location=\"" . site_url . "admin_user.php\"
                                })
                                </script>";
                            } else {
                                echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณาสร้างพาสเวิร์ดใหม่ โดยใช้ภาษาอังกฤษ ตัวเลข ผสมกันอย่างน้อย 6 ตัวอักษร เช่น pass1234',function(){
                             window.location=\"" . site_url . "admin_user_form.php?uid=$userId\"
                            })
                                    </script>";
                            }
                    }else{
                        echo "<script type='text/javascript'>
                            bootbox.alert('อีเมล์นี้มีผู้ใช้งานแล้ว โปรดลองอีเมล์อื่น !',function(){
                                window.location=\"" . site_url . "admin_user_form.php?uid=$userId\"
                            })
                            </script>";
                    }
                }else{
                    echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลอีเมล์ให้ถูกต้อง !',function(){
                                window.location=\"" . site_url . "admin_user_form.php?uid=$userId\"
                            })
                            </script>";

                }

            }else{
                echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลให้ครบถ้วน !',function(){
                                window.location=\"" . site_url . "admin_user_form.php?uid=$userId\"
                            })
                            </script>";

            }

	    }
    }
?>