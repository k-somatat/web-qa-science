<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("admin/commons/page-header1.0.php");

class admin_deleteNews {
    public function __construct(){

        if($_GET['nid'] != ""){
            $newsDAO = new NewsDAO();
            $news = new News();

            $news->news_id = $_GET['nid'];

            $newsDAO->delete($news);



            echo "<script type='text/javascript'>
            bootbox.alert('ลบข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_news.php\"
            })
            </script>";
        }else{

            echo "<script type='text/javascript'>
            bootbox.alert('ไม่สามารถลบข้อมูลได้',function(){
                window.location=\"" . site_url . "admin_news\"
            })
            </script>";


        }

    }

} 