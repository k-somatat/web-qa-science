<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
//$page_name="หน้าแรก";
$page_name="ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์";
$page_icon="home";
$page_home_active = "active";
$page_course_active = "";
// Page Setup END
?>

<!-- Header Include Here -->
<?php require_once("commons/page-header1.0.php"); ?>
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

          </div>
        </div><!-- /.row -->


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

                                echo '<a href="news_detail.php?id='.$news['news_id'][$index].'" class="list-group-item">';
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
<!--      </div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
    <?php include("commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
