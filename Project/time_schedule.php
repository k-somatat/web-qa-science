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
<?php

include ("./commons/page-header1.0.php");
$tsTimeScheduleDAO = new TsTimeScheduleDAO ();
$tsTimeschedule = new TsTimeSchedule ();
$tsTimeschedule_type1 = new TsTimeSchedule ();
$tsTimeschedule_type2 = new TsTimeSchedule ();
$tsTimeschedule_type3 = new TsTimeSchedule ();
$date1 = new DateTime ();
$date2 = new DateTime ();
if ($_POST ['date1']) {
	$date1 = new DateTime ( $_POST ['date1'] );
}
if ($_POST ['date2']) {
	$date2 = new DateTime ( $_POST ['date2'] );
}
$tsTimeschedule = $tsTimeScheduleDAO->findbyTimeStartAndUserIdAll ( $date1->format ( 'Y-m-d' ), $date2->format ( 'Y-m-d' ), $_SESSION ['USER'] ['user_id'] [0] );
$tsTimeschedule_type1 = $tsTimeScheduleDAO->findbyTimeStartAndUserIdRange ( 1, $date1->format ( 'Y-m-d' ), $date2->format ( 'Y-m-d' ), $_SESSION ['USER'] ['user_id'] [0] );
$descriptionCount1 = count($tsTimeschedule_type1);
$tsTimeschedule_type2 = $tsTimeScheduleDAO->findbyTimeStartAndUserIdRange ( 2, $date1->format ( 'Y-m-d' ), $date2->format ( 'Y-m-d' ), $_SESSION ['USER'] ['user_id'] [0] );
$descriptionCount2 = count($tsTimeschedule_type2);
$tsTimeschedule_type3 = $tsTimeScheduleDAO->findbyTimeStartAndUserIdRange ( 3, $date1->format ( 'Y-m-d' ), $date2->format ( 'Y-m-d' ), $_SESSION ['USER'] ['user_id'] [0] );
$descriptionCount3 = count($tsTimeschedule_type3);

?>
<link rel="stylesheet" href="<?=site_url; ?>dist/css/ts.css">
<!-- End Header Include -->
<!-- content -->
<div id="page-wrapper" class="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 style="color: #003bb3"><?=$page_name; ?></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> <?=$page_name; ?></li>
			</ol>

		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<form name="datetimepicker" class="col-lg-12"
					action="time_schedule.php" method="post">
					<div class="pull-left">
						<div id="dateTimePicker" class="input-append"
							style="width: 320px;">
							<div class="input-group col-xs-10 no-pad add-on">
								<input type="text" class="form-control" id="date1" name="date1"
									data-format="yyyy-MM-dd" placeholder="เริ่มจากวันที่"
									value="<?=$_POST['date1']; ?>" />
								<div class="input-group-addon">
									<div class="glyphicon glyphicon-time"></div>
								</div>
							</div>
						</div>
						<div id="dateTimePicker2" class="input-append"
							style="width: 320px;">
							<div class="input-group col-xs-10 no-pad add-on">
								<input type="text" class="form-control" id="date2" name="date2"
									data-format="yyyy-MM-dd" placeholder="ถึงวันที่"
									value="<?=$_POST['date2']; ?>" />
								<div class="input-group-addon">
									<div class="glyphicon glyphicon-time"></div>
								</div>
							</div>
							<div class="col-xs-2">
								<a onclick="document.datetimepicker.submit()"
									class="btn btn-custom2">ไป</a>
							</div>
						</div>
					</div>
					<div class="pull-right">
						<a href="time_schedule_add.php" class="btn btn-primary">เพิ่มกิจกรรม</a>
					</div>
				</form>
			</div>
		</div>
		<br>
		<div class="table-responsive ts">
			<table>
				<thead>
					<tr>
						<th width="10%">&nbsp</th>
						<th width="5%">06.00-07.00</th>
						<th width="5%">07.00-08.00</th>
						<th width="5%">08.00-09.00</th>
						<th width="5%">09.00-10.00</th>
						<th width="5%">10.00-11.00</th>
						<th width="5%">11.00-12.00</th>
						<th width="5%">12.00-13.00</th>
						<th width="5%">13.00-14.00</th>
						<th width="5%">14.00-15.00</th>
						<th width="5%">15.00-16.00</th>
						<th width="5%">16.00-17.00</th>
						<th width="5%">17.00-18.00</th>
						<th width="5%">18.00-19.00</th>
						<th width="5%">19.00-20.00</th>
						<th width="5%">20.00-21.00</th>
						<th width="5%">21.00-22.00</th>
						<th width="5%">22.00-23.00</th>
						<th width="5%">23.00-00.00</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$j = 0;
					for($index = $date1; $index <= $date2; $index->modify ( '+1 day' )) {
						?>
					<tr>
						<td>
	           				<?
						echo $index->format ( 'วันที่d/m/Y' );
						?><br>

						</td>
						<td valign="top" colspan="18">
							<div class="row">
								<div class="col-lg-12"
									style="padding-left: 15px; padding-right: 15px;">
									<div class="schedule-block" style="width: 0%;">&nbsp</div>
								<?php
						$first = 0;
						for($i = 0; $i < count ( $tsTimeschedule_type1 ['ts_type'] ); $i ++) {
							if ($tsTimeschedule_type1 ['date'] [$i] == $index->format ( 'Y-m-d' )) {
								if ($first == 0) {
									?>
											
								<?php
									$timestart = new DateTime ( $tsTimeschedule_type1 ['time_start'] [$i] );
									$timeend = new DateTime ( $tsTimeschedule_type1 ['time_end'] [$i] );
									$space = ($timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60) - 6;
									$space = abs ( $space ) * 100 / 18;
									$width = (abs ( $timeend->format ( 'H' ) + $timeend->format ( 'i' ) / 60 ) - abs ( $timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60 )) * 100 / 18;
									$first ++;
									?>
										<div class="schedule-block" style="width: <?=$space; ?>%;">&nbsp</div>
									<div class="schedule-tag schedule-tag-style-1" id="ts_des1_<?=$i; ?>"
											style="width: <?=$width;?>%;"><?=$tsTimeschedule_type1['ts_name'][$i]?></div>
											<div class="schedule-detail-box" id="ts_1_<?=$i;?>"
												style=" position: fixed; display:none; top: 30%; left: 35%; ">
												<div class="padding-20">
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">ชื่อกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><?=$tsTimeschedule_type1['ts_name'][$i];?></label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">เวลากิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><? 
														$timedescriptionstart = new DateTime($tsTimeschedule_type1['time_start'][$i]);
														$timedescriptionend = new DateTime($tsTimeschedule_type1['time_end'][$i]);
														$datedescription = new DateTime($tsTimeschedule_type1['date'][$i]);
														echo "วันที่ " . $datedescription->format('d/m/Y') ." เวลา " . $timedescriptionstart->format('H:i') . " - " . $timedescriptionend->format('H:i');
														?>
														</label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">รายละเอียดกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;word-wrap:break-word;"><?=$tsTimeschedule_type1['ts_description'][$i];?></label>
													</div>
												</div>
											</div>
									<?php
								} else {
									$lasttimeend = new DateTime ( $tsTimeschedule_type1 ['time_end'] [$i - 1] );
									$timestart = new DateTime ( $tsTimeschedule_type1 ['time_start'] [$i] );
									$timeend = new DateTime ( $tsTimeschedule_type1 ['time_end'] [$i] );
									$space = ($timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60) - ($lasttimeend->format ( 'H' ) + $lasttimeend->format ( 'i' ) / 60);
									if ($space >= 0) {
										$space = abs ( $space ) * 100 / 18;
									} else
										$space = 0;
									
									$width = (abs ( $timeend->format ( 'H' ) + $timeend->format ( 'i' ) / 60 ) - abs ( $timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60 )) * 100 / 18;
									
									?>
									<div class="schedule-block" style="width: <?=$space; ?>%;">&nbsp</div>
									<div class="schedule-tag schedule-tag-style-1" id="ts_des1_<?=$i; ?>"
											style="width: <?=$width;?>%;"><?=$tsTimeschedule_type1['ts_name'][$i]?></div>
											<div class="schedule-detail-box" id="ts_1_<?=$i;?>"
												style=" position: fixed; display:none; top: 30%; left: 35%; ">
												<div class="padding-20">
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">ชื่อกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><?=$tsTimeschedule_type1['ts_name'][$i];?></label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">เวลากิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><? 
														$timedescriptionstart = new DateTime($tsTimeschedule_type1['time_start'][$i]);
														$timedescriptionend = new DateTime($tsTimeschedule_type1['time_end'][$i]);
														$datedescription = new DateTime($tsTimeschedule_type1['date'][$i]);
														echo "วันที่ " . $datedescription->format('d/m/Y') ." เวลา " . $timedescriptionstart->format('H:i') . " - " . $timedescriptionend->format('H:i');
														?>
														</label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">รายละเอียดกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;word-wrap:break-word;"><?=$tsTimeschedule_type1['ts_description'][$i];?></label>
													</div>
												</div>
											</div>
								<?php
								}
							}
						}
						?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12"
									style="padding-left: 15px; padding-right: 15px;">
									<div class="schedule-block" style="width: 0%;">&nbsp</div>
								<?php
						$first = 0;
						for($i = 0; $i < count ( $tsTimeschedule_type2 ['ts_type'] ); $i ++) {
							if ($tsTimeschedule_type2 ['date'] [$i] == $index->format ( 'Y-m-d' )) {
								if ($first == 0) {
									?>
											
								<?php
									$timestart = new DateTime ( $tsTimeschedule_type2 ['time_start'] [$i] );
									$timeend = new DateTime ( $tsTimeschedule_type2 ['time_end'] [$i] );
									$space = ($timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60) - 6;
									$space = abs ( $space ) * 100 / 18;
									$width = (abs ( $timeend->format ( 'H' ) + $timeend->format ( 'i' ) / 60 ) - abs ( $timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60 )) * 100 / 18;
									$first ++;
									?>
										<div class="schedule-block" style="width: <?=$space; ?>%;">&nbsp</div>
									<div class="schedule-tag schedule-tag-style-2" id="ts_des2_<?=$i; ?>"
											style="width: <?=$width;?>%;"><?=$tsTimeschedule_type2['ts_name'][$i]?></div>
											<div class="schedule-detail-box" id="ts_2_<?=$i;?>"
												style=" position: fixed; display:none; top: 30%; left: 35%; ">
												<div class="padding-20">
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">ชื่อกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><?=$tsTimeschedule_type2['ts_name'][$i];?></label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">เวลากิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><? 
														$timedescriptionstart = new DateTime($tsTimeschedule_type2['time_start'][$i]);
														$timedescriptionend = new DateTime($tsTimeschedule_type2['time_end'][$i]);
														$datedescription = new DateTime($tsTimeschedule_type2['date'][$i]);
														echo "วันที่ " . $datedescription->format('d/m/Y') ." เวลา " . $timedescriptionstart->format('H:i') . " - " . $timedescriptionend->format('H:i');
														?>
														</label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">รายละเอียดกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;word-wrap:break-word;"><?=$tsTimeschedule_type2['ts_description'][$i];?></label>
													</div>
												</div>
											</div>
									<?php
								} else {
									$lasttimeend = new DateTime ( $tsTimeschedule_type2 ['time_end'] [$i - 1] );
									$timestart = new DateTime ( $tsTimeschedule_type2 ['time_start'] [$i] );
									$timeend = new DateTime ( $tsTimeschedule_type2 ['time_end'] [$i] );
									$space = ($timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60) - ($lasttimeend->format ( 'H' ) + $lasttimeend->format ( 'i' ) / 60);
									if ($space >= 0) {
										$space = abs ( $space ) * 100 / 18;
									} else
										$space = 0;
									
									$width = (abs ( $timeend->format ( 'H' ) + $timeend->format ( 'i' ) / 60 ) - abs ( $timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60 )) * 100 / 18;
									
									?>
									<div class="schedule-block" style="width: <?=$space; ?>%;">&nbsp</div>
									<div class="schedule-tag schedule-tag-style-2" id="ts_des2_<?=$i; ?>"
											style="width: <?=$width;?>%;"><?=$tsTimeschedule_type2['ts_name'][$i]?></div>
											<div class="schedule-detail-box" id="ts_2_<?=$i;?>"
												style=" position: fixed; display:none; top: 30%; left: 35%; ">
												<div class="padding-20">
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">ชื่อกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><?=$tsTimeschedule_type2['ts_name'][$i];?></label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">เวลากิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><? 
														$timedescriptionstart = new DateTime($tsTimeschedule_type2['time_start'][$i]);
														$timedescriptionend = new DateTime($tsTimeschedule_type2['time_end'][$i]);
														$datedescription = new DateTime($tsTimeschedule_type2['date'][$i]);
														echo "วันที่ " . $datedescription->format('d/m/Y') ." เวลา " . $timedescriptionstart->format('H:i') . " - " . $timedescriptionend->format('H:i');
														?>
														</label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">รายละเอียดกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;word-wrap:break-word;"><?=$tsTimeschedule_type2['ts_description'][$i];?></label>
													</div>
												</div>
											</div>
								<?php
								}
							}
						}
						
						?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12"
									style="padding-left: 15px; padding-right: 15px;">
									<div class="schedule-block" style="width: 0%;">&nbsp</div>
								<?php
						$first = 0;
						for($i = 0; $i < count ( $tsTimeschedule_type3 ['ts_type'] ); $i ++) {
							if ($tsTimeschedule_type3 ['date'] [$i] == $index->format ( 'Y-m-d' )) {
								if ($first == 0) {
									?>
											
								<?php
									$timestart = new DateTime ( $tsTimeschedule_type3 ['time_start'] [$i] );
									$timeend = new DateTime ( $tsTimeschedule_type3 ['time_end'] [$i] );
									$space = ($timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60) - 6;
									$space = abs ( $space ) * 100 / 18;
									$width = (abs ( $timeend->format ( 'H' ) + $timeend->format ( 'i' ) / 60 ) - abs ( $timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60 )) * 100 / 18;
									$first ++;
									?>
										<div class="schedule-block" style="width: <?=$space; ?>%;">&nbsp</div>
									<div class="schedule-tag schedule-tag-style-3" id="ts_des3_<?=$i; ?>"
											style="width: <?=$width;?>%;"><?=$tsTimeschedule_type3['ts_name'][$i]?></div>
											<div class="schedule-detail-box" id="ts_3_<?=$i;?>"
												style=" position: fixed; display:none; top: 30%; left: 35%; ">
												<div class="padding-20">
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">ชื่อกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><?=$tsTimeschedule_type3['ts_name'][$i];?></label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">เวลากิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><? 
														$timedescriptionstart = new DateTime($tsTimeschedule_type3['time_start'][$i]);
														$timedescriptionend = new DateTime($tsTimeschedule_type3['time_end'][$i]);
														$datedescription = new DateTime($tsTimeschedule_type3['date'][$i]);
														echo "วันที่ " . $datedescription->format('d/m/Y') ." เวลา " . $timedescriptionstart->format('H:i') . " - " . $timedescriptionend->format('H:i');
														?>
														</label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">รายละเอียดกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;word-wrap:break-word;"><?=$tsTimeschedule_type3['ts_description'][$i];?></label>
													</div>
												</div>
											</div>
									<?php
								} else {
									$lasttimeend = new DateTime ( $tsTimeschedule_type3 ['time_end'] [$i - 1] );
									$timestart = new DateTime ( $tsTimeschedule_type3 ['time_start'] [$i] );
									$timeend = new DateTime ( $tsTimeschedule_type3 ['time_end'] [$i] );
									$space = ($timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60) - ($lasttimeend->format ( 'H' ) + $lasttimeend->format ( 'i' ) / 60);
									if ($space >= 0) {
										$space = abs ( $space ) * 100 / 18;
									} else
										$space = 0;
									
									$width = (abs ( $timeend->format ( 'H' ) + $timeend->format ( 'i' ) / 60 ) - abs ( $timestart->format ( 'H' ) + $timestart->format ( 'i' ) / 60 )) * 100 / 18;
									
									?>
									<div class="schedule-block" style="width: <?=$space; ?>%;">&nbsp</div>
									<div class="schedule-tag schedule-tag-style-3" id="ts_des3_<?=$i; ?>"
											style="width: <?=$width;?>%;"><?=$tsTimeschedule_type3['ts_name'][$i]?></div>
											<div class="schedule-detail-box" id="ts_3_<?=$i;?>"
												style=" position: fixed; display:none; top: 30%; left: 35%; ">
												<div class="padding-20">
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">ชื่อกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><?=$tsTimeschedule_type3['ts_name'][$i];?></label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">เวลากิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;"><? 
														$timedescriptionstart = new DateTime($tsTimeschedule_type3['time_start'][$i]);
														$timedescriptionend = new DateTime($tsTimeschedule_type3['time_end'][$i]);
														$datedescription = new DateTime($tsTimeschedule_type3['date'][$i]);
														echo "วันที่ " . $datedescription->format('d/m/Y') ." เวลา " . $timedescriptionstart->format('H:i') . " - " . $timedescriptionend->format('H:i');
														?>
														</label>
													</div>
													<div class="row">
														<label class="control-label col-lg-4" style="background: #F7F7F7;">รายละเอียดกิจกรรม</label>
														<label class="control-label col-lg-8" style="background: #F7F7F7;word-wrap:break-word;"><?=$tsTimeschedule_type3['ts_description'][$i];?></label>
													</div>
												</div>
											</div>
								<?php
								}
							}
						}
						
						?>
								</div>
							</div>
						</td>
					</tr>
					<?php
						$j ++;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th width="10%">&nbsp</th>
						<th width="5%">06.00-07.00</th>
						<th width="5%">07.00-08.00</th>
						<th width="5%">08.00-09.00</th>
						<th width="5%">09.00-10.00</th>
						<th width="5%">10.00-11.00</th>
						<th width="5%">11.00-12.00</th>
						<th width="5%">12.00-13.00</th>
						<th width="5%">13.00-14.00</th>
						<th width="5%">14.00-15.00</th>
						<th width="5%">15.00-16.00</th>
						<th width="5%">16.00-17.00</th>
						<th width="5%">17.00-18.00</th>
						<th width="5%">18.00-19.00</th>
						<th width="5%">19.00-20.00</th>
						<th width="5%">20.00-21.00</th>
						<th width="5%">21.00-22.00</th>
						<th width="5%">22.00-23.00</th>
						<th width="5%">23.00-00.00</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.row -->


<script type="text/javascript">
    $(function () {
        $('#dateTimePicker').datetimepicker({
            pickTime: false
        });
    });
    $(function () {
        $('#dateTimePicker2').datetimepicker({
            pickTime: false
        });
    });
    <? 
    for($i=0;$i<$descriptionCount1;$i++){
    ?>
	    $('#ts_des1_<?=$i; ?>').click(function () {
	    	<? 
	    		for($j=0;$j<$descriptionCount1;$j++){
	    	?>
	    		$('#ts_1_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
	    	<? 
	    		for($j=0;$j<$descriptionCount2;$j++){
	    	?>
	    		$('#ts_2_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
	    	<? 
	    		for($j=0;$j<$descriptionCount3;$j++){
	    	?>
	    		$('#ts_3_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
		    $('#ts_1_<?=$i; ?>').fadeIn(500);
		});
	    $('#ts_1_<?=$i; ?>').click(function () {$('#ts_1_<?=$i; ?>').hide();});
    <?
	}
    ?>
    <? 
    for($i=0;$i<$descriptionCount2;$i++){
    ?>
	    $('#ts_des2_<?=$i; ?>').click(function () {
	    	<? 
	    		for($j=0;$j<$descriptionCount1;$j++){
	    	?>
	    		$('#ts_1_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
	    	<? 
	    		for($j=0;$j<$descriptionCount2;$j++){
	    	?>
	    		$('#ts_2_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
	    	<? 
	    		for($j=0;$j<$descriptionCount3;$j++){
	    	?>
	    		$('#ts_3_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
		    $('#ts_2_<?=$i; ?>').fadeIn(500);
		});
	    $('#ts_2_<?=$i; ?>').click(function () {$('#ts_2_<?=$i; ?>').hide();});
    <?
	}
    ?>
    <? 
    for($i=0;$i<$descriptionCount3;$i++){
    ?>
	    $('#ts_des3_<?=$i; ?>').click(function () {
	    	<? 
	    		for($j=0;$j<$descriptionCount1;$j++){
	    	?>
	    		$('#ts_1_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
	    	<? 
	    		for($j=0;$j<$descriptionCount2;$j++){
	    	?>
	    		$('#ts_2_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
	    	<? 
	    		for($j=0;$j<$descriptionCount3;$j++){
	    	?>
	    		$('#ts_3_<?=$j; ?>').hide();
	    	<? 
				}
	    	?>
		    $('#ts_3_<?=$i; ?>').fadeIn(500);
		    
		});
	    $('#ts_3_<?=$i; ?>').click(function () {$('#ts_3_<?=$i; ?>').hide();});	    
	    
    <?
	}
    ?>
</script>

<!-- 	<div class="schedule-detail-box dropdown-menu" -->
	
</div>
<!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
