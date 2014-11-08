<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("./commons/page-header1.0.php");

class updateTQF
{
    public function __construct()
    {
        $tid = $_GET['id'];

        if ($_POST['subject_name'] && $_POST['semester'] && $_POST['date'] != '' ) {

            $tqfDAO = new TqfDAO();
            $tqf = new Tqf();



            $tqf->tqf_id = $_GET['id'];

            $tqfs = $tqfDAO->findbyPK($tqf->tqf_id);

            $tqf->tqf_subject = trim($_POST['subject_name']);
            $tqf->tqf_semester = trim($_POST['semester']);

            $split_date = explode('-',$_POST['date']);
            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];

            $tqf->tqf_subject_update = $date;

            $tqf->tqf_time_update = date('y-m-d h:i:s');
            $tqf->tqf_time_create = $tqfs['tqf_time_create'][0];

            $upload = new UploadAction();
            $path = $upload->UploadSingleFile('TQF3','TQF');
            $path2 = $upload->UploadSingleFile('TQF5','TQF');

            if ($_FILES['TQF3']["size"] == 0) {
                if ($tqfs['tqf_document_tqf3'][0] != '') {
                    $tqf->tqf_document_tqf3 = $tqfs['tqf_document_tqf3'][0];
                }
            } else {
                $tqf->tqf_document_tqf3 = $path['path'];
            }

            if ($_FILES['TQF5']["size"] == 0) {
                if ($tqfs['tqf_document_tqf5'][0] != '') {
                    $tqf->tqf_document_tqf5 = $tqfs['tqf_document_tqf5'][0];
                }
            } else {
                $tqf->tqf_document_tqf5 = $path2['path'];
            }

            $tqf->user_id = $_SESSION['USER']['user_id'][0];


            $result = $tqfDAO->update($tqf);


            echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "tqf.php\"
            })
            </script>";
        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "tqf_form.php?tid=$tid\"
            })
            </script>";
        }

    }
}


