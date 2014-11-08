<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="โครงการ";
$page_icon="list-alt";
$page_admin_project_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->

<script>
    function getPage(count) {
        var numPage;
        numPage = 'แสดงผลลัพธ์การค้นหาข้อมูล ' + count + ' รายการ';
        document.getElementById('numRow').innerHTML = numPage;
    }
</script>

      <div id="page-wrapper" class="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 style="color: #003bb3"><?=$page_name; ?> <small></small></h1>
            <ol class="breadcrumb">
                <li>หน้าแรก</li>
                <li>โครงการ</li>
              <li class="active"><i class="fa fa-<?=$page_icon; ?>"> ข้อมูลแผนงานทั้งหมด</i> </li>
            </ol>
          </div>
        </div><!-- /.row -->

          <div class="row">
              <div class="col-lg-12">
                  <!-- Nav tabs -->
                  <ul class="nav nav-pills">
                      <li class="active"><a href="#admin_plan"  data-toggle="tab">ข้อมูลแผนงานทั้งหมด</a></li>
                      <li ><a href="admin_project.php">ข้อมูลโครงการทั้งหมด</a></li>
                      <li><a href="admin_project_form.php">เพิ่มข้อมูล</a></li>
                  </ul>
              </div>
          </div>

          <!-- Tab panes -->
          <div class="tab-content">

              <div class="tab-pane active" id="admin_plan">
                  <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; " > ข้อมูลหลักสูตร </p>

                  <div class="form-group">
                      <label class="col-sm-9 text-success" style="font-weight: normal" id="numRow"></label>
                      <!--                <ul class="pagination">-->
                      <!--                    <li><a href="#">&laquo;</a></li>-->
                      <!--                    <li><a href="#">1</a></li>-->
                      <!--                    <li><a href="#">2</a></li>-->
                      <!--                    <li><a href="#">3</a></li>-->
                      <!--                    <li><a href="#">4</a></li>-->
                      <!--                    <li><a href="#">5</a></li>-->
                      <!--                    <li><a href="#">&raquo;</a></li>-->
                      <!--                </ul>-->
                      <label class="col-sm-2 text-success" style="font-weight: normal; text-align: right; padding-top: 5px">Export
                          File</label>
                      <button class="col-sm-1"
                              style="background-image: url(images/exporter-excel.jpg); height: 30px; width: 85px; margin-bottom: 5px"
                              onclick="export_xls()"></button>
                  </div>

                  <table class="table-bordered">
                      <thead class="table-modify" style="text-align: center">
                          <th class="wrapper-text-center" style="width: 10%; height: 10%">ลำดับที่ <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 30%">ชื่อแผนงาน <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 30%">ชื่อผู้จัดทำข้อมูล <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 30%">ชื่อผู้ปรับปรุงข้อมูล <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 13%">แก้ไขข้อมูล <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 13%">ลบข้อมูล <i class="fa fa-sort"></i></th>
                      </thead>
                      <tbody>
                      <?

                      $planDAO = new PlanDAO();
                      $plan = new Plan();

                      $plan = $planDAO->findAll();

                      $planUser = $planDAO->findAll();
                      $_SESSION['planUser'] = $planUser;

                      $len = count($plan['plan_id']);
                      $count = 1;

                      $userDAO = new UserDAO();

                      for ($index = 0; $index < $len; $index++) {


                              echo "<tr style='text-align: center'>" . "<td>" . $count . "</td>";
                              echo  "<td>" . $plan['plan_name'][$index] . "</td>";

                              $user = new User();
                              $user = $userDAO->findbyUserId($plan['plan_user_create'][$index]);
                              $splitName = explode(' ',$user['user_first_name'][0]);
                              echo  "<td>" . $splitName[0].$splitName[1]." ".$user['user_last_name'][0] . "</td>";

                              if($plan['plan_user_update'][$index] != ''){
                                  $user = $userDAO->findbyUserId($plan['plan_user_update'][$index]);
                                  $splitName = explode(' ',$user['user_first_name'][0]);
                                  echo  "<td>" . $splitName[0].$splitName[1]." ".$user['user_last_name'][0] . "</td>";
                              }else{
                                  echo  "<td>" . '-' . "</td>";
                              }


                              echo
                                  "<td>" .
                                  "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='admin_project_form.php?plid=" . $plan['plan_id'][$index] . "'>
                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
                                  . "</td>" .
                                  "<td>" .
                                  "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $plan['plan_id'][$index] . ")>
                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
                                  . "</td></tr>";

                              $count++;

                      }

                      $count = $count - 1;
                      if ($count >= 5) {
                          echo "<SCRIPT LANGUAGE='javascript'>
                   getPage($count)
                </SCRIPT>";
                      }
                      ?>

                      </tbody>
                  </table>

                  <div class="col-sm-12" >
                      <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count?> รายการ</div>
                  </div>

                  <div class="col-sm-12" style="text-align: center">
                                            <ul class="pagination">
                                                <li><a href="<?=site_url.'admin_course.php?page=prevent'?>">&laquo;</a></li>
                                                <li><a href="<?=site_url.'admin_course.php?page=1'?>">1</a></li>
                                                <li><a href="<?=site_url.'admin_course.php?page=2'?>">2</a></li>
                                                <li><a href="<?=site_url.'admin_course.php?page=3'?>">3</a></li>
                                                <li><a href="<?=site_url.'admin_course.php?page=4'?>">4</a></li>
                                                <li><a href="<?=site_url.'admin_course.php?page=5'?>">5</a></li>
                                                <li><a href="<?=site_url.'admin_course.php?page=next'?>">&raquo;</a></li>
                                            </ul>
                  </div>
              </div>
          </div>

        

      </div><!-- /#page-wrapper -->

    <script>
        function confirm_delete(pid) {
            bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
                if (result) {

                    window.location = 'sqlfunction.php?method=delete_project&pid=' + pid+"&cur="+1;
                } else {
                    console.log("User declined dialog");
                }
            });
        }
    </script>

<script>
    function export_xls() {
        window.location = 'src/function/export_project_xls.php';
    }
</script>

<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
