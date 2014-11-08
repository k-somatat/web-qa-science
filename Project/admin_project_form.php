<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "โครงการ";
$page_icon = "list-alt";
$page_admin_project_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php"); ?>
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
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> เพิ่มข้อมูล</li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
            <li><a href="admin_plan.php">ข้อมูลแผนงานทั้งหมด</a></li>
            <li><a href="admin_project.php">ข้อมูลโครงการทั้งหมด</a></li>
            <li class="active"><a href="#admin_project_form"  data-toggle="tab">เพิ่มข้อมูล</a></li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Tab panes -->

<div class="tab-pane active" id="admin_project_form">

</div>

<?

if(!empty($_GET['plid'])){
    $query_method = "update_project";
    $type = 1;
    $control_select = 1;

    $planDAO = new PlanDAO();
    $plan = new Plan();

    $plan = $planDAO->findbyPlanId($_GET['plid']);

    $id = $plan['plan_id'][0];
    $project_name = $plan['plan_name'][0];

    $project_id = "";
    $project_date = "";
    $project_date_end = "";
    $project_process = "";
    $project_budget = "";
    $project_final_budget = "";
    $plan_id = "";


}else if (!empty($_GET['pid'])) {
    $query_method = "update_project";
    $type = 2;
//     uncommnet this line when you want disabled select option when user update
    $control_select = 1;

    $projectDAO = new ProjectDAO();
    $project = $projectDAO->findbyPK($_GET['pid']);

    $id = $project['project_id'][0];
    $project_name = $project['project_name'][0];
    $project_amount = $project['project_author_amount'][0];
    $userAuthor = $project['project_author'][0];
    $userAuthor2 = $project['project_author2'][0];
    $userAuthor3 = $project['project_author3'][0];

    $plan_id = $project['plan_id'][0];

    $split_date = explode('-',$project['project_date'][0]);
    $split_date_end = explode('-',$project['project_date_end'][0]);
    $project_date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
    $project_date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

    $project_process = $project['project_process'][0];
    $project_budget = $project['project_budget'][0];
    $project_final_budget = $project['project_final_budget'][0];
    $project_document_approve = $project['project_document_approve'][0];
    $project_document_charges = $project['project_document_charges'][0];
    $project_document_conclusion = $project['project_document_conclusion'][0];
    $project_document_image = $project['project_document_image'][0];


} else {
    $query_method = "create_project";
    $id = "";
    $project_name = "";
    $project_date = "";
    $project_date_end = "";
    $project_process = "";
    $project_budget = "";
    $project_final_budget = "";
    $plan_id = "";
}


?>


<div class="tab-pane" id="project_form">
    <p class="col-md-12"
       style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
        กรอกรายละเอียดโครงการ</p>

    <form class="form-horizontal" role="form" method="post"
          action="<?= site_url . "sqlfunction.php?method=$query_method&id=$id&Notype=$type" ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-sm-4 control-label">เลือกประเภท</label>

            <div class="col-sm-5">
                <select class="form-control" id="type_name" name="type_name" <?=$control_select == 1 ? disabled : enabled ?>>
                    <option value="1" <?= $type == 1 ? 'selected="selected"' : '' ?>>แผนงาน
                    </option>
                    <option value="2" <?= $type == 2 ? 'selected="selected"' : '' ?>>โครงการ
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group" id="dv_plan" style="display: none">
            <label class="col-sm-4 control-label">ชื่อแผนงาน</label>

            <div class="col-sm-5">
                <select class="form-control" id="plan_id" name="plan_id">
                    <?
                        $planDAO = new PlanDAO();
                        $plan = new Plan();
                        $plan = $planDAO->findAll();

                        $length = count($plan['plan_id']);
                        for($index = 0; $index<$length; $index++){

                            if($plan_id == $plan['plan_id'][$index]){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }

                            echo " <option value='".$plan['plan_id'][$index]."' $selected>".$plan['plan_name'][$index]."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="lbTask" class="col-sm-4 control-label" id="lb_project_name">ชื่อแผนงาน</label>

            <div class="col-sm-5 input-group">
                    <input type="text" class="form-control" id="name" name="name"
                       value="<? echo $project_name ?>"
                       placeholder="ชื่อแผนงาน">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </div>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

        <div class="form-group" id="dv_amount" style="display: none">
            <label for="lb_subject" id="lb_name" class="col-sm-4 control-label">จำนวนผู้จัดทำโครงการ</label>
            <input type="text" name="amount" id="amount" value="<?=$project_amount?>" style="display: none">
            <div class="col-sm-5">
                <div class="col-sm-3">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="inlineCheckbox1" onclick="calc(1);"> 1 คน
                    </label>
                </div>
                <div class="col-sm-3">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox2" name="inlineCheckbox2" onclick="calc(2);"> 2 คน
                    </label>
                </div>
                <div class="col-sm-3">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox3" name="inlineCheckbox3" onclick="calc(3);"> 3 คน
                    </label>
                </div>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

        <div class="form-group" id="dv_author" style="display: none">
            <label for="lbAuthor" id="lb_author" class="col-sm-4 control-label" >ชื่อผู้จัดทำ</label>

            <div class="col-sm-5">

                <select class="form-control" id="userAuthor" name="userAuthor">
                    <option value="">เลือกชื่อผู้จัดทำ</option>
                    <?
                    $userDAO = new UserDAO();
                    $users = new User();
                    $users = $userDAO->findAll();

                    $count_record = count($users['user_id']);

                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    for($index = 0; $index<$count_record; $index++){
                        $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                        if($users['user_first_name'][$index] != ''){
                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){
                                ?>
                                <option value='<?=$users['user_id'][$index]?>' <?=$users['user_id'][$index] == $userAuthor ? 'selected = "selected"' : ''; ?>>
                                    <?=$users['user_first_name'][$index]." ".$users['user_last_name'][$index]?>
                                </option>
                            <?
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

        <div class="form-group" id="dv_author2" style="display: none">
            <label for="lbAuthor" id="lb_author2" class="col-sm-4 control-label" >ชื่อผู้จัดทำ</label>

            <div class="col-sm-5">

                <select class="form-control" id="userAuthor2" name="userAuthor2">
                    <option value="">เลือกชื่อผู้จัดทำ</option>
                    <?
                    $userDAO = new UserDAO();
                    $users = new User();
                    $users = $userDAO->findAll();

                    $count_record = count($users['user_id']);

                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    for($index = 0; $index<$count_record; $index++){
                        $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                        if($users['user_first_name'][$index] != ''){
                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){
                                ?>
                                <option value='<?=$users['user_id'][$index]?>' <?=$users['user_id'][$index] == $userAuthor2 ? 'selected = "selected"' : ''; ?>>
                                    <?=$users['user_first_name'][$index]." ".$users['user_last_name'][$index]?>
                                </option>
                            <?
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

        <div class="form-group" id="dv_author3" style="display: none">
            <label for="lbAuthor" id="lb_author3" class="col-sm-4 control-label" ></label>

            <div class="col-sm-5">

                <select class="form-control" id="userAuthor3" name="userAuthor3">
                    <option value="">เลือกชื่อผู้จัดทำ</option>
                    <?
                    $userDAO = new UserDAO();
                    $users = new User();
                    $users = $userDAO->findAll();

                    $count_record = count($users['user_id']);

                    $userRoleDAO = new UserRoleDAO();
                    $userRole = new UserRole();

                    for($index = 0; $index<$count_record; $index++){
                        $userRole = $userRoleDAO->findbyUserId($users['user_id'][$index]);
                        if($users['user_first_name'][$index] != ''){
                            if($userRole['role_id'][0] != 1 && $userRole['role_id'][0] != 2 ){
                                ?>
                                <option value='<?=$users['user_id'][$index]?>' <?=$users['user_id'][$index] == $userAuthor3 ? 'selected = "selected"' : ''; ?>>
                                    <?=$users['user_first_name'][$index]." ".$users['user_last_name'][$index]?>
                                </option>
                            <?
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

        <div class="form-group" id="dv_date" style="display: none">
            <label for="lb_date" id="lb_date" class="col-sm-4 control-label">ระยะเวลาดำเนินการ</label>

            <div class="col-sm-5">

                <div class="col-sm-6 no-pad" id="dv_date_start" >

                    <div id="dateTimePicker" class="input-append" >
                        <div class="input-group col-xs-12 no-pad add-on">
                            <input type="text" class="form-control" id="date" name="date"
                                   data-format="dd-MM-yyyy" placeholder="ระยะเวลาดำเนินการ"
                                   value="<?=$project_date; ?>" />
                            <div class="input-group-addon">
                                <div class="glyphicon glyphicon-time"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" id="dv_date_end" >
                    <div id="dateTimePicker1" class="input-append date">

                        <div id="dateTimePicker1" class="input-append" style="width: 240px">
                            <div class="input-group col-xs-10 no-pad add-on">
                                <input type="text" class="form-control" id="date_end" name="date_end"
                                       data-format="dd-MM-yyyy" placeholder="สิ้นสุดการดำเนินการ"
                                       value="<?=$project_date_end; ?>" />
                                <div class="input-group-addon">
                                    <div class="glyphicon glyphicon-time"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

        <div class="form-group" id="dv_process" style="display: none">
            <label for="lbLocation" class="col-sm-4 control-label">การดำเนินการ</label>

            <div class="col-sm-5">
                <!-- disable select option when user update  -->
               <!-- <select class="form-control" id="sdd" name="sdd" <?=$control_select == 1 ? disabled : enabled ?>> -->
                <select class="form-control" id="sdd" name="sdd" >
                    <option value="0" <?=$project_process == "ยังไม่ได้ดำเนินการ" ? 'selected="selected"' : '' ?>>ยังไม่ได้ดำเนินการ</option>
                    <option value="1" <?=$project_process == "กำลังดำเนินการ" ? 'selected="selected"' : '' ?>>กำลังดำเนินการ</option>
                    <option value="2" <?=$project_process == "เสร็จสิ้นแล้ว" ? 'selected="selected"' : '' ?>>เสร็จสิ้นแล้ว</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

<!--   ************************  form show when project_process finished  ******************************     -->
        <div class="form-group" id="d_form1" style="display: none">

            <label class="col-sm-4 control-label">งบประมาณได้รับการอนุมัติ</label>

            <div class="col-sm-5 input-group">
                <input type="text" class="form-control" id="approve_budget" name="approve_budget"
                       value="<? echo $project_budget ?>"
                       placeholder="งบประมาณได้รับการอนุมัติ">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </div>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>

        <div class="form-group" id="d_form2" style="display: none">

            <label class="col-sm-4 control-label">งบประมาณใช้จริง</label>

            <div class="col-sm-5 input-group">
                <input type="text" class="form-control" id="final_budget" name="final_budget"
                       value="<? echo $project_final_budget ?>"
                       placeholder="งบประมาณสิ้นสุดโครงการ">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </div>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>
        <div class="form-group" id="dv_approve" style="display: none">
            <label for="lbFile" class="col-sm-4 control-label">บันทึกข้อความขออนุมัติ</label>

            <div class="col-sm-5">
                <input type="file" class="file" id="approve" name="approve"
                       value="<? echo $project_document_approve ?>"
                       placeholder="บันทึกข้อความขออนุมัติ">
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red"></label>
            </div>
        </div>

        <div class="form-group" id="dv_charges" style="display: none">
            <label for="lbFile" class="col-sm-4 control-label">บันทึกข้อความสรุปค่าใช้จ่าย</label>

            <div class="col-sm-5">
                <input type="file" class="file" id="charges" name="charges"
                       value="<? echo $project_document_charges ?>"
                       placeholder="บันทึกข้อความสรุปค่าใช้จ่าย">
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red"></label>
            </div>
        </div>

        <div class="form-group" id="dv_conclusion" style="display: none">
            <label for="lbFile" class="col-sm-4 control-label">สรุปผลโครงการ</label>

            <div class="col-sm-5">
                <input type="file" class="file" id="conclusion" name="conclusion"
                       value="<? echo $project_document_conclusion ?>"
                       placeholder="สรุปผลโครงการ">
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red"></label>
            </div>
        </div>

        <div class="form-group" id="dv_image" style="display: none">
            <label for="lbFile" class="col-sm-4 control-label">รูปกิจกรรม</label>

            <div class="col-sm-5">
                <input type="file" class="file" id="image" name="image"
                       value="<? echo $project_document_image?>"
                       placeholder="รูปกิจกรรม">
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red"></label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 12px">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align: right">
                    <button type="submit" id="submit" class="btn btn-primary btn-lg">ยืนยัน</button>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<!--                    <button type="reset" id="clear" class="btn btn-default btn-lg" onclick="window.open('project_form.php')">-->
                    <button type="reset" id="clear" class="btn btn-default btn-lg" onclick="window.history.back();">
                        ยกเลิก
                    </button>
                </div>
            </div>
        </div>


    </form>

</div>




<script type="text/javascript">
    $(function () {

        var val = $('#type_name').val();

        var lb_projectName;
        var projectName =  document.getElementById('name');

        switch (val) {

            case "1" :
                lb_projectName = "ชื่อแผนงาน";
                projectName.placeholder = "ชื่อแผนงาน";
                document.getElementById('dv_plan').style.display = "none";
                document.getElementById('dv_amount').style.display = "none";
                document.getElementById('dv_author').style.display = "none";
                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('dv_date').style.display = "none";
                document.getElementById('dv_process').style.display = "none";
                document.getElementById('d_form1').style.display = "none";
                document.getElementById('d_form2').style.display = "none";
                document.getElementById('dv_approve').style.display = "none";
                document.getElementById('dv_charges').style.display = "none";
                document.getElementById('dv_conclusion').style.display = "none";
                document.getElementById('dv_image').style.display = "none";

                break;

            case "2":

                lb_projectName = "ชื่อโครงการ";
                projectName.placeholder = "ชื่อโครงการ";
                document.getElementById('dv_plan').style.display = "block";
                document.getElementById('dv_amount').style.display = "block";
                document.getElementById('dv_author').style.display = "none";
                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('dv_date').style.display = "block";
                document.getElementById('dv_process').style.display = "block";
                document.getElementById('d_form1').style.display = "none";
                document.getElementById('d_form2').style.display = "none";
                document.getElementById('dv_approve').style.display = "block";
                document.getElementById('dv_charges').style.display = "block";
                document.getElementById('dv_conclusion').style.display = "block";
                document.getElementById('dv_image').style.display = "block";

                break;
        }

        document.getElementById('lb_project_name').innerHTML = lb_projectName;

        var amount = document.getElementById('amount').value;

        switch (amount){
            case "1" :
                document.getElementById('inlineCheckbox1').checked = true;
                calc(1);
                break;
            case "2" :
                document.getElementById('inlineCheckbox2').checked = true;
                calc(2);
                break;
            case "3" :
                document.getElementById('inlineCheckbox3').checked = true;
                calc(3);
                break;
        }


            var val = $('#sdd').val();



            switch (val) {

                case "0" :

                    document.getElementById('d_form1').style.display = "none";
                    document.getElementById('d_form2').style.display = "none";

                    break;

                case "1":

                    document.getElementById('d_form1').style.display = "none";
                    document.getElementById('d_form2').style.display = "none";

                    break;

                case "2" :

                    document.getElementById('d_form1').style.display = "block";
                    document.getElementById('d_form2').style.display = "block";

                    break;

            }
    })
</script>


<script type="text/javascript">
    $(function () {
        $('#dateTimePicker').datetimepicker({
            pickTime: false
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#dateTimePicker1').datetimepicker({
            pickTime: false
        });
    });
</script>


<script type="text/javascript">

    $('#type_name').change(function () {

        var val = $('#type_name').val();

        var lb_projectName;
        var projectName =  document.getElementById('name');

        switch (val) {

            case "1" :
                lb_projectName = "ชื่อแผนงาน";
                projectName.placeholder = "ชื่อแผนงาน"
                document.getElementById('dv_plan').style.display = "none";
                document.getElementById('dv_amount').style.display = "none";
                document.getElementById('dv_author').style.display = "none";
                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('dv_date').style.display = "none";
                document.getElementById('dv_process').style.display = "none";
                document.getElementById('d_form1').style.display = "none";
                document.getElementById('d_form2').style.display = "none";
                document.getElementById('dv_approve').style.display = "none";
                document.getElementById('dv_charges').style.display = "none";
                document.getElementById('dv_conclusion').style.display = "none";
                document.getElementById('dv_image').style.display = "none";

                break;

            case "2":
                lb_projectName = "ชื่อโครงการ";
                projectName.placeholder = "ชื่อโครงการ";
                document.getElementById('dv_plan').style.display = "block";
                document.getElementById('dv_amount').style.display = "block";
                document.getElementById('dv_author').style.display = "none";
                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('dv_date').style.display = "block";
                document.getElementById('dv_process').style.display = "block";
                document.getElementById('d_form1').style.display = "none";
                document.getElementById('d_form2').style.display = "none";
                document.getElementById('dv_approve').style.display = "block";
                document.getElementById('dv_charges').style.display = "block";
                document.getElementById('dv_conclusion').style.display = "block";
                document.getElementById('dv_image').style.display = "block";

                break;
        }

        document.getElementById('lb_project_name').innerHTML = lb_projectName;


    });
</script>


<script type="text/javascript">

    $('#sdd').change(function () {

        var val = $('#sdd').val();



        switch (val) {

            case "0" :

                document.getElementById('d_form1').style.display = "none";
                document.getElementById('d_form2').style.display = "none";

                break;

            case "1":

                document.getElementById('d_form1').style.display = "none";
                document.getElementById('d_form2').style.display = "none";

                break;

            case "2" :

                document.getElementById('d_form1').style.display = "block";
                document.getElementById('d_form2').style.display = "block";

                break;

        }

    });
</script>


<script type="text/javascript">

function calc(isCheck){

    var lb_author;
    var lb_author2;
    var lb_author3;

    switch (isCheck){
        case 1 :
            if(document.getElementById('inlineCheckbox1').checked == true){
                document.getElementById('inlineCheckbox2').checked = false;
                document.getElementById('inlineCheckbox3').checked = false;

                lb_author = "ชื่อผู้จัดทำ"

                /// set data author 1

                document.getElementById('dv_author').style.display = "block";

                /// set data author 2

                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('userAuthor2').value = "";

                /// set data author 3

                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('userAuthor3').value = "";

                document.getElementById('amount').value = "1";

            }else{

                /// set data author 1

                document.getElementById('dv_author').style.display = "none";
                document.getElementById('userAuthor').value = "";
                /// set data author 2

                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('userAuthor2').value = "";
                /// set data author 3

                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('userAuthor3').value = "";
                /// set amount author
                document.getElementById('amount').value = "0";
            }

            break;

        case 2 :
            if(document.getElementById('inlineCheckbox2').checked == true){
                document.getElementById('inlineCheckbox1').checked = false;
                document.getElementById('inlineCheckbox3').checked = false;

                lb_author = "ชื่อผู้จัดทำคนที่ 1"
                lb_author2 = "ชื่อผู้จัดทำคนที่ 2"

                /// set data author 1

                document.getElementById('dv_author').style.display = "block";
                /// set data author 2

                document.getElementById('dv_author2').style.display = "block";

                /// set data author 3

                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('userAuthor3').value = "";

                /// set amount author
                document.getElementById('amount').value = "2";

            }else{

                /// set data author 1

                document.getElementById('dv_author').style.display = "none";
                document.getElementById('userAuthor').value = "";
                /// set data author 2

                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('userAuthor2').value = "";
                /// set data author 3

                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('userAuthor3').value = "";
                /// set amount author
                document.getElementById('amount').value = "0";
            }

            break;
        case 3 :
            if(document.getElementById('inlineCheckbox3').checked == true){
                document.getElementById('inlineCheckbox1').checked = false;
                document.getElementById('inlineCheckbox2').checked = false;

                lb_author = "ชื่อผู้จัดทำคนที่ 1"
                lb_author2 = "ชื่อผู้จัดทำคนที่ 2"
                lb_author3 = "ชื่อผู้จัดทำคนที่ 3"

                /// set data author 1

                document.getElementById('dv_author').style.display = "block";

                /// set data author 2

                document.getElementById('dv_author2').style.display = "block";

                /// set data author 3

                document.getElementById('dv_author3').style.display = "block";


                /// set amount author
                document.getElementById('amount').value = "3";
            }else{

                /// set data author 1

                document.getElementById('dv_author').style.display = "none";
                document.getElementById('userAuthor').value = "";
                /// set data author 2

                document.getElementById('dv_author2').style.display = "none";
                document.getElementById('userAuthor2').value = "";
                /// set data author 3

                document.getElementById('dv_author3').style.display = "none";
                document.getElementById('userAuthor3').value = "";
                /// set amount author
                document.getElementById('amount').value = "0";
            }

            break;
    }

    document.getElementById('lb_author').innerHTML = lb_author;
    document.getElementById('lb_author2').innerHTML = lb_author2;
    document.getElementById('lb_author3').innerHTML = lb_author3;
}
</script>

</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
