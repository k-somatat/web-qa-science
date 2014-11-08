<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "จัดการข้อมูลผู้ใช้งาน";
$page_icon = "list-alt";
$page_home_active = "";
$page_admin_user_active = "active";

// Page Setup END
?>

<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php"); ?>
<?
require_once(ABSPATH . 'src/DAO/FacultyDAO.class.php');
require_once(ABSPATH . 'src/vo/Faculty.class.php');
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
                <li><?= $page_name; ?></li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"> ข้อมูลผู้ใช้งานทั้งหมด</i></li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li class="active"><a href="#admin_user" data-toggle="tab">ข้อมูลผู้ใช้งานทั้งหมด</a></li>
                <li><a href="admin_user_permission.php">สิทธิ์การเข้าใช้งาน</a></li>
                <li><a href="admin_user_form.php">เพิ่มข้อมูลผู้ใช้งาน</a></li>
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="research_academic">
            <p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
                ข้อมูลผู้ใช้งานทั้งหมด</p>

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

            <table class="table-bordered">
                <thead class="table-modify" style="text-align: center">
                    <th class="text-center" style="width: 5%">ไอดี<br>ผู้ใช้</th>
                    <th  style="text-align: center; width: 13%; height: 10%">อีเมล์ <i class="fa fa-sort"></i></th>
                    <th  style="text-align: center; width: 8%">รหัสผ่าน <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 25%">ชื่อ - นามสกุล <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 10%">ตำแหน่ง <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 8%">คณะ <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 10%">สาขา <i class="fa fa-sort"></i></th>
                    <th style="text-align: center; width: 10%">เบอร์โทรติดต่อ <i class="fa fa-sort"></i></th>
<!--                    <th style="text-align: center; width: 10%">สิทธิ์การเข้าใช้งาน <i class="fa fa-sort"></i></th>-->
                    <th style="text-align: center;">แก้ไขข้อมูล </th>
                    <th style="text-align: center;">ลบข้อมูล</th>
                </thead>
                <tbody>

                <?
                $facultyDAO = new FacultyDAO();
                $majorDAO = new MajorDAO();
                $userDAO = new UserDAO();
                $users = new User();
                $users = $userDAO->findAll();

                $queryUser = $userDAO->findAll();
                $_SESSION['UserId'] = $queryUser;

                for($Index = 0; $Index < count($_SESSION['UserId']['user_id']); $Index++){

                    $major = $majorDAO->findbyMajorId($_SESSION['UserId']['major_id'][$Index]);
                    $faculty = $facultyDAO->findbyFacultyId($major['faculty_id'][0]);

                    $_SESSION['UserId']['major'][$Index] = $major['major_name'][0];
                    $_SESSION['UserId']['faculty'][$Index] = $faculty['faculty_name'][0];

                }

                $len = count($users['user_id']);
                $count = 1;
                for ($index = 0; $index < $len; $index++) {

                    $majors = new Major();
                    $majors = $majorDAO->findbyMajorId($users['major_id'][$index]);

                    $facultyDAO = new FacultyDAO();
                    $facultys = new Faculty();
                    $facultys = $facultyDAO->findbyFacultyId($majors['faculty_id'][0]);

                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);

                    $roleDAO = new RoleDAO();
                    $role = new Role();

                    $role = $roleDAO->findAll();
                    $count_role = count($role['role_id']);

                    for($i=0; $i<$count_role; $i++){
                        if($userRole['role_id'][0] == $role['role_id'][$i]){
                            $permission = $role['role_name'][$i];
                            break;
                        }else{
                            $permission ='';
                        }
                    }

                    $splitName = explode(' ',$users['user_first_name'][$index]);
                    $user_firstName = $splitName[0].$splitName[1];

                        echo "<tr style='text-align: center'>" . "<td>" . $users['user_id'][$index] . "</td>";
                        echo "<td>" . $users['username'][$index] . '</td>' .
                            '<td>' . $users['password'][$index] . '</td>' .
                            '<td>' . $user_firstName ." ".$users['user_last_name'][$index]. '</td>' .
                            '<td>' . $users['user_position'][$index] . '</td>' .
                            '<td>' . $facultys['faculty_name'][0] . '</td>' .
                            '<td>' . $majors['major_name'][0] . '</td>' .
                            '<td>' . $users['user_tel'][$index] . '</td>';
//                            '<td>' . $permission . '</td>';


                        echo
                            "<td>" .
                            "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='admin_user_form.php?uid=" . $users['user_id'][$index] . "'>
                             <i class='glyphicon glyphicon-edit'></i> แก้ไข</button>"
                            . "</td>" .
                            "<td>" .
                            "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $users['user_id'][$index] . ")>
                             <i class='glyphicon glyphicon-trash'></i> ลบ</button>"
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


    <script>
        $(function () {
            $('#myTab a:last').tab('show')
        })
    </script>


    <script type="text/javascript">
        function confirm_delete(uid) {
            bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {
                if (result) {

                    window.location = 'sqlfunction.php?method=delete_user&uid=' + uid;
                } else {
                    console.log("User declined dialog");
                }
            });
        }
    </script>
    <script>
        function export_xls() {
            window.location = 'src/function/export_user_xls.php';
        }
    </script>



</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->


<!--$len = count($table_pk['COLUMN_NAME']);-->