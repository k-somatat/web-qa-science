<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
//$page_name="หน้าแรก";
$page_name="ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์";
$page_icon="home";
$page_president_home_active = "active";
$page_dropdown_president_open = "open";
// Page Setup END
?>

<!-- Header Include Here -->
<?php require_once("president/commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 style="color: #003bb3"><?=$page_name; ?> <small></small></h1>
        <ol class="breadcrumb">
            <li>หน้าแรก</li>
            <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</li>
        </ol>
        <!--            <div class="alert alert-success alert-dismissable">-->
        <!--              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
        <!--              Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.-->
        <!--            </div>-->
    </div>
</div><!-- /.row -->

<!--    Maintenance Page     -->
<!--        <div class="row">-->
<!--            <div class="col-lg-4">-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <img src="images/maintenance.jpg">-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--            </div>-->
<!--        </div>-->
<!--*****************Main Page***************-->
<!--        <div class="row">-->
<!--          <div class="col-lg-3">-->
<!--            <div class="panel panel-info">-->
<!--              <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                  <div class="col-xs-6">-->
<!--                    <i class="fa fa-comments fa-5x"></i>-->
<!--                  </div>-->
<!--                  <div class="col-xs-6 text-right">-->
<!--                    <p class="announcement-heading">456</p>-->
<!--                    <p class="announcement-text">New Mentions!</p>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                  <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                      View Mentions-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                      <i class="fa fa-arrow-circle-right"></i>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </a>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-lg-3">-->
<!--            <div class="panel panel-warning">-->
<!--              <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                  <div class="col-xs-6">-->
<!--                    <i class="fa fa-check fa-5x"></i>-->
<!--                  </div>-->
<!--                  <div class="col-xs-6 text-right">-->
<!--                    <p class="announcement-heading">12</p>-->
<!--                    <p class="announcement-text">To-Do Items</p>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                  <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                      Complete Tasks-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                      <i class="fa fa-arrow-circle-right"></i>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </a>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-lg-3">-->
<!--            <div class="panel panel-danger">-->
<!--              <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                  <div class="col-xs-6">-->
<!--                    <i class="fa fa-tasks fa-5x"></i>-->
<!--                  </div>-->
<!--                  <div class="col-xs-6 text-right">-->
<!--                    <p class="announcement-heading">18</p>-->
<!--                    <p class="announcement-text">Crawl Errors</p>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                  <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                      Fix Issues-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                      <i class="fa fa-arrow-circle-right"></i>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </a>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-lg-3">-->
<!--            <div class="panel panel-success">-->
<!--              <div class="panel-heading">-->
<!--                <div class="row">-->
<!--                  <div class="col-xs-6">-->
<!--                    <i class="fa fa-comments fa-5x"></i>-->
<!--                  </div>-->
<!--                  <div class="col-xs-6 text-right">-->
<!--                    <p class="announcement-heading">56</p>-->
<!--                    <p class="announcement-text">New Orders!</p>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              <a href="#">-->
<!--                <div class="panel-footer announcement-bottom">-->
<!--                  <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                      Complete Orders-->
<!--                    </div>-->
<!--                    <div class="col-xs-6 text-right">-->
<!--                      <i class="fa fa-arrow-circle-right"></i>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </a>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--          <div class="col-lg-12">-->
<!--            <div class="panel panel-primary">-->
<!--              <div class="panel-heading">-->
<!--                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Traffic Statistics: October 1, 2013 - October 31, 2013</h3>-->
<!--              </div>-->
<!--              <div class="panel-body">-->
<!--                <div id="morris-chart-area"></div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--          <div class="col-lg-4">-->
<!--            <div class="panel panel-primary">-->
<!--              <div class="panel-heading">-->
<!--                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Traffic Sources: October 1, 2013 - October 31, 2013</h3>-->
<!--              </div>-->
<!--              <div class="panel-body">-->
<!--                <div id="morris-chart-donut"></div>-->
<!--                <div class="text-right">-->
<!--                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-lg-4">-->
<!--            <div class="panel panel-primary">-->
<!--              <div class="panel-heading">-->
<!--                <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Activity</h3>-->
<!--              </div>-->
<!--              <div class="panel-body">-->
<!--                <div class="list-group">-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">just now</span>-->
<!--                    <i class="fa fa-calendar"></i> Calendar updated-->
<!--                  </a>-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">4 minutes ago</span>-->
<!--                    <i class="fa fa-comment"></i> Commented on a post-->
<!--                  </a>-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">23 minutes ago</span>-->
<!--                    <i class="fa fa-truck"></i> Order 392 shipped-->
<!--                  </a>-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">46 minutes ago</span>-->
<!--                    <i class="fa fa-money"></i> Invoice 653 has been paid-->
<!--                  </a>-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">1 hour ago</span>-->
<!--                    <i class="fa fa-user"></i> A new user has been added-->
<!--                  </a>-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">2 hours ago</span>-->
<!--                    <i class="fa fa-check"></i> Completed task: "pick up dry cleaning"-->
<!--                  </a>-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">yesterday</span>-->
<!--                    <i class="fa fa-globe"></i> Saved the world-->
<!--                  </a>-->
<!--                  <a href="#" class="list-group-item">-->
<!--                    <span class="badge">two days ago</span>-->
<!--                    <i class="fa fa-check"></i> Completed task: "fix error on sales page"-->
<!--                  </a>-->
<!--                </div>-->
<!--                <div class="text-right">-->
<!--                  <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--                <div class="panel panel-primary">-->
<!--                    <div class="panel-heading">-->
<!--                        <h3 class="panel-title"><i class="fa fa-clock-o"></i> ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</h3>-->
<!--                    </div>-->
<!--                    <div class="panel-body">-->
<!--                        <div class="list-group">-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">16/05/2557</span>-->
<!--                                <i class="fa fa-comment"></i> 	ประชุม KM กลุ่มวิจัย คณะวิทยาศาสตร์ วันที่ 16 พฤษภาคม 2557 เวลา 9.00 – 12.00 น-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">16/05/2557</span>-->
<!--                                <i class="fa fa-comment"></i> 	ประชุม SWOT คณะวิทยาศาสตร์ วันที่ 16 พฤษภาคม 2557 เวลา 13.00 – 14.00 น-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">16/05/2557</span>-->
<!--                                <i class="fa fa-comment"></i> 	ประชุม KM กลุ่มการเรียนการสอน คณะวิทยาศาสตร์ วันที่ 19 พฤษภาคม 2557 เวลา 13.00 – 14.00 น-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">16/05/2557</span>-->
<!--                                <i class="fa fa-check"></i> 	ส่งเล่ม SAR คณะวิทยาศาสตร์ ภายในวันที่ 26 พฤษภาคม 2557-->
<!--                            </a>-->
<!---->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">16/05/2557</span>-->
<!--                                <i class="fa fa-comment"></i> 	อบรมหัวข้อเรื่อง การจัดงานเป็นทีม คณะวิทยาศาสตร์ 28 พฤษภาคม 2557 เวลา 13.00 – 15.00 น-->
<!--                            </a>-->
<!---->
<!--                        </div>-->
<!--                        <div>-->
<!--                        <div class="text-left col-sm-6" >-->
<!--                            <a href="#">support : <img width='60' src="--><?//=site_url."images/chrome-firefox.jpg" ?><!-- ">  </a>-->
<!--                        </div>-->
<!--                        <div class="text-right col-sm-6">-->
<!--                            <a href="#">ดูทั้งหมด <i class="fa fa-arrow-circle-right"></i></a>-->
<!--                        </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


<div class="tab-content">

    <div class="tab-pane active" id="index">

        <div class="panel panel-primary" style=" margin-bottom: 30px; margin-top: 30px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o"></i> ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</h3>
            </div>

            <div class="panel-body">
                <div class="list-group">

                    <?
                    $newsDAO = new NewsDAO();
                    $news = new News();
                    $news = $newsDAO->findAll();

                    $length = count($news['news_id']);

                    for($index = $length-1; $index >= 0; $index--){

                        echo '<a href="president_news_detail.php?id='.$news['news_id'][$index].'" class="list-group-item">';
                        if($news['news_time_update'][$index] == ''){
                            $spiltDate = explode('-',$news['news_time_create'][$index]);
                            echo '<span class="badge">'.$spiltDate[2]."-".$spiltDate[1]."-".$spiltDate[0].'</span>';
                        }else{
                            $spiltDate = explode('-',$news['news_time_update'][$index]);
                            echo '<span class="badge">'.$spiltDate[2]."-".$spiltDate[1]."-".$spiltDate[0].'</span>';
                        }
                        echo '<i class="fa fa-comment"></i> '.$news['news_headline'][$index];
                        echo '</a>';
                    }
                    ?>
                </div>
                <div class="text-left col-sm-6" >
                    <a href="#">support : <img width='60' src="<?=site_url."images/chrome-firefox.jpg" ?> ">  </a>
                </div>
                <div class="text-right">
                    <a href="#">ดูทั้งหมด <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--                <div class="panel panel-primary">-->
<!--                    <div class="panel-heading">-->
<!--                        <h3 class="panel-title"><i class="fa fa-clock-o"></i> ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</h3>-->
<!--                    </div>-->
<!--                    <div class="panel-body">-->
<!--                        <div class="list-group">-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">just now</span>-->
<!--                                <i class="fa fa-calendar"></i> Calendar updated-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">4 minutes ago</span>-->
<!--                                <i class="fa fa-comment"></i> Commented on a post-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">23 minutes ago</span>-->
<!--                                <i class="fa fa-truck"></i> Order 392 shipped-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">46 minutes ago</span>-->
<!--                                <i class="fa fa-money"></i> Invoice 653 has been paid-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">1 hour ago</span>-->
<!--                                <i class="fa fa-user"></i> A new user has been added-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">2 hours ago</span>-->
<!--                                <i class="fa fa-check"></i> Completed task: "pick up dry cleaning"-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">yesterday</span>-->
<!--                                <i class="fa fa-globe"></i> Saved the world-->
<!--                            </a>-->
<!--                            <a href="#" class="list-group-item">-->
<!--                                <span class="badge">two days ago</span>-->
<!--                                <i class="fa fa-check"></i> Completed task: "fix error on sales page"-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="text-right">-->
<!--                            <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


<!--      </div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
