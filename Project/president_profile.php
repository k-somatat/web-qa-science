<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "ข้อมูลส่วนตัว";
$page_icon = "fa fa-user";
$page_president_home_active = "active";
require_once(ABSPATH . 'src/DAO/UserDAO.class.php');
require_once(ABSPATH . 'src/DAO/UserRoleDAO.class.php');
require_once(ABSPATH . 'src/DAO/RoleDAO.class.php');
require_once(ABSPATH . 'src/DAO/MajorDAO.class.php');
require_once(ABSPATH . 'src/vo/Major.class.php');
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("president/commons/page-header1.0.php"); ?>
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

<div class="row">
<!--    <div class="col-lg-3">-->
<!--        <div class="panel panel-info">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                        <i class="fa fa-comments fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                        <p class="announcement-heading">456</p>-->
<!--                        <p class="announcement-text">New Mentions!</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                    <div class="row">-->
<!--                        <div class="col-xs-6">-->
<!--                            View Mentions-->
<!--                        </div>-->
<!--                        <div class="col-xs-6 text-right">-->
<!--                            <i class="fa fa-arrow-circle-right"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-3">-->
<!--        <div class="panel panel-warning">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                        <i class="fa fa-check fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                        <p class="announcement-heading">12</p>-->
<!--                        <p class="announcement-text">To-Do Items</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                    <div class="row">-->
<!--                        <div class="col-xs-6">-->
<!--                            Complete Tasks-->
<!--                        </div>-->
<!--                        <div class="col-xs-6 text-right">-->
<!--                            <i class="fa fa-arrow-circle-right"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-3">-->
<!--        <div class="panel panel-danger">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                        <i class="fa fa-tasks fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                        <p class="announcement-heading">18</p>-->
<!--                        <p class="announcement-text">Crawl Errors</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                    <div class="row">-->
<!--                        <div class="col-xs-6">-->
<!--                            Fix Issues-->
<!--                        </div>-->
<!--                        <div class="col-xs-6 text-right">-->
<!--                            <i class="fa fa-arrow-circle-right"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-3">-->
<!--        <div class="panel panel-success">-->
<!--            <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                        <i class="fa fa-comments fa-5x"></i>-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                        <p class="announcement-heading">56</p>-->
<!--                        <p class="announcement-text">New Orders!</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                    <div class="row">-->
<!--                        <div class="col-xs-6">-->
<!--                            Complete Orders-->
<!--                        </div>-->
<!--                        <div class="col-xs-6 text-right">-->
<!--                            <i class="fa fa-arrow-circle-right"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
</div><!-- /.row -->

<div class="row">
<!--    <div class="col-lg-12">-->
<!--        <div class="panel panel-primary">-->
<!--            <div class="panel-heading">-->
<!--                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Traffic Statistics: October 1, 2013 - October 31, 2013</h3>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <div id="morris-chart-area"></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div><!-- /.row -->

<div class="row">
<!--    <div class="col-lg-4">-->
<!--        <div class="panel panel-primary">-->
<!--            <div class="panel-heading">-->
<!--                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Traffic Sources: October 1, 2013 - October 31, 2013</h3>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <div id="morris-chart-donut"></div>-->
<!--                <div class="text-right">-->
<!--                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-4">-->
<!--        <div class="panel panel-primary">-->
<!--            <div class="panel-heading">-->
<!--                <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Activity</h3>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <div class="list-group">-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">just now</span>-->
<!--                        <i class="fa fa-calendar"></i> Calendar updated-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">4 minutes ago</span>-->
<!--                        <i class="fa fa-comment"></i> Commented on a post-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">23 minutes ago</span>-->
<!--                        <i class="fa fa-truck"></i> Order 392 shipped-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">46 minutes ago</span>-->
<!--                        <i class="fa fa-money"></i> Invoice 653 has been paid-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">1 hour ago</span>-->
<!--                        <i class="fa fa-user"></i> A new user has been added-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">2 hours ago</span>-->
<!--                        <i class="fa fa-check"></i> Completed task: "pick up dry cleaning"-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">yesterday</span>-->
<!--                        <i class="fa fa-globe"></i> Saved the world-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        <span class="badge">two days ago</span>-->
<!--                        <i class="fa fa-check"></i> Completed task: "fix error on sales page"-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="text-right">-->
<!--                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-4">-->
<!--        <div class="panel panel-primary">-->
<!--            <div class="panel-heading">-->
<!--                <h3 class="panel-title"><i class="fa fa-money"></i> Recent Transactions</h3>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <div class="table-responsive">-->
<!--                    <table class="table table-bordered table-hover table-striped tablesorter">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Order # <i class="fa fa-sort"></i></th>-->
<!--                            <th>Order Date <i class="fa fa-sort"></i></th>-->
<!--                            <th>Order Time <i class="fa fa-sort"></i></th>-->
<!--                            <th>Amount (USD) <i class="fa fa-sort"></i></th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td>3326</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>3:29 PM</td>-->
<!--                            <td>$321.33</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3325</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>3:20 PM</td>-->
<!--                            <td>$234.34</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3324</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>3:03 PM</td>-->
<!--                            <td>$724.17</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3323</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>3:00 PM</td>-->
<!--                            <td>$23.71</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3322</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>2:49 PM</td>-->
<!--                            <td>$8345.23</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3321</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>2:23 PM</td>-->
<!--                            <td>$245.12</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3320</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>2:15 PM</td>-->
<!--                            <td>$5663.54</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3319</td>-->
<!--                            <td>10/21/2013</td>-->
<!--                            <td>2:13 PM</td>-->
<!--                            <td>$943.45</td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--                <div class="text-right">-->
<!--                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div><!-- /.row -->

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
<!--                                     <label class="control-label" for="inputSuccess2">--><?//echo $user_name?><!--</label>-->
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
                                    <label class="control-label" for="inputSuccess2"><b style="color: #006dcc">วิทยาศาสตร์</b></label>
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
                           <a href="president_profile_edit.php" class="btn btn-primary form-control">แก้ไขข้อมูลส่วนตัว</a>
                   </div>
                   <br class="visible-xs visible-sm">
                   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                           <a href="president_change_password_form.php" class="btn btn-primary form-control">เปลี่ยนรหัสผ่าน</a>
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
       window.location = "president_index.php";
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
