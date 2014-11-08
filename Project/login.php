<?php
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "Login";
// Page Setup END
require_once(ABSPATH . 'commons/page-include.php');
?>
    <title><?= $page_name; ?> | Science Management</title>

    </head>
    <body id="login-page">
    <div class="">
        <div class="login-form col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
            <div class="box-inner">
                <form class="form-horizontal" role="form" name="login_form" method="post"
                      action="<?= site_url . "callfunction.php?method=login"; ?>">
                    <p class="row" style="color: #003bb3; font-size: large"><img
                            src="<?= site_url ?>images/web_logo.png"
                            class="pull-center hidden-xs hidden-sm hidden-md col-lg-4"
                            style="width: 90px;"/>
                            <img
                            src="<?= site_url ?>images/web_logo.png"
                            class="center col-xs-12 col-sm-12 col-md-12 hidden-lg"
                            style="width: 90px;"/>
                        <label class="col-xs-12 col-sm-12 col-md-12 hidden-lg text-center"><br>ระบบสารสนเทศเพื่อการบริหาร คณะวิทยาศาสตร์</label>
                        <label class="hidden-xs hidden-sm hidden-md col-lg-12 "><br>ระบบสารสนเทศเพื่อการบริหาร คณะวิทยาศาสตร์</label>
                    </p>

                    <div class="form-group">
                        <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 margin-top-10">
                            Username
                        </label>

                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-10 input-group">
                            <input type="text" id="inputUsername" name="inputUsername" class="form-control"
                                   placeholder="ป้อนข้อมูลอีเมล์แอดเดรส... example@siam.edu "/>
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 margin-top-10">
                            Password
                        </label>

                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-10 input-group">
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control"
                                   placeholder="ป้อนข้อมูลพาสเวิร์ด..."/>
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="text-align: center;">

                            <!--              Register Button              -->
<!--                            <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg"-->
<!--                               style="margin-left: 40px">Register</a>-->

                            <input type="submit" class="btn btn-primary btn-custom1 btn-lg" style="margin-left: 10px"
                                   value="Login"/>
                        </div>
                    </div>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title">ระบบสารสนเทศเพื่อการบริหารและการตัดสินใจประกันคุณภาพ</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" name="register_form" method="post"
                                      action="<?= site_url . "callfunction.php?method=register"; ?>">
                                    <h1 class="font-times"><img src="<?= site_url ?>images/web_logo.png"
                                                                class="margin-left-10 margin-bottom-15 margin-right-20"
                                                                style="width: 90px;"/>
                                        สมัครสมาชิก</h1>

                                    <div class="form-group">
                                        <label for="inputUsername"
                                               class="col-xs-12 col-sm-12 col-md-3 col-lg-3 margin-top-10">
                                            Username
                                        </label>

                                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group">
                                            <input type="text" id="inputUsername" name="inputUsername"
                                                   class="form-control" placeholder="สร้างอีเมล์แอดเดรส..."/>
                                            <!--                                            <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="สร้างอีเมล์แอดเดรส... example@siam.edu"/>-->
                                            <!--                                                <span class="input-group-addon">-->
                                            <!--                                                    <i class="glyphicon glyphicon-user"></i>-->
                                            <!--                                                </span>-->
                                            <span class="input-group-addon"><b>@</b></span>
                                            <span class="input-group-addon"><b>siam.edu</b></span>
                                            <!--                                            <input type="text" class="form-control" placeholder="Username">-->
                                        </div>
                                        <!--                                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 input-group">-->
                                        <!--                                            <div class="input-group">-->
                                        <!--                                                <span class="input-group-addon">@</span>-->
                                        <!--                                                <input type="text" class="form-control" placeholder="Username">-->
                                        <!--                                            </div>-->
                                        <!--                                        </div>-->
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword"
                                               class="col-xs-12 col-sm-12 col-md-3 col-lg-3 margin-top-10">
                                            Password
                                        </label>

                                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group">
                                            <input type="password" id="inputPassword" name="inputPassword"
                                                   class="form-control" placeholder="สร้างรหัสผ่าน"/>
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRePassword"
                                               class="col-xs-12 col-sm-12 col-md-3 col-lg-3 margin-top-10">
                                            Re-password
                                        </label>

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-9 input-group">
                                            <input type="password" id="inputRePassword" name="inputRePassword"
                                                   class="form-control" placeholder="ยืนยันรหัสผ่าน"/>
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
                                        </div>
                                    </div>
                                    <!--                    <img src="-->
                                    <?//=site_url."images/web_logo.png"?><!--" width="125px" height="125px" class="img-thumbnail" alt="Thumbnail Image">-->
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-lg"> ยืนยัน</button>
                                <button type="reset" class="btn btn-default btn-lg" data-dismiss="modal">ยกเลิก</button>

                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>

            <div class="box-bottom margin-bottom-20">
                Science Management System.
            </div>
        </div>
    </div>
    </body>

<?if ($_GET['onMal'] == 1) {
    echo "<script type='text/javascript'>$('#myModal').modal({
                        show: true,
                        remote: '/myModal'
                    });</script>";
} ?>