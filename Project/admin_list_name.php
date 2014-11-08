<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "รายชื่อบุคลากร";
$page_icon = "list-alt";
$page_admin_list_name_active = "active";
// Page Setup END

?>
<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php");
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
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> <?=$page_name?></li>
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
<!--                <li class="active"><a href="#TQF">ข้อมูลรายชื่อบุคลากรคณะวิทยาศาสตร์</a></li>-->
<!--                <li><a href="TQF_form.php">เพิ่มข้อมูลกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</a></li>-->
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="conference">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลรายชื่อบุคลากรคณะวิทยาศาสตร์ </p>

            <table class=" table-bordered ">
                <thead class="table-modify" style="text-align: center">
                <th  style="width: 5%; height: 50px;  text-align: center"> ลำดับที่ <i class="fa fa-sort"></i></th>
                <th style="width: 35%; text-align: center">ชื่อ - นามสกุล <i class="fa fa-sort" ></i></th>
                <th  style="width: 20%; text-align: center">ตำแหน่ง <i class="fa fa-sort"></i></th>
                <th class="text-center">สาขา<i class="fa fa-sort"></i></th>
                <th style="width: 11%; text-align: center">เบอร์โทรติดต่อ<i class="fa fa-sort"></i></th>

                </thead>
                <tbody>
                <?

                $userDao = new UserDAO();
                $users = $userDao->findAll();

                $majorDAO = new MajorDAO();

                $len = count($users['user_id']);
                $count = 1;

                for ($index = 0; $index < $len; $index++) {
                    $major = new Major();
                    $major = $majorDAO->findbyMajorId($users['major_id'][$index]);
                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){

                        if($users['major_id'][$index] == 4){


                            echo "<tr style='text-align: center'>
                                                  <td>" . $count . "</td>" ;

                            $spilt_user = explode(' ',$users['user_first_name'][$index]);
                            echo '<td ">' . $spilt_user[0].$spilt_user[1]." ".$users['user_last_name'][$index] . '</td>' .

//                       echo "<td>" . $users['user_first_name'][$index] ." ".$users['user_last_name'][$index].  '</td>' .

                                "<td>" .$users['user_position'][$index]. "</td>" .
                                "<td>" .$major['major_name'][0] . "</td>" .
                                "<td>" .$users['user_tel'][$index] . "</td>" ;


                            $count++;
                        }
                    }

                }

                for ($index = 0; $index < $len; $index++) {
                    $major = new Major();
                    $major = $majorDAO->findbyMajorId($users['major_id'][$index]);
                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){

                        if($users['major_id'][$index] == 5){


                            echo "<tr style='text-align: center'>
                                                  <td>" . $count . "</td>" ;

                            $spilt_user = explode(' ',$users['user_first_name'][$index]);
                            echo '<td>' . $spilt_user[0].$spilt_user[1]." ".$users['user_last_name'][$index] . '</td>' .

//                       echo "<td>" . $users['user_first_name'][$index] ." ".$users['user_last_name'][$index].  '</td>' .

                                "<td>" .$users['user_position'][$index]. "</td>" .
                                "<td>" .$major['major_name'][0] . "</td>" .
                                "<td>" .$users['user_tel'][$index] . "</td>" ;


                            $count++;
                        }
                    }

                }

                for ($index = 0; $index < $len; $index++) {
                    $major = new Major();
                    $major = $majorDAO->findbyMajorId($users['major_id'][$index]);
                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){

                        if($users['major_id'][$index] == 1){


                            echo "<tr style='text-align: center'>
                                                  <td>" . $count . "</td>" ;

                            $spilt_user = explode(' ',$users['user_first_name'][$index]);
                            echo '<td>' . $spilt_user[0].$spilt_user[1]." ".$users['user_last_name'][$index] . '</td>' .

//                       echo "<td>" . $users['user_first_name'][$index] ." ".$users['user_last_name'][$index].  '</td>' .
                                "<td>" .$users['user_position'][$index]. "</td>" .
                                "<td>" .$major['major_name'][0] . "</td>" .
                                "<td>" .$users['user_tel'][$index] . "</td>" ;


                            $count++;
                        }
                    }

                }

                for ($index = 0; $index < $len; $index++) {
                    $major = new Major();
                    $major = $majorDAO->findbyMajorId($users['major_id'][$index]);
                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){

                        if($users['major_id'][$index] == 2){


                            echo "<tr style='text-align: center'>
                                                  <td>" . $count . "</td>" ;

                            $spilt_user = explode(' ',$users['user_first_name'][$index]);
                            echo '<td>' . $spilt_user[0].$spilt_user[1]." ".$users['user_last_name'][$index] . '</td>' .

//                       echo "<td>" . $users['user_first_name'][$index] ." ".$users['user_last_name'][$index].  '</td>' .
                                "<td>" .$users['user_position'][$index]. "</td>" .
                                "<td>" .$major['major_name'][0] . "</td>" .

                                "<td>" .$users['user_tel'][$index] . "</td>" ;


                            $count++;
                        }
                    }

                }

                for ($index = 0; $index < $len; $index++) {
                    $major = new Major();
                    $major = $majorDAO->findbyMajorId($users['major_id'][$index]);
                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){

                        if($users['major_id'][$index] == 3){


                            echo "<tr style='text-align: center'>
                                                  <td>" . $count . "</td>" ;

                            $spilt_user = explode(' ',$users['user_first_name'][$index]);
                            echo '<td>' . $spilt_user[0].$spilt_user[1]." ".$users['user_last_name'][$index] . '</td>' .

//                       echo "<td>" . $users['user_first_name'][$index] ." ".$users['user_last_name'][$index].  '</td>' .
                                "<td>" .$users['user_position'][$index]. "</td>" .
                                "<td>" .$major['major_name'][0] . "</td>" .

                                "<td>" .$users['user_tel'][$index] . "</td>" ;


                            $count++;
                        }
                    }

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

    function confirm_delete(tid) {
        bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
            if (result) {

                window.location = 'sqlfunction.php?method=delete_tqf&tid=' + tid;
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

<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->