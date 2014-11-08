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
                <li>ส่วนของผู้บริหาร</li>
                <li>การอบรม/สัมมนา/ประชุมวิชาการ</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการ</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li class="active"><a href="#president_conference">ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการทั้งหมด</a></li>
                <li><a href="president_conference_graph.php">ผลการอบรม/สัมมนา/ประชุมวิชาการ</a></li>

            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="president_conference">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการ </p>

            <div class="form-group">
                <div class="form-control col-sm-12" style="background-color: ; border-left: hidden; border-right: hidden; border-top: hidden; height: 50px">
                <form method="post" action="<?=site_url.'sqlfunction.php?method=president_search_conference&NoData=1'?>">
                <p class="col-md-2" style="text-align: left; color: #000; margin-top: 10px">
                    ปีการศึกษา </p>
                <div >
                    <select class="form-control" name="startYear" style="position: absolute; margin-left: 100px; width: 100px; height: 30px; margin-top: 5px">
                        <?
                        $conferenceDAO = new ConferenceDAO();
                        $conferenceQuery = new Conference();

                        $conferenceQuery = $conferenceDAO->findAll();

                        for($index = 0; $index<count($conferenceQuery['conference_id']); $index++){

                            $date = explode('-',$conferenceQuery['conference_date'][$index]);

                            $yearQuery = intval($date[0]) + 543;
                            $yearNow = date('Y') + 543;

                            $key = array_search($yearQuery,$year);
                            if(strlen($key) == '')
                                $year[$index] = $yearQuery;
                        }

                        usort($year,'sortYear');

                        foreach($year as $key => $values){
                            echo "<option value='".$values."'>".$values."</option>";
                        }
                        ?>
                    </select>
                </div>
                <p style="position: absolute; margin-left: 220px; width: 100px; height: 30px; margin-top: 11px; color: #000; font-size: 15px">
                    ถึง </p>

                <div>
                    <select class="form-control" name="endYear" style="position: absolute; margin-left: 260px; width: 100px; height: 30px; margin-top: 5px">
                        <?
                        $conferenceDAO = new ConferenceDAO();
                        $conferenceQuery = new Conference();

                        $conferenceQuery = $conferenceDAO->findAll();

                        for($index = 0; $index<count($conferenceQuery['conference_id']); $index++){

                            $date = explode('-',$conferenceQuery['conference_date'][$index]);

                            $yearQuery = intval($date[0]) + 543;
                            $yearNow = date('Y') + 543;

                            $key = array_search($yearQuery,$year);
                            if(strlen($key) == '')
                                $year[$index] = $yearQuery;
                        }

                        usort($year,'sortYear');

                        foreach($year as $key => $values){
                            echo "<option value='".$values."'>".$values."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div>
<!--                    <input type="submit" value="ค้นหา" class="btn btn-danger " style="position: absolute; margin-left: 260px; width: 100px; height:35px; margin-top: 3px">-->
                    <button class='btn btn-large btn-info btn-danger' type="submit" style="position: absolute; margin-left: 210px; width: 100px; height:35px; margin-top: 1px">
                    <i class='glyphicon glyphicon-search'></i> ค้นหา</button>
                </div>

                <p style="position: absolute; margin-left: 510px; width: 100px; height: 30px; margin-top: 11px; color: #e9322d; white-space: nowrap; font-weight: bold; font-size: 15px;">
                    เปรียบเทียบได้ไม่เกิน 3 ปีการศึกษา </p>
                </div>
                </form>
            </div>

            <table class=" table fa-border table-bordered ">
                <thead class="table-modify" style="text-align: center">
                <th  style=" height: 50px;  text-align: center"> ชื่อภาควิชา <i class="fa fa-sort"></i></th>
                <th style=" text-align: center">จำนวนอาจารย์ที่ได้รับการอบรม / คน <i class="fa fa-sort" ></i></th>
                <th style=" text-align: center">จำนวนค่าใช้จ่ายในการอบรมทั้งหมด / บาท <i class="fa fa-sort"></i></th>
                <th style=" text-align: center">ดูรายละเอียด <i class="fa fa-sort"></i></th>
                </thead>
                <tbody>
                <?
                $conferenceDao = new ConferenceDAO();
                $conference = new Conference();

                if(!empty($_GET['NoCo'])){
                    $NoConference = unserialize($_GET['NoCo']);
                }

                $conference = $conferenceDao->findAll();

                $len = count($conference['conference_id']);

                $userDAO = new UserDAO();

                $Math = 0;
                $MathUser;
                $Physics = 0;
                $PhysicsUser;
                $Chemistry = 0;
                $ChemistryUser;
                $Food = 0;
                $FoodUser;
                $Com = 0;
                $ComUser;
                $MathBudget = 0;
                $PhysicsBudget = 0;
                $ChemistryBudget = 0;
                $FoodBudget = 0;
                $ComBudget = 0;

                $userRoleDAO = new UserRoleDAO();
                $userRole = new UserRole();

                for ($index = 0; $index < $len; $index++) {
                    $user = new User();

                    if(!empty($NoConference)){



                        $spiltYear = explode('-',$conference['conference_date'][$index]);

                        if($NoConference[0] == $spiltYear[0]+543){

                            $userRole = $userRoleDAO->findbyUserId($conference['user_id'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($conference['user_id'][$index]);

                                switch($user['major_id'][0]){
                                    case 1 :
                                        $Math = $Math + 1;
                                        $MathUser[$index] = $conference['user_id'][$index];
                                        $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 2 :
                                        $Physics = $Physics + 1;
                                        $PhysicsUser[$index] = $conference['user_id'][$index];
                                        $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 3 :
                                        $Chemistry = $Chemistry + 1;
                                        $ChemistryUser[$index] = $conference['user_id'][$index];
                                        $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 4 :
                                        $Food = $Food + 1;
                                        $FoodUser[$index] = $conference['user_id'][$index];
                                        $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 5 :
                                        $Com = $Com + 1;
                                        $ComUser[$index] = $conference['user_id'][$index];
                                        $ComBudget = $ComBudget+$conference['conference_budget'][$index];
                                        break;
                                }
                            }

                        }else if($NoConference[1] == $spiltYear[0]+543){

                            $userRole = $userRoleDAO->findbyUserId($conference['user_id'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($conference['user_id'][$index]);

                                switch($user['major_id'][0]){
                                    case 1 :
                                        $Math = $Math + 1;
                                        $MathUser[$index] = $conference['user_id'][$index];
                                        $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 2 :
                                        $Physics = $Physics + 1;
                                        $PhysicsUser[$index] = $conference['user_id'][$index];
                                        $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 3 :
                                        $Chemistry = $Chemistry + 1;
                                        $ChemistryUser[$index] = $conference['user_id'][$index];
                                        $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 4 :
                                        $Food = $Food + 1;
                                        $FoodUser[$index] = $conference['user_id'][$index];
                                        $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 5 :
                                        $Com = $Com + 1;
                                        $ComUser[$index] = $conference['user_id'][$index];
                                        $ComBudget = $ComBudget+$conference['conference_budget'][$index];
                                        break;
                                }
                            }

                        }else if($NoConference[2] == $spiltYear[0]+543){

                            $userRole = $userRoleDAO->findbyUserId($conference['user_id'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($conference['user_id'][$index]);

                                switch($user['major_id'][0]){
                                    case 1 :
                                        $Math = $Math + 1;
                                        $MathUser[$index] = $conference['user_id'][$index];
                                        $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 2 :
                                        $Physics = $Physics + 1;
                                        $PhysicsUser[$index] = $conference['user_id'][$index];
                                        $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 3 :
                                        $Chemistry = $Chemistry + 1;
                                        $ChemistryUser[$index] = $conference['user_id'][$index];
                                        $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 4 :
                                        $Food = $Food + 1;
                                        $FoodUser[$index] = $conference['user_id'][$index];
                                        $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                        break;
                                    case 5 :
                                        $Com = $Com + 1;
                                        $ComUser[$index] = $conference['user_id'][$index];
                                        $ComBudget = $ComBudget+$conference['conference_budget'][$index];
                                        break;
                                }
                            }

                        }
                    }else{

                        $userRole = $userRoleDAO->findbyUserId($conference['user_id'][$index]);

                        if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                            $user = $userDAO->findbyUserId($conference['user_id'][$index]);


                            switch($user['major_id'][0]){
                                case 1 :
                                    $Math = $Math + 1;
                                    $MathUser = $conference['user_id'][$index];
                                    $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                    break;
                                case 2 :
                                    $Physics = $Physics + 1;
                                    $PhysicsUser = $conference['user_id'][$index];
                                    $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                    break;
                                case 3 :
                                    $Chemistry = $Chemistry + 1;
                                    $ChemistryUser = $conference['user_id'][$index];
                                    $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                    break;
                                case 4 :
                                    $Food = $Food + 1;
                                    $FoodUser = $conference['user_id'][$index];
                                    $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                    break;
                                case 5 :
                                    $Com = $Com + 1;
                                    $ComUser = $conference['user_id'][$index];
                                    $ComBudget = $ComBudget+$conference['conference_budget'][$index];
                                    break;
                            }
                        }

                    }




                }
//        ***************************** amount author
//                $conferences = new Conference();
//
//                $conferences = $conferenceDAO->findAll();
//
//                for($index = 0; $index < count($conferences['conference_id']); $index++){
//
//                    $conferenceId = $conferences['conference_id'][$index];
//                    $conferenceDate = explode('-',$conferences['conference_date'][$index]);
//                    $userId = $conferences['user_id'][$index];
//
//                    for($i = 0; $i < count($conferences['conference_id']); $i++){
//                        if($conferenceId != $conferences['conference_id'][$i]){
//                            if($userId == $conferences['user_id'][$i]){
//                                $splitDates = explode('-',$conferences['conference_date'][$i]);
//                                if($splitDates[0] == $conferenceDate[0]){
//                                    echo $conferenceId;
//                                   echo $userExist[$i] = $conferences['user_id'][$index]."<br>";
//                                }
//                            }
//                        }
//                    }
//
//                    $conferenceuserId[$index] = $conferences['user_id'][$index];
//
//                }
//
//
//                if($userExist != ''){
//                $userExist = array_unique($userExist);
//
//                    $keys = array_search($userExist,$conferenceuserId);
//
//                    if($keys !== false) unset($conferenceuserId[$keys]);
//
//                    if($conferenceuserId[$index] != $userExist[$index])
//
//                print_r(count($userExist));
//                }
//
//
//                for($index = 0; $index < count($conferenceuserId); $index++){
//
//                        $conferenceUser = $conferenceDAO->findbyUserId($conferenceuserId[$index]);
//
//                    $length =  count($conferenceUser['conference_id']);
//
//                    $users = $userDAO->findbyUserId($conferenceUser['user_id'][0]);
//
////                    print_r($users['user_id']);
//
//                    if($length > 1){
//                        for($i = $length; $i > 1; $i--){
//
////                            echo "length > 1 : ".$length."<br>";
//
//                            switch($users['major_id'][0]){
//                                case 1 :
//                                    $Math = $Math - 1;
//                                    break;
//                                case 2 :
//                                    $Physics = $Physics - 1;
//                                    break;
//                                case 3 :
//                                    $Chemistry = $Chemistry - 1;
//                                    break;
//                                case 4 :
//                                    $Food = $Food - 1;
//                                    break;
//                                case 5 :
//                                    $Com = $Com - 1;
//                                    break;
//                            }
//
//                        }
//                    }
//
//                }
                $NoCo = unserialize($_GET['NoCo']);
                $urlPortion = '&NoCo='.urlencode(serialize($NoCo));

                $majorDAO = new MajorDAO();
                $major = new Major();

                $major = $majorDAO->findAll();

                $count = 1;
                for($index = 0; $index<count($major['major_id']); $index++){
                    echo "<tr style='text-align: center'>
                    <td>" . $major['major_name'][$index] . "</td>" ;
                    $majorId = $major['major_id'][$index];
                        switch($major['major_id'][$index]){
                            case 1 :

                                echo "<td>" . $Math . "</td>" .
                                    "<td>" . number_format($MathBudget,2) . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_conference.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 2 :
                                echo "<td>" . $Physics . "</td>" .
                                    "<td>" . number_format($PhysicsBudget,2) . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_conference.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 3 :
                                echo "<td>" . $Chemistry . "</td>" .
                                    "<td>" . number_format($ChemistryBudget,2) . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_conference.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 4 :
                                echo "<td>" . $Food . "</td>" .
                                    "<td>" . number_format($FoodBudget,2) . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_conference.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 5 :
                                echo "<td>" . $Com . "</td>" .
                                    "<td>" . number_format($ComBudget,2) . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_conference.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td></tr>" ;

                                break;
                        }
                    $count++;

                }

                $total = $Math+$Physics+$Chemistry+$Food+$Com;
                $totalBudget = $MathBudget+$PhysicsBudget+$ChemistryBudget+$FoodBudget+$ComBudget;
                ?>
                <tr style="text-align: center"><td style="font-weight: bold; color: #e9322d">รวม</td>
                <td><?=$total?></td>
                <td><?=number_format($totalBudget,2)?></td></tr>


                </tbody>
            </table>

            <div class="col-sm-12" style="margin-top: 15px">
                <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count-1?> รายการ</div>
            </div>




    </div>
    </div>

    <?
        function sortYear($yearMin, $yearMax)
        {
            if ($yearMin == $yearMax) {
                return 0;
            }
            return ($yearMin    < $yearMax) ? -1 : 1;
        }
    ?>


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