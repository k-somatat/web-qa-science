<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("admin/commons/page-header1.0.php");

class admin_updateCourse
{
    public function __construct()
    {
        $cid = $_GET['id'];

        if ($_POST['course_field'] && $_POST['year'] && $_POST['date']  != '') {

            $courseDAO = new CourseDAO();
            $course = new Course();

            $course->course_id = $cid;
            $course->course_field = trim($_POST['course_field']);
            $course->course_year = trim($_POST['year']);

            $split_date = explode('-',$_POST['date']);
            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];

            $courseQuery = new Course();
            $courseQuery = $courseDAO->findbyCourseId($cid);
            $course->time_create = $courseQuery['time_create'][0];
            $course->time_update = $date;

            $course->user_create = $courseQuery['user_create'][0];
            $course->user_update = $_SESSION['USER']['user_id'][0];

            $upload = new UploadAction();
            $path = $upload->UploadSingleFile('file','Course');

            if($_FILES['file']['size'] == 0){
                $course->course_url = $courseQuery['course_url'][0];
            }else{
                $course->course_url = $path['path'];
            }

            $course->course_type_id = $_POST['course_type'];

            $result = $courseDAO->update($course);

            switch($course->course_type_id){
                case 1 :
                    $page = "admin_course_project.php";
                    break;
                case 2 :
                    $page = "admin_course.php";
                    break;
            }


            echo "<script type='text/javascript'>
            bootbox.alert('อัพเดทข้อมูลเรียบร้อยแล้ว',function(){
                window.location=\"" . site_url . "$page\"
            })
            </script>";

        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "admin_course_form.php?cid=$cid\"
            })
            </script>";
        }

    }
}


