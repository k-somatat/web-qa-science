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
<div id="page-wrapper" class="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 style="color: #003bb3"><?= $page_name; ?>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li>หน้าแรก</li>
            <li><?= $page_name; ?></li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"> สิทธิ์การเข้าใช้งาน</i></li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
            <li><a href="admin_user.php">ข้อมูลผู้ใช้งานทั้งหมด</a></li>
            <li class="active"><a href="#admin_user_permission" data-toggle="tab">สิทธิ์การเข้าใช้งาน</a></li>
            <li><a href="admin_user_form.php">เพิ่มข้อมูลผู้ใช้งาน</a></li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Tab panes -->
<div class="tab-content">

<div class="tab-pane active" id="research_academic">
<p class="col-md-12" style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; ">
    ข้อมูลสิทธิ์การใช้งานทั้งหมด</p>

<div class="col-sm-12">
    <div class="col-sm-6">
        <p class="col-md-10"
           style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: #398439">
            กำหนดสิทธิ์การใช้งาน</p>



            <table class="table-bordered" >
                <thead class="table-modify" style="text-align: center">
                <th class="text-center ">ลำดับที่</th>
                <th style="text-align: center; width: 100%">สิทธิ์การใช้งาน <i class="fa fa-sort"></i></th>
<!--                                    <th style="text-align: center;">แก้ไขข้อมูล </th>-->
                <!--                    <th style="text-align: center;">ลบข้อมูล</th>-->
                </thead>
                <tbody>

                <?


                $roleDAO = new RoleDAO();
                $role = new Role();

                $role = $roleDAO->findAll();
                $len = count($role['role_id']);
                $count = 1;
                for ($index = 0; $index < $len; $index++) {


                    echo "<tr style='text-align: center'>" . "<td>" . $count . "</td>";
                    echo "<td>" . $role['role_name'][$index] . '</td>';

                    $roleId = $role['role_id'][$index];

//                        echo "<input type='text' id='role_id' value='$roleId' style='display : none'>";
//                        echo
//                            "<td>" .
//                            '<a data-toggle="modal" href="#myModal"  class="btn btn-large btn-info btn-primary">
//                                               <i class="glyphicon glyphicon-edit"></i> แก้ไข</a>'
//                            . "</td>" .
//                            "<td>" ;


//                         echo   "<td>" .
//                            "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='user_form.php?uid=" . $users['user_id'][$index] . "'>
//                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
//                            . "</td>" ;
//                            "<td>" ;
//                            "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $users['user_id'][$index] . ")>
//                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
//                            . "</td></tr>";
                    $count++;
                }
                ?>


                </tbody>
            </table>

            <div class="col-sm-12" style="margin-top: 15px">
                <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?= $count - 1 ?> รายการ</div>
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

    <div class="col-sm-6">

        <p class="col-md-10"
           style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: #ad6704">
            กำหนดสิทธิ์ผู้ใช้งาน</p>

        <table class="table-bordered">
            <thead class="table-modify" style="text-align: center">
            <th class="text-center" style="width: 10%">ไอดี<br>ผู้ใช้</th>
            <th style="text-align: center; width: 10%">อีเมล์ <i class="fa fa-sort"></i></th>
            <!--                        <th  style="text-align: center; width: 20%">ชื่อ - นามสกุล <i class="fa fa-sort"></i></th>-->
            <th style="text-align: center; width: 20%">สิทธิ์การใช้งาน <i class="fa fa-sort"></i></th>
            <!--                        <th style="text-align: center;">แก้ไขข้อมูล </th>-->
            <!--                        <th style="text-align: center;">ลบข้อมูล</th>-->
            </thead>
            <tbody>
            <?

            $userDAO = new UserDAO();
            $users = new User();

            $users = $userDAO->findAll();

            $len = count($users['user_id']);
            $count = 1;
            for ($index = 0; $index < $len; $index++) {

                $userRoleDAO = new UserRoleDAO();
                $userRole = new UserRole();

                $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);


                echo "<input type='text' id='userId' value='" . $users['user_id'][$index] . "' style='display:none'>";
                echo "<tr style='text-align: center'>" . "<td>" . $users['user_id'][$index] . "</td>";
                echo "<td>" . $users['username'][$index] . '</td>';
                $userId = $users['user_id'][$index];
                ?>

                <form class="form-horizontal" role="form" method="post"

                      enctype="multipart/form-data">


                    <? echo '<td><select class="form-control" id="'.$userId.'" name="permission" onchange="AddPermission(' . $userId . ')" >';
                       echo "<option value=''>"."ไม่ได้กำหนดสิทธิ์"."</option>";


                    $roleDAO = new RoleDAO();
                    $role = new Role();

                    $role = $roleDAO->findAll();
                    $count_role = count($role['role_id']);

                    for ($i = 0; $i < $count_role; $i++) {
                        if ($userRole['role_id'][0] == $role['role_id'][$i]) {
                            $selected = "selected='selected'";
                        } else {
                            $selected = '';
                        }
                        echo ' <option value="' . $role['role_id'][$i] . '" ' . $selected . '>' . $role['role_name'][$i] . '</option>';

                    }

                    echo '</select></td>';
                    ?>
                </form>



<?
//                            echo
//                                "<td>" .
//                                "<button class='btn btn-large btn-info btn-primary' onclick=window.location.href='user_form.php?uid=" . $users['user_id'][$index] . "'>
//                             <i class='glyphicon glyphicon-edit'></i> Edit</button>"
//                                . "</td>" .
//                                "<td>" .
//                                "<button class='btn btn-large btn-danger' onclick=confirm_delete(" . $users['user_id'][$index] . ")>
//                             <i class='glyphicon glyphicon-trash'></i> Delete</button>"
//                                . "</td></tr>";
                $count++;
            }
            ?>


            </tbody>
        </table>

        <div class="col-sm-12" style="margin-top: 15px">
            <div class="text-success">แสดงผลลัพธ์การค้นหาข้อมูล <?= $count - 1 ?> รายการ</div>

        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title">ระบบสารสนเทศเพื่อการบริหารและการตัดสินใจประกันคุณภาพ</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post"
                      action="<?= site_url . "callfunction.php?method=register"; ?>">
                    <h1 class="font-times"><img src="<?= site_url ?>images/web_logo.png"
                                                class="margin-left-10 margin-bottom-15 margin-right-20"
                                                style="width: 90px;"/>
                        แก้ไขสิทธ์การใช้งาน</h1>


                    <div class="form-group">
                        <label for="lbPermission"
                               class="col-xs-12 col-sm-12 col-md-3 col-lg-3 margin-top-10">
                            สิทธิ์การใช้งาน
                        </label>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-9 input-group">
                            <input type="text" id="permission" name="permission"
                                   class="form-control" placeholder="กำหนดสิทธิ์การใช้งาน"/>
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-pencil"></i>
							</span>
                        </div>
                    </div>
                    <!--                    <img src="-->
                    <?//=site_url."images/web_logo.png"?><!--" width="125px" height="125px" class="img-thumbnail" alt="Thumbnail Image">-->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-lg"> ยืนยัน</button>
                        <button type="reset" class="btn btn-default btn-lg" data-dismiss="modal">ยกเลิก</button>

                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>
</div>

</div>


<script>
    $(function () {
        $('#myTab a:last').tab('show')
    })
</script>

<?//if ($_GET['onMal'] == 1) {
//    echo "<script type='text/javascript'>
// var roleId = document.getElementById('role_id');
//                         roleId = roleId.value;
//                         var roleName = document.getElementById('permission');
//                         roleName.value = roleId;
//                        $('#myModal').modal({
//                        show: true,
//                        remote: '/myModal?rid='+roleId;
//
//                    });</script>";
//} ?>


<script>

    function AddPermission(userId) {
//            var permission = document.getElementById('permission').value;
//           for(var index = 0 ; index<permission.length; inedx++){
//            var userId = document.getElementById('userId').value;
//            var userId = userId.value;
        var userId = userId;
        var roleId = document.getElementById(userId);
        var permission = roleId.options[roleId.selectedIndex].value;
        window.location = 'sqlfunction.php?method=update_permission&pid=' + permission + '&uid=' + userId;

    }
    //        });
</script>


<!--    <script type="text/javascript">-->
<!--        function confirm_delete(rid) {-->
<!--            bootbox.confirm("ยืนยันการลบข้อมูล !", function (result) {-->
<!--                if (result) {-->
<!---->
<!--                    window.location = 'sqlfunction.php?method=delete_research&rid=' + rid + '&cur=' + 1;-->
<!--                } else {-->
<!--                    console.log("User declined dialog");-->
<!--                }-->
<!--            });-->
<!--        }-->
<!--    </script>-->


</div>
<!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->


<!--$len = count($table_pk['COLUMN_NAME']);-->