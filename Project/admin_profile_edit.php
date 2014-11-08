<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "โปรโฟล์";
$page_icon = "home";
$page_home_active = "active";
require_once(ABSPATH . 'src/DAO/UserDAO.class.php');
require_once(ABSPATH . 'src/DAO/UserRoleDAO.class.php');
require_once(ABSPATH . 'src/DAO/RoleDAO.class.php');
require_once(ABSPATH . 'src/DAO/MajorDAO.class.php');
require_once(ABSPATH . 'src/vo/Major.class.php');
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
            <li>โปรโฟล์ </li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> แก้ไขข้อมูลส่วนตัว</li>
        </ol>
        <div class="alert alert-success alert-dismissable hide">
            <button type="button" class="closse" data-dismiss="alert" aria-hidden="true">&times;</button>
            Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free
            to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables
            and charts, so make sure you check out the necessary documentation links provided.
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">

    <?
    $userdao = new UserDAO();
    $user = new User();
    $user = $userdao->findbyPK($_SESSION['USER']['user_id'][0]);

    $user_id = $user['user_id'][0];
    $user_email = $user['username'][0];
    $user_first_name = $user['user_first_name'][0];
    $first_name = explode(" ",$user_first_name);
    $gender = $first_name[0];
    $firstName = $first_name[1];
    $user_last_name = $user['user_last_name'][0];
    $user_major = $user['major_id'][0];
    $user_image = $user['user_image'][0];
    $user_tel = $user['user_tel'][0];
    $user_position = $user['user_position'][0];


    $majorDAO = new MajorDAO();
    $major = new Major();
    $major = $majorDAO->findbyPK($user_major);

    $facultyDAO = new FacultyDAO();
    $faculty = new Faculty();

    $faculty = $facultyDAO->findbyFacultyId($major['faculty_id'][0]);

//    echo $user_image;
    $split =  explode("/",$user_image);
    $user_image =  site_url."uploads/$split[2]/$split[3]";
//    echo site_url."images/profile.png";
//    echo site_url."images/profile.png";

    ?>




<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=admin_update_profile" ?>" enctype="multipart/form-data">

    <div class="form-group">
        <img src="<?=$user_image ? $user_image : site_url."images/profile.png" ?>" class=" center" style="width: 150px; height: 150px"/>
        <p style="text-align: center; margin-top: 12px">
<!--            <a id="a-file">แก้ไขรูปประจำตัว</a></p>-->
        <input type="file" name="file" id="file" value="แก้ไขรูปประจำตัว" style="margin-left: 500px"></p>
    </div>

<div class="form-group">
    <label for="lb_author" id="lb_author" class="col-sm-4 control-label">ชื่ออาจารย์</label>

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
                   value="<? echo $firstName ?>"
                   placeholder="ชื่อ">
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="last_name" name="last_name"
                   value="<? echo $user_last_name ?>"
                   placeholder="นามสกุล">
        </div>
    </div>
    <div class="col-sm-3">
        <label style="font-size: large; color: red">*</label>
    </div>
</div>

    <div class="form-group" >
        <label for="lb_email" id="lb_email" class="col-sm-4 control-label">อีเมล์</label>

        <div class="col-sm-5">
            <input type="text" class="form-control" id="email" name="email"
                   value="<? echo $user_email ?>" placeholder="อีเมล์" disabled>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" >
        <label for="lb_major" id="lb_major" class="col-sm-4 control-label">สาขาวิชา</label>

        <div class="col-sm-5">
<!--            <input type="text" class="form-control" id="major" name="major"-->
<!--                   value="--><?// echo $user_major ?><!--" placeholder="สาขาวิชา">-->
            <select class="form-control" id="major" name="major">

                <?

                    $majorDAO = new MajorDAO();
                    $major = new Major();

                    $major = $majorDAO->findAll();

                    $length = count($major['major_id']);
                    for($index = 0; $index<$length; $index++ ){
                        if($user_major == $major['major_id'][$index]){
                            $selected = "selected='selected'";
                        }else{
                            $selected = '';

                        }
                        echo ' <option value="'.$major['major_id'][$index].'" '.$selected.'>'.$major['major_name'][$index].'</option>';
                    }

                ?>
            </select>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" >
            <label for="lb_faculty" id="lb_faculty" class="col-sm-4 control-label">คณะที่สังกัด</label>

        <div class="col-sm-5">
            <input type="text" class="form-control" id="faculty" name="faculty"
                   value="<?=$faculty['faculty_name'][0]?>" placeholder="คณะที่สังกัด" disabled>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_institution" id="lb_position" class="col-sm-4 control-label">  ตำแหน่ง</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="position" name="position"
                   value="<? echo $user_position ?>" placeholder="ตำแหน่ง">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red"></label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_institution" id="lb_tel" class="col-sm-4 control-label">  เบอร์โทรศัพท์/มือถือ</label>

        <div class="col-sm-5">
            <input type="text" class="form-control" id="tel" name="tel"
                   value="<? echo $user_tel ?>" placeholder="เบอร์โทรศัพท์">
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red"></label>
        </div>
    </div>


    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 12px">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align: right">
                <button type="submit" id="submit" class="btn btn-primary" style="width: 100px">ยืนยัน</button>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <!--                <button type="reset" id="clear" class="btn btn-default" onclick="window.open('conference_form.php')">ยกเลิก</button>-->
                <button type="reset" id="clear" class="btn btn-default" style="width: 100px" onclick="back_page()">
                    ยกเลิก
                </button>
            </div>
        </div>
    </div>


</form>



</div><!-- /#page-wrapper -->
    <script type="text/javascript">
        function back_page(){
            window.history.back();
        }
    </script>
    <script>
        $("#file").click(function(){
            $("#a-file").click();
        });​
    </script>
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
