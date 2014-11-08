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
            <li>หน้าแรก</li>
            <li>โครงการ</li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลโครงการทั้งหมด</li>
        </ol>
        <div class="alert alert-success alert-dismissable hide">
            <button type="button" class="closse" data-dismiss="alert" aria-hidden="true">&times;</button>
            Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free
            to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables
            and charts, so make sure you check out the necessary documentation links provided.
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
<!--            <li class="active"><a href="#project" data-toggle="tab">ข้อมูลโครงการทั้งหมด</a></li>-->
<!--            <li><a href="project_form.php">เพิ่มข้อมูลโครงการ</a></li>-->
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Tab panes -->

    <div class="tab-pane active" id="project">
        <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
            ข้อมูลโครงการ </p>

        <table class="table-bordered">

            <thead class="table-modify" style="text-align: center">
                <th class="wrapper-text-center" style="width: 5%; height: 10%">ลำดับที่ <i class="fa fa-sort"></i></th>
                <th  style="width: 30%; text-align: center">ชื่อโครงการ <i class="fa fa-sort"></i></th>
                <th  style="width: 20%; text-align: center">ชื่อผู้รับผิดชอบ <i class="fa fa-sort"></i></th>
                <th  style="width: 20%; text-align: center">ระยะเวลาดำเนินการ <i class="fa fa-sort"></i></th>
                <th  style="width: 10%; text-align: center">การดำเนินการ <i class="fa fa-sort"></i></th>
                <th  style="width: 5 %; text-align: center">งบประมาณได้รับการอนุมัติ <i class="fa fa-sort"></i></th>
                <th  style="width: 5 %; text-align: center">งบประมาณใช้จริง <i class="fa fa-sort"></i></th>
                <th  style="width: 5 %; text-align: center">เอกสารอ้างอิงแบบเสนอโครงการ <i class="fa fa-sort"></i></th>
                <th  style="width: 5 %; text-align: center">เอกสารอ้างอิงบันทึกข้อความเบื้องต้น <i class="fa fa-sort"></i></th>
                <th  style="width: 5 %; text-align: center">เอกสารอ้างอิงสรุปผลโครงการ <i class="fa fa-sort"></i></th>
                <th  style="width: 5 %; text-align: center">เอกสารอ้างอิงสรุปค่าใช่จ่าย <i class="fa fa-sort"></i></th>
<!--                <th class="wrapper-text-center">แก้ไขข้อมูล</th>-->
<!--                <th class="wrapper-text-center">ลบข้อมูล</th>-->
            </thead>
            <tbody>
<!--            <tr style="text-align: center">-->
<!--                <td>1</td>-->
<!--                <td>โครงการพัฒนาระบบสารสนเทศเพื่อการบริหารและการตัดสินใจประกันคุณภาพ</td>-->
<!--                <td>ภาคเรียนที่ 2-3</td>-->
<!--                <td>กำลังดำเนินการ</td>-->
<!--                <td>-</td>-->
<!--                <td>-</td>-->
<!--                <td>-</td>-->
<!--                <td>-</td>-->
<!--            </tr>-->

            <?

            $projectDAO = new ProjectDAO();
            $project = new Project();

            $project = $projectDAO->findAll();

            //                foreach($rs_academics as $key => $val){
            //                $numb = count($val);}

            $len = count($project['project_id']);
            $count = 1;
            for ($index = 0; $index < $len; $index++) {
//                if ($project['user_id'][$index] == $_SESSION["USER"]["user_id"][0]) {

//                    $budget = $project['project_budget'][$index] != null  ? $project['project_budget'][$index]  : "<font color=blue ><b> - </b></font>";
//                    $final_budget = $project['project_final_budget'][$index] != null  ? $project['project_final_budget'][$index]  : "<font color=blue ><b> - </b></font>";

                   $split_budget = explode(".",$project['project_budget'][$index]);
                   $split_final_budget = explode(".",$project['project_final_budget'][$index]);;

                    if($project['project_budget'][$index] === null){
                         $budget = "<font color=blue ><b> - </b></font>";
                    }else{
                        if($split_budget[1] == null){
                            $budget = $project['project_budget'][$index]."."."00";
                            $budget = add_comma($budget);
                        }else{
                            $budget = $project['project_budget'][$index];
                            $budget = add_comma($budget);
                        }
                    }
                    if($project['project_final_budget'][$index] === null){
                        $final_budget = "<font color=blue ><b> - </b></font>";
                    }else{
                        if($split_final_budget[1] == null){
                            $final_budget = $project['project_final_budget'][$index]."."."00";
                            $final_budget = add_comma($final_budget);
                        }else{
                            $final_budget = $project['project_final_budget'][$index];
                            $final_budget = add_comma($final_budget);
                        }
                    }

                $userDao = new UserDAO();
                $users = $userDao->findbyUserId($project['user_id'][$index]);

                    echo "<tr style='text-align: center'>" . "<td>" . $count . "</td>";
                    echo "<td>" . $project['project_name'][$index] . '</td>' .
                        "<td>" . $users['user_first_name'][0] ." ".$users['user_last_name'][0].  '</td>' ;

                        $split_date = explode('-',$project['project_date'][$index]);
                        $split_date_end = explode('-',$project['project_date_end'][$index]);
                        $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
                        $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

                        if($project['project_date_end'][$index] != '0000-00-00'){

                            echo '<td>' ."<table boder='1' style='width: 100%;'><tr><td>"."เริ่ม  ". $date ."</td></tr><tr><td>". "ถึง  "
                                . $date_end ."</td></tr></table>". '</td>';
                        }else{
                            echo '<td>'. $date . '</td>';
                        }

                    echo '<td>' . $project['project_process'][$index] . '</td>' .
                        '<td>' . $budget  . '</td>' .
                        '<td>' . $final_budget . '</td>' ;

                    if ($project['project_document_approve'][$index] == "") {
                        echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                    } else {
                        echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $project['project_document_approve'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                    }
                    if ($project['project_document_charges'][$index] == "") {
                        echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                    } else {
                        echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $project['project_document_charges'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                    }
                    if ($project['project_document_conclusion'][$index] == "") {
                        echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                    } else {
                        echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $project['project_document_conclusion'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                    }
                    if ($project['project_document_image'][$index] == "") {
                        echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                    } else {
                        echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $project['project_document_image'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                    }
//                    echo
//                        "<td>" .
//                        "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='project_form.php?pid=" . $project['project_id'][$index] . "'>
//                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
//                        . "</td>" .
//                        "<td>" .
//                        "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $project['project_id'][$index] . ")>
//                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
//                        . "</td></tr>";
                    $count++;
//                } else {
//
//                }
            }
            ?>

            </tbody>
        </table>

<!--        <div class="col-sm-12" style="text-align: center">-->
<!--            <ul class="pagination">-->
<!--                <li><a href="#">&laquo;</a></li>-->
<!--                <li><a href="#">1</a></li>-->
<!--                <li><a href="#">2</a></li>-->
<!--                <li><a href="#">3</a></li>-->
<!--                <li><a href="#">4</a></li>-->
<!--                <li><a href="#">5</a></li>-->
<!--                <li><a href="#">&raquo;</a></li>-->
<!--            </ul>-->
<!--        </div>-->
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


    <div class="tab-pane" id="project_form">

    </div>



<script>
    $(function () {
        $('#myTab a:last').tab('show')
    })
</script>


<script type="text/javascript">
    function confirm_delete(pid) {
        bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
            if (result) {

                window.location = 'sqlfunction.php?method=delete_project&pid=' + pid;
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
