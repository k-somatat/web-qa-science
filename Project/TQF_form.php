<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "กรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ";
$page_icon = "list-alt";
$page_TQF_active = "active";
// Page Setup END

?>
<!-- Header Include Here -->
<?php include("./commons/page-header1.0.php");
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
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> <?=$page_name?></li>
        </ol>
        <div class="alert alert-success alert-dismissable hide">
            <button type="button" class="closse" data-dismiss="alert" aria-hidden="true">&times;</button>
            Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel
            free to use this template for your admin needs! We are using a few different plugins to handle the
            dynamic tables and charts, so make sure you check out the necessary documentation links provided.
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
            <li><a href="TQF.php">ข้อมูลกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</a></li>
            <li class="active"><a class="active" href="#TQF_form" data-toggle="tab">เพิ่มข้อมูลกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</a>
            </li>
        </ul>
    </div>
</div>
<!-- /.row -->



<?



if (!empty($_GET['tid'])) {
    $query_method = "update_tqf";

    $tqfDAO = new TqfDAO();
    $tqfs = $tqfDAO->findbyPK($_GET['tid']);

    $tqf_id = $tqfs['tqf_id'][0];
    $tqf_subject = $tqfs['tqf_subject'][0];
    $tqf_semester = $tqfs['tqf_semester'][0];

    $split_date = explode('-',$tqfs['tqf_subject_update'][0]);
    $tqf_subject_update = $split_date[2]."-".$split_date[1]."-".$split_date[0];

    $tqf_document_tqf3 = $tqfs['tqf_document_tqf3'][0];
    $tqf_document_tqf5 = $tqfs['tqf_document_tqf5'][0];

} else {
    $query_method = "create_tqf";
    $tqf_id = "";
    $tqf_subject = "";
    $tqf_semester = "";
    $tqf_subject_update = "";
    $tqf_document_tqf3 = "";
    $tqf_document_tqf5 = "";
}


?>


<p class="col-md-12"
   style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
    กรอกรายละเอียดกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ </p>

<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=$query_method&id=$tqf_id" ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="lbTask" class="col-sm-4 control-label">รหัสวิชา/ชื่อวิชา</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="subject_name" name="subject_name"
                   value="<? echo $tqf_subject ?>" placeholder="รหัสวิชา/ชื่อวิชา ตัวอย่างเช่น 125-218 ระเบียบวิธีการเชิงตัวเลข">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lbMajor" class="col-sm-4 control-label">ภาคการศึกษา</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="semester" name="semester"
                   value="<? echo $tqf_semester ?>" placeholder="ภาคการศึกษา 1/2557">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
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
                               value="<?=$tqf_subject_update; ?>" />
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
        <label for="lbFile" class="col-sm-4 control-label">เอกสาร มคอ. 3/4</label>

        <div class="col-sm-5">
            <div class="col-sm-10">
                <input type="file" class="file" id="TQF3" name="TQF3"
                       value="" placeholder="เอกสาร มคอ. 3">
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
        <label for="lbFile" class="col-sm-4 control-label">เอกสาร มคอ. 5/6</label>

        <div class="col-sm-5">
            <div class="col-sm-10">
                <input type="file" class="file" id="TQF5" name="TQF5"
                       value="" placeholder="เอกสาร มคอ. 5">
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