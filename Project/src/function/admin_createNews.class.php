<?php
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("admin/commons/page-header1.0.php");

class admin_createNews
{
    public function __construct()
    {
        if ($_POST['news_headline'] && $_POST['date'] != '' ) {

        $newsDAO = new NewsDAO();

        $news = new News();

            $news->news_headline = trim($_POST['news_headline']);
            $news->news_detail = trim($_POST['news_detail']);
            $splitDate = explode("-",trim($_POST['date']));

            $news->news_time_create = $splitDate[2]."-".$splitDate[1]."-".$splitDate[0];

            $upload = new UploadAction();
            $path = $upload->UploadSingleFile('file','News');

            $news->news_document = $path['path'];
            $news->user_create = $_SESSION['USER']['user_id'][0];

            $result = $newsDAO->insert($news);

            echo "<script type='text/javascript'>
            bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_index.php\"
            })
            </script>";

        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "admin_news_form.php\"
            })
            </script>";

        }
    }
}
