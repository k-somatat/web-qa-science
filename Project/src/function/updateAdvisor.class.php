<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("./commons/page-header1.0.php");

class updateAdvisor
{
    public function __construct()
    {

        $aid = $_GET['id'];

        $advisorDAO = new AdvisorDAO();
        $advisor = new Advisor();


        switch ($_GET['advisor_type_id']) {

            case 1 :
                if ($_POST['name'] && $_POST['first_name'] && $_POST['last_name'] && $_POST['year'] != "") {
                    if ($_POST['amount'] == "1") {
                        $gender2 = $_POST['first_name2'];
                        $gender3 = $_POST['first_name3'];
                    } else if ($_POST['amount'] == "2") {
                        if($_POST['first_name2'] && $_POST['last_name2'] != ""){
                        $gender2 = $_POST['gender2'];
                        $gender3 = $_POST['first_name3'];
                        }else{
                            echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                        window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                                    })
                                    </script>";
                            exit;
                        }
                    } else if ($_POST['amount'] == "3") {
                        if($_POST['first_name2'] && $_POST['last_name2'] && $_POST['first_name3'] && $_POST['last_name3'] != ""){
                        $gender2 = $_POST['gender2'];
                        $gender3 = $_POST['gender3'];
                        }else{
                            echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                        window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                                    })
                                    </script>";
                            exit;
                        }
                    }
                    $advisor->advisor_id = $_GET['id'];
                    $advisor->advisor_name = $_POST['name'];
                    $advisor->advisor_author = $_POST['gender'] . " " . $_POST['first_name'] . " " . $_POST['last_name'];
                    $advisor->advisor_author2 = $gender2 . " " . $_POST['first_name2'] . " " . $_POST['last_name2'];
                    $advisor->advisor_author3 = $gender3 . " " . $_POST['first_name3'] . " " . $_POST['last_name3'];
                    $advisor->advisor_amount = $_POST['amount'];
                    $advisor->advisor_year = $_POST['year'];

                    $upload = new UploadAction();
                    $path = $upload->UploadSingleFile('file', 'advisor');


                    $advisors = $advisorDAO->findbyPK($advisor->advisor_id);
                    if ($_FILES['file']["size"] == 0) {

                        if ($advisors['advisor_document'] != '') {
                            $advisor->advisor_document = $advisors['advisor_document'][0];
                        }
                    } else {
                        $advisor->advisor_document = $path['path'];
                    }

                    $advisor->advisor_time_create = $advisors['advisor_time_update'];
                    $advisor->advisor_time_update = date("Y-m-d H:i:s");
                    $advisor->advisor_type_id = 1;
                    $advisor->user_id = $_SESSION['USER']['user_id'][0];

                    $advisorDAO->update($advisor);


                    echo "<script type='text/javascript'>
                            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                                window.location=\"" . site_url . "advisor_project.php\"
                            })
                            </script>";

                } else {

                    echo "<script type='text/javascript'>
                    bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                        window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                    })
                    </script>";
                    exit;
                }
                break;

            case 2 :

                if ($_POST['name'] && $_POST['first_name'] && $_POST['last_name'] && $_POST['year'] && $_POST['location']  != "") {
                    if ($_POST['amount'] == "1") {
                        $gender2 = $_POST['first_name2'];
                        $gender3 = $_POST['first_name3'];
                        $gender4 = $_POST['first_name4'];
                        $gender5 = $_POST['first_name5'];
                    } else if ($_POST['amount'] == "2") {
                        if($_POST['first_name2'] && $_POST['last_name2'] != ""){
                        $gender2 = $_POST['gender2'];
                        $gender3 = $_POST['first_name3'];
                        $gender4 = $_POST['first_name4'];
                        $gender5 = $_POST['first_name5'];
                        }else{
                            echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                        window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                                    })
                                    </script>";
                            exit;
                        }
                    } else if ($_POST['amount'] == "3") {
                        if($_POST['first_name2'] && $_POST['last_name2'] && $_POST['first_name3'] && $_POST['last_name3'] != ""){
                        $gender2 = $_POST['gender2'];
                        $gender3 = $_POST['gender3'];
                        $gender4 = $_POST['first_name4'];
                        $gender5 = $_POST['first_name5'];
                        }else{
                            echo "<script type='text/javascript'>
                                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                            window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                                        })
                                        </script>";
                            exit;
                        }
                    } else if ($_POST['amount'] == "4") {
                        if($_POST['first_name2'] && $_POST['last_name2'] && $_POST['first_name3'] && $_POST['last_name3']
                            && $_POST['first_name4'] && $_POST['last_name4']!= ""){
                        $gender2 = $_POST['gender2'];
                        $gender3 = $_POST['gender3'];
                        $gender4 = $_POST['gender4'];
                        $gender5 = $_POST['first_name5'];
                        }else{
                            echo "<script type='text/javascript'>
                                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                                window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                                            })
                                            </script>";
                            exit;
                        }
                    } else if ($_POST['amount'] == "5") {
                        if($_POST['first_name2'] && $_POST['last_name2'] && $_POST['first_name3'] && $_POST['last_name3']
                            && $_POST['first_name4'] && $_POST['last_name4'] && $_POST['first_name5'] && $_POST['last_name5']!= ""){
                        $gender2 = $_POST['gender2'];
                        $gender3 = $_POST['gender3'];
                        $gender4 = $_POST['gender4'];
                        $gender5 = $_POST['gender5'];
                        }else{
                            echo "<script type='text/javascript'>
                                                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                                            window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                                                        })
                                                        </script>";
                            exit;
                        }
                    }

                    $advisor->advisor_id = $_GET['id'];
                    $advisor->advisor_name = $_POST['name'];
                    $advisor->advisor_author = $_POST['gender'] . " " . $_POST['first_name'] . " " . $_POST['last_name'];
                    $advisor->advisor_author2 = $gender2 . " " . $_POST['first_name2'] . " " . $_POST['last_name2'];
                    $advisor->advisor_author3 = $gender3 . " " . $_POST['first_name3'] . " " . $_POST['last_name3'];
                    $advisor->advisor_author4 = $gender4 . " " . $_POST['first_name4'] . " " . $_POST['last_name4'];
                    $advisor->advisor_author5 = $gender5 . " " . $_POST['first_name5'] . " " . $_POST['last_name5'];
                    $advisor->advisor_amount = $_POST['amount'];
                    $advisor->advisor_year = $_POST['year'];
                    $advisor->advisor_location = $_POST['location'];

                    $upload = new UploadAction();
                    $path = $upload->UploadSingleFile('file', 'advisor');

                    $advisors = $advisorDAO->findbyPK($advisor->advisor_id);

                    if ($_FILES['file']["size"] == 0) {

                        if ($advisors['advisor_document'] != '') {
                            $advisor->advisor_document = $advisors['advisor_document'][0];
                        }
                    } else {
                        $advisor->advisor_document = $path['path'];
                    }

//                    $advisor->advisor_document = $path['path'];
                    $advisor->advisor_time_create = $advisors['advisor_time_update'];
                    $advisor->advisor_time_update = date("Y-m-d H:i:s");
                    $advisor->advisor_type_id = 2;
                    $advisor->user_id = $_SESSION['USER']['user_id'][0];

                    $advisorDAO->update($advisor);


                    echo "<script type='text/javascript'>
                        bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                            window.location=\"" . site_url . "advisor_cooperative_education.php\"
                        })
                        </script>";
                } else {

                    echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                        })
                        </script>";
                    exit;
                }
                break;
            case 3 :

                if ($_POST['detail'] && $_POST['classYear'] && $_POST['amountPerson'] && $_POST['date'] != "") {

                    $advisor->advisor_id = $_GET['id'];
                    $advisor->advisor_name = $_POST['detail'];
                    $advisor->advisor_year = $_POST['classYear'];
                    $advisor->advisor_amount = $_POST['amountPerson'];

                    $split_date = explode('-',$_POST['date']);
                    $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];

                    $advisor->advisor_date = $date;

                    $upload = new UploadAction();
                    $path = $upload->UploadSingleFile('file', 'advisor');


                    $advisors = $advisorDAO->findbyPK($advisor->advisor_id);
                    if ($_FILES['file']["size"] == 0) {


                        if ($advisors['advisor_document'] != '') {
                            $advisor->advisor_document = $advisors['advisor_document'][0];
                        }
                    } else {
                        $advisor->advisor_document = $path['path'];
                    }


//                    $advisor->advisor_document = $path['path'];
                    $advisor->advisor_time_create = $advisors['advisor_time_update'];
                    $advisor->advisor_time_update = date("Y-m-d H:i:s");
                    $advisor->advisor_type_id = 3;
                    $advisor->user_id = $_SESSION['USER']['user_id'][0];

                    $advisorDAO->update($advisor);


                    echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "advisor_class.php\"
            })
            </script>";


                } else {

                    echo "<script type='text/javascript'>
                        bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                            window.location=\"" . site_url . "advisor_form.php?aid=$aid\"
                        })
                        </script>";
                    exit;
                }

                break;
        }


//


    }
}


