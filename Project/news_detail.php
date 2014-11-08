<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
//$page_name="หน้าแรก";
$page_name="ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์";
$page_icon="home";
$page_home_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php require_once("./commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->




        <?

        include(ABSPATH.'index.php');

        $id = $_GET['id'];

        $newsDAO = new NewsDAO();
        $news = new News();
        $news = $newsDAO->findbyNewsId($id);

        $head_ling = $news['news_headline'][0];
        $detail = $news['news_detail'][0];

        if($news['news_time_update'][0] == '' ){
            $split_date = explode('-',$news['news_time_create'][0]);
            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
        }else{
            $split_date = explode('-',$news['news_time_update'][0]);
            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
        }

        $doc = $news['news_document'][0];


        ?>




                    <div class="panel-body">
                        <div class="list-group">

                            <a data-toggle="modal" href="/myModal" class="btn btn-primary btn-lg" style="display: none">Launch demo modal</a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
<!--                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                                            <!--                    <h4 class="modal-title">ข้อมูลส่วนตัว</h4>-->
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="modal-title"><i class="fa fa-credit-card"></i> ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-horizontal">


                                                <div class="profile-detail">
                                                    <div class="form-group" style="margin-top: 20px; ">
                                                        <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 margin-top-10 control-label" style="text-align: left";>
                                                            <b style="color: #dd514c">หัวเรื่อง</b>
                                                        </label>

                                                        <div class="col-lg-10">
                                                            <label class="control-label"  style="text-align: left"><b style="color: #006dcc; "><?= $head_ling?></b></label>
                                                        </div>


                                                    </div>

                                                    <div class="form-group" >


                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group form-group has-success has-feedback" >
                                                            <label for="inputUsername" class="col-lg-2 control-label" style="text-align: left";>
                                                                <b style="color: #dd514c">รายละเอียด</b>
                                                            </label>
                                                            <div class="col-lg-10 ">
                                                                <label class="control-label" style="text-align: left" for="inputSuccess2"><b style="color: #006dcc"><?= $detail?></b></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 control-label" style="text-align: left";>
                                                            <b style="color: #dd514c">    วันที่ปรับปรุงข้อมูล</b>
                                                        </label>

                                                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group form-group has-success has-feedback">

                                                            <div class="col-lg-8 ">
                                                                <label class="control-label" style="text-align: left; margin-top: 20px" for="inputSuccess2"><b style="color: #006dcc"><?= $date?></b></label>
                                                            </div>

                                                            <div class="col-lg-4 ">
                                                                <!--                                    <label class="control-label" for="inputSuccess2"><b style="color: #040404">--><?//echo $user_name?><!--</b></label>-->
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 control-label" style="text-align: left; ">
                                                            <b style="color: #dd514c">  เอกสารแนบไฟล์</b>
                                                        </label>

                                                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 input-group form-group has-success has-feedback">

                                                            <div class="col-lg-8 ">
                                                                <?
                                                                if ($doc == "") {
                                                                    ?>
                                                                    <label class="control-label" style="text-align: left; margin-top: 10px";><b>  ไม่มีเอกสารแนบไฟล์</b></label>
                                                                <?
                                                                } else {
                                                                    ?>
                                                                <label class="control-label" style="text-align: left; margin-top: 10px";><b style="color: #006dcc;">
                                                                    <?= '<a href="' . site_url . 'src/function/download.php?filename=' . $doc . '">'?>ดาวน์โหลดเอกสาร</a></b></label>
                                                                <?
                                                                }
                                                                ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    </div>


                                                </div>
                                            <div class="modal-footer">
                                                <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">
                                                    <button type="reset" class="btn btn-primary form-control" data-dismiss="modal" onclick="wrap_page()">ยกเลิก</button>
                                                </div>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                        </div>
                        <div class="text-right">
                            <a href="#">ดูทั้งหมด <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
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


            <!--      </div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
    <?php include("commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
