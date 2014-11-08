<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="สรุปโครงการ";
$page_icon="list-alt";
$page_president_project_report_active = "active";
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
                      <li>หน้าแรก</li>
                      <li>สรุปโครงการ</li>
                      <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลโครงการรูปแบบกราฟ</li>
                  </ol>
              </div>
          </div>

          <div class="row">
              <div class="col-lg-12">
                  <!-- Nav tabs -->
                  <ul class="nav nav-pills">
                      <li><a href="president_project_report.php">ข้อมูลโครงการทั้งหมด</a></li>
                      <li class="active"><a href="#project_report_graph" data-toggle="tab">ข้อมูลโครงการรูปแบบกราฟ</a></li>
                  </ul>
              </div>
          </div>



          <div class="tab-pane active" id="project_report_graph">
            <div class="col-lg-12">
                <div id="container" style="height: 400px"></div>
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

                $complete = ($complete*100)/$len;
                $work_in_progress = ($work_in_progress*100)/$len;
                $not_yet = ($not_yet*100)/$len;

                ?>
            </div>
         </div>
          <div class="row">
              <label class="col-lg-12" style="text-align: center">โครงการทั้งหมด : <?=$len?> </label>
          </div>

      </div><!-- /#page-wrapper -->

<!-- END Content -->
<script type="text/javascript">
    $(function () {
        var complete = <?php echo $complete?>;
        var work_in_progress = <?php echo $work_in_progress?>;
        var not_yet = <?php echo $not_yet?>;
        $('#container').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: 'รายงานการดำเนินการโครงการ'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'การดำเนินการของโครงาน',
                data: [
                    ['ยังไม่ได้ดำเนินการ', not_yet],
                    ['กำลังดำเนินการ',    work_in_progress  ],
                    {
                        name: 'เสร็จสิ้นแล้ว',
                        y: complete,
                        sliced: true,
                        selected: true
                    },
                ]
            }]
        });
    });
</script>
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
