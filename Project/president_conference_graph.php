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
                <li>สรุปผลการอบรม/สัมมนา/ประชุมวิชาการ</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ผลการอบรม/สัมมนา/ประชุมวิชาการ</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li ><a href="president_conference.php">ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการทั้งหมด</a></li>
                <li class="active"><a href="#president_conference_graph.php">ผลการอบรม/สัมมนา/ประชุมวิชาการ</a></li>

            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="president_conference">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
               ผลการอบรม/สัมมนา/ประชุมวิชาการ </p>

            <div class="form-group">
                <div class="form-control col-sm-12" style="background-color: ; margin-top: 30px; border-left: hidden; border-right: hidden; border-top: hidden; height: 50px">
                    <form method="post" action="<?=site_url.'sqlfunction.php?method=president_search_conference&NoData=2'?>">

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
                    <div>
                        <button class='btn btn-large btn-info btn-danger' type="submit" style="position: absolute; margin-left: 210px; width: 100px; height:35px; margin-top: 1px">
                            <i class='glyphicon glyphicon-search'></i> ค้นหา</button>
                    </div>

                <p style="position: absolute; margin-left: 510px; width: 100px; height: 30px; margin-top: 11px; color: #e9322d; white-space: nowrap; font-weight: bold; font-size: 15px;">
                    เปรียบเทียบได้ไม่เกิน 3 ปีการศึกษา </p>
                </div>
            </div>

            <?
            $conferenceDao = new ConferenceDAO();
            $conference = new Conference();

            if(!empty($_GET['NoCo'])){
                $NoConference = unserialize($_GET['NoCo']);
//                    $len = count($NoConference);
//                    for($i = 0; $i < $len; $i++){
//                        $conference['conference_id'][$i] = $NoConference[$i];
//                    }
            }

            $conference = $conferenceDao->findAll();

            $len = count($conference['conference_id']);

            $userDAO = new UserDAO();

            $Math = 0;
            $Physics = 0;
            $Chemistry = 0;
            $Food = 0;
            $Com = 0;
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
                                    $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                    break;
                                case 2 :
                                    $Physics = $Physics + 1;
                                    $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                    break;
                                case 3 :
                                    $Chemistry = $Chemistry + 1;
                                    $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                    break;
                                case 4 :
                                    $Food = $Food + 1;
                                    $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                    break;
                                case 5 :
                                    $Com = $Com + 1;
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
                                    $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                    break;
                                case 2 :
                                    $Physics = $Physics + 1;
                                    $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                    break;
                                case 3 :
                                    $Chemistry = $Chemistry + 1;
                                    $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                    break;
                                case 4 :
                                    $Food = $Food + 1;
                                    $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                    break;
                                case 5 :
                                    $Com = $Com + 1;
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
                                    $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                    break;
                                case 2 :
                                    $Physics = $Physics + 1;
                                    $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                    break;
                                case 3 :
                                    $Chemistry = $Chemistry + 1;
                                    $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                    break;
                                case 4 :
                                    $Food = $Food + 1;
                                    $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                    break;
                                case 5 :
                                    $Com = $Com + 1;
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
                                $MathBudget = $MathBudget+$conference['conference_budget'][$index];
                                break;
                            case 2 :
                                $Physics = $Physics + 1;
                                $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
                                break;
                            case 3 :
                                $Chemistry = $Chemistry + 1;
                                $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
                                break;
                            case 4 :
                                $Food = $Food + 1;
                                $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
                                break;
                            case 5 :
                                $Com = $Com + 1;
                                $ComBudget = $ComBudget+$conference['conference_budget'][$index];
                                break;
                        }
                    }

                }


//                $userRole = $userRoleDAO->findbyUserId($conference['user_id'][$index]);
//
//                if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){
//
//                    $user = $userDAO->findbyUserId($conference['user_id'][$index]);
//
//                    switch($user['major_id'][0]){
//                        case 1 :
//                            $Math = $Math + 1;
//                            $MathBudget = $MathBudget+$conference['conference_budget'][$index];
//                            break;
//                        case 2 :
//                            $Physics = $Physics + 1;
//                            $PhysicsBudget = $PhysicsBudget+$conference['conference_budget'][$index];
//                            break;
//                        case 3 :
//                            $Chemistry = $Chemistry + 1;
//                            $ChemistryBudget = $ChemistryBudget+$conference['conference_budget'][$index];
//                            break;
//                        case 4 :
//                            $Food = $Food + 1;
//                            $FoodBudget = $FoodBudget+$conference['conference_budget'][$index];
//                            break;
//                        case 5 :
//                            $Com = $Com + 1;
//                            $ComBudget = $ComBudget+$conference['conference_budget'][$index];
//                            break;
//                    }
//                }

            }

            $total = $Math+$Physics+$Chemistry+$Food+$Com;

            ?>


            <div class="form-group col-sm-12" style="color: #000000">


                <div class="col-sm-6" id="piechart" style="width: 600px; height: 550px;"></div>
                <div class="col-sm-5" style="background-color: #c4e3f3; margin-top: 80px">
                    <label for="lb_subject" style="margin-top: 20px; margin-left: 65px; color: #e9322d">จำนวนอาจารย์แต่ละภาควิชาที่ได้รับการอบรม</label><br>
                    <label for="lb_subject" style="margin-top: 15px; margin-left: 70px;">ภาควิชา</label>
                    <label for="lb_subject" style="margin-top: 15px; margin-left: 120px">จำนวนอาจารย์ / คน</label><br>
                    <label for="lb_subject" style="margin-left: 20px; margin-top: 15px"> ภาควิชาคณิตศาสตร์</label>
                    <label for="lb_subject" style="margin-left: 150px"> <?=$Math?></label><br>
                    <label for="lb_subject" style="margin-left: 20px;  margin-top: 15px"> ภาควิชาฟิสิกส์</label>
                    <label for="lb_subject" style="margin-left: 189px"> <?=$Physics?></label><br>
                    <label for="lb_subject" style="margin-left: 20px;  margin-top: 15px"> ภาควิชาเคมี</label>
                    <label for="lb_subject" style="margin-left: 204px"> <?=$Chemistry?></label><br>
                    <label for="lb_subject" style="margin-left: 20px;  margin-top: 15px"> ภาควิชาเทคโนโลยีการอาหาร</label>
                    <label for="lb_subject" style="margin-left: 97px"> <?=$Food?></label><br>
                    <label for="lb_subject" style="margin-left: 20px;  margin-top: 15px"> ภาควิชาวิทยาการคอมพิวเตอร์</label>
                    <label for="lb_subject" style="margin-left: 94px"> <?=$Com?></label><br>
                    <label for="lb_subject" style="margin-left: 20px;  margin-top: 15px; color: #e9322d"> รวม</label>
                    <label for="lb_subject" style="margin-left: 256px; color: #e9322d; text-decoration: underline"> <?=$total?></label><br><br><br>
                </div>
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
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['สาขา', 'ทำวิจัย', 'ไม่ทำวิจัย'],
                ['คณิตศาสตร์',<?=$Math?>,<?=$Math?>],
                ['ฟิสิกส์',<?=$Physics?>,<?=$Math?>],
                ['เคมี',<?=$Chemistry?>,<?=$Math?>],
                ['เทคโนโลยีการอาหาร',<?=$Food?>,<?=$Math?>],
                ['วิทยาการคอมพิวเตอร์',<?=$Com?>,<?=$Math?>]
            ]);

            var options = {
                title: 'จำนวนอาจารย์ที่ได้รับการอบรม',
                hAxis: {title: 'สาขา', titleTextStyle: {color: 'red'}}
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['สาขา', 'จำนวน'],
                ['คณิตศาสตร์',     <?=$Math?>],
                ['ฟิสิกส์',      <?=$Physics?>],
                ['เคมี',  <?=$Chemistry?>],
                ['เทคโนโลยีการอาหาร TV', <?=$Food?>],
                ['วิทยาการคอมพิวเตอร์',    <?=$Com?>]
            ]);

            var options = {
                title: 'จำนวนอาจารย์ที่ได้รับการอบรม'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>



</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->