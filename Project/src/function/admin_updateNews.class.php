<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("admin/commons/page-header1.0.php");

class admin_updateNews
{
    public function __construct()
    {
        $nid = $_GET['id'];

        if ($_POST['news_headline'] && $_POST['date'] != '' ) {

            $newsDAO = new NewsDAO();
            $news = new News();

            $news->news_id = $_GET['id'];
            $news->news_headline = trim($_POST['news_headline']);
            $news->news_detail = trim($_POST['news_detail']);
            $splitDate = explode("-",trim($_POST['date']));

            $news_query = $newsDAO->findbyNewsId($nid);

            $news->news_time_create = $news_query['news_time_create'][0];
            $news->news_time_update = $splitDate[2]."-".$splitDate[1]."-".$splitDate[0];

            $upload = new UploadAction();
            $path = $upload->UploadSingleFile('file','News');

            if($_FILES['file']['size'] == 0){
                if($news_query['news_document'][0] != ''){
                $news->news_document = $news_query['news_document'][0];
                }
            }else{
                $news->news_document = $path['path'];
            }

            $news->user_create = $news_query['user_create'][0];
            $news->user_update = $_SESSION['USER']['user_id'][0];



            $result = $newsDAO->update($news);


            echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_news.php\"
            })
            </script>";

        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "admin_news_form.php?nid=$nid\"
            })
            </script>";
        }

    }
}


