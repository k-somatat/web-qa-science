<?php
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("admin/commons/page-header1.0.php");

class admin_createTQF
{
    public function __construct()
    {
        if ($_POST['subject_name'] && $_POST['semester'] && $_POST['date'] && $_POST['userAuthor'] != '' ) {

        $tqfDAO = new TqfDAO();

        $tqf = new Tqf();

            $tqf->tqf_subject = trim($_POST['subject_name']);
            $tqf->tqf_semester = trim($_POST['semester']);

            $split_date = explode('-',$_POST['date']);
            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];

            $tqf->tqf_subject_update = $date;

            $upload = new UploadAction();
            $path = $upload->UploadSingleFile('TQF3','TQF');
            $path2 = $upload->UploadSingleFile('TQF5','TQF');

            $tqf->tqf_document_tqf3 = $path['path'];
            $tqf->tqf_document_tqf5 = $path2['path'];
            $tqf->user_id = $_POST['userAuthor'];

            $result = $tqfDAO->insert($tqf);

            echo "<script type='text/javascript'>
            bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_TQF.php\"
            })
            </script>";

        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "admin_TQF_form.php\"
            })
            </script>";

        }
    }
}
