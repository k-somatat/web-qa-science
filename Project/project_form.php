<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "โครงการ";
$page_icon = "list-alt";
$page_project_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("./commons/page-header1.0.php"); ?>
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
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> แก้ไขข้อมูลโครงการ</li>
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
            <li><a href="project.php">ข้อมูลโครงการทั้งหมด</a></li>
<!--            <li class="active"><a href="#project_form" data-toggle="tab">เพิ่มข้อมูลโครงการ</a></li>-->
            <li class="active"><a href="#project_form" data-toggle="tab">แก้ไขข้อมูลโครงการ</a></li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Tab panes -->

<div class="tab-pane active" id="project">

</div>

<?



if (!empty($_GET['pid'])) {
    $query_method = "user_update_project";
//     uncommnet this line when you want disabled select option when user update
//    $control_select = 1;

    $projectDAO = new ProjectDAO();
    $project = $projectDAO->findbyPK($_GET['pid']);

    $project_id = $project['project_id'][0];
    $project_name = $project['project_name'][0];

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
    $project_id = "";
    $project_name = "";
    $project_date = "";
    $project_date_end = "";
    $project_process = "";
    $project_budget = "";
    $project_final_budget = "";
}


?>


<div class="tab-pane" id="project_form">
    <p class="col-md-12"
       style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
        กรอกรายละเอียดโครงการ</p>

    <form class="form-horizontal" role="form" method="post"
          action="<?= site_url . "sqlfunction.php?method=$query_method&id=$project_id" ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label for="lbTask" class="col-sm-4 control-label">ชื่อโครงการ</label>

            <div class="col-sm-5 input-group">
                <input type="text" class="form-control" id="name" name="name"
                       value="<? echo $project_name ?>"
                       placeholder="ชื่อโครงการ" disabled>
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </div>
            </div>
            <div class="col-sm-3">
                <label style="font-size: large; color: red">*</label>
            </div>
        </div>


        <div class="form-group">
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

        <div class="form-group">
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

                <!--  show all data  -->
<!--        <div class="form-group" id="d_form1" >-->
<!---->
<!--            <label class="col-sm-4 control-label">งบประมาณได้รับการอนุมัติ (บาท)</label>-->
<!---->
<!--            <div class="col-sm-5">-->
<!--                <input type="text" class="form-control" id="approve_budget" name="approve_budget"-->
<!--                       value="--><?// echo $project_budget ?><!--"-->
<!--                       placeholder="งบประมาณได้รับการอนุมัติ (บาท)">-->
<!--            </div>-->
<!--            <div class="col-sm-3">-->
<!--                <label style="font-size: large; color: red"></label>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="form-group" id="d_form2" >-->
<!---->
<!--            <label class="col-sm-4 control-label">งบประมาณสิ้นสุดโครงการ (บาท)</label>-->
<!---->
<!--            <div class="col-sm-5">-->
<!--                <input type="text" class="form-control" id="final_budget" name="final_budget"-->
<!--                       value="--><?// echo $project_final_budget ?><!--"-->
<!--                       placeholder="งบประมาณสิ้นสุดโครงการ (บาท)">-->
<!--            </div>-->
<!--            <div class="col-sm-3">-->
<!--                <label style="font-size: large; color: red"></label>-->
<!--            </div>-->
<!--        </div>-->

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
        <div class="form-group">
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

        <div class="form-group">
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

        <div class="form-group">
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

        <div class="form-group">
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

</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
