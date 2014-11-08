<?php session_start();

include("president/commons/page-header1.0.php");

	class president_changePassword {
		public function __construct() {

                        $userdao = new UserDAO();
                        $user = new User();

                        $user->user_id = $_SESSION['USER']['user_id'][0];
                        $user->password = $_SESSION['USER']['password'][0];

                        if($_POST['passworded'] != $_SESSION['USER']['password'][0]){
                            echo "<script type='text/javascript'>
                                bootbox.alert('กรุณากรอกพาสเวิร์ดเดิมให้ถูกต้อง',function(){
                             window.location=\"" . site_url . "president_change_password_form.php\"
                        })
                                </script>";
                        }else{
                            if($_POST['newPassword'] != $_POST['confirmPassword']){
                                echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกพาสเวิร์ดใหม่ให้เหมือนกัน',function(){
                             window.location=\"" . site_url . "president_change_password_form.php\"
                        })
                                    </script>";
                            }else{
                                $password = $_POST['newPassword'];
                                if(  preg_match( '~[a-z]~', $password) &&
                                    preg_match( '~\d~', $password) &&
                                    (strlen( $password) > 6)){


                                    $user->user_id = $_SESSION['USER']['user_id'][0];
                                    $user->username = $_SESSION['USER']['username'][0];
                                    $user->password = $password;
                                    $user->user_first_name = $_SESSION['USER']['user_first_name'][0];
                                    $user->user_last_name = $_SESSION['USER']['user_last_name'][0];
                                    $user->user_image = $_SESSION['USER']['user_image'][0];
                                    $user->major_id = $_SESSION['USER']['major_id'][0];
                                    $user->user_tel = $_SESSION['USER']['user_tel'][0];
                                    $user->time_create = $_SESSION['USER']['time_create'][0];
                                    $user->time_update = date("Y-m-d H:i:s");

                                    $userdao->update($user);

                                    $_SESSION['USER']['password'][0] = $user->password;

                                    echo "<script type='text/javascript'>
                        bootbox.alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว',function(){
                            window.location=\"" . site_url . "president_profile.php?onMal=1\"
                        })
                        </script>";


                                } else {
                                    echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณาสร้างพาสเวิร์ดใหม่ โดยใช้ภาษาอังกฤษ ตัวเลข ผสมกันอย่างน้อย 6 ตัวอักษร เช่น pass1234',function(){
                             window.location=\"" . site_url . "president_change_password_form.php\"
                        })
                                    </script>";
                                }
                            }

                        }

	    }
    }
?>