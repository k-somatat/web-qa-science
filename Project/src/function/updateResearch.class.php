<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("./commons/page-header1.0.php");


class updateResearch
{
    public function __construct()
    {

        $researchDAO = new ResearchDAO();
        $research = new Research();

        $rid = $_GET['id'];


            switch ($_GET['research_type_id']) {
                case 1 :
                    if ($_POST['subject'] && $_POST['institution'] && $_POST['date_start'] && $_POST['date_end'] && $_POST['location'] != "") {

                        if(!empty($_POST['date_end'])){

                            $splitDate = explode('-',$_POST['date_start']);
                            $day = $splitDate[0];
                            $month = $splitDate[1];
                            $year = $splitDate[2];

                            $splitDateEnd = explode('-',$_POST['date_end']);
                            $end_day = $splitDateEnd[0];
                            $end_month = $splitDateEnd[1];
                            $end_year = $splitDateEnd[2];

                            if($year <= $end_year  ){
                                if($year == $end_year){
                                    if($month<= $end_month){
                                        if($month == $end_month){
                                            if($day <= $end_day){
                                            }else{
                                                echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                               window.location=\"" . site_url . "research_form.php?rid=$rid\"
                                    })
                                    </script>";
                                                exit;
                                            }
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                          window.location=\"" . site_url . "research_form.php?rid=$rid\"
                            })
                            </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
          window.location=\"" . site_url . "research_form.php?rid=$rid\"
                })
                </script>";
                                exit;
                            }
                        }
                        $research->research_id = $_GET['id'];
                        $research->research_name = $_POST['subject'];
    //                    $research->research_author = $_POST['author'];
//                        $user = explode(" ",$_SESSION['USER']['user_first_name'][0]);
                        $research->research_author = $_SESSION['USER']['user_first_name'][0]." ".$_SESSION['USER']['user_last_name'][0];
                        $research->research_institution = $_POST['institution'];

                        $split_date = explode('-',$_POST['date_start']);
                        $split_date_end = explode('-',$_POST['date_end']);
                        $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
                        $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

                        $research->research_date = $date;
                        $research->research_date_end = $date_end;


                        $research->research_location = $_POST['location'];
                        $budget = trim($_POST['budget']);
                        if($budget != null){
                            $research->research_budget = $budget;
                        }else{
                            $research->research_budget = null;
                        }
    //                    $research->research_budget = $_POST['budget'];

                        $upload = new UploadAction();
                        $path = $upload->UploadSingleFile('file', 'research');

                        if($_FILES['file']["size"] == 0){
                            $researchs = $researchDAO->findbyPK($research->research_id);

                            if($researchs['research_document'] != ''){
                                $research->research_document = $researchs['research_document'][0];
                            }
                        }else{
                            $research->research_document = $path['path'];
                        }

                        $res = new Research();
                        $res = $researchDAO->findbyPK($research->research_id);

                        $research->research_time_create = $res['research_time_create'][0];
                        $research->research_time_update = date('Y-m-d H:i:s');

                        $research->research_type_id = 1;
                        $research->user_id = $_SESSION['USER']['user_id'][0];

                        $result = $researchDAO->update($research);

                        echo "<script type='text/javascript'>
                            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                                window.location=\"" . site_url . "research_academic.php\"
                            })
                            </script>";
                    } else {
                        echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "research_form.php?rid=$rid\"
                        })
                        </script>";

                        exit;
                    }
                    break;
                case 2 :

                    if ($_POST['subject'] && $_POST['institution'] && $_POST['date_start'] && $_POST['date_end'] != "") {

                        if(!empty($_POST['date_end'])){

                            $splitDate = explode('-',$_POST['date_start']);
                            $day = $splitDate[0];
                            $month = $splitDate[1];
                            $year = $splitDate[2];

                            $splitDateEnd = explode('-',$_POST['date_end']);
                            $end_day = $splitDateEnd[0];
                            $end_month = $splitDateEnd[1];
                            $end_year = $splitDateEnd[2];

                            if($year <= $end_year  ){
                                if($year == $end_year){
                                    if($month<= $end_month){
                                        if($month == $end_month){
                                            if($day <= $end_day){
                                            }else{
                                                echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                               window.location=\"" . site_url . "research_form.php?rid=$rid\"
                                    })
                                    </script>";
                                                exit;
                                            }
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                          window.location=\"" . site_url . "research_form.php?rid=$rid\"
                            })
                            </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
          window.location=\"" . site_url . "research_form.php?rid=$rid\"
                })
                </script>";
                                exit;
                            }
                        }

                        $research->research_id = $_GET['id'];
                        $research->research_name = $_POST['subject'];
                        $research->research_author = $_SESSION['USER']['user_first_name'][0]." ".$_SESSION['USER']['user_last_name'][0];
                        $research->research_institution = $_POST['institution'];

                        $split_date = explode('-',$_POST['date_start']);
                        $split_date_end = explode('-',$_POST['date_end']);
                        $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
                        $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

                        $research->research_date = $date;
                        $research->research_date_end = $date_end;

                        $budget = trim($_POST['budget']);
                        if($budget != null){
                            $research->research_budget = $budget;
                        }else{
                            $research->research_budget = null;
                        }
    //                    $research->research_budget = $_POST['budget'];
                        $research->research_type_id =2;
                        $research->user_id = $_SESSION['USER']['user_id'][0];

                        $upload = new UploadAction();
                        $path = $upload->UploadSingleFile('file', 'research');

                        if($_FILES['file']["size"] == 0){
                            $researchs = $researchDAO->findbyPK($research->research_id);

                            if($researchs['research_document'] != ''){
                                $research->research_document = $researchs['research_document'][0];
                            }
                        }else{
                            $research->research_document = $path['path'];
                        }


    //                    $research->research_document = $path['path'];

                        $researchDAO->update($research);

                        echo "<script type='text/javascript'>
                            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                                window.location=\"" . site_url . "research_funded.php\"
                            })
                            </script>";
                    } else {
                        echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "research_form.php?rid=$rid\"
                        })
                        </script>";

                        exit;
                    }
                    break;
                case 3 :
                    $page = "research_appiled.php";

                    if ($_POST['subject'] && $_POST['institution'] && $_POST['detail'] && $_POST['date_start'] && $_POST['date_end'] != "") {


                        if(!empty($_POST['date_end'])){

                            $splitDate = explode('-',$_POST['date_start']);
                            $day = $splitDate[0];
                            $month = $splitDate[1];
                            $year = $splitDate[2];

                            $splitDateEnd = explode('-',$_POST['date_end']);
                            $end_day = $splitDateEnd[0];
                            $end_month = $splitDateEnd[1];
                            $end_year = $splitDateEnd[2];

                            if($year <= $end_year  ){
                                if($year == $end_year){
                                    if($month<= $end_month){
                                        if($month == $end_month){
                                            if($day <= $end_day){
                                            }else{
                                                echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                               window.location=\"" . site_url . "research_form.php?rid=$rid\"
                                    })
                                    </script>";
                                                exit;
                                            }
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                          window.location=\"" . site_url . "research_form.php?rid=$rid\"
                            })
                            </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
          window.location=\"" . site_url . "research_form.php?rid=$rid\"
                })
                </script>";
                                exit;
                            }
                        }

                        $research->research_id = $_GET['id'];
                        $research->research_name = $_POST['subject'];
                        $research->research_author = $_SESSION['USER']['user_first_name'][0]." ".$_SESSION['USER']['user_last_name'][0];
                        $research->research_institution = $_POST['institution'];

                        $split_date = explode('-',$_POST['date_start']);
                        $split_date_end = explode('-',$_POST['date_end']);
                        $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
                        $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

                        $research->research_date = $date;
                        $research->research_date_end = $date_end;

                        $research->research_detail = $_POST['detail'];
                        $research->research_budget = $_POST['budget'];
                        $research->research_type_id = 3;
                        $research->user_id = $_SESSION['USER']['user_id'][0];

                        $upload = new UploadAction();
                        $path = $upload->UploadSingleFile('file', 'research');

                        if($_FILES['file']["size"] == 0){
                            $researchs = $researchDAO->findbyPK($research->research_id);

                            if($researchs['research_document'] != ''){
                                $research->research_document = $researchs['research_document'][0];
                            }
                        }else{
                            $research->research_document = $path['path'];
                        }

    //                    $research->research_document = $path['path'];

                        $researchDAO->update($research);


                        echo "<script type='text/javascript'>
                            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                                window.location=\"" . site_url . "research_applied.php\"
                            })
                            </script>";
                    } else {
                        echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "research_form.php?rid=$rid\"
                        })
                        </script>";

                        exit;
                    }

                    break;
            }


    }
}


