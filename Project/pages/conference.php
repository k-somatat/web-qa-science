<?php
// 	Page Setup
$page_name="หลักสูตร";
$page_icon="list-alt";
$page_home_active = "";
$page_course_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("./commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->
<div id="page-wrapper" class="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?=$page_name; ?> <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> <?=$page_name; ?></li>
            </ol>
            <div class="alert alert-success alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
        </div>
    </div><!-- /.row -->




</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
