<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="ภาระงานอาจารย์ที่ปรึกษา";
$page_icon="list-alt";
$page_admin_advisor_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->

<script>
    function getPage(count){
        var numPage;
        numPage = 'แสดงผลลัพธ์การค้นหาข้อมูล '+count+' รายการ';
        document.getElementById('numRow').innerHTML = numPage;
    }
</script>

      <div id="page-wrapper" class="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 style="color: #003bb3"><?=$page_name; ?> <small></small></h1>
            <ol class="breadcrumb">
                <li>หน้าแรก</li>
                <li>ภาระงานอาจารย์ที่ปรึกษา</li>
              <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> อาจารย์ที่ปรึกษาชั้นปี</li>
            </ol>
            <div class="alert alert-success alert-dismissable hide">
              <button type="button" class="closse" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
          </div>
        </div><!-- /.row -->
          <div class="row">
              <div class="col-lg-12">
                  <!-- Nav tabs -->
                  <ul class="nav nav-pills">
<!--                      <li><a href="student_class.php">ข้อมูลนักศึกษา</a></li>-->
                      <li class="active"><a href="#admin_advisor_class" data-toggle="tab">อาจารย์ที่ปรึกษาชั้นปี</a></li>
                      <li><a href="admin_advisor_project.php" >อาจารย์ที่ปรึกษาโครงงาน</a></li>
                      <li><a href="admin_advisor_cooperative_education.php" >อาจารย์ที่ปรึกษาสหกิจศึกษา</a></li>
                      <li><a href="admin_advisor_form.php" >เพิ่มข้อมูล</a></li>
                  </ul>
              </div>
          </div><!-- /.row -->

          <!-- Tab panes -->

           <div class="tab-pane active" id="president_advisor_class">
               <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; " > ข้อมูลที่ปรึกษาชั้นปี </p>

                   <div class="form-group" >
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
                       <label class="col-sm-2 text-success" style="font-weight: normal; text-align: right; padding-top: 5px">Export File</label>
                       <button class="col-sm-1" style="background-image: url(images/exporter-excel.jpg); height: 30px; width: 85px; margin-bottom: 5px" onclick="export_xls()"></button>
                   </div>


               <table class="table-bordered">
                   <thead class="table-modify" style="text-align: center">
                   <th class="wrapper-text-center" style="width: 7%; height: 10%">ลำดับที่ <i class="fa fa-sort"></i></th>
                   <th class="wrapper-text-center" style="width: 30%">รายละเอียดการเข้าพบ <i class="fa fa-sort"></i></th>
                   <th class="wrapper-text-center" style="width: 10%">ชั้นปี <i class="fa fa-sort"></i></th>
                   <th class="wrapper-text-center" style="width: 10%">จำนวนนักศึกษา/คน <i class="fa fa-sort"></i></th>
                   <th style="text-align: center; width: 15%">วันที่เข้าพบ</th>
                   <th  style="width: 20%; text-align: center">ชื่ออาจารย์ที่ปรึกษา <i class="fa fa-sort"></i></th>
                   <th style="text-align: center; width: 15%">เอกสารรายชื่อนักศึกษาที่เข้าพบ</th>
                   <th class="wrapper-text-center">แก้ไขข้อมูล</th>
                   <th class="wrapper-text-center">ลบข้อมูล</th>

                   </thead>
                   <tbody>
                   <!--                        <tr  style="text-align: center">-->
                   <!--                            <td>1</td>-->
                   <!--                            <td>โครงการพัฒนาระบบสารสนเทศเพื่อการบริหารและการตัดสินใจประกันคุณภาพ</td>-->
                   <!--                            <td>คณะวิทยาศาสตร์</td>-->
                   <!--                            <td>2556</td>-->
                   <!--                            <td>-</td>-->
                   <!--                        </tr>-->
                   <?

                   $advisorDAO = new AdvisorDAO();
                   $advisor = new Advisor();

                   $advisor = $advisorDAO->findbyAdvisorTypeId(3);

                   $advisorUserId = $advisorDAO->findAll();
                   $_SESSION['advisorClass'] = $advisorUserId;



                   $len = count($advisor['advisor_id']);
                   $count = 1;
                   for($index=0; $index<$len; $index++){

                       $userDao = new UserDAO();
                       $users = $userDao->findbyUserId($advisor['user_id'][$index]);

                       //if($advisor['user_id'][$index] == $_SESSION["USER"]["user_id"][0]){
                           echo "<tr style='text-align: center'>"."<td>".$count."</td>";
                           echo "<td>".$advisor['advisor_name'][$index].'</td>'.
                               '<td>'.$advisor['advisor_year'][$index].'</td>'.
                               "<td>".$advisor['advisor_amount'][$index].'</td>';
                               $split_date = explode('-',$advisor['advisor_date'][$index]);
                                $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];

                               echo '<td>'. $date . '</td>';
                               echo "<td>" . $users['user_first_name'][0] ." ".$users['user_last_name'][0].  '</td>' ;

                           if($advisor['advisor_document'][$index] == ""){
                               echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>"; ;
                           }else{
                               echo  "<td>" . '<a href="'.site_url.'src/function/download.php?filename='.$advisor['advisor_document'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>" ;
                           }
                           echo
                               "<td>".
                               "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='admin_advisor_form.php?aid=".$advisor['advisor_id'][$index]."'>
                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
                               ."</td>".
                               "<td>".
                               "<button class='btn btn-large btn-danger' onclick=confirm_delete(".$advisor['advisor_id'][$index].")>
                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
                               ."</td></tr>";
                           $count++;
//                       }else{
//
//                       }
                   }

                   $count = $count -1;
                   if($count >= 5){
                       echo "<SCRIPT LANGUAGE='javascript'>
                   getPage($count)
                </SCRIPT>";
                   }

                   ?>
                   </tbody>
               </table>

               <div class="col-sm-12" style="margin-top: 15px">
                   <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count?> รายการ</div>
                   <!--                <ul class="pagination">-->
                   <!--                    <li><a href="#">&laquo;</a></li>-->
                   <!--                    <li><a href="#">1</a></li>-->
                   <!--                    <li><a href="#">2</a></li>-->
                   <!--                    <li><a href="#">3</a></li>-->
                   <!--                    <li><a href="#">4</a></li>-->
                   <!--                    <li><a href="#">5</a></li>-->
                   <!--                    <li><a href="#">&raquo;</a></li>-->
                   <!--                </ul>-->
               </div>




            </div>
          </div>
          <script type="text/javascript">

              function confirm_delete(aid){
                  bootbox.confirm("ยืนยันการลบข้อมูล !", function(result) {
                      if(result){

                          window.location='sqlfunction.php?method=admin_delete_advisor&aid='+aid+'&cur='+3;
                      } else {
                          console.log("User declined dialog");
                      }
                  });
              }
          </script>
          <script>
              function export_xls() {
                  window.location = 'src/function/export_advisor_class_xls.php';
              }
          </script>

<!--          </div>-->
<!---->
<!---->
<!--      </div><!-- /#page-wrapper -->
<!---->
<!---->
<!---->
<!--})-->
<!---->
<!--</script>-->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
