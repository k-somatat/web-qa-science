<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "งานวิจัย";
$page_icon = "list-alt";
$page_home_active = "";
$page_president_research_active = "active";
$page_dropdown_president_open = "open";

require_once(ABSPATH . 'src/DAO/ResearchDAO.class.php');
require_once(ABSPATH . 'src/vo/Research.class.php');

// Page Setup END
?>

<!-- Header Include Here -->
<?php include("president/commons/page-header1.0.php"); ?>
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
                <li>งานวิจัย</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลงานวิจัย</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li class="active"><a href="#president_research_academic" data-toggle="tab">ข้อมูลงานวิจัย</a></li>
                <li><a href="president_research_graph_academic.php">การเสนอผลงานวิจัย/วิชาการ</a></li>
                <li><a href="president_research_graph_funded.php">งานวิจัยที่ได้รับทุนสนับสนุน</a></li>
                <li><a href="president_research_graph_applied.php">ผลงานวิจัยที่นำไปใช้ประโยชน์</a></li>
<!--                <li><a href="president_research_graph_budget.php">กราฟแสดงงบประมาณงานวิจัยแต่ละปีการศึกษา</a></li>-->
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="president_research_academic">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลผลงานวิจัย </p>

            <div class="form-group">
                <div class="form-control col-sm-12" style="background-color: ; border-left: hidden; border-right: hidden; border-top: hidden; height: 50px">
                    <form method="post" action="<?=site_url.'sqlfunction.php?method=president_search_research&NoData=1'?>">

                    <p class="col-md-2" style="text-align: left; color: #000; margin-top: 10px">
                        ปีการศึกษา </p>
                    <div >
                        <select class="form-control" name="startYear" style="position: absolute; margin-left: 100px; width: 100px; height: 30px; margin-top: 5px">
                            <?
                            $researchDAO = new ResearchDAO();
                            $research = new Research();

                            $research = $researchDAO->findAll();


                            for($index = 0; $index<count($research['research_id']); $index++){

                                $date = explode('-',$research['research_date'][$index]);

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

                            ?>
                        </select>
                    </div>
                    <p style="position: absolute; margin-left: 220px; width: 100px; height: 30px; margin-top: 11px; color: #000; font-size: 15px">
                        ถึง </p>

                    <div>
                        <select class="form-control" name="endYear" style="position: absolute; margin-left: 260px; width: 100px; height: 30px; margin-top: 5px">
                            <?
                            $researchDAO = new ResearchDAO();
                            $research = new Research();

                            $research = $researchDAO->findAll();


                            for($index = 0; $index<count($research['research_id']); $index++){

                                $date = explode('-',$research['research_date'][$index]);

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
                <th style=" text-align: center">จำนวนผลงาน / ภาควิชา <i class="fa fa-sort" ></i></th>
                <th style=" text-align: center">จำนวนทุนสนับสนุน / บาท <i class="fa fa-sort"></i></th>
                <th style=" text-align: center">ดูรายละเอียด <i class="fa fa-sort"></i></th>

                </thead>
                <tbody>
                <?
                $researchDAO = new ResearchDAO();
                $research = new Research();

                if(!empty($_GET['NoCo'])){
                    $NoResearch = unserialize($_GET['NoCo']);
                }



                $research = $researchDAO->findAll();

                $len = count($research['research_id']);

                $userRoleDAO = new UserRoleDAO();
                $userDAO = new UserDAO();

                $Math = 0;
                $Physics = 0;
                $Chemistry = 0;
                $Food = 0;
                $Com = 0;
                $MathUserId = array();
                $PhysicsUserId = array();
                $ChemistryUserId = array();
                $FoodUserId = array();
                $ComUserId = array();
                $MathBudget = 0;
                $PhysicsBudget = 0;
                $ChemistryBudget = 0;
                $FoodBudget = 0;
                $ComBudget = 0;



                for ($index = 0; $index < $len; $index++) {
                    $user = new User();

                if(!empty($NoResearch)){

                    $spiltYear = explode('-',$research['research_date'][$index]);

                if($NoResearch[0] == $spiltYear[0]+543){

                $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);

                if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                    $user = $userDAO->findbyUserId($research['user_id'][$index]);


                    switch($user['major_id'][0]){
                        case 1 :
                            $Math = $Math + 1;
                            $MathBudget = $MathBudget+$research['research_budget'][$index];
                            break;
                        case 2 :
                            $Physics = $Physics + 1;
                            $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
                            break;
                        case 3 :
                            $Chemistry = $Chemistry + 1;
                            $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
                            break;
                        case 4 :
                            $Food = $Food + 1;
                            $FoodBudget = $FoodBudget+$research['research_budget'][$index];
                            break;
                        case 5 :
                            $Com = $Com + 1;
                            $ComBudget = $ComBudget+$research['research_budget'][$index];
                            break;
                    }
                }

                }else if($NoResearch[1] == $spiltYear[0]+543){

                    $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);

                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                        $user = $userDAO->findbyUserId($research['user_id'][$index]);


                        switch($user['major_id'][0]){
                            case 1 :
                                $Math = $Math + 1;
                                $MathBudget = $MathBudget+$research['research_budget'][$index];
                                break;
                            case 2 :
                                $Physics = $Physics + 1;
                                $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
                                break;
                            case 3 :
                                $Chemistry = $Chemistry + 1;
                                $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
                                break;
                            case 4 :
                                $Food = $Food + 1;
                                $FoodBudget = $FoodBudget+$research['research_budget'][$index];
                                break;
                            case 5 :
                                $Com = $Com + 1;
                                $ComBudget = $ComBudget+$research['research_budget'][$index];
                                break;
                        }
                    }
                }else if($NoResearch[2] == $spiltYear[0]+543){
                    $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);

                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                        $user = $userDAO->findbyUserId($research['user_id'][$index]);


                        switch($user['major_id'][0]){
                            case 1 :
                                $Math = $Math + 1;
                                $MathBudget = $MathBudget+$research['research_budget'][$index];
                                break;
                            case 2 :
                                $Physics = $Physics + 1;
                                $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
                                break;
                            case 3 :
                                $Chemistry = $Chemistry + 1;
                                $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
                                break;
                            case 4 :
                                $Food = $Food + 1;
                                $FoodBudget = $FoodBudget+$research['research_budget'][$index];
                                break;
                            case 5 :
                                $Com = $Com + 1;
                                $ComBudget = $ComBudget+$research['research_budget'][$index];
                                break;
                        }
                    }
                }
                }else{
                    $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);

                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                        $user = $userDAO->findbyUserId($research['user_id'][$index]);


                        switch($user['major_id'][0]){
                            case 1 :
                                $Math = $Math + 1;
                                $MathUserId[$index] = $research['user_id'][$index];
                                $MathBudget = $MathBudget+$research['research_budget'][$index];
                                break;
                            case 2 :
                                $Physics = $Physics + 1;
                                $PhysicsUserId[$index] = $research['user_id'][$index];
                                $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
                                break;
                            case 3 :
                                $Chemistry = $Chemistry + 1;
                                $ChemistryUserId[$index] = $research['user_id'][$index];
                                $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
                                break;
                            case 4 :
                                $Food = $Food + 1;
                                $FoodUserId[$index] = $research['user_id'][$index];
                                $FoodBudget = $FoodBudget+$research['research_budget'][$index];
                                break;
                            case 5 :
                                $Com = $Com + 1;
                                $ComUserId[$index] = $research['user_id'][$index];
                                $ComBudget = $ComBudget+$research['research_budget'][$index];
                                break;
                        }
                    }
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
                            echo "<td>" . $Math . "</td>" .
                                "<td>" . number_format($MathBudget,2) . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_research.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                            break;
                        case 2 :
                            echo "<td>" . $Physics . "</td>" .
                                "<td>" . number_format($PhysicsBudget,2) . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_research.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                            break;
                        case 3 :
                            echo "<td>" . $Chemistry . "</td>" .
                                "<td>" . number_format($ChemistryBudget,2) . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_research.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                            break;
                        case 4 :
                            echo "<td>" . $Food . "</td>" .
                                "<td>" . number_format($FoodBudget,2) . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_research.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                            break;
                        case 5 :
                            echo "<td>" . $Com . "</td>" .
                                "<td>" . number_format($ComBudget,2) . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_research.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td></tr>" ;

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



    <script>
        $(function () {
            $('#myTab a:last').tab('show')
        })
    </script>


    <script type="text/javascript">
        function confirm_delete(rid) {
            bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
                if (result) {

                    window.location = 'sqlfunction.php?method=delete_research&rid=' + rid + '&cur=' + 1;
                } else {
                    console.log("User declined dialog");
                }
            });
        }
    </script>


</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->


<!--$len = count($table_pk['COLUMN_NAME']);-->