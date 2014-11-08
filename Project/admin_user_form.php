<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "จัดการข้อมูลผู้ใช้งาน";
$page_icon = "list-alt";
$page_home_active = "";
$page_admin_user_active = "active";



// Page Setup END
?>

<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php"); ?>
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
            <li><?= $page_name; ?></li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"> เพิ่มข้อมูลผู้ใช้งาน</i></li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
            <li><a href="admin_user.php">ข้อมูลผู้ใช้งานทั้งหมด</a></li>
            <li><a href="admin_user_permission.php">สิทธิ์การเข้าใช้งาน</a></li>
            <li class="active"><a href="#admin_user_form" data-toggle="tab">เพิ่มข้อมูลผู้ใช้งาน</a></li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Tab panes -->

<?
if (!empty($_GET['uid'])) {
    $query_method = "update_user";
    $control_select = 1;

    $userDAO = new UserDAO();
    $users = $userDAO->findbyUserId($_GET['uid']);

    $user_id = $users['user_id'][0];
    $user_email = $users['username'][0];

    $spilt_userName = explode('@',$user_email);

    $username = $spilt_userName[0];
    $user_password = $users['password'][0];
    $user_fullName = $users['user_first_name'][0];

    $spiltName = explode(' ',$user_fullName);

    $user_academicRank = $spiltName[0];
    $user_firstName = $spiltName[1];
    $user_lastName = $users['user_last_name'][0];
    $user_position = $users['user_position'][0];
    $user_tel = $users['user_tel'][0];
    $user_image = $users['user_image'][0];

    $split =  explode("/",$user_image);
    $user_image =  site_url."uploads/$split[2]/$split[3]";

    $user_majorId = $users['major_id'][0];

    $majorsDAO = new MajorDAO();
    $major = new Major();
    $major = $majorsDAO->findbyMajorId($user_majorId);

    $facultiesDAO = new FacultyDAO();
    $faculties = new Faculty();
    $faculties = $facultiesDAO->findbyFacultyId($major['faculty_id'][0]);

    $user_facultyId = $faculties['faculty_id'][0];





} else {
    $query_method = "register";
    $user_id = "";
    $username = "";
    $user_password = "";
    $user_academicRank = "";
    $user_firstName = "";
    $user_lastName = "";
    $user_position = "";
    $user_tel = "";
    $user_image = "";
    $user_majorId = "";
    $user_facultyId = "";
}
?>


<!--<div class="tab-pane" id="add_research">-->
<p class="col-md-12"
   style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
    กรอกรายละเอียดผู้ใช้งาน </p>

<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=$query_method"; ?>"
      enctype="multipart/form-data">
<!--    action="--><?//= site_url . "sqlfunction.php?method=$query_method&id=$research_id&research_type_id=$research_type_id" ?><!--"-->

    <div class="form-group">
        <img src="<?=$user_image ? $user_image : site_url."images/profile.png" ?>" class=" center" style="width: 150px; height: 150px"/>
        <p style="text-align: center; margin-top: 12px">
            <!--            <a id="a-file">แก้ไขรูปประจำตัว</a></p>-->
            <input type="file" name="file" id="file" value="แก้ไขรูปประจำตัว" style="margin-left: 500px"></p>
    </div>

    <div class="col-sm-5 input-group" style="display: none">
        <input type="password" id="userId" name="userId" value="<?=$user_id?>"
               class="form-control" />
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </span>
    </div>

    <div class="form-group">
        <label for="inputUsername"
               class="col-sm-4 control-label">
            ชื่อผู้ใช้งาน
        </label>

        <div class="col-sm-5 input-group">
            <input type="text" id="inputUsername" name="inputUsername" value="<?=$username?>"
                   class="form-control" placeholder="สร้างอีเมล์แอดเดรส..."/>
            <span class="input-group-addon"><b>@</b></span>
            <span class="input-group-addon"><b>siam.edu</b></span>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword"
               class="col-sm-4 control-label">
            รหัสผ่าน
        </label>

        <div class="col-sm-5 input-group">
            <input type="password" id="inputPassword" name="inputPassword" value="<?=$user_password?>"
                   class="form-control" placeholder="สร้างรหัสผ่าน"/>
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <?
        if(!empty($_GET['uid'])){
            $IsHide = 'none';
        }else{
            $IsHide = 'block';
        }
    ?>

    <div class="form-group" style="display: <?=$IsHide?>">
        <label for="inputPassword"
               class="col-sm-4 control-label">
            ยืนยันรหัสผ่าน
        </label>

        <div class="col-sm-5 input-group">
            <input type="password" id="inputRePassword" name="inputRePassword"
                   class="form-control" placeholder="ยืนยันรหัสผ่าน"/>
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_academic_rank" id="lb_academic_rank" class="col-sm-4 control-label">ชื่อ - นามสกุล</label>

        <div class="col-sm-5">
            <div class="col-sm-4">
                <select class="form-control" id="academic_rank" name="academic_rank">
                    <option value="ศ.ดร." <?=$user_academicRank == "ศ.ดร." ? 'selected="selected"' : ''?>>ศ.ดร.</option>
                    <option value="ศ." <?=$user_academicRank == "ศ." ? 'selected="selected"' : '' ?>>ศ.</option>
                    <option value="รศ.ดร." <?=$user_academicRank == "รศ.ดร." ? 'selected="selected"' : ''?>>รศ.ดร.</option>
                    <option value="รศ." <?=$user_academicRank == "รศ." ? 'selected="selected"' : '' ?>>รศ.</option>
                    <option value="ผศ.ดร." <?=$user_academicRank == "ผศ.ดร." ? 'selected="selected"' : '' ?>>ผศ.ดร.</option>
                    <option value="ผศ." <?=$user_academicRank == "ผศ." ? 'selected="selected"' : '' ?>>ผศ.</option>
                    <option value="ดร." <?=$user_academicRank == "ดร." ? 'selected="selected"' : '' ?>>ดร.</option>
                    <option value="อ." <?=$user_academicRank == "อ." ? 'selected="selected"' : '' ?>>อ.</option>
                    <option value="คุณ" <?=$user_academicRank == "คุณ" ? 'selected="selected"' : '' ?>>คุณ</option>
                </select>
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="first_name" name="first_name"
                       value="<? echo $user_firstName ?>"
                       placeholder="ชื่อ">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="last_name" name="last_name"
                       value="<? echo $user_lastName ?>"
                       placeholder="นามสกุล">
            </div>
        </div>

    </div>

    <div class="form-group" id="dv_institution">
        <label for="lb_position" id="lb_position" class="col-sm-4 control-label">ตำแหน่ง</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="position" name="position"
                   value="<? echo $user_position ?>" placeholder="ตำแหน่ง">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>

    </div>

    <div class="form-group" >
        <label for="lb_major" id="lb_major" class="col-sm-4 control-label">สาขาวิชา</label>

        <div class="col-sm-5">
            <select class="form-control" id="major" name="major">
                <?
                $majorDAO = new MajorDAO();
                $major = new Major();
                $major = $majorDAO->findAll();

                $length = count($major['major_id']);
                for($index = 0; $index<$length; $index++ ){
                    if($user_majorId == $major['major_id'][$index]){
                        $selected = "selected='selected'";
                    }else{
                        $selected = '';
                    }
                    echo ' <option value="'.$major['major_id'][$index].'" '.$selected.'>'.$major['major_name'][$index].'</option>';
                }
                ?>
            </select>
        </div>

    </div>

    <div class="form-group" >
        <label for="lb_faculty" id="lb_faculty" class="col-sm-4 control-label">คณะที่สังกัด</label>

        <div class="col-sm-5">
            <select class="form-control" id="faculty" name="faculty">
                <?
                $facultyDAO = new FacultyDAO();
                $faculty = new Faculty();
                $faculty = $facultyDAO->findAll();
                $length = count($faculty['faculty_id']);

                for($index = 0; $index<$length; $index++ ){

                    if($user_facultyId == $faculty['faculty_id'][$index]){
                        $selected = "selected='selected'";
                    }else{
                        $selected = '';
                    }
                    echo ' <option value="'.$faculty['faculty_id'][$index].'" '.$selected.'>'.$faculty['faculty_name'][$index].'</option>';
                }
                ?>
            </select>

        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_institution" id="lb_tel" class="col-sm-4 control-label">  เบอร์โทรศัพท์/มือถือ</label>

        <div class="col-sm-5 input-group">
            <input type="tel" class="form-control" id="tel" name="tel"
                   value="<? echo $user_tel ?>" placeholder="เบอร์โทรศัพท์ ตัวอย่างเช่น 09-0101-0101" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>

    </div>



    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 12px">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align: right">
                <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg">ยืนยัน</button>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <!--                <button type="reset" id="clear" class="btn btn-default" onclick="window.open('conference_form.php')">ยกเลิก</button>-->
                <button type="reset" id="clear" class="btn btn-default btn-lg" onclick="window.history.back();">
                    ยกเลิก
                </button>
            </div>
        </div>
    </div>


</form>



<script>
    $(function () {
        $('#myTab a:last').tab('show')
    })
</script>



</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->


<!--$len = count($table_pk['COLUMN_NAME']);-->