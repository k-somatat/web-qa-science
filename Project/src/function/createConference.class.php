<?php
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("./commons/page-header1.0.php");

class createConference
{
    public function __construct()
    {
        if ($_POST['task'] && $_POST['major'] && $_POST['date'] && $_POST['location'] != "") {

            if(!empty($_POST['date_end'])){

                $splitDate = explode('-',$_POST['date']);
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
                                        window.location=\"" . site_url . "conference_form.php\"
                                    })
                                    </script>";
                                    exit;
                                }
                            }
                        }else{
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                                window.location=\"" . site_url . "conference_form.php\"
                            })
                            </script>";
                            exit;
                        }
                    }
                }else{
                    echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                    window.location=\"" . site_url . "conference_form.php\"
                })
                </script>";
                    exit;
                }
            }

                $conferenceDao = new ConferenceDAO();

                $conference = new Conference();

                $conference->conference_name = trim($_POST['task']);
                $conference->conference_institution = trim($_POST['major']);

                $split_date = explode('-',$_POST['date']);
            $split_date_end = explode('-',$_POST['date_end']);
            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
            $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

            $conference->conference_date = $date;
            $conference->conference_date_end = $date_end;
                $conference->conference_location = trim($_POST['location']);
                $conference->conference_topic = trim($_POST['topic']);
                $budget = trim($_POST['budget']);
                if($budget != null){
                $conference->conference_budget = $budget;
                }else{
                    $conference->conference_budget = null;
                }

                $conference->conference_tech_name = $_SESSION['USER']['user_first_name'][0]." ".$_SESSION['USER']['user_last_name'][0];

                $upload = new UploadAction();
                $path = $upload->UploadSingleFile('file','conference');

                $conference->conference_document = $path['path'];
                $conference->conference_time_create = date('Y-m-d H:i:s');
                $conference->user_id = $_SESSION['USER']['user_id'][0];

                $result = $conferenceDao->insert($conference);

                echo "<script type='text/javascript'>
                bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                    window.location=\"" . site_url . "conference.php\"
                })
                </script>";

        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "conference_form.php\"
            })
            </script>";

        }
    }
}
