<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 1/23/14
 * Time: 2:56 PM
 */

include("admin/commons/page-header1.0.php");
class updateProject
{

    public function __construct()
    {


        $pid = $_GET['id'];
        if($_GET['Notype'] == 1){

            if($_POST['name'] != ''){
                $planDAO = new PlanDAO();
                $plan = new Plan();
                $planQuery = $planDAO->findbyPlanId($pid);

                $plan->plan_id = $planQuery['plan_id'][0];
                $plan->plan_name = $_POST['name'];
                $plan->plan_time_create = $planQuery['plan_time_create'][0];
                $plan->plan_time_update = date('Y-m-d H:i:s');
                $plan->plan_user_create = $planQuery['plan_user_create'][0];
                $plan->plan_user_update = $_SESSION['USER']['user_id'][0];

                $result = $planDAO->update($plan);

                echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_plan.php\"
            })
            </script>";

            }else{
                echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?plid=$pid\"
                            })
                            </script>";
            }


        }else{

            if ($_POST['name'] && $_POST['date'] && $_POST['date_end'] != ""
            ) {

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
                              window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                                    })
                                    </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                          window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                                exit;
                            }
                        }
                    }else{
                        echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
         window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                })
                </script>";
                        exit;
                    }
                }


                $projectDAO = new ProjectDAO();

                $project = new Project();

                $upload = new UploadAction();
                $path_approve = $upload->UploadSingleFile('approve', 'projectApprove');
                $path_charges = $upload->UploadSingleFile('charges', 'projectCharges');
                $path_conclusion = $upload->UploadSingleFile('conclusion', 'projectConclusion');
                $path_image = $upload->UploadSingleFile('image', 'projectImage');


                switch ($_POST['sdd']) {
                    case 0 :

                        if($_POST['amount'] == 2 && $_POST['userAuthor2'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                            exit;
                        }else if($_POST['amount'] == 3 && $_POST['userAuthor3'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                            exit;
                        }
                        $project->plan_id = $_POST['plan_id'];
                        $project->project_author = $_POST['userAuthor'];
                        $project->project_author2 = $_POST['userAuthor2'];
                        $project->project_author3 = $_POST['userAuthor3'];
                        $project->project_author_amount = $_POST['amount'];

                        $project->project_id = $_GET['id'];
                        $project->project_name = $_POST['name'];

                        $split_date = explode('-', $_POST['date']);
                        $split_date_end = explode('-', $_POST['date_end']);
                        $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
                        $date_end = $split_date_end[2] . "-" . $split_date_end[1] . "-" . $split_date_end[0];

                        $project->project_date = $date;
                        $project->project_date_end = $date_end;
                        $project->project_process = "ยังไม่ได้ดำเนินการ";
                        $project->project_budget = null;
                        $project->project_final_budget = null;


                        if ($_FILES['approve']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_approve'] != '') {
                                $project->project_document_approve = $projects['project_document_approve'][0];
                            }
                        } else {
                            $project->project_document_approve = $path_approve['path'];
                        }


                        if ($_FILES['charges']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_charges'] != '') {
                                $project->project_document_charges = $projects['project_document_charges'][0];
                            }
                        } else {
                            $project->project_document_charges = $path_charges['path'];
                        }


                        if ($_FILES['conclusion']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_conclusion'] != '') {
                                $project->project_document_conclusion = $projects['project_document_conclusion'][0];
                            }
                        } else {
                            $project->project_document_conclusion = $path_conclusion['path'];
                        }


                        if ($_FILES['image']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_image'] != '') {
                                $project->project_document_image = $projects['project_document_image'][0];
                            }
                        } else {
                            $project->project_document_image = $path_image['path'];
                        }

                        $proj = $projectDAO->findbyPK($project->project_id);
                        $project->project_pre = $proj['project_pre'][0];
                        $project->project_time_create = $proj['project_time_create'][0];
                        $project->project_time_update = date('Y-m-d H:i:s');

                        $project->user_create = $proj['user_create'][0];
                        $project->user_update = $_SESSION['USER']['user_id'][0];

                        $projectDAO->update($project);


                        echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_project.php\"
            })
            </script>";


                        break;
                    case 1 :

                        if($_POST['amount'] == 2 && $_POST['userAuthor2'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                            exit;
                        }else if($_POST['amount'] == 3 && $_POST['userAuthor3'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                            exit;
                        }
                        $project->plan_id = $_POST['plan_id'];
                        $project->project_author = $_POST['userAuthor'];
                        $project->project_author2 = $_POST['userAuthor2'];
                        $project->project_author3 = $_POST['userAuthor3'];
                        $project->project_author_amount = $_POST['amount'];

                        $project->project_id = $_GET['id'];
                        $project->project_name = $_POST['name'];

                        $split_date = explode('-', $_POST['date']);
                        $split_date_end = explode('-', $_POST['date_end']);
                        $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
                        $date_end = $split_date_end[2] . "-" . $split_date_end[1] . "-" . $split_date_end[0];

                        $project->project_date = $date;
                        $project->project_date_end = $date_end;
                        $project->project_budget = null;
                        $project->project_final_budget = null;
                        $project->project_process = "กำลังดำเนินการ";


                        if ($_FILES['approve']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_approve'] != '') {
                                $project->project_document_approve = $projects['project_document_approve'][0];
                            }
                        } else {
                            $project->project_document_approve = $path_approve['path'];
                        }

//                    $project->project_document_approve = $path_approve['path'];


                        if ($_FILES['charges']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_charges'] != '') {
                                $project->project_document_charges = $projects['project_document_charges'][0];
                            }
                        } else {
                            $project->project_document_charges = $path_charges['path'];
                        }


//                    $project->project_document_charges = $path_charges['path'];


                        if ($_FILES['conclusion']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_conclusion'] != '') {
                                $project->project_document_conclusion = $projects['project_document_conclusion'][0];
                            }
                        } else {
                            $project->project_document_conclusion = $path_conclusion['path'];
                        }

//                    $project->project_document_conclusion = $path_conclusion['path'];


                        if ($_FILES['image']["size"] == 0) {
                            $projects = $projectDAO->findbyPK($project->project_id);

                            if ($projects['project_document_image'] != '') {
                                $project->project_document_image = $projects['project_document_image'][0];
                            }
                        } else {
                            $project->project_document_image = $path_image['path'];
                        }

//                    $project->project_document_image = $path_image['path'];

//                    $project->project_document_approve = $path_approve['path'];
//                    $project->project_document_charges = $path_charges['path'];
//                    $project->project_document_conclusion = $path_conclusion['path'];
//                    $project->project_document_image = $path_image['path'];
                        $proj = $projectDAO->findbyPK($project->project_id);
                        $project->project_pre = $proj['project_pre'][0];
                        $project->project_time_create = $proj['project_time_create'][0];
                        $project->project_time_update = date('Y-m-d H:i:s');
                        $project->user_create = $proj['user_create'][0];
                        $project->user_update = $_SESSION['USER']['user_id'][0];

                        $projectDAO->update($project);

                        echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_project.php\"
            })
            </script>";
                        break;

                    case 2 :

                        if($_POST['amount'] == 2 && $_POST['userAuthor2'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                            exit;
                        }else if($_POST['amount'] == 3 && $_POST['userAuthor3'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                            exit;
                        }
                        $project->plan_id = $_POST['plan_id'];
                        $project->project_author = $_POST['userAuthor'];
                        $project->project_author2 = $_POST['userAuthor2'];
                        $project->project_author3 = $_POST['userAuthor3'];
                        $project->project_author_amount = $_POST['amount'];

                        $budget = $_POST['approve_budget'];
                        $final = $_POST['final_budget'];
                        if ($budget != null && $final != null) {
                            $project->project_id = $_GET['id'];
                            $project->project_name = $_POST['name'];
                            $split_date = explode('-', $_POST['date']);
                            $split_date_end = explode('-', $_POST['date_end']);
                            $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
                            $date_end = $split_date_end[2] . "-" . $split_date_end[1] . "-" . $split_date_end[0];

                            $project->project_date = $date;
                            $project->project_date_end = $date_end;
                            $project->project_process = "เสร็จสิ้นแล้ว";
                            $project->project_budget = $budget;
                            $project->project_final_budget = $final;
//                        $project->project_budget = $_POST['approve_budget'];
//                        $project->project_final_budget = $_POST['final_budget'];


                            if ($_FILES['approve']["size"] == 0) {
                                $projects = $projectDAO->findbyPK($project->project_id);

                                if ($projects['project_document_approve'] != '') {
                                    $project->project_document_approve = $projects['project_document_approve'][0];
                                }
                            } else {
                                $project->project_document_approve = $path_approve['path'];
                            }

                            //                    $project->project_document_approve = $path_approve['path'];


                            if ($_FILES['charges']["size"] == 0) {
                                $projects = $projectDAO->findbyPK($project->project_id);

                                if ($projects['project_document_charges'] != '') {
                                    $project->project_document_charges = $projects['project_document_charges'][0];
                                }
                            } else {
                                $project->project_document_charges = $path_charges['path'];
                            }


                            //                    $project->project_document_charges = $path_charges['path'];


                            if ($_FILES['conclusion']["size"] == 0) {
                                $projects = $projectDAO->findbyPK($project->project_id);

                                if ($projects['project_document_conclusion'] != '') {
                                    $project->project_document_conclusion = $projects['project_document_conclusion'][0];
                                }
                            } else {
                                $project->project_document_conclusion = $path_conclusion['path'];
                            }

                            //                    $project->project_document_conclusion = $path_conclusion['path'];


                            if ($_FILES['image']["size"] == 0) {
                                $projects = $projectDAO->findbyPK($project->project_id);

                                if ($projects['project_document_image'] != '') {
                                    $project->project_document_image = $projects['project_document_image'][0];
                                }
                            } else {
                                $project->project_document_image = $path_image['path'];
                            }

                            //                    $project->project_document_image = $path_image['path'];

                            //                    $project->project_document_approve = $path_approve['path'];
                            //                    $project->project_document_charges = $path_charges['path'];
                            //                    $project->project_document_conclusion = $path_conclusion['path'];
                            //                    $project->project_document_image = $path_image['path'];
                            $proj = $projectDAO->findbyPK($project->project_id);

                            $project->project_time_create = $proj['project_time_create'][0];
                            $project->project_time_update = date('Y-m-d H:i:s');
                            $project->project_pre = $proj['project_pre'][0];
                            $project->user_create = $proj['user_create'][0];
                            $project->user_update = $_SESSION['USER']['user_id'][0];

                            $projectDAO->update($project);

                            echo "<script type='text/javascript'>
                            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                                window.location=\"" . site_url . "admin_project.php\"
                            })
                            </script>";
                            break;

                        }
                        else {
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
                            })
                            </script>";
                            exit;

                        }

                }


            } else {


                echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "admin_project_form.php?pid=$pid\"
            })
            </script>";

            }



    }
    }

}