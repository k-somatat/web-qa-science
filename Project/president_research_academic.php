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
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> การเสนอผลงานวิจัย/วิชาการ</li>
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
                <li class="active"><a href="#president_research_academic" data-toggle="tab">การเสนอผลงานวิจัย/วิชาการ</a></li>
                <li><a href="president_research_funded.php">งานวิจัยที่ได้รับทุนสนับสนุน</a></li>
                <li><a href="president_research_applied.php">ผลงานวิจัยที่นำไปใช้ประโยชน์</a></li>
                <li><a href="president_research_graph_academic.php">ข้อมูลงานวิจัยรูปแบบกราฟ</a></li>
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="president_research_academic">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลการเสนอผลงานวิจัย/วิชาการ </p>

            <table class="table-bordered">
                <thead class="table-modify" style="text-align: center">
                    <th class="text-center ">ลำดับที่ <i class="fa fa-sort"></i></th>
                    <th  style="text-align: center; width: 25%; height: 10%">ชื่อผลงาน <i class="fa fa-sort"></i></th>
                    <th  style="text-align: center; width: 15%">ชื่อผู้จัดทำ <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 15%">หน่วยงานที่จัดประชุม/วารสารที่ตีพิมพ์ <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 10%">สถานที่จัดประชุม <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 12%">วันที่นำเสนอ/วาระที่ออกของวารสาร <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 10%">ค่าใช้จ่าย (บาท)<i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 10%">บทความวิจัย/วิชาการที่ตีพิมพ์ <i class="fa fa-sort"></i></th>
<!--                    <th style="text-align: center;">แก้ไขข้อมูล </th>-->
<!--                    <th style="text-align: center;">ลบข้อมูล</th>-->
                </thead>
                <tbody>

                <?

                $researchDAO = new ResearchDAO();
                $research = new Research();

                $research = $researchDAO->findbyResearchTypeId(1);

                //                foreach($rs_academics as $key => $val){
                //                $numb = count($val);}

                $len = count($research['research_id']);
                $count = 1;
                for ($index = 0; $index < $len; $index++) {
                    //if ($research['user_id'][$index] == $_SESSION["USER"]["user_id"][0]) {
                        echo "<tr style='text-align: center'>" . "<td>" . $count . "</td>";
                        echo "<td>" . $research['research_name'][$index] . '</td>' ;
                    $spiltName = explode(' ',$research['research_author'][$index]);

                    echo "<td>" . $spiltName[0].$spiltName[1]." ".$spiltName[2] . '</td>' .
                            '<td>' . $research['research_institution'][$index] . '</td>' .
                            '<td>' . $research['research_location'][$index] . '</td>'  ;

                        $split_date = explode('-',$research['research_date'][$index]);
                        $split_date_end = explode('-',$research['research_date_end'][$index]);
                        $date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
                        $date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

                        if($research['research_date_end'][$index] != '0000-00-00'){

                            echo '<td>' ."<table boder='1' style='width: 100%;'><tr><td>"."เริ่ม  ". $date ."</td></tr><tr><td>". "ถึง  "
                                . $date_end ."</td></tr></table>". '</td>';
                        }else{
                            echo '<td>'. $date . '</td>';
                        }

                        if($research['research_budget'][$index] === null){
                            echo "<td>" . "<font color=blue ><b> - </b></font>" . "</td>";
                        }
                        else{
                            $split_budget = explode(".",$research['research_budget'][$index]);
                            if($split_budget[1] == null){
                                $budget = $research['research_budget'][$index]."."."00";
                                $budget = add_comma($budget);
                            }else{
                                $budget = $research['research_budget'][$index];
                                $budget = add_comma($budget);
                            }
                            echo "<td>" . $budget . "</td>";
                        }


                        if ($research['research_document'][$index] == "") {
                            echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                        } else {
                            echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $research['research_document'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                        }
//                        echo
//                            "<td>" .
//                            "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='research_form.php?rid=" . $research['research_id'][$index] . "'>
//                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
//                            . "</td>" .
//                            "<td>" .
//                            "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $research['research_id'][$index] . ")>
//                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
//                            . "</td></tr>";
                        $count++;
//                    } else {
//
//                    }
                }
                ?>




                <!--                <tr  style="text-align: center">-->
                <!--                    <td>1</td>-->
                <!--                    <td>โครงการพัฒนาระบบสารสนเทศเพื่อการบริหารและการตัดสินใจประกันคุณภาพ</td>-->
                <!--                    <td>อ.อัญชุลี ไชยรินทร์</td>-->
                <!--                    <td>คณะวิทยาศาสตร์</td>-->
                <!--                    <td>มหาวิทยาลัยสยาม</td>-->
                <!--                    <td>12/10/2013</td>-->
                <!--                    <td>200,000 บาท</td>-->
                <!--                    <td>download</td>-->
                <!--                </tr>-->
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

        <div class="tab-pane active" id="research_funded">

        </div>

        <div class="tab-pane active" id="research_applied">

        </div>


        <div class="tab-pane" id="add_research">
        </div>

    </div>


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