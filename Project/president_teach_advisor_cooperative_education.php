<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="ภาระงานอาจารย์ที่ปรึกษา";
$page_icon="list-alt";
$page_president_teach_advisor_active = "active";
$page_dropdown_teach_open = "open";

require_once(ABSPATH . "src/DAO/AdvisorDAO.class.php");
require_once(ABSPATH . "src/vo/Advisor.class.php");
// Page Setup END

?>

<!-- Header Include Here -->
<?php include("president/commons/page-header1.0.php"); ?>
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
                <li>ส่วนของอาจารย์</li>
                <li>ภาระงานอาจารย์ที่ปรึกษา</li>
              <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> อาจารย์ที่ปรึกษาสหกิจศึกษา</li>
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
                      <li><a href="president_teach_student_class.php">ข้อมูลนักศึกษา</a></li>
                      <li><a href="president_teach_advisor_class.php" >อาจารย์ที่ปรึกษาชั้นปี</a></li>
                      <li><a href="president_teach_advisor_project.php">อาจารย์ที่ปรึกษาโครงงาน</a></li>
                      <li class="active"><a href="#advisor_cooperative_education" data-toggle="tab">อาจารย์ที่ปรึกษาสหกิจศึกษา</a></li>
                      <li><a href="president_teach_advisor_form.php">เพิ่มข้อมูล</a></li>
                  </ul>
              </div>
          </div><!-- /.row -->

          <!-- Tab panes -->
            <div class="tab-pane active" id="advisor_project">

            </div>


            <div class="tab-pane" id="advisor_cooperative_education">
                <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; " > ข้อมูลที่ปรึกษาสหกิจศึกษา </p>

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
                        <th style="width: 7%;  text-align: center;">ลำดับที่ <i class="fa fa-sort"></i></th>
                        <th style="width: 25%; text-align: center; ">ชื่อโครงการ <i class="fa fa-sort"></i></th>
                        <th style="width: 20%; text-align: center;">ผู้จัดทำ <i class="fa fa-sort"></i></th>
                        <th style="text-align: center; width: 10%">ปีการศึกษา <i class="fa fa-sort"></i></th>
                        <th style="text-align: center; width: 20%">สถานประกอบการ <i class="fa fa-sort"></i></th>
                        <th style="text-align: center; width: 10%">เอกสารอ้างอิง <i class="fa fa-sort"></i></th>
                        <th style="text-align: center;">แก้ไขข้อมูล</th>
                        <th style="text-align: center;">ลบข้อมูล</th>
                    </thead>
                    <tbody>
<!--                    <tr  style="text-align: center">-->
<!--                        <td>1</td>-->
<!--                        <td>แอพพลิเคชั่นทายผลบอลบนระบบปฏิบัติการแอนดรอย์</td>-->
<!--                        <td>นายกิตติชัย โสมทัตถ์</td>-->
<!--                        <td>2556</td>-->
<!--                        <td>บริษัทโครตันจำกัด</td>-->
<!--                        <td>-</td>-->
<!--                    </tr>-->

                    <?

                    $advisorDAO = new AdvisorDAO();
                    $advisor = new Advisor();

                    $advisor = $advisorDAO->findbyAdvisorTypeId(2);

                    $advisorUserId = $advisorDAO->findbyUserId($_SESSION['USER']['user_id'][0]);
                    $_SESSION['advisorCooperative_education'] = $advisorUserId;

                    $len = count($advisor['advisor_id']);
                    $count = 1;

                    for($index=0; $index<$len; $index++){
                        if($advisor['user_id'][$index] == $_SESSION["USER"]["user_id"][0]){
                            echo "<tr style='text-align: center'>"."<td>".$count."</td>";
                            echo "<td>".$advisor['advisor_name'][$index].'</td>';

                            $amount = $advisor['advisor_amount'][$index];
                            switch($amount){
                                case 1 :
                                    $spilt_author1 = explode(' ',$advisor['advisor_author'][$index]);
                                    echo '<td>' . $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2] . '</td>' ;
                                    break;
                                case 2 :
                                    $spilt_author1 = explode(' ',$advisor['advisor_author'][$index]);
                                    $spilt_author2 = explode(' ',$advisor['advisor_author2'][$index]);
                                    echo '<td>' . $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2] . '<br>'
                                        . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] . '</td>' ;
                                   break;
                                case 3 :
                                    $spilt_author1 = explode(' ',$advisor['advisor_author'][$index]);
                                    $spilt_author2 = explode(' ',$advisor['advisor_author2'][$index]);
                                    $spilt_author3 = explode(' ',$advisor['advisor_author3'][$index]);
                                    echo '<td>' . $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2] . '<br>'
                                        . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] . '<br>'
                                        . $spilt_author3[0].$spilt_author3[1]." ".$spilt_author3[2] . '</td>' ;
                                    break;
                                case 4 :
                                    $spilt_author1 = explode(' ',$advisor['advisor_author'][$index]);
                                    $spilt_author2 = explode(' ',$advisor['advisor_author2'][$index]);
                                    $spilt_author3 = explode(' ',$advisor['advisor_author3'][$index]);
                                    $spilt_author4 = explode(' ',$advisor['advisor_author4'][$index]);
                                    echo '<td>' . $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2] . '<br>'
                                                . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] . '<br>'
                                                . $spilt_author3[0].$spilt_author3[1]." ".$spilt_author3[2] . '<br>'
                                                . $spilt_author4[0].$spilt_author4[1]." ".$spilt_author4[2] . '</td>' ;
                                    break;
                                case 5 :
                                    $spilt_author1 = explode(' ',$advisor['advisor_author'][$index]);
                                    $spilt_author2 = explode(' ',$advisor['advisor_author2'][$index]);
                                    $spilt_author3 = explode(' ',$advisor['advisor_author3'][$index]);
                                    $spilt_author4 = explode(' ',$advisor['advisor_author4'][$index]);
                                    $spilt_author5 = explode(' ',$advisor['advisor_author5'][$index]);
                                    echo '<td>' . $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2] . '<br>'
                                                . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] . '<br>'
                                                . $spilt_author3[0].$spilt_author3[1]." ".$spilt_author3[2] . '<br>'
                                                . $spilt_author4[0].$spilt_author4[1]." ".$spilt_author4[2] . '<br>'
                                                . $spilt_author5[0].$spilt_author5[1]." ".$spilt_author5[2] . '</td>' ;
                                    break;
                            }

                           echo '<td>'.$advisor['advisor_year'][$index].'</td>'.
                            '<td>'.$advisor['advisor_location'][$index].'</td>';

                        if($advisor['advisor_document'][$index] == ""){
                            echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                        }else{
                            echo  "<td>" . '<a href="'.site_url.'src/function/download.php?filename='.$advisor['advisor_document'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>" ;
                        }
                        echo
                            "<td>".
                            "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='president_teach_advisor_form.php?aid=".$advisor['advisor_id'][$index]."'>
                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
                            ."</td>".
                            "<td>".
                            "<button class='btn btn-large btn-danger' onclick=confirm_delete(".$advisor['advisor_id'][$index].")>
                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
                            ."</td></tr>";
                            $count++;
                        }else{

                        }
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

            <div class="tab-pane" id="add_advisor">

            </div>


        <script type="text/javascript">

            function confirm_delete(aid){
                bootbox.confirm("ยืนยันการลบข้อมูล !", function(result) {
                    if(result){

                        window.location='sqlfunction.php?method=president_delete_advisor&aid='+aid+'&cur='+2;
                    } else {
                        console.log("User declined dialog");
                    }
                });
            }
        </script>



          <script>
              $(function () {
                  $('#myTab a:last').tab('show')
              })
          </script>
        <script>
            function export_xls() {
                window.location = 'src/function/export_advisor_cooperative_education_xls.php';
            }
        </script>


      </div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
