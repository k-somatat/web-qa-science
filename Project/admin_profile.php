<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "ข้อมูลส่วนตัว";
$page_icon = "fa fa-user";
$page_admin_home_active = "active";
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
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> <?= $page_name; ?></li>
        </ol>
    </div>
</div>
<!-- /.row -->


<?
$userdao = new UserDAO();
$user = new User();
$user = $userdao->findbyPK($_SESSION['USER']['user_id'][0]);

$user_id = $user['user_id'][0];
$user_name = $user['username'][0];
$user_position = $user['user_position'][0];
$user_first_name = $user['user_first_name'][0];
$first_name = explode(" ",$user_first_name);

$firstName = $first_name[0].$first_name[1];
$user_last_name = $user['user_last_name'][0];
$user_image = $user['user_image'][0];
$user_major = $user['major_id'][0];

$majorDAO = new MajorDAO();
$major = new Major();
$major = $majorDAO->findbyPK($user_major);

$facultyDAO = new FacultyDAO();
$faculty = new Faculty();

$faculty = $facultyDAO->findbyFacultyId($major['faculty_id'][0]);


$user_tel = $user['user_tel'][0];
//    $tel = $user['user_tel'][0];
//    $user_tel = substr("$tel",0,2)."-".substr("$tel",2,4)."-".substr("$tel",6,4);
$use_image = $user['user_image'][0];
$split =  explode("/",$user_image);
$user_image =  site_url."uploads/$split[2]/$split[3]";


?>

<!-- Button trigger modal -->
<a data-toggle="modal" href="/myModal" class="btn btn-primary btn-lg" style="display: none">Launch demo modal</a>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--                    <h4 class="modal-title">ข้อมูลส่วนตัว</h4>-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="modal-title"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</h3>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" name="register_form" method="post" action="<?=site_url . "callfunction.php?method=register"; ?>">

                    <div class="form-group profile-detail-image">
                        <img src="<?=$user_image ? $user_image : site_url."images/profile.png" ?>" class=" center" style="width: 150px; height: 150px"/>
                        <!--                            <p style="text-align: center; margin-top: 12px"><a href="course.php ">แก้ไขรูปประจำตัว</a></p>-->
                    </div>
                    <div class="profile-detail">
                        <div class="form-group" style="margin-top: 40px">
                            <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 margin-top-10 control-label">
                                <b style="color: #dd514c">อีเมล์</b>
                            </label>

                            <div class="col-lg-6 ">
                                <label class="control-label" for="inputSuccess2"><b style="color: #006dcc"><?echo $user_name?></b></label>
                            </div>

                            <div class="col-lg-2">

                            </div>

                            <div class="col-lg-4 ">
                            </div>
                        </div>

                        <div class="form-group" >


                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group form-group has-success has-feedback" >
                                <label for="inputUsername" class="col-lg-2 control-label">
                                    <b style="color: #dd514c">ชื่อ</b>
                                </label>
                                <div class="col-lg-4 ">
                                    <label class="control-label" for="inputSuccess2"><b style="color: #006dcc"><?echo $firstName?></b></label>
                                </div>

                                <div class="col-lg-2">
                                    <label class="control-label" for="inputSuccess2"><b style="color: #dd514c">นามสกุล</b></label>
                                </div>

                                <div class="col-lg-4 ">
                                    <label class="control-label" for="inputSuccess2"><b style="color: #006dcc"><?echo $user_last_name?></b></label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 control-label">
                                <b style="color: #dd514c">    สาขาวิชา</b>
                            </label>

                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group form-group has-success has-feedback">

                                <div class="col-lg-8 ">
                                    <label class="control-label" for="inputSuccess2"><b style="color: #006dcc"><?echo $major['major_name'][0]?></b></label>
                                </div>

                                <div class="col-lg-4 ">
                                    <!--                                    <label class="control-label" for="inputSuccess2"><b style="color: #040404">--><?//echo $user_name?><!--</b></label>-->
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 control-label">
                                <b style="color: #dd514c">  คณะ</b>
                            </label>

                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group form-group has-success has-feedback">

                                <div class="col-lg-8 ">
                                    <label class="control-label" for="inputSuccess2"><b style="color: #006dcc"><?=$faculty['faculty_name'][0]?></b></label>
                                </div>


                                <div class="col-lg-4 ">
                                    <!--                                    <label class="control-label" for="inputSuccess2"><b style="color: #040404">--><?//echo $user_name?><!--</b></label>-->
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 control-label">
                                <b style="color: #dd514c">  ตำแหน่ง</b>
                            </label>

                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group form-group has-success has-feedback">

                                <div class="col-lg-8 ">
                                    <label class="control-label" for="inputSuccess2"><b style="color: #006dcc"><?=$user_position?></b></label>
                                </div>


                                <div class="col-lg-4 ">
                                    <!--                                    <label class="control-label" for="inputSuccess2"><b style="color: #040404">--><?//echo $user_name?><!--</b></label>-->
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 control-label">
                                <b style="color: #dd514c">โทรศัพท์</b>
                            </label>

                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group form-group has-success has-feedback">

                                <div class="col-lg-8 ">
                                    <label class="control-label" for="inputSuccess2"><b style="color: #006dcc"><?echo $user_tel?></b></label>
                                </div>

                                <div class="col-lg-4 ">
                                    <!--                                    <label class="control-label" for="inputSuccess2"><b style="color: #040404">--><?//echo $user_name?><!--</b></label>-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <a href="admin_profile_edit.php" class="btn btn-primary form-control">แก้ไขข้อมูลส่วนตัว</a>
                        </div>
                        <br class="visible-xs visible-sm">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <a href="admin_change_password_form.php" class="btn btn-primary form-control">เปลี่ยนรหัสผ่าน</a>
                        </div>
                        <br class="visible-xs visible-sm">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-offset-1 col-lg-3">
                            <button type="reset" class="btn btn-danger form-control" data-dismiss="modal" onclick="wrap_page()">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<script type="text/javascript">
    $('#myModal').modal({
        show: true,
        remote: '/myModal'
    });
</script>
<script type="text/javascript">
    function back_page(){
        window.history.back();
    }
</script>

<script type="text/javascript">
    function wrap_page(){
//       window.history.back();
        window.location = "admin_index.php";
    }
</script>




<?if($_GET['onMal'] == 1){
    echo "<script type='text/javascript'>$('#myModal').modal({
                        show: true,
                        remote: '/myModal'
                    });</script>";
} ?>


</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
