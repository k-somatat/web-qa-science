<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("./commons/page-header1.0.php");

class updateConference
{
    public function __construct()
    {
        $cid =$_GET['id'];

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
                                         window.location=\"" . site_url . "conference_form.php?cid=$cid\"
                                    })
                                    </script>";
                                    exit;
                                }
                            }
                        }else{
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                                window.location=\"" . site_url . "conference_form.php?cid=$cid\"
                            })
                            </script>";
                            exit;
                        }
                    }
                }else{
                    echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                    window.location=\"" . site_url . "conference_form.php?cid=$cid\"
                })
                </script>";
                    exit;
                }
            }

            $conferenceDao = new ConferenceDAO();

            $conference = new Conference();

            $conference->conference_id = $_GET['id'];
            $conference->conference_name = $_POST['task'];
            $conference->conference_institution = $_POST['major'];

            $split_date = explode('-',$_POST['date']);
            $split_date_end = explode('-',$_POST['date_end']);
            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
            $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

            $conference->conference_date = $date;
            $conference->conference_date_end = $date_end;

            $conference->conference_location = $_POST['location'];
            $conference->conference_topic = trim($_POST['topic']);
            $budget = trim($_POST['budget']);

            if ($budget != null) {
                $conference->conference_budget = $budget;
            } else {
                $conference->conference_budget = null;
            }

            $conference->conference_tech_name = $_SESSION['USER']['user_first_name'][0] . " " . $_SESSION['USER']['user_last_name'][0];

            $upload = new UploadAction();
            $path = $upload->UploadSingleFile('file', 'conference');
            $conferences = $conferenceDao->findbyPK($conference->conference_id);

            $conference->conference_time_create = $conferences['conference_time_create'][0];
            $conference->conference_time_update = date('Y-m-d H:i:s');

            if ($_FILES['file']["size"] == 0) {


                if ($conferences['conference_document'] != '') {
                    $conference->conference_document = $conferences['conference_document'][0];
                }
            } else {
                $conference->conference_document = $path['path'];
            }
            // user not permission this case
            if($conferences['user_id'] != $_SESSION['USER']['user_id']){
                echo "<script type='text/javascript'>
                    bootbox.alert('คุณไม่มีสิทธิ์แก้ไขข้อมูลดังกล่าวได้',function(){
                        window.location=\"" . site_url . "conference.php\"
                    })
                    </script>";
            }else{
            $conference->user_id = $_SESSION['USER']['user_id'][0];

//            echo $conference->conference_name;
//
            $result = $conferenceDao->update($conference);


            echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "conference.php\"
            })
            </script>";
            }
        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "conference_form.php?cid=$cid\"
            })
            </script>";
        }

    }
}


