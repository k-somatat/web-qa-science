<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("admin/commons/page-header1.0.php");

class deleteUser {
    public function __construct(){

        $userId = $_SESSION['USER']['user_id'][0];
        $userRoleDAO = new UserRoleDAO();
        $userROle = new UserRole();
        $userROle = $userRoleDAO->findbyUserId($userId);
        $permission = $userROle['role_id'][0];

        if($permission == 01){
            if($_GET['uid'] != ""){
                $userDAO = new UserDAO();

                $users = new User();

                $users->user_id = $_GET['uid'];

                $userDAO->delete($users);

                echo "<script type='text/javascript'>
                bootbox.alert('ลบข้อมูลเรียบร้อยแล้ว',function(){
                    window.location=\"" . site_url . "admin_user.php\"
                })
                </script>";
            }else{

                echo "<script type='text/javascript'>
                bootbox.alert('ไม่สามารถลบข้อมูลได้',function(){
                    window.location=\"" . site_url . "admin_user.php\"
                })
                </script>";
            }
        }else{
            echo "<script type='text/javascript'>
                bootbox.alert('คุณไม่มีสิทธิ์ในการลบข้อมูล',function(){
//                    window.location=\"" . site_url . "admin_user.php\"
                })
                </script>";
        }
    }

} 