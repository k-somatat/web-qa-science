<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("./commons/page-header1.0.php");

class deleteResearch {
    public function __construct(){
        switch($_GET['cur']){
            case 1 :
                $page = "research_academic.php";
                break;
            case 2 :
                $page = "research_funded.php";
                break;
            case 3 :
                $page = "research_applied.php";
                break;
        }
        if($_GET['rid'] != ""){
            $researchDAO = new ResearchDAO();
            $research = new Research();

            $research->research_id = $_GET['rid'];

            $researchDAO->delete($research);



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