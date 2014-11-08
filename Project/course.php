<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="เอกสาร";
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
            <h1 style="color: #003bb3"><?=$page_name; ?> <small></small></h1>
            <ol class="breadcrumb">
                <li>หน้าแรก</li>
              <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> <?=$page_name; ?></li>
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
                      <li class="active"><a href="#plan_form" data-toggle="tab">แบบฟอร์มโครงการ</a></li>
                      <li><a href="#course_form" data-toggle="tab">แบบฟอร์มหลักสูตร</a></li>
                  </ul>
              </div>
          </div><!-- /.row -->

          <!-- Tab panes -->
          <div class="tab-content">

              <div class="tab-pane active" id="plan_form">
                  <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; " > ข้อมูลโครงการ </p>

                  <table class="table fa-border">
                      <thead class="table-modify" style="text-align: center">
                          <th class="wrapper-text-center" style="width: 10%; height: 50px;">ลำดับที่  <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 30%">ชื่อแบบฟอร์ม <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 13%">เอกสารอ้างอิง <i class="fa fa-sort"></i></th>
                      </thead>
                      <tbody>
                          <?

                          $courseDAO = new CourseDAO();
                          $course = new Course();

                          $course = $courseDAO->findAll();

                          //                foreach($rs_academics as $key => $val){
                          //                $numb = count($val);}

                          $len = count($course['course_id']);
                          $count = 1;
                          for ($index = 0; $index < $len; $index++) {

                              if($course['course_type_id'][$index] == 1){

                                  echo "<tr style='text-align: center'>" . "<td>" . $count . "</td>";
                                  echo  "<td>" . $course['course_field'][$index] . "</td>";

                                  if ($course['course_url'][$index] == "") {
                                      echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                                  } else {
                                      echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $course['course_url'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                                  }
                                  $count++;
                              }else{}
                          }
                          ?>
<!--                          <td>1</td>-->
<!--                          <td>แบบฟอร์มเสนอโครงการ</td>-->
<!--                          <td>download file</td>-->
<!--                      </tr>-->
<!--                      <tr  style="text-align: center">-->
<!--                          <td>2</td>-->
<!--                          <td>แบบฟอร์มบันทึกข้อความเบื้องต้น</td>-->
<!--                          <td>download file</td>-->
<!--                      </tr>-->
<!--                      <tr  style="text-align: center">-->
<!--                          <td>3</td>-->
<!--                          <td>แบบฟอร์มสรุปผลโครงการ</td>-->
<!--                          <td>download file</td>-->
<!--                      </tr>-->
<!--                      <tr  style="text-align: center">-->
<!--                          <td>4</td>-->
<!--                          <td>แบบฟอร์มสรุปค่าใช่จ่าย</td>-->
<!--                          <td>download file</td>-->
<!--                      </tr>-->
                      </tbody>
                  </table>

                  <div class="col-sm-12" >
                      <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count-1?> รายการ</div>
                  </div>

<!--                  <div class="col-sm-12" style="text-align: center">-->
<!--                      <ul class="pagination">-->
<!--                          <li><a href="#">&laquo;</a></li>-->
<!--                          <li><a href="#">1</a></li>-->
<!--                          <li><a href="#">2</a></li>-->
<!--                          <li><a href="#">3</a></li>-->
<!--                          <li><a href="#">4</a></li>-->
<!--                          <li><a href="#">5</a></li>-->
<!--                          <li><a href="#">&raquo;</a></li>-->
<!--                      </ul>-->
<!--                  </div>-->

              </div>


              <div class="tab-pane" id="course_form">
                  <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; " > ข้อมูลหลักสูตร </p>

                  <table class="table fa-border">
                      <thead class="table-modify" style="text-align: center">
                          <th class="wrapper-text-center" style="width: 10%; height: 10%">ลำดับที่ <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 30%">ชื่อแบบฟอร์ม <i class="fa fa-sort"></i></th>
                          <th class="wrapper-text-center" style="width: 13%">เอกสารอ้างอิง <i class="fa fa-sort"></i></th>
                      </thead>
                      <tbody>
                      <?

                      $courseDAO = new CourseDAO();
                      $course = new Course();

                      $course = $courseDAO->findAll();

                      //                foreach($rs_academics as $key => $val){
                      //                $numb = count($val);}

                      $len = count($course['course_id']);
                      $count = 1;

                      for ($index = 0; $index < $len; $index++) {

                          if($course['course_type_id'][$index] == 2){

                              echo "<tr style='text-align: center'>" . "<td>" . $count . "</td>";
                              echo  "<td>" . $course['course_field'][$index] . "</td>";

                              if ($course['course_url'][$index] == "") {
                                  echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                              } else {
                                  echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $course['course_url'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                              }
                              $count++;
                          }else{}
                      }
                      ?>

<!--                      <tr  style="text-align: center">-->
<!--                          <td>1</td>-->
<!--                          <td>หลักสูตรวิทยาการคอมพิวเตอร์ปี 2556</td>-->
<!--                          <td>download file</td>-->
<!--                      </tr>-->
<!--                      <tr  style="text-align: center">-->
<!--                          <td>2</td>-->
<!--                          <td>หลักสูตรเทคโนโลยีการอาหารปี 2556</td>-->
<!--                          <td>download file</td>-->
<!--                      </tr>-->
                      </tbody>
                  </table>

                  <div class="col-sm-12" >
                      <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count-1?> รายการ</div>
                  </div>

<!--                  <div class="col-sm-12" style="text-align: center">-->
<!--                                            <ul class="pagination">-->
<!--                                                <li><a href="#">&laquo;</a></li>-->
<!--                                                <li><a href="#">1</a></li>-->
<!--                                                <li><a href="#">2</a></li>-->
<!--                                                <li><a href="#">3</a></li>-->
<!--                                                <li><a href="#">4</a></li>-->
<!--                                                <li><a href="#">5</a></li>-->
<!--                                                <li><a href="#">&raquo;</a></li>-->
<!--                                            </ul>-->
<!--                  </div>-->
              </div>
          </div>

        

      </div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
