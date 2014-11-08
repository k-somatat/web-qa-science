<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("admin/commons/page-header1.0.php");

class updatePermission {
    public function __construct(){

        $userId = $_GET['uid'];
        $role_id = $_GET['pid'];
        echo $_POST['permission'];

        $userRoleDAO = new UserRoleDAO();
        $userROle = new UserRole();

        $usersRole = $userRoleDAO->findbyUserId($userId);


        if(!empty($usersRole['user_id'][0])){

            $userROle->user_id = $userId;
            $userROle->role_id = $role_id;

            $userRoleDAO->update($userROle);


                echo "<script type='text/javascript'>
                bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                    window.location=\"" . site_url . "admin_user_permission.php\"
                })
                </script>";
        }else{
            $userROle->user_id = $userId;
            $userROle->role_id = $role_id;

            $userRoleDAO->insert($userROle);


            echo "<script type='text/javascript'>
                bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                    window.location=\"" . site_url . "admin_user_permission.php\"
                })
                </script>";
        }

    }

} 