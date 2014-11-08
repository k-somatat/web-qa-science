<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "โครงการ";
$page_icon = "list-alt";
$page_president_project_active = "active";
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
                <li>โครงการ</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลโครงการทั้งหมด</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                        <li class="active"><a href="#president_project" data-toggle="tab">ข้อมูลโครงการทั้งหมด</a></li>
<!--                        <li><a href="president_project_graph.php">เพิ่มข้อมูลโครงการ</a></li>-->

                        </ul>
                    </div>
                </div>
                <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="president_project">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลโครงการ </p>

            <div class="form-group">
                <div class="form-control col-sm-12" style="background-color: ; border-left: hidden; border-right: hidden; border-top: hidden; height: 50px">
                <form method="post" action="<?=site_url.'sqlfunction.php?method=president_search_project&NoData=1'?>">
                <p class="col-md-2" style="text-align: left; color: #000; margin-top: 10px">
                    ปีการศึกษา </p>
                <div >
                    <select class="form-control" name="startYear" style="position: absolute; margin-left: 100px; width: 100px; height: 30px; margin-top: 5px">
                        <?
                        $projectDAO = new ProjectDAO();
                        $project = new Project();

                        $project = $projectDAO->findAll();

                        for($index = 0; $index<count($project['project_id']); $index++){

                            $date = explode('-',$project['project_date'][$index]);

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
                        $projectDAO = new ProjectDAO();
                        $project = new Project();

                        $project = $projectDAO->findAll();

                        for($index = 0; $index<count($project['project_id']); $index++){

                            $date = explode('-',$project['project_date'][$index]);

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
                <th style=" text-align: center">จำนวนโครงการ <i class="fa fa-sort" ></i></th>
                <th style=" text-align: center">จำนวนงบประมาณที่ได้รับอนุมัติ / บาท <i class="fa fa-sort"></i></th>
                <th style=" text-align: center">จำนวนงบประมาณที่ใช้จริง / บาท <i class="fa fa-sort"></i></th>
                <th style=" text-align: center">ดูรายละเอียด <i class="fa fa-sort"></i></th>
                </thead>
                <tbody>
                <?

                $Math = 0;
                $Physics = 0;
                $Chemistry = 0;
                $Food = 0;
                $Com = 0;
                $MathCount = 0;
                $PhysicsCount = 0;
                $ChemistryCount = 0;
                $FoodCount = 0;
                $ComCount = 0;
                $MathBudget = 0;
                $PhysicsBudget = 0;
                $ChemistryBudget = 0;
                $FoodBudget = 0;
                $ComBudget = 0;

                if(!empty($_GET['NoCo'])){
                    $NoProject = unserialize($_GET['NoCo']);
                }

                $project = new Project();
                $project = $projectDAO->findAll();

                $len = count($project['project_id']);

                $userDAO = new UserDAO();

                $userRoleDAO = new UserRoleDAO();
                $userRole = new UserRole();

                for ($index = 0; $index < $len; $index++) {
                    $user = new User();

                    if(!empty($NoProject)){

                        $spiltYear = explode('-',$project['project_date'][$index]);

                        if($NoProject[0] == $spiltYear[0]+543){

                            $userRole = $userRoleDAO->findbyUserId($project['user_create'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($project['user_create'][$index]);


                                switch($user['major_id'][0]){
                                    case 1 :
                                        $MathCount = $MathCount + 1;
                                        $MathUser = $project['user_create'][$index];
                                        $MathBudget = $MathBudget+$project['project_budget'][$index];
                                        $MathBudgetFinal = $MathBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 2 :
                                        $PhysicsCount = $PhysicsCount + 1;
                                        $PhysicsUser = $project['user_create'][$index];
                                        $PhysicsBudget = $PhysicsBudget+$project['project_budget'][$index];
                                        $PhysicsBudgetFinal = $PhysicsBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 3 :
                                        $ChemistryCount = $ChemistryCount + 1;
                                        $ChemistryUser = $project['user_create'][$index];
                                        $ChemistryBudget = $ChemistryBudget+$project['project_budget'][$index];
                                        $ChemistryBudgetFinal = $ChemistryBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 4 :
                                        $FoodCount = $FoodCount + 1;
                                        $FoodUser = $project['user_create'][$index];
                                        $FoodBudget = $FoodBudget+$project['project_budget'][$index];
                                        $FoodBudgetFinal = $FoodBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 5 :
                                        $ComCount = $ComCount + 1;
                                        $ComUser = $project['user_create'][$index];
                                        $ComBudget = $ComBudget+$project['project_budget'][$index];
                                        $ComBudgetFinal = $ComBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                }
                            }


                        }else if($NoProject[1] == $spiltYear[0]+543){

                            $userRole = $userRoleDAO->findbyUserId($project['user_create'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($project['user_create'][$index]);


                                switch($user['major_id'][0]){
                                    case 1 :
                                        $MathCount = $MathCount + 1;
                                        $MathUser = $project['user_create'][$index];
                                        $MathBudget = $MathBudget+$project['project_budget'][$index];
                                        $MathBudgetFinal = $MathBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 2 :
                                        $PhysicsCount = $PhysicsCount + 1;
                                        $PhysicsUser = $project['user_create'][$index];
                                        $PhysicsBudget = $PhysicsBudget+$project['project_budget'][$index];
                                        $PhysicsBudgetFinal = $PhysicsBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 3 :
                                        $ChemistryCount = $ChemistryCount + 1;
                                        $ChemistryUser = $project['user_create'][$index];
                                        $ChemistryBudget = $ChemistryBudget+$project['project_budget'][$index];
                                        $ChemistryBudgetFinal = $ChemistryBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 4 :
                                        $FoodCount = $FoodCount + 1;
                                        $FoodUser = $project['user_create'][$index];
                                        $FoodBudget = $FoodBudget+$project['project_budget'][$index];
                                        $FoodBudgetFinal = $FoodBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 5 :
                                        $ComCount = $ComCount + 1;
                                        $ComUser = $project['user_create'][$index];
                                        $ComBudget = $ComBudget+$project['project_budget'][$index];
                                        $ComBudgetFinal = $ComBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                }
                            }


                        }else if($NoProject[2] == $spiltYear[0]+543){

                            $userRole = $userRoleDAO->findbyUserId($project['user_create'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($project['user_create'][$index]);


                                switch($user['major_id'][0]){
                                    case 1 :
                                        $MathCount = $MathCount + 1;
                                        $MathUser = $project['user_create'][$index];
                                        $MathBudget = $MathBudget+$project['project_budget'][$index];
                                        $MathBudgetFinal = $MathBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 2 :
                                        $PhysicsCount = $PhysicsCount + 1;
                                        $PhysicsUser = $project['user_create'][$index];
                                        $PhysicsBudget = $PhysicsBudget+$project['project_budget'][$index];
                                        $PhysicsBudgetFinal = $PhysicsBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 3 :
                                        $ChemistryCount = $ChemistryCount + 1;
                                        $ChemistryUser = $project['user_create'][$index];
                                        $ChemistryBudget = $ChemistryBudget+$project['project_budget'][$index];
                                        $ChemistryBudgetFinal = $ChemistryBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 4 :
                                        $FoodCount = $FoodCount + 1;
                                        $FoodUser = $project['user_create'][$index];
                                        $FoodBudget = $FoodBudget+$project['project_budget'][$index];
                                        $FoodBudgetFinal = $FoodBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                    case 5 :
                                        $ComCount = $ComCount + 1;
                                        $ComUser = $project['user_create'][$index];
                                        $ComBudget = $ComBudget+$project['project_budget'][$index];
                                        $ComBudgetFinal = $ComBudgetFinal+$project['project_final_budget'][$index];
                                        break;
                                }
                            }

                        }
                    }else{

                        $userRole = $userRoleDAO->findbyUserId($project['user_create'][$index]);

                        if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                            $user = $userDAO->findbyUserId($project['user_create'][$index]);


                            switch($user['major_id'][0]){
                                case 1 :
                                    $MathCount = $MathCount + 1;
                                    $MathUser = $project['user_create'][$index];
                                    $MathBudget = $MathBudget+$project['project_budget'][$index];
                                    $MathBudgetFinal = $MathBudgetFinal+$project['project_final_budget'][$index];
                                    break;
                                case 2 :
                                    $PhysicsCount = $PhysicsCount + 1;
                                    $PhysicsUser = $project['user_create'][$index];
                                    $PhysicsBudget = $PhysicsBudget+$project['project_budget'][$index];
                                    $PhysicsBudgetFinal = $PhysicsBudgetFinal+$project['project_final_budget'][$index];
                                    break;
                                case 3 :
                                    $ChemistryCount = $ChemistryCount + 1;
                                    $ChemistryUser = $project['user_create'][$index];
                                    $ChemistryBudget = $ChemistryBudget+$project['project_budget'][$index];
                                    $ChemistryBudgetFinal = $ChemistryBudgetFinal+$project['project_final_budget'][$index];
                                    break;
                                case 4 :
                                    $FoodCount = $FoodCount + 1;
                                    $FoodUser = $project['user_create'][$index];
                                    $FoodBudget = $FoodBudget+$project['project_budget'][$index];
                                    $FoodBudgetFinal = $FoodBudgetFinal+$project['project_final_budget'][$index];
                                    break;
                                case 5 :
                                    $ComCount = $ComCount + 1;
                                    $ComUser = $project['user_create'][$index];
                                    $ComBudget = $ComBudget+$project['project_budget'][$index];
                                    $ComBudgetFinal = $ComBudgetFinal+$project['project_final_budget'][$index];
                                    break;
                            }
                        }

//                        $userRole1 = $userRoleDAO->findbyUserId($project['project_author'][$index]);
//
//                        if($userRole1['role_id'][0] != 1 && $userRole1['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole1['role_id'][0] != 10){
//
//                            $user1 = $userDAO->findbyUserId($project['project_author'][$index]);
//
//                            switch($user1['major_id'][0]){
//                                case 1 :
//                                    $Math = $Math + 1;
//                                    break;
//                                case 2 :
//                                    $Physics = $Physics + 1;
//                                    break;
//                                case 3 :
//                                    $Chemistry = $Chemistry + 1;
//                                    break;
//                                case 4 :
//                                    $Food = $Food + 1;
//                                    break;
//                                case 5 :
//                                    $Com = $Com + 1;
//                                    break;
//                            }
//                        }
//
//                        $userRole2 = $userRoleDAO->findbyUserId($project['project_author2'][$index]);
//
//                        if($userRole2['role_id'][0] != 1 && $userRole2['role_id'][0] != 2 && $userRole2['role_id'][0] != 9 && $userRole2['role_id'][0] != 10){
//
//                            $user2 = $userDAO->findbyUserId($project['project_author2'][$index]);
//
//                            switch($user2['major_id'][0]){
//                                case 1 :
//                                    $Math = $Math + 1;
//                                    break;
//                                case 2 :
//                                    $Physics = $Physics + 1;
//                                    break;
//                                case 3 :
//                                    $Chemistry = $Chemistry + 1;
//                                    break;
//                                case 4 :
//                                    $Food = $Food + 1;
//                                    break;
//                                case 5 :
//                                    $Com = $Com + 1;
//                                    break;
//                            }
//                        }
//
//
//                        $userRole3 = $userRoleDAO->findbyUserId($project['project_author3'][$index]);
//
//                        if($userRole3['role_id'][0] != 1 && $userRole3['role_id'][0] != 2 && $userRole3['role_id'][0] != 9 && $userRole3['role_id'][0] != 10){
//
//                            $user3 = $userDAO->findbyUserId($project['project_author3'][$index]);
//
//                            switch($user3['major_id'][0]){
//                                case 1 :
//                                    $Math = $Math + 1;
//                                    break;
//                                case 2 :
//                                    $Physics = $Physics + 1;
//                                    break;
//                                case 3 :
//                                    $Chemistry = $Chemistry + 1;
//                                    break;
//                                case 4 :
//                                    $Food = $Food + 1;
//                                    break;
//                                case 5 :
//                                    $Com = $Com + 1;
//                                    break;
//                            }
//                        }

                    }
                }

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
                                echo "<td>" . $MathCount . "</td>" .
                                    "<td>" . $MathBudget . "</td>" .
                                    "<td>" . $MathBudgetFinal . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_project.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 2 :
                                echo "<td>" . $PhysicsCount . "</td>" .
                                    "<td>" . $PhysicsBudget . "</td>" .
                                    "<td>" . $PhysicsBudgetFinal . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_project.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 3 :
                                echo "<td>" . $ChemistryCount . "</td>" .
                                    "<td>" . $ChemistryBudget . "</td>" .
                                    "<td>" . $ChemistryBudgetFinal . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_project.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 4 :
                                echo "<td>" . $FoodCount . "</td>" .
                                    "<td>" . $FoodBudget . "</td>" .
                                    "<td>" . $FoodBudgetFinal . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_project.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 5 :
                                echo "<td>" . $ComCount . "</td>" .
                                    "<td>" . $ComBudget . "</td>" .
                                    "<td>" . $ComBudgetFinal . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_project.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td></tr>" ;

                                break;
                        }
                    $count++;

                }

                $total = $MathCount+$PhysicsCount+$ChemistryCount+$FoodCount+$ComCount;
                $totalBudget = $MathBudget+$PhysicsBudget+$ChemistryBudget+$FoodBudget+$ComBudget;
                $totalBudgetFinal = $MathBudgetFinal+$PhysicsBudgetFinal+$ChemistryBudgetFinal+$FoodBudgetFinal+$ComBudgetFinal;
                ?>
                <tr style="text-align: center"><td style="font-weight: bold; color: #e9322d">รวม</td>
                <td><?=$total?></td>
                <td><?=$totalBudget?></td>
                <td><?=$totalBudgetFinal?></td></tr>


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