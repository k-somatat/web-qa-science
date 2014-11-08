<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("president/commons/page-header1.0.php");

class president_deleteAdvisor {
    public function __construct(){
        switch($_GET['cur']){
            case 1 :
                $page = "president_teach_advisor_project.php";
                break;
            case 2 :
                $page = "president_teach_advisor_cooperative_education.php";
                break;
            case 3 :
                $page = "president_teach_advisor_class.php";
                break;
        }
        if($_GET['aid'] != ""){
            $advisorDAO = new AdvisorDAO();
            $advisor = new Advisor();

            $advisor->advisor_id = $_GET['aid'];

            $advisorDAO->delete($advisor);



            echo "<script type='text/javascript'>
            bootbox.alert('ลบข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "$page\"
            })
            </script>";
        }else{

            echo "<script type='text/javascript'>
            bootbox.alert('ไม่สามารถลบข้อมูลได้',function(){
                window.location=\"" . site_url . "$page\"
            })
            </script>";


        }

    }

} 