<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 2:56 PM
 */

include("president/commons/page-header1.0.php");
class president_createResearch
{

    public function __construct()
    {
            $researchDAO = new ResearchDAO();

            $research = new Research();

            $upload = new UploadAction();
            $path = $upload->UploadSingleFile('file', 'research');


            switch ($_POST['sdd']) {
                case 0 :
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
                                       window.location=\"" . site_url . "president_teach_research_form.php\"
                                    })
                                    </script>";
                                                exit;
                                            }
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                               window.location=\"" . site_url . "president_teach_research_form.php\"
                            })
                            </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                   window.location=\"" . site_url . "president_teach_research_form.php\"
                })
                </script>";
                                exit;
                            }
                        }

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
    //                    $research->research_date = $_POST['date_only'];
                        $research->research_location = $_POST['location'];
                        $budget = trim($_POST['budget']);
                        if($budget != null){
                            $research->research_budget = $budget;
                        }else{
                            $research->research_budget = null;
                        }

                        $research->research_document = $path['path'];
                        $research->research_time_create = date('Y-m-d H:i:s');
                        $research->research_type_id = 1;
                        $research->user_id = $_SESSION['USER']['user_id'][0];

                        $researchDAO->insert($research);

                        echo "<script type='text/javascript'>
                        bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                            window.location=\"" . site_url . "president_teach_research_academic.php\"
                        })
                        </script>";

                    } else {
                        echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "president_teach_research_form.php\"
                        })
                        </script>";

                        exit;
                    }


                    break;
                case 1 :

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
                                       window.location=\"" . site_url . "president_teach_research_form.php\"
                                    })
                                    </script>";
                                                exit;
                                            }
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                               window.location=\"" . site_url . "president_teach_research_form.php\"
                            })
                            </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                   window.location=\"" . site_url . "president_teach_research_form.php\"
                })
                </script>";
                                exit;
                            }
                        }

                        $research->research_name = $_POST['subject'];
    //                    $research->research_author = $_POST['author'];
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

                        $research->research_document = $path['path'];
                        $research->research_time_create = date('Y-m-d H:i:s');
                        $research->research_type_id = 2;
                        $research->user_id = $_SESSION['USER']['user_id'][0];

                        $researchDAO->insert($research);

                        echo "<script type='text/javascript'>
                            bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                                window.location=\"" . site_url . "president_teach_research_funded.php\"
                            })
                            </script>";
                    } else {
                        echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "president_teach_research_form.php\"
                        })
                        </script>";

                        exit;
                    }
                    break;
                case 2 :

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
                                       window.location=\"" . site_url . "president_teach_research_form.php\"
                                    })
                                    </script>";
                                                exit;
                                            }
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                               window.location=\"" . site_url . "president_teach_research_form.php\"
                            })
                            </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                   window.location=\"" . site_url . "president_teach_research_form.php\"
                })
                </script>";
                                exit;
                            }
                        }

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
                        $research->research_document = $path['path'];
                        $research->research_time_create = date('Y-m-d H:i:s');
                        $research->research_type_id = 3;
                        $research->user_id = $_SESSION['USER']['user_id'][0];

                        $researchDAO->insert($research);


                        echo "<script type='text/javascript'>
                            bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                                window.location=\"" . site_url . "president_teach_research_applied.php\"
                            })
                            </script>";

                    } else {
                        echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "president_teach_research_form.php\"
                        })
                        </script>";

                        exit;
                    }
                    break;
            }

    }

    public function onSuccess()
    {
        echo "<script type='text/javascript'>
                bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว !')
            </script>";

        echo "<script type='text/javascript'>
                window.location=\"" . site_url . "research.php\";
            </script>";
    }

    public function onFail()
    {
        echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน')
            </script>";

        echo "<script type='text/javascript'>
            window.location=\"" . site_url . "research_form.php\"
        </script>";
    }
}