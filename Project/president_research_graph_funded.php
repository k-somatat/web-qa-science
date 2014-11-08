<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "งานวิจัย";
$page_icon = "list-alt";
$page_home_active = "";
$page_president_research_active = "active";
$page_dropdown_president_open = "open";

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
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> งานวิจัยที่ได้รับทุนสนับสนุน</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li ><a href="president_research.php">ข้อมูลงานวิจัย</a></li>
                <li><a href="president_research_graph_academic.php" >การเสนอผลงานวิจัย/วิชาการ</a></li>
                <li class="active"><a href="#president_research_graph_funded" data-toggle="tab">งานวิจัยที่ได้รับทุนสนับสนุน</a></li>
                <li><a href="president_research_graph_applied.php">ผลงานวิจัยที่นำไปใช้ประโยชน์</a></li>
<!--                <li><a href="president_research_graph_budget.php">กราฟแสดงงบประมาณงานวิจัยแต่ละปีการศึกษา</a></li>-->
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active form-horizontal" id="president_research_graph_funded">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                งานวิจัยที่ได้รับทุนสนับสนุน </p>

                <div class="form-group">
                    <div class="form-control col-sm-12" style="background-color: ; border-left: hidden; border-right: hidden; border-top: hidden; height: 50px">
                        <form method="post" action="<?=site_url.'sqlfunction.php?method=president_search_research&NoData=3'?>">
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
                </div>

         </form>

        <div class="form-group">

            <?
                $researchDAO = new ResearchDAO();
                $research = new Research();

                if(!empty($_GET['NoCo'])){
                    $NoResearch = unserialize($_GET['NoCo']);
                }

                $research = $researchDAO->findAll();

                $userDAO = new UserDAO();
                $user = new User();

                $userRoleDAO = new UserRoleDAO();

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
                $MathQuery = 0;
                $PhysicsQuery = 0;
                $ChemistryQuery = 0;
                $FoodQuery = 0;
                $ComQuery = 0;
                $MathResearch = 0;
                $PhysicsResearch = 0;
                $ChemistryResearch = 0;
                $FoodResearch = 0;
                $ComResearch = 0;

                for($index = 0; $index<count($research['research_id']); $index++){
                    if($research['research_type_id'][$index] == 2){

                        if(!empty($NoResearch)){

                            $spiltYear = explode('-',$research['research_date'][$index]);

                            if($NoResearch[0] == $spiltYear[0]+543){

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

                            }else if($NoResearch[1] == $spiltYear[0]+543){

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
                            }else if($NoResearch[2] == $spiltYear[0]+543){
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


//                        switch($user['major_id'][0]){
//                            case 1 :
//                                $Math = $Math + 1;
//                                $MathArr[] = $user['user_id'][0];
//                                break;
//                            case 2 :
//                                $Physics = $Physics + 1;
//                                $PhysicsArr[] = $user['user_id'][0];
//                                break;
//                            case 3 :
//                                $Chemistry = $Chemistry + 1;
//                                $ChemistryArr[] = $user['user_id'][0];
//                                break;
//                            case 4 :
//                                $Food = $Food + 1;
//                                $FoodArr[] = $user['user_id'][0];
//                                break;
//                            case 5 :
//                                $Com = $Com + 1;
//                                $ComArr[] = $user['user_id'][0];
//                                break;
//                        }
                    }
//                    else if($research['research_type_id'][$index] == 2){
//
//                        if(!empty($NoResearch)){
//
//                            $spiltYear = explode('-',$research['research_date'][$index]);
//
//                            if($NoResearch[0] == $spiltYear[0]+543){
//
//                                $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);
//
//                                if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){
//
//                                    $user = $userDAO->findbyUserId($research['user_id'][$index]);
//
//
//                                    switch($user['major_id'][0]){
//                                        case 1 :
//                                            $Math2 = $Math2 + 1;
//                                            $MathBudget = $MathBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 2 :
//                                            $Physics2 = $Physics2 + 1;
//                                            $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 3 :
//                                            $Chemistry2 = $Chemistry2 + 1;
//                                            $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 4 :
//                                            $Food2 = $Food2 + 1;
//                                            $FoodBudget = $FoodBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 5 :
//                                            $Com2 = $Com2 + 1;
//                                            $ComBudget = $ComBudget+$research['research_budget'][$index];
//                                            break;
//                                    }
//                                }
//
//                            }else if($NoResearch[1] == $spiltYear[0]+543){
//
//                                $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);
//
//                                if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){
//
//                                    $user = $userDAO->findbyUserId($research['user_id'][$index]);
//
//
//                                    switch($user['major_id'][0]){
//                                        case 1 :
//                                            $Math2 = $Math2 + 1;
//                                            $MathBudget = $MathBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 2 :
//                                            $Physics2 = $Physics2 + 1;
//                                            $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 3 :
//                                            $Chemistry2 = $Chemistry2 + 1;
//                                            $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 4 :
//                                            $Food2 = $Food2 + 1;
//                                            $FoodBudget = $FoodBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 5 :
//                                            $Com2 = $Com2 + 1;
//                                            $ComBudget = $ComBudget+$research['research_budget'][$index];
//                                            break;
//                                    }
//                                }
//                            }else if($NoResearch[2] == $spiltYear[0]+543){
//                                $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);
//
//                                if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){
//
//                                    $user = $userDAO->findbyUserId($research['user_id'][$index]);
//
//
//                                    switch($user['major_id'][0]){
//                                        case 1 :
//                                            $Math2 = $Math2 + 1;
//                                            $MathBudget = $MathBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 2 :
//                                            $Physics2 = $Physics2 + 1;
//                                            $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 3 :
//                                            $Chemistry2 = $Chemistry2 + 1;
//                                            $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 4 :
//                                            $Food2 = $Food2 + 1;
//                                            $FoodBudget = $FoodBudget+$research['research_budget'][$index];
//                                            break;
//                                        case 5 :
//                                            $Com2 = $Com2 + 1;
//                                            $ComBudget = $ComBudget+$research['research_budget'][$index];
//                                            break;
//                                    }
//                                }
//                            }
//                        }else{
//                            $userRole = $userRoleDAO->findbyUserId($research['user_id'][$index]);
//
//                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){
//
//                                $user = $userDAO->findbyUserId($research['user_id'][$index]);
//
//
//                                switch($user['major_id'][0]){
//                                    case 1 :
//                                        $Math2 = $Math2 + 1;
//                                        $MathBudget = $MathBudget+$research['research_budget'][$index];
//                                        break;
//                                    case 2 :
//                                        $Physics2 = $Physics2 + 1;
//                                        $PhysicsBudget = $PhysicsBudget+$research['research_budget'][$index];
//                                        break;
//                                    case 3 :
//                                        $Chemistry2 = $Chemistry2 + 1;
//                                        $ChemistryBudget = $ChemistryBudget+$research['research_budget'][$index];
//                                        break;
//                                    case 4 :
//                                        $Food2 = $Food2 + 1;
//                                        $FoodBudget = $FoodBudget+$research['research_budget'][$index];
//                                        break;
//                                    case 5 :
//                                        $Com2= $Com2 + 1;
//                                        $ComBudget = $ComBudget+$research['research_budget'][$index];
//                                        break;
//                                }
//                            }
//                        }



//                    *********************************************

//                        $user = $userDAO->findbyUserId($research['user_id'][$index]);
//
//                        switch($user['major_id'][0]){
//                            case 1 :
//                                $Math2 = $Math2 + 1;
//                                $MathArr2[] = $user['user_id'][0];
//                                break;
//                            case 2 :
//                                $Physics2 = $Physics2 + 1;
//                                $PhysicsArr2[] = $user['user_id'][0];
//                                break;
//                            case 3 :
//                                $Chemistry2 = $Chemistry2 + 1;
//                                $ChemistryArr2[] = $user['user_id'][0];
//                                break;
//                            case 4 :
//                                $Food2 = $Food2 + 1;
//                                $FoodArr2[] = $user['user_id'][0];
//                                break;
//                            case 5 :
//                                $Com2 = $Com2 + 1;
//                                $ComArr2[] = $user['user_id'][0];
//                                break;
//                        }
//                    }
                }

                $user = $userDAO->findAll();

                for($index = 0; $index<count($user['user_id']); $index++){


                $userRole = $userRoleDAO->findbyUserId($user['user_id'][$index]);

                    if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){


                    switch($user['major_id'][$index]){
                        case 1 :
                            $MathQuery = $MathQuery + 1;
                            break;
                        case 2 :
                            $PhysicsQuery = $PhysicsQuery + 1;
                            break;
                        case 3 :
                            $ChemistryQuery = $ChemistryQuery + 1;
                            break;
                        case 4 :
                            $FoodQuery = $FoodQuery + 1;
                            break;
                        case 5 :
                            $ComQuery = $ComQuery + 1;
                            break;
                    }

                }
                }

//                    print_r($MathUserId);
//                    print_r($PhysicsUserId);
//                    print_r($ChemistryUserId);
//                    print_r($FoodUserId);
//                    print_r($ComUserId);


                    $mathUser = array_unique($MathUserId);
                    $PhysicsUser = array_unique($PhysicsUserId);
                    $ChemistryUser = array_unique($ChemistryUserId);
                    $FoodUser = array_unique($FoodUserId);
                    $ComUser = array_unique($ComUserId);

//                    print_r($mathUser);
//                    print_r($PhysicsUser);
//                    print_r($ChemistryUser);
//                    print_r($FoodUser);
//                    print_r($ComUser);

                    $mathCount = count($mathUser);
                    $physicsCount = count($PhysicsUser);
                    $chemistryCount = count($ChemistryUser);
                    $foodCount = count($FoodUser);
                    $comCount = count($ComUser);


//                    print_r($mathCount);
//                    print_r($physicsCount);
//                    print_r($chemistryCount);
//                    print_r($foodCount);
//                    print_r($comCount);


                    $MathQuery = $MathQuery - $mathCount;
                    $PhysicsQuery = $PhysicsQuery - $physicsCount;
                    $ChemistryQuery = $ChemistryQuery - $chemistryCount;
                    $FoodQuery = $FoodQuery - $foodCount;
                    $ComQuery = $ComQuery - $comCount;

                    $MathResearch = $MathResearch - $Math;
                    $PhysicsResearch= $PhysicsResearch -$Physics;
                    $ChemistryResearch = $ChemistryResearch - $Chemistry;
                    $FoodResearch = $FoodResearch - $Food;
                    $ComResearch= $ComResearch - $Com;


//                    $MathQuery2 = $MathQuery - $Math2;
//                    $PhysicsQuery2 = $PhysicsQuery -$Physics2;
//                    $ChemistryQuery2 = $ChemistryQuery - $Chemistry2;
//                    $FoodQuery2 = $FoodQuery - $Food2;
//                    $ComQuery2 = $ComQuery - $Com2;


                    $authorResearch = $mathCount + $physicsCount + $chemistryCount + $foodCount + $comCount;
                    $authorNotResearch = $MathQuery + $PhysicsQuery + $ChemistryQuery + $FoodQuery + $ComQuery;

                    $Research = $Math + $Physics + $Chemistry + $Food +$Com;

//                    $authorResearch2 = $Math2 + $Physics2 + $Chemistry2 + $Food2 +$Com2;
//                    $authorNotResearch2 = $MathQuery2 + $PhysicsQuery2 + $ChemistryQuery2 + $FoodQuery2 + $ComQuery2;

            ?>

                    <div class="col-sm-5" style="background-color: #fde5ef; height: 100px; margin-top: 20px; margin-left: 40px; ">
                        <label for="lb_subject" style="margin-top: 5px; margin-left: 50px">กราฟแสดงจำนวนอาจารย์ที่ได้รับทุนวิจัย </label><br>
                        <label for="lb_subject" style="margin-top: 5px; margin-left: 25px">จำนวนผู้ทำวิจัยที่ได้รับทุน</label>
                        <label for="lb_subject" style="margin-left: 40px; ">  <?=$authorResearch?> คน</label><br>
                        <label for="lb_subject" style="margin-top: 5px; margin-left: 20px">จำนวนผู้ทำวิจัยที่ไม่ได้รับทุน</label>
                        <label for="lb_subject" style="margin-left: 20px">  <?=$authorNotResearch?> คน</label><br>
                    </div>

                    <div class="col-sm-5" style="background-color: #cee7ff; height: 100px; margin-top: 20px; margin-left: 60px">
                        <label for="lb_subject" style="margin-top: 5px; margin-left: 100px">กราฟแสดงจำนวนผลงานที่ได้รับทุนวิจัย</label><br>
                        <label for="lb_subject" style="margin-top: 15px; margin-left: 25px">จำนวนผลงานวิจัย</label>
                        <label for="lb_subject" style="margin-left: 22px"> <?=$Research?> ผลงาน</label><br>
<!--                        <label for="lb_subject" style="margin-top: 5px">จำนวนผู้ไม่ทำวิจัย</label>-->
<!--                        <label for="lb_subject" style="margin-left: 7px"> : --><?//=$authorNotResearch2?><!-- คน</label><br>-->
                    </div>
        </div>

        <div class="form-group">
            <div class="col-sm-5">
                <div id="chart_div2" style="height: 400px; width: 550px"></div>
            </div>
            <div class="col-sm-6">
                <div id="chart_div" style="height: 400px; width: 550px; margin-left: 60px"></div>
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
                ['สาขา', 'ผู้ที่ได้รับทุนวิจัย', 'ผู้ที่ไม่ได้รับทุนวิจัย'],
                ['คณิตศาสตร์',<?=$mathCount?>,<?=$MathQuery?>],
                ['ฟิสิกส์',<?=$physicsCount?>,<?=$PhysicsQuery?>],
                ['เคมี',<?=$chemistryCount?>,<?=$ChemistryQuery?>],
                ['เทคโนโลยีการอาหาร',<?=$foodCount?>,<?=$FoodQuery?>],
                ['วิทยาการคอมพิวเตอร์',<?=$comCount?>,<?=$ComQuery?>]
            ]);

            var options = {
                title: 'จำนวนผู้ที่ได้รับทุนวิจัย',
                hAxis: {title: 'สาขา', titleTextStyle: {color: 'red'}}
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }
    </script>

        <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['สาขา', 'ผลงานวิจัย',''],
                    ['คณิตศาสตร์',<?=$Math?>,<?=0?>],
                    ['ฟิสิกส์',<?=$Physics?>,<?=0?>],
                    ['เคมี',<?=$Chemistry?>,<?=0?>],
                    ['เทคโนโลยีการอาหาร',<?=$Food?>,<?=0?>],
                    ['วิทยาการคอมพิวเตอร์',<?=$Com?>,<?=0?>]
                ]);

                var options = {
                    title: 'จำนวนผลงานวิจัย',
                    hAxis: {title: 'สาขา', titleTextStyle: {color: 'red'}}
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>



</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->


<!--$len = count($table_pk['COLUMN_NAME']);-->