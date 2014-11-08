<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 1/23/14
 * Time: 2:56 PM
 */
include("admin/commons/page-header1.0.php");
class createProject
{

    public function __construct()
    {

        if($_POST['type_name'] == 1){

            if($_POST['name'] != ''){
            $planDAO = new PlanDAO();
            $plan = new Plan();

            $plan->plan_name = $_POST['name'];
            $plan->plan_time_create = date('Y-m-d');
            $plan->plan_user_create = $_SESSION['USER']['user_id'][0];

            $result = $planDAO->insert($plan);

            echo "<script type='text/javascript'>
            bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "admin_plan.php\"
            })
            </script>";

            }else{
                echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php\"
                            })
                            </script>";
            }


        }else{

            $upload = new UploadAction();
            $path_approve = $upload->UploadSingleFile('approve', 'projectApprove');
            $path_charges = $upload->UploadSingleFile('charges', 'projectCharges');
            $path_conclusion = $upload->UploadSingleFile('conclusion', 'projectConclusion');
            $path_image = $upload->UploadSingleFile('image', 'projectImage');

            if ($_POST['name'] && $_POST['date'] && $_POST['date_end'] && $_POST['plan_id'] && $_POST['userAuthor']
                != ""
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
                                  window.location=\"" . site_url . "admin_project_form.php\"
                                        })
                                        </script>";
                                        exit;
                                    }
                                }
                            }else{
                                echo "<script type='text/javascript'>
                                bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                             window.location=\"" . site_url . "admin_project_form.php\"
                                })
                                </script>";
                                exit;
                            }
                        }
                    }else{
                        echo "<script type='text/javascript'>
                    bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
             window.location=\"" . site_url . "admin_project_form.php\"
                    })
                    </script>";
                        exit;
                    }
                }

                $projectDAO = new ProjectDAO();
                $project = new Project();

                switch ($_POST['sdd']) {
                    case 0 :

                        if($_POST['amount'] == 2 && $_POST['userAuthor2'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php\"
                            })
                            </script>";
                            exit;
                        }else if($_POST['amount'] == 3 && $_POST['userAuthor3'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php\"
                            })
                            </script>";
                            exit;
                        }
                        $project->plan_id = $_POST['plan_id'];
                        $project->project_author = $_POST['userAuthor'];
                        $project->project_author2 = $_POST['userAuthor2'];
                        $project->project_author3 = $_POST['userAuthor3'];
                        $project->project_author_amount = $_POST['amount'];


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
                        $project->project_document_approve = $path_approve['path'];
                        $project->project_document_charges = $path_charges['path'];
                        $project->project_document_conclusion = $path_conclusion['path'];
                        $project->project_document_image = $path_image['path'];
                        $project->project_time_create = date('Y-m-d H:i:s');
                        $project->user_create = $_SESSION['USER']['user_id'][0];

                        $projectDAO->insert($project);


                        echo "<script type='text/javascript'>
                bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                    window.location=\"" . site_url . "admin_project.php\"
                })
                </script>";


                        break;
                    case 1 :

                        if($_POST['amount'] == 2 && $_POST['userAuthor2'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php\"
                            })
                            </script>";
                            exit;
                        }else if($_POST['amount'] == 3 && $_POST['userAuthor3'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php\"
                            })
                            </script>";
                            exit;
                        }
                        $project->plan_id = $_POST['plan_id'];
                        $project->project_author = $_POST['userAuthor'];
                        $project->project_author2 = $_POST['userAuthor2'];
                        $project->project_author3 = $_POST['userAuthor3'];
                        $project->project_author_amount = $_POST['amount'];
                        $project->project_name = $_POST['name'];

                        $split_date = explode('-', $_POST['date']);
                        $split_date_end = explode('-', $_POST['date_end']);
                        $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
                        $date_end = $split_date_end[2] . "-" . $split_date_end[1] . "-" . $split_date_end[0];

                        $project->project_date = $date;
                        $project->project_date_end = $date_end;
                        $project->project_process = "กำลังดำเนินการ";
                        $project->project_budget = null;
                        $project->project_final_budget = null;
                        $project->project_document_approve = $path_approve['path'];
                        $project->project_document_charges = $path_charges['path'];
                        $project->project_document_conclusion = $path_conclusion['path'];
                        $project->project_document_image = $path_image['path'];
                        $project->project_time_create = date('Y-m-d H:i:s');
                        $project->user_create = $_SESSION['USER']['user_id'][0];

                        $projectDAO->insert($project);

                        echo "<script type='text/javascript'>
                bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                    window.location=\"" . site_url . "admin_project.php\"
                })
                </script>";
                        break;

                    case 2 :

                        if($_POST['amount'] == 2 && $_POST['userAuthor2'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php\"
                            })
                            </script>";
                            exit;
                        }else if($_POST['amount'] == 3 && $_POST['userAuthor3'] == ''){
                            echo "<script type='text/javascript'>
                            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                window.location=\"" . site_url . "admin_project_form.php\"
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
                            $project->project_document_approve = $path_approve['path'];
                            $project->project_document_charges = $path_charges['path'];
                            $project->project_document_conclusion = $path_conclusion['path'];
                            $project->project_document_image = $path_image['path'];
                            $project->project_time_create = date('Y-m-d H:i:s');
                            $project->user_create = $_SESSION['USER']['user_id'][0];

                            $projectDAO->insert($project);

                            echo "<script type='text/javascript'>
                        bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                            window.location=\"" . site_url . "admin_project.php\"
                        })
                        </script>";
                            break;

                        } else {
                            echo "<script type='text/javascript'>
                                bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                                    window.location=\"" . site_url . "admin_project_form.php\"
                                })
                                </script>";
                        }

                }


            } else {


                echo "<script type='text/javascript'>
                bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                    window.location=\"" . site_url . "admin_project_form.php\"
                })
                </script>";

            }
        }
    }

}