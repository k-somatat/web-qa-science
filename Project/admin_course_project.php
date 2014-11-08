<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="เอกสาร";
$page_icon="list-alt";
$page_admin_home_active = "";
$page_admin_course_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->
      <div id="page-wrapper" class="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 style="color: #003bb3"><?=$page_name; ?> <small></small></h1>
            <ol class="breadcrumb">
                <li>หน้าแรก</li>
              <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> แบบฟอร์มโครงการ</li>
            </ol>
            <div class="alert alert-success alert-dismissable hide">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
          </div>
        </div><!-- /.row -->

          <div class="row">
              <div class="col-lg-12">
                  <!-- Nav tabs -->
                  <ul class="nav nav-pills">
                      <li class="active"><a href="#admin_course_project" data-toggle="tab">แบบฟอร์มโครงการ</a></li>
                      <li><a href="admin_course.php" >แบบฟอร์มหลักสูตร</a></li>
                      <li><a href="admin_course_form.php">เพิ่มแบบฟอร์ม</a></li>
                  </ul>
              </div>
          </div><!-- /.row -->

          <!-- Tab panes -->
          <div class="tab-content">

              <div class="tab-pane active" id="admin_course_project">
                  <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; " > ข้อมูลโครงการ </p>

                  <table class="table fa-border">
                      <thead class="table-modify" style="text-align: center">
                          <th class="wrapper-text-center" style="width: 10%; height: 50px;">ลำดับที่  <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 30%">ชื่อแบบฟอร์ม <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 13%">เอกสารอ้างอิง <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 13%">แก้ไขข้อมูล <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 13%">ลบข้อมูล <i class="fa fa-sort"></i></th>
                      </thead>
                      <tbody>
                          <?

                          $courseDAO = new CourseDAO();
                          $course = new Course();

                          $course = $courseDAO->findAll();

                          $len = count($course['course_id']);
                          $count = 1;
                          for ($index = 0; $index < $len; $index++) {

                              if($course['course_type_id'][$index] == 1){

                                  echo "<tr style='text-align: center'>" . "<td>" . $count . "</td>";
                                  echo  "<td>" . $course['course_field'][$index] . "</td>";

                                  if ($course['course_url'][$index] == "") {
                                      echo "<td>" . "<font color=blue>ไม่พบไฟล์อ้างอิง</font>" . "</td>";
                                  } else {
                                      echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $course['course_url'][$index] . '">' . "ดาวน์โหลดไฟล์" . "</td>";
                                  }


                                  echo
                                      "<td>" .
                                      "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='admin_course_form.php?cid=" . $course['course_id'][$index] . "'>
                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
                                      . "</td>" .
                                      "<td>" .
                                      "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $course['course_id'][$index] . ")>
                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
                                      . "</td></tr>";


                                  $count++;
                              }
                          }
                          ?>

                      </tbody>
                  </table>

                  <div class="col-sm-12" >
                      <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count-1?> รายการ</div>
                  </div>
<!--
                  <div class="col-sm-12" style="text-align: center">
                      <ul class="pagination">
                          <li><a href="<?=site_url.'admin_course_project.php?page=prevent'?>">&laquo;</a></li>
                          <li><a href="<?=site_url.'admin_course_project.php?page=1'?>">1</a></li>
                          <li><a href="<?=site_url.'admin_course_project.php?page=2'?>">2</a></li>
                          <li><a href="<?=site_url.'admin_course_project.php?page=3'?>">3</a></li>
                          <li><a href="<?=site_url.'admin_course_project.php?page=4'?>">4</a></li>
                          <li><a href="<?=site_url.'admin_course_project.php?page=5'?>">5</a></li>
                          <li><a href="<?=site_url.'admin_course_project.php?page=next'?>">&raquo;</a></li>
                      </ul>
                  </div>
-->
              </div>

          </div>

        

      </div><!-- /#page-wrapper -->

<script>
    function confirm_delete(cid) {
        bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
            if (result) {

                window.location = 'sqlfunction.php?method=admin_delete_course&cid=' + cid+"&cur="+1;
            } else {
                console.log("User declined dialog");
            }
        });
    }
</script>
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
