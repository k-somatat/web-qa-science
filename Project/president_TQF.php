<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "กรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ";
$page_icon = "list-alt";
$page_president_TQF_active = "active";
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
                <li>กรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li class="active"><a href="#president_tqf">ข้อมูลกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</a></li>
<!--                <li><a href="president_tqf_graph.php">ข้อมูล มคอ. รูปแบบกราฟ</a></li>-->

            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="president_tqf">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</p>

            <div class="form-group">
                <div class="form-control col-sm-12" style="background-color: ; border-left: hidden; border-right: hidden; border-top: hidden; height: 50px">
                <form method="post" action="<?=site_url.'sqlfunction.php?method=president_search_TQF&NoData=1'?>">
                <p class="col-md-2" style="text-align: left; color: #000; margin-top: 10px">
                    ปีการศึกษา </p>
                <div >
                    <select class="form-control" name="startYear" style="position: absolute; margin-left: 100px; width: 100px; height: 30px; margin-top: 5px">
                        <?
                        $tqfDAO = new TqfDAO();
                        $tqf = new Tqf();

                        $tqf = $tqfDAO->findAll();

                        for($index = 0; $index<count($tqf['tqf_id']); $index++){

                            $date = explode('/',$tqf['tqf_semester'][$index]);

                            $yearQuery = intval($date[1]);
//                            $yearNow = date('Y') + 543;

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
                        $tqfDAO = new TqfDAO();
                        $tqf = new Tqf();

                        $tqf = $tqfDAO->findAll();

                        for($index = 0; $index<count($tqf['tqf_id']); $index++){

                            $date = explode('/',$tqf['tqf_semester'][$index]);

                            $yearQuery = intval($date[1]);
//                            $yearNow = date('Y') + 543;

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
                <th style=" text-align: center">จำนวนรายวิชา <i class="fa fa-sort" ></i></th>
                <th style=" text-align: center">จำนวน มคอ. 3/4 <i class="fa fa-sort"></i></th>
                <th style=" text-align: center">จำนวน มคอ. 5/6 <i class="fa fa-sort"></i></th>
                <th style=" text-align: center">ดูรายละเอียด <i class="fa fa-sort"></i></th>
                </thead>
                <tbody>
                <?
                $tqf = new Tqf();

                if(!empty($_GET['NoCo'])){
                    $NoTQF = unserialize($_GET['NoCo']);
                }

                $tqf = $tqfDAO->findAll();

                $len = count($tqf['tqf_id']);

                $userDAO = new UserDAO();

                $Math = 0;
                $Physics = 0;
                $Chemistry = 0;
                $Food = 0;
                $Com = 0;
                $MathSubject = 0;
                $MathTQF3 = 0;
                $MathTQF5 = 0;
                $PhysicsSubject = 0;
                $PhysicsTQF3 = 0;
                $PhysicsTQF5 = 0;
                $ChemistrySubject = 0;
                $ChemistryTQF3 = 0;
                $ChemistryTQF5 = 0;
                $FoodSubject = 0;
                $FoodTQF3 = 0;
                $FoodTQF5 = 0;
                $ComSubject = 0;
                $ComTQF3 = 0;
                $ComTQF5 = 0;

                $userRoleDAO = new UserRoleDAO();
                $userRole = new UserRole();

                for ($index = 0; $index < $len; $index++) {
                    $user = new User();

                    if(!empty($NoTQF)){



                        $spiltYear = explode('/',$tqf['tqf_semester'][$index]);

                        if($NoTQF[0] == $spiltYear[1]){

                            $userRole = $userRoleDAO->findbyUserId($tqf['user_id'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($tqf['user_id'][$index]);


                                switch($user['major_id'][0]){
                                    case 1 :
                                        $Math = $Math + 1;
                                        $MathSubject = $MathSubject + 1;
                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $MathTQF3 = $MathTQF3 + 1;
                                        }else{
                                            $MathTQF3 = $MathTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $MathTQF5 = $MathTQF5 + 1;
                                        }else{
                                            $MathTQF5 = $MathTQF5 + 0;
                                        }


                                        break;
                                    case 2 :
                                        $Physics = $Physics + 1;
                                        $PhysicsSubject = $PhysicsSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $PhysicsTQF3 = $PhysicsTQF3 + 1;
                                        }else{
                                            $PhysicsTQF3 = $PhysicsTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $PhysicsTQF5 = $PhysicsTQF5 + 1;
                                        }else{
                                            $PhysicsTQF5 = $PhysicsTQF5 + 0;
                                        }
                                        break;
                                    case 3 :
                                        $Chemistry = $Chemistry + 1;
                                        $ChemistrySubject = $ChemistrySubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $ChemistryTQF3 = $ChemistryTQF3 + 1;
                                        }else{
                                            $ChemistryTQF3 = $ChemistryTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $ChemistryTQF5 = $ChemistryTQF5 + 1;
                                        }else{
                                            $ChemistryTQF5 = $ChemistryTQF5 + 0;
                                        }

                                        break;
                                    case 4 :
                                        $Food = $Food + 1;
                                        $FoodSubject = $FoodSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $FoodTQF3 = $FoodTQF3 + 1;
                                        }else{
                                            $FoodTQF3 = $FoodTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $FoodTQF5 = $FoodTQF5 + 1;
                                        }else{
                                            $FoodTQF5 = $FoodTQF5 + 0;
                                        }
                                        break;
                                    case 5 :
                                        $Com = $Com + 1;
                                        $ComSubject = $ComSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $ComTQF3 = $ComTQF3 + 1;
                                        }else{
                                            $ComTQF3 = $ComTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $ComTQF5 = $ComTQF5 + 1;
                                        }else{
                                            $ComTQF5 = $ComTQF5 + 0;
                                        }
                                        break;
                                }
                            }

                        }else if($NoTQF[1] == $spiltYear[1]){

                            $userRole = $userRoleDAO->findbyUserId($tqf['user_id'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($tqf['user_id'][$index]);


                                switch($user['major_id'][0]){
                                    case 1 :
                                        $Math = $Math + 1;
                                        $MathSubject = $MathSubject + 1;
                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $MathTQF3 = $MathTQF3 + 1;
                                        }else{
                                            $MathTQF3 = $MathTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $MathTQF5 = $MathTQF5 + 1;
                                        }else{
                                            $MathTQF5 = $MathTQF5 + 0;
                                        }


                                        break;
                                    case 2 :
                                        $Physics = $Physics + 1;
                                        $PhysicsSubject = $PhysicsSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $PhysicsTQF3 = $PhysicsTQF3 + 1;
                                        }else{
                                            $PhysicsTQF3 = $PhysicsTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $PhysicsTQF5 = $PhysicsTQF5 + 1;
                                        }else{
                                            $PhysicsTQF5 = $PhysicsTQF5 + 0;
                                        }
                                        break;
                                    case 3 :
                                        $Chemistry = $Chemistry + 1;
                                        $ChemistrySubject = $ChemistrySubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $ChemistryTQF3 = $ChemistryTQF3 + 1;
                                        }else{
                                            $ChemistryTQF3 = $ChemistryTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $ChemistryTQF5 = $ChemistryTQF5 + 1;
                                        }else{
                                            $ChemistryTQF5 = $ChemistryTQF5 + 0;
                                        }

                                        break;
                                    case 4 :
                                        $Food = $Food + 1;
                                        $FoodSubject = $FoodSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $FoodTQF3 = $FoodTQF3 + 1;
                                        }else{
                                            $FoodTQF3 = $FoodTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $FoodTQF5 = $FoodTQF5 + 1;
                                        }else{
                                            $FoodTQF5 = $FoodTQF5 + 0;
                                        }
                                        break;
                                    case 5 :
                                        $Com = $Com + 1;
                                        $ComSubject = $ComSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $ComTQF3 = $ComTQF3 + 1;
                                        }else{
                                            $ComTQF3 = $ComTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $ComTQF5 = $ComTQF5 + 1;
                                        }else{
                                            $ComTQF5 = $ComTQF5 + 0;
                                        }
                                        break;
                                }
                            }

                        }else if($NoTQF[2] == $spiltYear[1]){

                            $userRole = $userRoleDAO->findbyUserId($tqf['user_id'][$index]);

                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                                $user = $userDAO->findbyUserId($tqf['user_id'][$index]);


                                switch($user['major_id'][0]){
                                    case 1 :
                                        $Math = $Math + 1;
                                        $MathSubject = $MathSubject + 1;
                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $MathTQF3 = $MathTQF3 + 1;
                                        }else{
                                            $MathTQF3 = $MathTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $MathTQF5 = $MathTQF5 + 1;
                                        }else{
                                            $MathTQF5 = $MathTQF5 + 0;
                                        }


                                        break;
                                    case 2 :
                                        $Physics = $Physics + 1;
                                        $PhysicsSubject = $PhysicsSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $PhysicsTQF3 = $PhysicsTQF3 + 1;
                                        }else{
                                            $PhysicsTQF3 = $PhysicsTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $PhysicsTQF5 = $PhysicsTQF5 + 1;
                                        }else{
                                            $PhysicsTQF5 = $PhysicsTQF5 + 0;
                                        }
                                        break;
                                    case 3 :
                                        $Chemistry = $Chemistry + 1;
                                        $ChemistrySubject = $ChemistrySubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $ChemistryTQF3 = $ChemistryTQF3 + 1;
                                        }else{
                                            $ChemistryTQF3 = $ChemistryTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $ChemistryTQF5 = $ChemistryTQF5 + 1;
                                        }else{
                                            $ChemistryTQF5 = $ChemistryTQF5 + 0;
                                        }

                                        break;
                                    case 4 :
                                        $Food = $Food + 1;
                                        $FoodSubject = $FoodSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $FoodTQF3 = $FoodTQF3 + 1;
                                        }else{
                                            $FoodTQF3 = $FoodTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $FoodTQF5 = $FoodTQF5 + 1;
                                        }else{
                                            $FoodTQF5 = $FoodTQF5 + 0;
                                        }
                                        break;
                                    case 5 :
                                        $Com = $Com + 1;
                                        $ComSubject = $ComSubject + 1;

                                        if($tqf['tqf_document_tqf3'][$index] != ''){
                                            $ComTQF3 = $ComTQF3 + 1;
                                        }else{
                                            $ComTQF3 = $ComTQF3 + 0;
                                        }
                                        if($tqf['tqf_document_tqf5'][$index] != ''){
                                            $ComTQF5 = $ComTQF5 + 1;
                                        }else{
                                            $ComTQF5 = $ComTQF5 + 0;
                                        }
                                        break;
                                }
                            }

                        }
                    }else{

                        $userRole = $userRoleDAO->findbyUserId($tqf['user_id'][$index]);

                        if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 && $userRole['role_id'][0] != 9 && $userRole['role_id'][0] != 10){

                            $user = $userDAO->findbyUserId($tqf['user_id'][$index]);


                            switch($user['major_id'][0]){
                                case 1 :
                                    $Math = $Math + 1;
                                    $MathSubject = $MathSubject + 1;
                                    if($tqf['tqf_document_tqf3'][$index] != ''){
                                        $MathTQF3 = $MathTQF3 + 1;
                                    }else{
                                        $MathTQF3 = $MathTQF3 + 0;
                                    }
                                    if($tqf['tqf_document_tqf5'][$index] != ''){
                                        $MathTQF5 = $MathTQF5 + 1;
                                    }else{
                                        $MathTQF5 = $MathTQF5 + 0;
                                    }


                                    break;
                                case 2 :
                                    $Physics = $Physics + 1;
                                    $PhysicsSubject = $PhysicsSubject + 1;

                                    if($tqf['tqf_document_tqf3'][$index] != ''){
                                        $PhysicsTQF3 = $PhysicsTQF3 + 1;
                                    }else{
                                        $PhysicsTQF3 = $PhysicsTQF3 + 0;
                                    }
                                    if($tqf['tqf_document_tqf5'][$index] != ''){
                                        $PhysicsTQF5 = $PhysicsTQF5 + 1;
                                    }else{
                                        $PhysicsTQF5 = $PhysicsTQF5 + 0;
                                    }
                                    break;
                                case 3 :
                                    $Chemistry = $Chemistry + 1;
                                    $ChemistrySubject = $ChemistrySubject + 1;

                                    if($tqf['tqf_document_tqf3'][$index] != ''){
                                        $ChemistryTQF3 = $ChemistryTQF3 + 1;
                                    }else{
                                        $ChemistryTQF3 = $ChemistryTQF3 + 0;
                                    }
                                    if($tqf['tqf_document_tqf5'][$index] != ''){
                                        $ChemistryTQF5 = $ChemistryTQF5 + 1;
                                    }else{
                                        $ChemistryTQF5 = $ChemistryTQF5 + 0;
                                    }

                                    break;
                                case 4 :
                                    $Food = $Food + 1;
                                    $FoodSubject = $FoodSubject + 1;

                                    if($tqf['tqf_document_tqf3'][$index] != ''){
                                        $FoodTQF3 = $FoodTQF3 + 1;
                                    }else{
                                        $FoodTQF3 = $FoodTQF3 + 0;
                                    }
                                    if($tqf['tqf_document_tqf5'][$index] != ''){
                                        $FoodTQF5 = $FoodTQF5 + 1;
                                    }else{
                                        $FoodTQF5 = $FoodTQF5 + 0;
                                    }
                                    break;
                                case 5 :
                                    $Com = $Com + 1;
                                    $ComSubject = $ComSubject + 1;

                                    if($tqf['tqf_document_tqf3'][$index] != ''){
                                        $ComTQF3 = $ComTQF3 + 1;
                                    }else{
                                        $ComTQF3 = $ComTQF3 + 0;
                                    }
                                    if($tqf['tqf_document_tqf5'][$index] != ''){
                                        $ComTQF5 = $ComTQF5 + 1;
                                    }else{
                                        $ComTQF5 = $ComTQF5 + 0;
                                    }
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
//                                echo "<td>" . $Math . "</td>" .
                                echo   "<td>" . $MathSubject . "</td>" .
                                    "<td>" . $MathTQF3 . "</td>" .
                                    "<td>" . $MathTQF5 . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_tqf.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 2 :
//                                echo "<td>" . $Physics . "</td>" .
                                 echo   "<td>" . $PhysicsSubject . "</td>" .
                                    "<td>" . $PhysicsTQF3 . "</td>" .
                                    "<td>" . $PhysicsTQF5 . "</td>" .
                                "<td>" . "<a href='".site_url."sub_president_tqf.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 3 :
//                                echo "<td>" . $Chemistry . "</td>" .
                                echo "<td>" . $ChemistrySubject . "</td>" .
                                 "<td>" . $ChemistryTQF3 . "</td>" .
                                 "<td>" . $ChemistryTQF5 . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_tqf.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 4 :
//                                echo "<td>" . $Food . "</td>" .
                                 echo   "<td>" . $FoodSubject . "</td>" .
                                    "<td>" . $FoodTQF3 . "</td>" .
                                    "<td>" . $FoodTQF5 . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_tqf.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td>" ;

                                break;
                            case 5 :
//                                echo "<td>" . $Com . "</td>" .
                                 echo   "<td>" . $ComSubject . "</td>" .
                                    "<td>" . $ComTQF3 . "</td>" .
                                    "<td>" . $ComTQF5 . "</td>" .
                                    "<td>" . "<a href='".site_url."sub_president_tqf.php?mid=$majorId$urlPortion'><img src='".site_url."images/watch_image.png' width='30'></a>" . "</td></tr>" ;

                                break;
                        }
                    $count++;

                }

                $total = $Math+$Physics+$Chemistry+$Food+$Com;
                $totalBudget = $MathBudget+$PhysicsBudget+$ChemistryBudget+$FoodBudget+$ComBudget;
                ?>
                <tr style="text-align: center"><td style="font-weight: bold; color: #e9322d">รวม</td>
                <td><?=$total?></td>
                <td><?=$totalBudget?></td></tr>


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