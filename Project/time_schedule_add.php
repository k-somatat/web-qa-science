<?php

session_start ();
// Page Setup
define ( 'ABSPATH', dirname ( __FILE__ ) . '/' );
$page_name = "ตารางปฏิบัติงาน";
$page_icon = "list-alt";
$page_home_active = "";
$page_time_schedule_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("./commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->
<div id="page-wrapper" class="page-wrapper">
	<div class="row">
	    <div class="col-lg-12">
	        <h1 style="color: #003bb3"><?= $page_name; ?>
	            <small>เพิ่มกิจกรรม</small>
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> <?= $page_name; ?></li>
	        </ol>
	    </div>
	</div>
		<form class="row" action="<?= site_url . "sqlfunction.php?method=add_schedule"?>" method="post">
			<div class="form-horizontal col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<div class="form-group row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<label class="control-label require" for="ts_name">ชื่อ กิจกรรม</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<input type="text" id="ts_name" name="ts_name" class="form-control" />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<label class="control-label require" for="date">วันที่</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div id="dateTimePicker" class="">
							<div class="input-group no-pad add-on">
								<input type="text" class="form-control" id="date" name="date"
									data-format="yyyy-MM-dd" placeholder="วันที่"/>
								<div class="input-group-addon">
									<div class="glyphicon glyphicon-time"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<label class="control-label require" for="time_start">ตั้งแต่เวลา</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<input type="text" id="time_start" name="time_start" placeholder="เช่น 08:00 หรือ 17:12" class="form-control" />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<label class="control-label require" for="time_end">ถึง</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<input type="text" id="time_end" name="time_end" placeholder="เช่น 08:00 หรือ 17:12" class="form-control" />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<label class="control-label require" for="time_end">ประเภท</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<select class="form-control" id="ts_type" name="ts_type">
							<option value="1">ตารางสอน</option>
							<option value="2">อื่นๆ</option>
							<option value="3">กิจกรรมคณะ</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<label class="control-label require" for="ts_description">รายละเอียดกิจกรรม</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<textarea  id="ts_description" name="ts_description" class="form-control" style="height: 150px;" ></textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<input type="reset" class="btn btn-primary pull-right margin-10" value="ล้างข้อมูล"/> &nbsp 
					<input type="submit" class="btn btn-primary pull-right margin-10" value="เพิ่ม"/> &nbsp 
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
