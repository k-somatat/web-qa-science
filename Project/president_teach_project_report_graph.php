<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name = "โครงการ";
$page_icon = "list-alt";
$page_president_teach_project_report_active = "active";
$page_dropdown_president_open = "open";
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
                      <li>ส่วนของอาจารย์</li>
                      <li>สรุปโครงการ</li>
                      <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> กราฟแสดงข้อมูลโครงการ</li>
                  </ol>
              </div>
          </div>

          <div class="row">
              <div class="col-lg-12">
                  <!-- Nav tabs -->
                  <ul class="nav nav-pills">
                      <li><a href="president_teach_project_report.php">ข้อมูลโครงการทั้งหมด</a></li>
                      <li class="active"><a href="#project_report_graph" data-toggle="tab">กราฟแสดงข้อมูลโครงการ</a></li>
                  </ul>
              </div>
          </div>

          <?
          $projectDAO = new ProjectDAO();
          $project = new Project();

          $project = $projectDAO->findAll();
          $len = count($project['project_id']);
          $not_yet = 0;
          $work_in_progress = 0;
          $complete = 0;
          for($index=0; $index<$len; $index++){

//                    if($project['project_process'][$index] == 'เสร็จสิ้นแล้ว'){
//                        $complete = $complete + 1;
//                    }else if($project['project_process'][$index] == 'กำลังดำเนินการ'){
//                        $work_in_progress = $work_in_progress + 1;
//                    }else if($project['project_process'][$index] == 'ยังไม่ได้ดำเนินการ'){
//                        $not_yet = $not_yet + 1;
//                    }

              switch($project['project_process'][$index]){
                  case 'เสร็จสิ้นแล้ว' :
                      $complete = $complete + 1;
                      break;
                  case 'กำลังดำเนินการ' :
                      $work_in_progress = $work_in_progress +1;
                      break;
                  case 'ยังไม่ได้ดำเนินการ' :
                      $not_yet = $not_yet + 1;
                      break;
              }
          }

          $totalProcess = $complete + $work_in_progress + $not_yet;

//          $complete = ($complete*100)/$len;
//          $work_in_progress = ($work_in_progress*100)/$len;
//          $not_yet = ($not_yet*100)/$len;

          ?>

          <?
            $projects = $projectDAO->findAll();

            $planDAO = new PlanDAO();
            $plan = new Plan();
            $plan = $planDAO->findAll();

            $budgetPlan1 = 0;
            $budgetPlan2 = 0;
            $budgetPlan3 = 0;
            $budgetPlan4 = 0;
            $budgetPlan5 = 0;
            $budgetPlan6 = 0;
            $planWork_in_progress = 0;
            $planComplete = 0;
            $planWork_in_progress1 = 0;
            $planComplete1 = 0;
            $planWork_in_progress2 = 0;
            $planComplete2 = 0;
            $planWork_in_progress3 = 0;
            $planComplete3 = 0;
            $planWork_in_progress4 = 0;
            $planComplete4 = 0;
            $planWork_in_progress5 = 0;
            $planComplete5 = 0;
            $planWork_in_progress6 = 0;
            $planComplete6 = 0;


            for($index = 0; $index<count($project['project_id']); $index++){

                switch($project['plan_id'][$index]){
                    case 1 :
                        $budgetPlan1 = $budgetPlan1+$project['project_final_budget'][$index];
                        if($project['project_process'][$index] == 'เสร็จสิ้นแล้ว'){
                            $planComplete1 = $planComplete1 + 1;
                        }else{
                            $planWork_in_progress1 = $planWork_in_progress1 + 1;
                        }
                        break;
                    case 2 :
                        $budgetPlan2 = $budgetPlan2+$project['project_final_budget'][$index];
                        if($project['project_process'][$index] == 'เสร็จสิ้นแล้ว'){
                            $planComplete2 = $planComplete2 + 1;
                        }else{
                            $planWork_in_progress2 = $planWork_in_progress2 + 1;
                        }
                        break;
                    case 3 :
                        $budgetPlan3 = $budgetPlan3+$project['project_final_budget'][$index];
                        if($project['project_process'][$index] == 'เสร็จสิ้นแล้ว'){
                            $planComplete3 = $planComplete3 + 1;
                        }else{
                            $planWork_in_progress3 = $planWork_in_progress3 + 1;
                        }
                        break;
                    case 4 :
                        $budgetPlan4 = $budgetPlan4+$project['project_final_budget'][$index];
                        if($project['project_process'][$index] == 'เสร็จสิ้นแล้ว'){
                            $planComplete4 = $planComplete4 + 1;
                        }else{
                            $planWork_in_progress4 = $planWork_in_progress4 + 1;
                        }
                        break;
                    case 5 :
                        $budgetPlan5 = $budgetPlan5+$project['project_final_budget'][$index];
                        if($project['project_process'][$index] == 'เสร็จสิ้นแล้ว'){
                            $planComplete5 = $planComplete5 + 1;
                        }else{
                            $planWork_in_progress5 = $planWork_in_progress5 + 1;
                        }
                        break;
                    case 6 :
                        $budgetPlan6 = $budgetPlan6+$project['project_final_budget'][$index];
                        if($project['project_process'][$index] == 'เสร็จสิ้นแล้ว'){
                            $planComplete6 = $planComplete6 + 1;
                        }else{
                            $planWork_in_progress6 = $planWork_in_progress6 + 1;
                        }
                        break;
                }
            }

          $total = $budgetPlan1+ $budgetPlan2 + $budgetPlan3 + $budgetPlan4 +$budgetPlan5 +$budgetPlan6;

          $planComplete = $planComplete1 + $planComplete2 + $planComplete3 + $planComplete4 + $planComplete5 + $planComplete6;
          $planWork_in_progress = $planWork_in_progress1 + $planWork_in_progress2 + $planWork_in_progress3 + $planWork_in_progress4 + $planWork_in_progress5 + $planWork_in_progress6;
          ?>



          <div class="tab-pane active" id="project_report_graph">

              <p class="col-md-12" style="text-align: center; margin-top: 30px; font-size: large; color: #3278b3">
                  ข้อมูลงบประมาณแต่ละแผนงาน </p>

              <div class="form-group col-sm-12" style="color: #2d6987">

                  <div class="col-sm-6" id="piechart" style="width: 600px; height: 550px;"></div>
                  <div class="col-sm-5" style="background-color: #eed3d7; margin-top: 80px">
                      <label for="lb_subject" style="margin-top: 20px; margin-left: 125px; color: #802420">งบประมาณแต่ละแผนงาน</label><br>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 70px;">แผนงาน</label>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 90px">งบประมาณที่ใช้จริง / บาท</label><br>
                      <label for="lb_subject" style="margin-left: 50px; margin-top: 15px"> แผนงานที่ 1 </label>
                      <label for="lb_subject" style="margin-left: 130px"> <?=number_format($budgetPlan1,2)?> </label><br>
                      <label for="lb_subject" style="margin-left: 50px;  margin-top: 15px"> แผนงานที่ 2 </label>
                      <label for="lb_subject" style="margin-left: 130px"> <?=number_format($budgetPlan2,2)?> </label><br>
                      <label for="lb_subject" style="margin-left: 50px;  margin-top: 15px"> แผนงานที่ 3 </label>
                      <label for="lb_subject" style="margin-left: 130px"> <?=number_format($budgetPlan3,2)?> </label><br>
                      <label for="lb_subject" style="margin-left: 50px;  margin-top: 15px"> แผนงานที่ 4 </label>
                      <label for="lb_subject" style="margin-left: 135px"> <?=number_format($budgetPlan4,2)?> </label><br>
                      <label for="lb_subject" style="margin-left: 50px;  margin-top: 15px"> แผนงานที่ 5</label>
                      <label for="lb_subject" style="margin-left: 142px"> <?=number_format($budgetPlan5,2)?> </label><br>
                      <label for="lb_subject" style="margin-left: 50px;  margin-top: 15px"> แผนงานที่ 6 </label>
                      <label for="lb_subject" style="margin-left: 135px"> <?=number_format($budgetPlan6,2)?> </label><br>
                      <label for="lb_subject" style="margin-left: 100px;  margin-top: 15px; color: #e9322d"> รวม</label>
                      <label for="lb_subject" style="margin-left: 130px; color: #e9322d; text-decoration: underline"> <?=number_format($total,2)?></label><br><br><br>
                  </div>
              </div>


              <div class="row">
                  <hr style="color: #0077b3; border-color: #eb9316; border-width: medium"  width ="50%" >
              </div>

              <p class="col-md-12" style="text-align: center; margin-top: 30px; font-size: large; color: #3278b3 ">
                  ข้อมูลการดำเนินการของโครการ </p>


              <div class="form-group col-sm-12" style="color: #285e8e">

                  <div class="col-sm-6" id="piechart2" style="width: 600px; height: 550px;"></div>
                  <div class="col-sm-5" style="background-color: #f8efc0; margin-top: 80px">
                      <label for="lb_subject" style="margin-top: 20px; margin-left: 100px; color: #398439">ข้อมูลการดำเนินการของโครงการ</label><br>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 30px;">สถานะการดำเนินการ</label>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 75px">จำนวนโครงการ </label><br>
                      <label for="lb_subject" style="margin-left: 30px; margin-top: 15px"> เสร็จสิ้นแล้ว </label>
                      <label for="lb_subject" style="margin-left: 175px"> <?=$complete?> </label><br>
                      <label for="lb_subject" style="margin-left: 30px;  margin-top: 15px"> กำลังดำเนินการ </label>
                      <label for="lb_subject" style="margin-left: 155px"> <?=$work_in_progress?> </label><br>
                      <label for="lb_subject" style="margin-left: 30px;  margin-top: 15px"> ยังไม่ได้ดำเนินการ </label>
                      <label for="lb_subject" style="margin-left: 140px"> <?=$not_yet?> </label><br>

                      <label for="lb_subject" style="margin-left: 30px;  margin-top: 15px; color: #e9322d"> รวม</label>
                      <label for="lb_subject" style="margin-left: 225px; color: #e9322d; text-decoration: underline"> <?=$totalProcess?></label><br><br><br>
                  </div>
              </div>

              <div class="row">
                  <hr style="color: #0077b3; border-color: #eb9316; border-width: medium"  width ="50%" >
              </div>

              <p class="col-md-12" style="text-align: center; margin-top: 30px; font-size: large; color: #3278b3 ">
                  เปรียบเทียบข้อมูลการดำเนินการของโครงการแต่ละแผน </p>

              <div class="form-group col-sm-12" style="color: #264584">

                  <div class="col-sm-6" id="chart_div" style="width: 600px; height: 550px;"></div>

                  <div class="col-sm-5" style="background-color: #dff0d8; margin-top: 80px">
                      <label for="lb_subject" style="margin-top: 20px; margin-left: 40px; color: #ad6704">เปรียบเทียบข้อมูลการดำเนินการของโครงการแต่ละแผน</label><br>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 35px;">แผนงาน</label>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 135px;">จำนวนโครงการ</label><br>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 205px">เสร็จสิ้น </label>
                      <label for="lb_subject" style="margin-top: 15px; margin-left: 35px">กำลังดำเนินการ </label><br>
                      <label for="lb_subject" style="margin-left: 30px; margin-top: 15px"> แผนงานที่ 1 </label>
                      <label for="lb_subject" style="margin-left: 120px"> <?=$planComplete1?> </label>
                      <label for="lb_subject" style="margin-left: 95px"> <?=$planWork_in_progress1?> </label><br>
                      <label for="lb_subject" style="margin-left: 30px; margin-top: 15px"> แผนงานที่ 2 </label>
                      <label for="lb_subject" style="margin-left: 120px"> <?=$planComplete2?> </label>
                      <label for="lb_subject" style="margin-left: 95px"> <?=$planWork_in_progress2?> </label><br>
                      <label for="lb_subject" style="margin-left: 30px; margin-top: 15px"> แผนงานที่ 3 </label>
                      <label for="lb_subject" style="margin-left: 120px"> <?=$planComplete3?> </label>
                      <label for="lb_subject" style="margin-left: 95px"> <?=$planWork_in_progress3?> </label><br>
                      <label for="lb_subject" style="margin-left: 30px; margin-top: 15px"> แผนงานที่ 4 </label>
                      <label for="lb_subject" style="margin-left: 120px"> <?=$planComplete4?> </label>
                      <label for="lb_subject" style="margin-left: 95px"> <?=$planWork_in_progress4?> </label><br>
                      <label for="lb_subject" style="margin-left: 30px; margin-top: 15px"> แผนงานที่ 5 </label>
                      <label for="lb_subject" style="margin-left: 120px"> <?=$planComplete5?> </label>
                      <label for="lb_subject" style="margin-left: 95px"> <?=$planWork_in_progress5?> </label><br>
                      <label for="lb_subject" style="margin-left: 30px; margin-top: 15px"> แผนงานที่ 6 </label>
                      <label for="lb_subject" style="margin-left: 120px"> <?=$planComplete6?> </label>
                      <label for="lb_subject" style="margin-left: 95px"> <?=$planWork_in_progress6?> </label><br>

                      <label for="lb_subject" style="margin-left: 30px;  margin-top: 15px; color: #e9322d"> รวม</label>
                      <label for="lb_subject" style="margin-left: 170px; color: #e9322d; text-decoration: underline"> <?=$planComplete?></label>
                      <label for="lb_subject" style="margin-left: 90px; color: #e9322d; text-decoration: underline"> <?=$planWork_in_progress?></label><br><br><br>
                  </div>
              </div>

            <div class="col-lg-12">


                  <!--                <div id="container" style="height: 400px"></div>-->
<!--                  <div class="col-sm-5" style="background-color: #fde5ef; height: 250px; margin-top: 50px; margin-left: 40px; ">-->
<!--                      <label for="lb_subject" style="margin-top: 10px; text-align: center; margin-left: 120px; font-size: 16px; color: #0e0e0e">งบประมาณแต่ละแผนงาน </label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px; margin-left: 22px"">เสร็จสิ้นแล้ว</label>-->
<!--                      <label for="lb_subject" style="margin-left: 12px">--><?//=number_format($budgetPlan1,2)?><!-- บาท</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px; margin-left: 22px"">กำลังดำเนินการ</label>-->
<!--                      <label for="lb_subject" style="margin-left: 12px">--><?//=number_format($budgetPlan2,2)?><!-- บาท</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px; margin-left: 22px"">ยังไม่ได้ดำเนินการ</label>-->
<!--                      <label for="lb_subject" style="margin-left: 12px">--><?//=number_format($budgetPlan3,2)?><!-- บาท</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px; margin-left: 22px"">แผนงานที่ 4 :</label>-->
<!--                      <label for="lb_subject" style="margin-left: 12px">--><?//=number_format($budgetPlan4,2)?><!-- บาท</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px; margin-left: 22px"">แผนงานที่ 5 :</label>-->
<!--                      <label for="lb_subject" style="margin-left: 12px">--><?//=number_format($budgetPlan5,2)?><!-- บาท</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px; margin-left: 22px"">แผนงานที่ 6 :</label>-->
<!--                      <label for="lb_subject" style="margin-left: 12px">--><?//=number_format($budgetPlan6,2)?><!-- บาท</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px; margin-left: 75px; color: #e9322d"">รวม :</label>-->
<!--                      <label for="lb_subject" style="margin-left: 12px; color: #e9322d; text-decoration: underline">--><?//=number_format($total,2)?><!-- บาท</label><br>-->
<!--                  </div>-->

<!--                  <div class="col-sm-5" style="background-color: #cee7ff; height: 100px; margin-top: 50px; margin-left: 60px">-->
<!--                      <label for="lb_subject" style="margin-top: 5px">การดำเนินการของโครงาน </label>-->
<!--                      <label for="lb_subject" style="margin-left: 20px"> :  งานวิจัยที่ได้รับทุนสนับสนุน</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px">จำนวนผู้ทำวิจัย</label>-->
<!--                      <label for="lb_subject" style="margin-left: 22px"> : --><?//=$authorResearch2?><!-- คน</label><br>-->
<!--                      <label for="lb_subject" style="margin-top: 5px">จำนวนผู้ไม่ทำวิจัย</label>-->
<!--                      <label for="lb_subject" style="margin-left: 7px"> : --><?//=$authorNotResearch2?><!-- คน</label><br>-->
<!--                  </div>-->
<!--                  <div class="col-sm-6" id="piechart" style="width: 600px; height: 550px;"></div>-->

              </div>
         </div>
          <div class="row">
<!--              <label class="col-lg-12" style="text-align: center">โครงการทั้งหมด : --><?//=$len?><!-- </label>-->
          </div>

      </div><!-- /#page-wrapper -->

<!-- END Content -->

<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['การดำเนินการของโครงาน', 'สถานะ'],
            ['แผนงานที่ 1',  <?=$budgetPlan1?>],
            ['แผนงานที่ 2',  <?=$budgetPlan2?>],
            ['แผนงานที่ 3',  <?=$budgetPlan3?>],
            ['แผนงานที่ 4',  <?=$budgetPlan4?>],
            ['แผนงานที่ 5',  <?=$budgetPlan5?>],
            ['แผนงานที่ 6',  <?=$budgetPlan6?>],
        ]);

        var options = {
            title: 'งบประมาณแต่ละแผนงาน'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['การดำเนินการของโครงาน', 'สถานะ'],
            ['เสร็จสิ้นแล้ว',     <?=$complete?>],
            ['กำลังดำเนินการ',      <?=$work_in_progress?>],
            ['ยังไม่ได้ดำเนินการ',  <?=$not_yet?>],
        ]);

        var options = {
            title: 'การดำเนินการของโครงการ'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
    }
</script>



<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['แผนงาน', 'เสร็จสิ้น', 'กำลังดำเนินการ'],
            ['แผนงานที่ 1',<?=$planComplete1?>,<?=$planWork_in_progress1?>],
            ['แผนงานที่ 2',<?=$planComplete2?>,<?=$planWork_in_progress2?>],
            ['แผนงานที่ 3',<?=$planComplete3?>,<?=$planWork_in_progress3?>],
            ['แผนงานที่ 4',<?=$planComplete4?>,<?=$planWork_in_progress4?>],
            ['แผนงานที่ 5',<?=$planComplete5?>,<?=$planWork_in_progress5?>],
            ['แผนงานที่ 6',<?=$planComplete6?>,<?=$planWork_in_progress6?>]
        ]);

        var options = {
            title: 'จำนวนโครงการ',
            hAxis: {title: 'แผนงาน', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>














<!--***********************Hight Graph**************************-->

<!--<script type="text/javascript">-->
<!--    $(function () {-->
<!--        var complete = --><?php //echo $complete?><!--;-->
<!--        var work_in_progress = --><?php //echo $work_in_progress?><!--;-->
<!--        var not_yet = --><?php //echo $not_yet?><!--;-->
<!--        $('#container').highcharts({-->
<!--            chart: {-->
<!--                type: 'pie',-->
<!--                options3d: {-->
<!--                    enabled: true,-->
<!--                    alpha: 45,-->
<!--                    beta: 0-->
<!--                }-->
<!--            },-->
<!--            title: {-->
<!--                text: 'รายงานการดำเนินการโครงการ'-->
<!--            },-->
<!--            tooltip: {-->
<!--                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'-->
<!--            },-->
<!--            plotOptions: {-->
<!--                pie: {-->
<!--                    allowPointSelect: true,-->
<!--                    cursor: 'pointer',-->
<!--                    depth: 35,-->
<!--                    dataLabels: {-->
<!--                        enabled: true,-->
<!--                        format: '{point.name}'-->
<!--                    }-->
<!--                }-->
<!--            },-->
<!--            series: [{-->
<!--                type: 'pie',-->
<!--                name: 'การดำเนินการของโครงาน',-->
<!--                data: [-->
<!--                    ['ยังไม่ได้ดำเนินการ', not_yet],-->
<!--                    ['กำลังดำเนินการ',    work_in_progress  ],-->
<!--                    {-->
<!--                        name: 'เสร็จสิ้นแล้ว',-->
<!--                        y: complete,-->
<!--                        sliced: true,-->
<!--                        selected: true-->
<!--                    },-->
<!--                ]-->
<!--            }]-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
