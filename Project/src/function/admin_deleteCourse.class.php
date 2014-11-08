<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 3/23/14
 * Time: 12:15 PM
 */

include("admin/commons/page-header1.0.php");

class admin_deleteCourse{
    public function __construct(){
        switch($_GET['cur']){
            case 1 :
                $page = "admin_course_project.php";
                break;
            case 2 :
                $page = "admin_course.php";
                break;
        }
        if($_GET['cid'] != ""){
            $courseDAO = new CourseDAO();
            $course = new Course();

            $course->course_id = $_GET['cid'];

            $courseDAO->delete($course);

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
    }

} 