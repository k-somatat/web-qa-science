<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("./commons/page-header1.0.php");

class deleteTQF {
    public function __construct(){
        if($_GET['tid'] != ""){
            $tqfDAO = new TqfDAO();
            $tqf = new Tqf();

            $tqf->tqf_id = $_GET['tid'];

            $tqfDAO->delete($tqf);

            echo "<script type='text/javascript'>
            bootbox.alert('ลบข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "tqf.php\"
            })
            </script>";
        }else{

            echo "<script type='text/javascript'>
            bootbox.alert('ไม่สามารถลบข้อมูลได้',function(){
                window.location=\"" . site_url . "tqf.php\"
            })
            </script>";


        }
    }

} 