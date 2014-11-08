<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "เปลี่ยนรหัสผ่าน";
$page_icon = "home";
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
            <li>โปรโฟล์ </li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> เปลี่ยนรหัสผ่าน</li>
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

    ?>




<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=admin_change_password" ?>" enctype="multipart/form-data">

    <div class="form-group">
        <img src="<?=site_url."images/change_password.png" ?>" class=" center" style="width: 150px; height: 150px"/>
        <p style="text-align: center; margin-top: 12px">
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
        <label for="lb_email" id="lb_email" class="col-sm-4 control-label">รหัสผ่านเดิม</label>

        <div class="col-sm-5">
            <input type="password" class="form-control" id="passworded" name="passworded"
                   value="" placeholder="รหัสผ่านเดิม">
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" >
        <label for="lb_email" id="lb_email" class="col-sm-4 control-label">สร้าง รหัสผ่านใหม่</label>

        <div class="col-sm-5">
            <input type="password" class="form-control" id="newPassword" name="newPassword"
                   value="" placeholder="ควรใช้ภาษาอังกฤษ ตัวเลข ผสมกันอย่างน้อย 6 ตัวอักษร เช่น pass1234">
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" >
        <label for="lb_email" id="lb_email" class="col-sm-4 control-label">ยืนยัน รหัสผ่านใหม่</label>

        <div class="col-sm-5">
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                   value="" placeholder="ควรใช้ภาษาอังกฤษ ตัวเลข ผสมกันอย่างน้อย 6 ตัวอักษร เช่น pass1234">
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>


    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 12px">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="text-align: right">
                <button type="submit" id="submit" class="btn btn-primary from-control" style="width: 100px">ยืนยัน</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
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
