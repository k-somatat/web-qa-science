<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "สรุปผลการอบรม/สัมมนา/ประชุมวิชาการ";
$page_icon = "list-alt";
$page_president_conference_active = "active";
$page_dropdown_president_open = "open";
// Page Setup END

?>
<!-- Header Include Here -->
<?php include("president/commons/page-header1.0.php");
require_once(ABSPATH . 'src/DAO/ConferenceDAO.class.php');
?>

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
                <li>แฟ้มสะสมงาน</li>
                <li>สรุปผลการอบรม/สัมมนา/ประชุมวิชาการ</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการทั้งหมด</li>
            </ol>
            <div class="alert alert-success alert-dismissable hide">
                <button type="button" class="closse" data-dismiss="alert" aria-hidden="true">&times;</button>
                Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel
                free to use this template for your admin needs! We are using a few different plugins to handle the
                dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
<!--                <li class="active"><a href="#president_conference">ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการทั้งหมด</a></li>-->
<!--                -->
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="president_conference">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการ </p>

            <table class=" table-bordered ">
                <thead class="table-modify" style="text-align: center">
                <th  style="width: 5%; height: 50px;  text-align: center"> ลำดับที่ <i class="fa fa-sort"></i></th>
                <th style="width: 25%; text-align: center">ชื่องาน <i class="fa fa-sort" ></i>
                  </th>
                <th class="text-center">หน่วยงาน <i class="fa fa-sort"></i></th>
                <th style="width: 11%; text-align: center">วันที่นำเสนอ <i class="fa fa-sort"></i></th>
                <th style="width: 5%; text-align: center">สถานที่ <i class="fa fa-sort"></i></th>
                <th  style="width: 15%; text-align: center">ชื่อบุคลากร <i class="fa fa-sort"></i></th>
                <th class="text-center">ค่าใช้จ่าย (บาท) <i class="fa fa-sort"></i></th>
                <th class="text-center">เอกสารบันทึกไฟล์ <i class="fa fa-sort"></i></th>
<!--                <th class="text-center">แก้ไขข้อมูล </th>-->
<!--                <th class="text-center">ลบข้อมูล </th>-->
                </thead>
                <tbody>
                <?
                $query_method = "delete_conference";
                $conferenceDao = new ConferenceDAO();
                $conference = new Conference();
                $conference = $conferenceDao->findAll();

                $len = count($conference['conference_id']);
                $count = 1;
                for ($index = 0; $index < $len; $index++) {
//                    if ($conference['user_id'][$index] == $_SESSION["USER"]["user_id"][0]) {
                        echo "<tr style='text-align: center'>
                                                  <td>" . $count . "</td>" .
                            "<td>" . $conference['conference_name'][$index] . "</td>" .
                            "<td>" . $conference['conference_institution'][$index] . "</td>" ;

                            $split_date = explode('-',$conference['conference_date'][$index]);
                            $split_date_end = explode('-',$conference['conference_date_end'][$index]);
                            $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
                            $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

                            if($conference['conference_date_end'][$index] != '0000-00-00'){

                                echo '<td>' ."<table boder='1' style='width: 100%;'><tr><td>"."เริ่ม  ". $date ."</td></tr><tr><td>". "ถึง  "
                                    . $date_end ."</td></tr></table>". '</td>';
                            }else{
                                echo '<td>'. $date . '</td>';
                            }

                            echo "<td>" . $conference['conference_location'][$index] . "</td>" .
                            "<td>" . $conference['conference_tech_name'][$index] . "</td>" ;


                        if($conference['conference_budget'][$index] === null){
                            echo "<td>" . "<font color=blue ><b> - </b></font>" . "</td>";
                        }
                        else{
                            $split_budget = explode(".",$conference['conference_budget'][$index]);
                            if($split_budget[1] == null){
                                $budget = $conference['conference_budget'][$index]."."."00";
                                $budget = add_comma($budget);
                            }else{
                                $budget = $conference['conference_budget'][$index];
                                $budget = add_comma($budget);
                            }
                            echo "<td>" . $budget . "</td>";
                        }

                        if ($conference['conference_document'][$index] == "") {
                            echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                        } else {
                            echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $conference['conference_document'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                        }
//                        echo
//                            "<td>" .
//                            "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='conference_form.php?cid=" . $conference['conference_id'][$index] . "'>
//                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
//                            . "</td>" .
////                        "<td>" . '<a href="conference_form.php?cid=' . $conference['conference_id'][$index] . '"><image src="images/Edit.png" height="50" width="60">' . "</td>" .
////                        "<td>" . '<image src="images/Edit.png" onClick="edit_conference(' . $conference['conference_id'][$index] . ')">' . "</td>" .
////                        "<td>" . '<a href="sqlfunction.php?method='.$query_method.'&cid=' . $conference['conference_id'][$index] . '"><image src="images/Delete.png" height="50" width="60">' . "</td> </tr>";
//                            "<td>" .
////                        "<button class='btn btn-large btn-danger' onclick=window.location.href='sqlfunction.php?method=".$query_method."&cid=".$conference['conference_id'][$index]."'>
//                            "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $conference['conference_id'][$index] . ")>
//                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
//                            . "</td></tr>";
                        $count++;
//                    } else {
//
//                    }
                }
                ?>
                </tbody>
            </table>

            <div class="col-sm-12" style="margin-top: 15px">
                <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count-1?> รายการ</div>
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

        <div class="tab-pane" id="add-conference">
        </div>
    </div>


<script type="text/javascript">
    $(function () {
        $('#dateTimePicker').datetimepicker({
            pickTime: false
        });
    });
</script>


<script>
    //              function showmytab(){

    $(function () {
        $('#myTab a:last').tab('show')
//                      $(function () { var a = $('[href=' + location.hash + ']'); a && a.tab('show'); });
//                      $('.nav a').on('shown', function (e) { window.location = "#add-confernce"; })
//                      $('a[href=#add-confernce]').tab('show');

    })
    //              }
</script>


<script src="js/jquery.min.js"></script>
<script>

    function confirm_delete(cid) {
        bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
            if (result) {

                window.location = 'sqlfunction.php?method=delete_conference&cid=' + cid;
            } else {
                console.log("User declined dialog");
            }
        });
    }

    //    function confirm(){
    //        window.location.href='sqlfunction.php?method=".$query_method."&cid=".$conference['conference_id'][$index]."'
    //    }

    function edit_conference(cid) {
//                  $.get("http://localhost/Project/SCI/Project/conference.php",{"id",cid});
        <!--                    alert('-->
        <?//=site_url ?><!--'+"conference.php?Cid="+cid);-->
//                  window.location.href = "editConference.php?cid="+ cid;

        <!--                   document.write('-->
        <?//=$id;?><!--='+cid);-->
        <!--                   document.write('-->
        <?//  $id =" + cid + "; ?><!--');-->


////                      ajax start
//                      var xhr;
//                      if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers
//                      else xhr = new ActiveXObject("Microsoft.XMLHTTP");     // for IE
//
//                      var url = 'editConference.php?Cid=' + cid;
//                      xhr.open('GET', url, false);
//                      xhr.onreadystatechange = function () {
//                          if (xhr.readyState===4 && xhr.status===200) {
////                              var task = document.getElementById('task');
////                              var major = document.getElementById('major');
////                              var date = document.getElementById('date');
////                              var location = document.getElementById('location');
////                              var techName = document.getElementById('techName');
////                              var budget = document.getElementById('budget');
////                              var file = document.getElementById('file');
////                              task.innerHTML = xhr.responseText;
//
//
//                              alert(xhr.responseText);
//                          }
//                      }
//                      xhr.send();
////                      ajax stop
//                      return false;


//                  $.ajax({
//                      type : 'GET',
//                      url : "http://127.0.0.1/Project/SCI/Project/editConference.php",
//                      data : {Cid : cid},
//                      success: function(data){
//                          alert(data);
//                      }

//                  });
        $.ajax({
            type: 'GET',
            url: "editConference.php",
            data: $(e.target).serialize(),
            dataType: "json",
            success: function (data) {
                alert(data);
            }

        });


//                  $(function()){
//                      $('a[href=#add-confernce]').tab('show');
//                  });


//                $conferenceDao = new ConferenceDAO();
//                $result = $conferenceDao->findbyPK($_GET['ids']);

//                  document.getElementById("task").va
    }
</script>

<?php
function getConference()
{
    echo "<script>" . alert("dasdsa") . "</script>";
}

?>


</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->