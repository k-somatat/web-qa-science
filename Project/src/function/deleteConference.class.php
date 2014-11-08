<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("./commons/page-header1.0.php");

class deleteConference {
    public function __construct(){
        if($_GET['cid'] != ""){
            $conferenceDAO = new ConferenceDAO();
            $conference = new Conference();

            $conference->conference_id = $_GET['cid'];

            $conferenceDAO->delete($conference);

            echo "<script type='text/javascript'>
            bootbox.alert('ลบข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "conference.php\"
            })
            </script>";
        }else{

            echo "<script type='text/javascript'>
            bootbox.alert('ไม่สามารถลบข้อมูลได้',function(){
                window.location=\"" . site_url . "conference.php\"
            })
            </script>";


        }
    }

} 