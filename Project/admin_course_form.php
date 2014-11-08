<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name="เอกสาร";
$page_icon="list-alt";
$page_admin_course_active = "active";
// Page Setup END

?>
<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php");
?>

<!-- End Header Include -->
<!-- content -->
<div id="page-wrapper" class="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 style="color: #003bb3"><?= $page_name; ?>
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li>หน้าแรก</li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"> เพิ่มแบบฟอร์มเอกสาร</i> </li>
        </ol>
    </div>
</div>
<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li><a href="admin_course_project.php">แบบฟอร์มโครงการ</a></li>
                <li><a href="admin_course.php" >แบบฟอร์มหลักสูตร</a></li>
                <li class="active"><a href="#admin_course_form" data-toggle="tab">เพิ่มแบบฟอร์ม</a></li>
            </ul>
        </div>
    </div><!-- /.row -->



<?



if (!empty($_GET['cid'])) {
    $query_method = "admin_update_course";

    $courseDAO = new CourseDAO();
    $course = $courseDAO->findbyPK($_GET['cid']);

    $course_id = $course['course_id'][0];
    $course_field = $course['course_field'][0];
    $course_year = $course['course_year'][0];
    $course_type_id = $course['course_type_id'][0];


    if($course['time_update'][0] != ''){
        $splitDate = explode('-',$course['time_update'][0]);
        $course_date = $splitDate[2]."-".$splitDate[1]."-".$splitDate[0];
    }else{
        $splitDate = explode('-',$course['time_create'][0]);
        $course_date = $splitDate[2]."-".$splitDate[1]."-".$splitDate[0];
    }


} else {
    $query_method = "admin_create_course";
    $course_id = "";
    $course_field = "";
    $course_year = "";
    $course_date = "";
}


?>


<p class="col-md-12"
   style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
    กรอกรายละเอียดแบบฟอร์มเอกสาร </p>

<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=$query_method&id=$course_id" ?>" enctype="multipart/form-data">


    <div class="form-group">
        <div class="col-sm-4 control-label">
            ประเภทแบบฟอร์มเอกสาร
        </div>
        <div class="col-sm-5">
            <select class="form-control" id="course_type" name="course_type">
                <?
                    $courseTypeDAO = new CourseTypeDAO();
                    $courseType = new CourseType();
                    $courseType = $courseTypeDAO->findAll();

                    $length = count($courseType['course_type_id']);

                    for($index = 0; $index < $length; $index++){

                        if($course_type_id == $courseType['course_type_id'][$index]){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }

                        echo "<option value='".$courseType['course_type_id'][$index]."' $selected>".$courseType['course_type_name'][$index]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-sm-3">
        </div>
    </div>

    <div class="form-group">
        <label for="lbHeadLine" class="col-sm-4 control-label">ชื่อแบบฟอร์ม</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="course_field" name="course_field"
                   value="<? echo $course_field ?>" placeholder="ชื่อแบบฟอร์ม">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lbHeadLine" class="col-sm-4 control-label">ปีการศึกษา</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="year" name="year"
                   value="<? echo $course_year ?>" placeholder="ปีการศึกษา ตัวอย่าง 2557">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_date" id="lb_date" class="col-sm-4 control-label">วันที่ปรับปรุงข้อมูล</label>

        <div class="col-sm-5">

            <div class="col-sm-12 no-pad" id="dv_date" >

                <div id="dateTimePicker" class="input-append" >
                    <div class="input-group col-xs-12 no-pad add-on">
                        <input type="text" class="form-control" id="date" name="date"
                               data-format="dd-MM-yyyy" placeholder="วันที่ปรับปรุงข้อมูล ตัวอย่าง 30-01-2014"
                               value="<?=$course_date; ?>" />
                        <div class="input-group-addon">
                            <div class="glyphicon glyphicon-time"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lbFile" class="col-sm-4 control-label">แนบไฟล์เอกสาร</label>

        <div class="col-sm-5">
            <div class="col-sm-10">
                <input type="file" class="file" id="file" name="file"
                       value="" placeholder="เอกสาร ม.ค.อ 3">
            </div>
            <div class="col-sm-10">
                <label>( doc, docx, pdf, ppt, pptx, gif ,jpg, png )</label>
            </div>

        </div>
        <div class="col-sm-3">
            <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 12px">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align: right">
                <button type="submit" id="submit" class="btn btn-primary btn-lg">ยืนยัน</button>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <button type="reset" id="clear" class="btn btn-default btn-lg" onclick="window.history.back()">ยกเลิก</button>
            </div>
        </div>
    </div>


</form>



<script type="text/javascript">
    $(function () {
        $('#dateTimePicker').datetimepicker({
            pickTime: false
        });
    });
</script>




</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->