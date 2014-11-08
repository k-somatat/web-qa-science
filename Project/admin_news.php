<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name="ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์";
$page_icon="list-alt";
$page_admin_home_active = "active";
$page_course_active = "";
// Page Setup END

?>
<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php");
require_once(ABSPATH . 'src/DAO/ConferenceDAO.class.php');
?>

<!-- End Header Include -->
<!-- content -->

<script>
    function getPage(count){
        var numPage;
        numPage = 'แสดงผลลัพธ์การค้นหาข้อมูล '+count+' รายการ';
        document.getElementById('numRow').innerHTML = numPage;
    }
</script>


<div id="page-wrapper" class="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 style="color: #003bb3"><?= $page_name; ?>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li>หน้าแรก</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> ข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li><a href="admin_index.php">ข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</a></li>
                <li class="active"><a href="#admin_news">ข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</a></li>
                <li><a href="admin_news_form.php">เพิ่มข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์</a></li>
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="admin_TQF">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์ </p>

            <div class="form-group" >
                <label class="col-sm-9 text-success" style="font-weight: normal" id="numRow"></label>
                <!--                <ul class="pagination">-->
                <!--                    <li><a href="#">&laquo;</a></li>-->
                <!--                    <li><a href="#">1</a></li>-->
                <!--                    <li><a href="#">2</a></li>-->
                <!--                    <li><a href="#">3</a></li>-->
                <!--                    <li><a href="#">4</a></li>-->
                <!--                    <li><a href="#">5</a></li>-->
                <!--                    <li><a href="#">&raquo;</a></li>-->
                <!--                </ul>-->
                <label class="col-sm-2 text-success" style="font-weight: normal; text-align: right; padding-top: 5px">Export File</label>
                <button class="col-sm-1" style="background-image: url(images/exporter-excel.jpg); height: 30px; width: 85px; margin-bottom: 5px" onclick="export_xls()"></button>
            </div>


            <table class=" table-bordered ">
                <thead class="table-modify" style="text-align: center">
                <th  style="width: 5%; height: 50px;  text-align: center"> ลำดับที่ <i class="fa fa-sort"></i></th>
                <th style="width: 35%; text-align: center">หัวเรื่อง <i class="fa fa-sort" ></i></th>
                <th  style="width: 20%; text-align: center">รายละเอียด <i class="fa fa-sort"></i></th>
                <th style="width: 11%; text-align: center">วันที่ปรับปรุงข้อมูล <i class="fa fa-sort"></i></th>
                <th style="width: 11%; text-align: center">ผู้จัดทำข้อมูล <i class="fa fa-sort"></i></th>
                <th style="width: 11%; text-align: center">ผู้ปรับปรุงข้อมูล <i class="fa fa-sort"></i></th>
                <th class="text-center">เอกสารไฟล์ <i class="fa fa-sort"></i></th>
                <th class="text-center">แก้ไขข้อมูล </th>
                <th class="text-center">ลบข้อมูล </th>
                </thead>
                <tbody>

                <?

                $userDAO = new UserDAO();
                $newsDAO = new NewsDAO();
                $news = new News();
                $news = $newsDAO->findAll();

                $queryNews = $newsDAO->findAll();
                $_SESSION['News'] = $queryNews;

                for($Index = 0; $Index < count($_SESSION['News']['news_id']); $Index++){
                    $user = $userDAO->findbyUserId($_SESSION['News']['user_create'][$Index]);
                    $spiltName = explode(' ',$user['user_first_name'][0]);
                    $_SESSION['News']['userCreate'][$Index] = $spiltName[0].$spiltName[1]." ".$user['user_last_name'][0];

                    if($_SESSION['News']['user_update'][$Index] != ''){
                        $user = $userDAO->findbyPK($_SESSION['News']['user_update'][$Index]);
                        $spiltName = explode(' ',$user['user_first_name'][0]);
                        $_SESSION['News']['userUpdate'][$Index] = $spiltName[0].$spiltName[1]." ".$user['user_last_name'][0];
                    }else{
                        $_SESSION['News']['userUpdate'][$Index] = '';
                    }
                }

                $length = count($news['news_id']);

                $count = 1;
                for ($index = 0; $index < $length; $index++) {
                        echo "<tr style='text-align: center'>
                                                  <td>" . $count . "</td>" ;
                       echo "<td>" . $news['news_headline'][$index] . "</td>" ;
                       echo "<td>" . $news['news_detail'][$index] . "</td>" ;

                    if($news['news_time_update'][$index] == ''){
                        $spiltDate = explode('-',$news['news_time_create'][$index]);
                        echo '<td>'.$spiltDate[2]."-".$spiltDate[1]."-".$spiltDate[0].'</td>';
                    }else{
                        $spiltDate = explode('-',$news['news_time_update'][$index]);
                        echo '<td>'.$spiltDate[2]."-".$spiltDate[1]."-".$spiltDate[0].'</td>';
                    }


                    $users = new User();

                    $users = $userDAO->findbyUserId($news['user_create'][$index]);
                    $spiltName = explode(' ',$users['user_first_name'][0]);
                    echo '<td>'.$spiltName[0].$spiltName[1]." ".$users['user_last_name'][0].'</td>';

                    if($news['user_update'][$index] != ''){
                        $users = $userDAO->findbyPK($news['user_update'][$index]);
                        $spiltName = explode(' ',$users['user_first_name'][0]);
                        echo '<td>'.$spiltName[0].$spiltName[1]." ".$users['user_last_name'][0].'</td>';
                    }else{
                        echo '<td>'."-".'</td>';
                    }

                    if($news[''])
                    echo '<td>'.$news['user_create'][$index].'</td>';

                        if ($news['news_document'][$index] == "") {
                            echo "<td>" . '<img src="'.site_url.'images/incorrect.jpg" width="20">' . "</td>";
                        } else {
                            echo "<td>" . '<a href="' . site_url . 'src/function/download.php?filename=' . $news['news_document'][$index] . '">' . '<img src="'.site_url.'images/correct.jpg" width="20">' . "</td>";
                        }
                        echo
                            "<td>" .
                            "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='admin_news_form.php?nid=" . $news['news_id'][$index] . "'>
                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"."</td>".
                            "<td>" ."<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $news['news_id'][$index] . ")>
                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
                            . "</td></tr>";
                        $count++;
                }
                $count = $count -1;
                if($count >= 5){
                    echo "<SCRIPT LANGUAGE='javascript'>
                   getPage($count)
                </SCRIPT>";
                }
                ?>
                </tbody>
            </table>

            <div class="col-sm-12" style="margin-top: 15px">
                <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?=$count?> รายการ</div>
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


<script type="text/javascript">
    $(function () {
        $('#dateTimePicker').datetimepicker({
            pickTime: false
        });
    });
</script>


<script>
    $(function () {
        $('#myTab a:last').tab('show')
    })
</script>


<script src="js/jquery.min.js"></script>
<script>

    function confirm_delete(nid) {
        bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
            if (result) {

                window.location = 'sqlfunction.php?method=admin_delete_news&nid=' + nid;
            } else {
                console.log("User declined dialog");
            }
        });
    }

    function edit_conference(cid) {
        $.ajax({
            type: 'GET',
            url: "editConference.php",
            data: $(e.target).serialize(),
            dataType: "json",
            success: function (data) {
                alert(data);
            }

        });
    }
</script>

    <script>
        function export_xls() {
            window.location = 'src/function/export_news_xls.php';
        }
    </script>



</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->