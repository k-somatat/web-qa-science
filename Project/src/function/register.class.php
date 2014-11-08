<?php
session_start();
	require_once(ABSPATH . 'src/DAO/UserDAO.class.php');
	require_once(ABSPATH . 'src/DAO/UserRoleDAO.class.php');
	require_once(ABSPATH . 'src/DAO/RoleDAO.class.php');
    include("admin/commons/page-header1.0.php");


	class RegisterAction {
		public function __construct() {

            if($_POST['inputUsername'] && $_POST['inputPassword'] && $_POST['inputRePassword'] && $_POST['faculty'] != ''){

                $user_email = $_POST['inputUsername']."@siam.edu";

                if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

                    $userDAO = new UserDAO();
                    $user = $userDAO->findbyUsername($user_email);

                    if($user['user_id'][0] == ''){

                        if($_POST['inputPassword'] == $_POST['inputRePassword'] ){

                            if(  preg_match( '~[a-z]~', $_POST['inputPassword']) &&
                                preg_match( '~\d~', $_POST['inputPassword']) &&
                                (strlen( $_POST['inputPassword']) > 6)){
                                $user = new User();
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
                                    $user->user_image = '';
                                }else{
                                    $user->user_image = $path['path'];
                                }

                                $user->user_tel = $_POST['tel'];
                                $user->major_id = $_POST['major'];
                                $user->time_create = date("Y-m-d H:i:s");
                                $userDAO->insert($user);


                                echo "<script type='text/javascript'>
                                bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว !',function(){
                                    window.location=\"" . site_url . "admin_user.php\"
                                })
                                </script>";
                            } else {
                                echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณาสร้างพาสเวิร์ดใหม่ โดยใช้ภาษาอังกฤษ ตัวเลข ผสมกันอย่างน้อย 6 ตัวอักษร เช่น pass1234',function(){
                             window.location=\"" . site_url . "admin_user_form.php\"
                        })
                                    </script>";
                            }
                        }else{
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลพาสเวิร์ดให้เหมือนกัน !',function(){
                                window.location=\"" . site_url . "admin_user_form.php\"
                            })
                            </script>";
                        }

                    }else{
                        echo "<script type='text/javascript'>
                            bootbox.alert('อีเมล์นี้มีผู้ใช้งานแล้ว โปรดลองอีเมล์อื่น !',function(){
                                window.location=\"" . site_url . "admin_user_form.php\"
                            })
                            </script>";
                    }

                }else{
                    echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลอีเมล์ให้ถูกต้อง !',function(){
                                window.location=\"" . site_url . "admin_user_form.php\"
                            })
                            </script>";

                }

            }else{
                echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลให้ครบถ้วน !',function(){
                                window.location=\"" . site_url . "admin_user_form.php\"
                            })
                            </script>";

            }
        }
	}
?>