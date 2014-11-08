<?php
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 2/2/14
 * Time: 6:25 PM
 */

include("admin/commons/page-header1.0.php");

class admin_createCourse
{
    public function __construct()
    {
        if ($_POST['course_field'] && $_POST['year'] && $_POST['date']  != '' && $_FILES['file']['size'] != 0) {

        $courseDAO = new CourseDAO();

        $course = new Course();

         $course->course_field = trim($_POST['course_field']);
                $course->course_year = trim($_POST['year']);

                $split_date = explode('-',$_POST['date']);
                $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];

                $course->time_create = $date;

                $upload = new UploadAction();
                $path = $upload->UploadSingleFile('file','Course');

                $course->course_url = $path['path'];
                $course->course_type_id = $_POST['course_type'];
                $course->user_create = $_SESSION['USER']['user_id'][0];

            $result = $courseDAO->insert($course);

            if($course->course_type_id == 1){
                echo "<script type='text/javascript'>
                    bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                        window.location=\"" . site_url . "admin_course_project.php\"
                    })
                    </script>";
            }else if($course->course_type_id == 2){
                echo "<script type='text/javascript'>
                    bootbox.alert('บันทึกข้อมูลเรียบร้อยแล้ว',function(){
                        window.location=\"" . site_url . "admin_course.php\"
                    })
                    </script>";
            }

        } else {

            echo "<script type='text/javascript'>
            bootbox.alert('กรุณากรอกข้อมูลกรอกข้อมูลให้ครบถ้วน',function(){
                window.location=\"" . site_url . "admin_course_form.php\"
            })
            </script>";

        }
    }
}
