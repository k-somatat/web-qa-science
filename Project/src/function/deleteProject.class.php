<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("admin/commons/page-header1.0.php");

class deleteProject {
    public function __construct(){
        switch($_GET['cur']){
            case 1 :
                $page = 'admin_plan.php';

                if($_GET['pid'] != ""){
                    $planDAO = new PlanDAO();

                    $plan = new Plan();

                    $plan->plan_id = $_GET['pid'];

                    $planDAO->delete($plan);

                    echo "<script type='text/javascript'>
                        bootbox.alert('ลบข้อมูลเรียบร้อยแล้ว',function(){
                            window.location=\"" . site_url . "$page\"
                        })
                        </script>";
                }else{

                    echo "<script type='text/javascript'>
                        bootbox.alert('ไม่สามารถลบข้อมูลได้',function(){
                            window.location=\"" . site_url . "$page\"
                        })
                        </script>";


                }
                break;
            case 2 :
                $page = 'admin_project.php';

                if($_GET['pid'] != ""){
                    $projectDAO = new ProjectDAO();

                    $project = new Project();

                    $project->project_id = $_GET['pid'];

                    $projectDAO->delete($project);

                    echo "<script type='text/javascript'>
                    bootbox.alert('ลบข้อมูลเรียบร้อยแล้ว',function(){
                        window.location=\"" . site_url . "$page\"
                    })
                    </script>";
                        }else{

                            echo "<script type='text/javascript'>
                    bootbox.alert('ไม่สามารถลบข้อมูลได้',function(){
                        window.location=\"" . site_url . "$page\"
                    })
                    </script>";


                }
                break;
        }

    }

} 