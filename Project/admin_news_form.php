<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name="ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์";
$page_icon="list-alt";
$page_admin_home_active = "active";
$page_course_active = "";
// Page Setup END

?>
<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php");
require_once(ABSPATH . 'src/DAO/ConferenceDAO.class.php');
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
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"> เพิ่มข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</i> </li>
        </ol>
    </div>
</div>
<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li ><a href="admin_index.php">ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</a></li>
                <li><a href="admin_news.php">ข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</a></li>
                <li class="active"><a href="#admin_news_form">เพิ่มข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</a></li>
            </ul>
        </div>
    </div>
<!-- /.row -->



<?



if (!empty($_GET['nid'])) {
    $query_method = "admin_update_news";

    $newDAO = new NewsDAO();
    $news = $newDAO->findbyPK($_GET['nid']);

    $news_id = $news['news_id'][0];
    $news_head_line = $news['news_headline'][0];
    $news_detail = $news['news_detail'][0];


    if($news['news_time_update'][0] != ''){
        $splitDate = explode('-',$news['news_time_update'][0]);
        $news_date = $splitDate[2]."-".$splitDate[1]."-".$splitDate[0];
    }else{
        $splitDate = explode('-',$news['news_time_create'][0]);
        $news_date = $splitDate[2]."-".$splitDate[1]."-".$splitDate[0];
    }


} else {
    $query_method = "admin_create_news";
    $news_id = "";
    $news_head_line = "";
    $news_detail = "";
    $news_date = "";
}


?>


<p class="col-md-12"
   style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
    กรอกรายละเอียดข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์ </p>

<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=$query_method&id=$news_id" ?>" enctype="multipart/form-data">


    <div class="form-group">
        <label for="lbHeadLine" class="col-sm-4 control-label">หัวเรื่อง</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="news_headline" name="news_headline"
                   value="<? echo $news_head_line ?>" placeholder="หัวข้อข่าว ประชาสัมพันธ์">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lbDetail" class="col-sm-4 control-label">รายละเอียด</label>

        <div class="col-sm-5 input-group">
            <textarea class="form-control" id="news_detail" name="news_detail"
                    placeholder="รายละเอียด"><?echo $news_detail?></textarea>
        </div>
        <div class="col-sm-3">
            <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
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
                               value="<?=$news_date; ?>" />
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