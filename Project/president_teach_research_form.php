<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "งานวิจัย";
$page_icon = "list-alt";
$page_home_active = "";
$page_president_teach_research_active = "active";
$page_dropdown_teach_open = "open";
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
            <li>ส่วนของอาจารย์</li>
            <li>งานวิจัย</li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> เพิ่มข้อมูลงานวิจัย</li>
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
            <li><a href="president_teach_research_academic.php">การเสนอผลงานวิจัย/วิชาการ</a></li>
            <li><a href="president_teach_research_funded.php">งานวิจัยที่ได้รับทุนสนับสนุน</a></li>
            <li><a href="president_teach_research_applied.php">ผลงานวิจัยที่นำไปใช้ประโยชน์</a></li>
            <li class="active"><a href="#add_research" data-toggle="tab">เพิ่มข้อมูลงานวิจัย</a></li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Tab panes -->

<?
if(!empty($_GET['rid']) ){
    $query_method = "president_update_research";
    $control_select = 1;

    $researchDAO = new ResearchDAO();
    $research = $researchDAO->findbyPK($_GET['rid']);

    $research_id = $research['research_id'][0];
    $research_name = $research['research_name'][0];
    $research_author = $research['research_author'][0];
    $research_institution = $research['research_institution'][0];
    $research_location = $research['research_location'][0];
    $research_detail = $research['research_detail'][0];

    $split_date = explode('-',$research['research_date'][0]);
    $split_date_end = explode('-',$research['research_date_end'][0]);
    $research_date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
    $research_date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

    $research_budget = $research['research_budget'][0];
    $research_document = $research['research_document'][0];
    $research_type_id = $research['research_type_id'][0];


} else {
    $query_method = "president_create_research";
    $research_id = "";
    $research_name = "";
    $research_author = "";
    $research_institution = "";
    $research_location = "";
    $research_detail = "";
    $research_date = "";
    $research_date_end = "";
    $research_budget = "";
    $research_document = "";
}
?>


<!--<div class="tab-pane" id="add_research">-->
<p class="col-md-12"
   style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
    กรอกรายละเอียดงานวิจัย </p>

<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=$query_method&id=$research_id&research_type_id=$research_type_id" ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label class="col-sm-4 control-label">ประเภทงานวิจัย</label>

        <div class="col-sm-5">
            <select class="form-control" id="sdd" name="sdd" <?=$control_select == 1 ? disabled : enabled ?>>
                <option value="0" <?=$research_type_id == 1 ? 'selected = "selected"' : ''; ?> >การเสนอผลงานวิจัย/วิชาการ</option>
                <option value="1" <?=$research_type_id == 2 ? 'selected = "selected"' : ''; ?> >งานวิจัยที่ได้รับทุนสนับสนุน</option>
                <option value="2" <?=$research_type_id == 3 ? 'selected = "selected"' : ''; ?>>ผลงานวิจัยที่นำไปใช้ประโยชน์</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_subject" id="lb_subject" class="col-sm-4 control-label">ชื่อผลงาน</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="subject" name="subject"
                   value="<? echo $research_name ?>" placeholder="ชื่อผลงาน">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

<!--  ********************  input type author name ***********************************  -->
    <div class="form-group" id="dv_author" style="display: none">
        <label for="lb_author" id="lb_author" class="col-sm-4 control-label">ชื่อผู้จัดทำ</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="author" name="author"
                   value="<? echo $research_author ?>" placeholder="ชื่อผู้จัดทำ">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" id="dv_institution">
        <label for="lb_institution" id="lb_institution" class="col-sm-4 control-label">หน่วยงานที่จัด/ประชุมวารสารที่ตีพิมพ์</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="institution" name="institution"
                   value="<? echo $research_institution ?>" placeholder="หน่วยงานที่จัด/ประชุมวารสารที่ตีพิมพ์">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" style="display: none" id="dv_detail">
        <label for="lb_detail" id="lb_detail" class="col-sm-4 control-label">lb_detail</label>

        <div class="col-sm-5">
            <textarea class="form-control" id="detail" name="detail"
                      placeholder="หน่วยงานที่จัด/ประชุมวารสารที่ตีพิมพ์"><? echo $research_detail ?></textarea>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_date" id="lb_date" class="col-sm-4 control-label">วันที่นำเสนอ/วาระที่ออกของวารสาร</label>

        <div class="col-sm-5">


                <div class="col-sm-12" id="dv_date_only" style="display: block">
                    <div id="dateTimePickerOnly" class="input-append date">
                        <div class="input-group-addon">
                            <input type="text" class="col-sm-10" id="date_only" name="date_only"
                                   value="<? echo $research_date ?>"
                                   data-format="dd-MM-yyyy" placeholder="วันที่นำเสนอ">

                                <span class="add-on">
                                    <div class="glyphicon glyphicon-time"></div>
                                </span>
                        </div>
                    </div>

                </div>

                <div class="col-sm-6 no-pad" id="dv_date_start" style="display: none">
                    <div id="dateTimePicker" class="input-append">
                        <div class="input-group col-xs-12 no-pad add-on">
                            <input type="text" class="form-control" id="date_start" name="date_start"
                                   value="<? echo $research_date ?>"
                                   data-format="dd-MM-yyyy"
                                   placeholder="วันที่นำเสนอ : 01-01-2014">

                            <div class="input-group-addon">
                                <div class="glyphicon glyphicon-time"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-6" id="dv_date_end" style="display: none">

                    <div id="dateTimePicker1" class="input-append"  style="width: 240px">
                        <div class="input-group col-xs-10 no-pad add-on">
                            <input type="text" class="form-control" id="date_end" name="date_end"
                                   value="<? echo $research_date_end ?>"
                                   data-format="dd-MM-yyyy"
                                   placeholder="สิ้นสุด : 30-01-2014">

                            <div class="input-group-addon">
                                <div class="glyphicon glyphicon-time"></div>
                            </div>
                        </div>
                    </div>

                </div>




        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" id="dv_location">
        <label for="lb_location" id="lb_location" class="col-sm-4 control-label">สถานที่จัดประชุม</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="location" name="location"
                   value="<? echo $research_location ?>" placeholder="สถานที่จัดประชุม">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" id="dv_budget">
        <label for="lb_budget" id="lb_budget" class="col-sm-4 control-label">ค่าใช้จ่าย (บาท)</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="budget" name="budget"
                   value="<? echo $research_budget ?>" placeholder="ค่าใช้จ่าย (บาท)">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lbFile" id="lbFile" class="col-sm-4 control-label">บทความวิจัย/วิชาการที่ตีพิมพ์</label>

        <div class="col-sm-5">
            <div class="col-sm-10">
                <input type="file" id="file" name="file"
                       value="<? echo $research_document ?>"
                       placeholder="บทความวิจัย/วิชาการที่ตีพิมพ์">
            </div>
            <div class="col-sm-10">
                <label>( doc, docx, pdf, ppt, pptx, gif ,jpg, png )</label>
            </div>

        </div>
        <div class="col-sm-3">
            <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
        </div>
    </div>


    <!--                <div class="form-group">-->
    <!--                    <label for="lb_one" id="lb_one" class="col-sm-4 control-label" ></label>-->
    <!--                    <div class="col-sm-5">-->
    <!--                        <input type="text" class="form-control" id="one" placeholder="lb_one">-->
    <!--                    </div>-->
    <!--                    <div class="col-sm-3">-->
    <!--                        <label style="font-size: large; color: red">*</label>-->
    <!--                    </div>-->
    <!--                </div>-->

    <!--                *************************************-->

    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 12px">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align: right">
                <button type="submit" id="submit" class="btn btn-primary btn-lg">ยืนยัน</button>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <!--                <button type="reset" id="clear" class="btn btn-default" onclick="window.open('conference_form.php')">ยกเลิก</button>-->
                <button type="reset" id="clear" class="btn btn-default btn-lg" onclick="window.history.back();">
                    ยกเลิก
                </button>
            </div>
        </div>
    </div>


</form>

</div>


<!--    <script type="text/javascript">-->
<!--        $('#datetimepicker').datetimepicker({-->
<!--            format: 'dd/MM/yyyy hh:mm:ss',-->
<!--            language: 'pt-BR'-->
<!--        });-->
<!--    </script>-->


<script>
    $(function () {
        $('#myTab a:last').tab('show')
    })
</script>

<script type="text/javascript">
    //        $('select').on('change',function(){
    //            var val = $(this).data('value');
    //            alert(val);
    //        });
    //        $('#sdd').change(function(){
    //            var val = $('#sdd').val();
    //            var dd_value = document.getElementById("dd_values");
    //            dd_value.value = val;
    //        });

    $('#sdd').change(function () {

        var val = $('#sdd').val();

        var lb_subject;
        var lb_authors;
        var lb_institution;
        var lb_detail;
        var lb_location;
        var lb_date;
        var lb_budget;
        var lb_file;

        var subject = document.getElementById("subject");
        var author = document.getElementById("author");
        var institution = document.getElementById("institution");
        var detail = document.getElementById("detail");
        var location = document.getElementById("location");
        var date_start = document.getElementById("date_start");
        var date_end = document.getElementById("date_end");
        var budget = document.getElementById("budget");


        switch (val) {

            case "0" :
                lb_subject = "ชื่อผลงาน";
//                lb_authors = "ชื่อผู้จัดทำ";
                lb_institution = "หน่วยงานที่จัดประชุม/วารสารที่ตีพิมพ์";
                lb_location = "สถานที่จัดประชุม";
                lb_date = "วันที่นำเสนอ/วาระที่ออกของวารสาร";
                lb_budget = "ค่าใช้จ่าย (บาท)";
                lb_file = "บทความวิจัย/วิชาการที่ตีพิมพ์";

                subject.placeholder = "ชื่อผลงาน";
//                author.placeholder = "ชื่อผู้จัดทำ";
                institution.placeholder = "หน่วยงานที่จัดประชุม/วารสารที่ตีพิมพ์";
                location.placeholder = "สถานที่จัดประชุม";
                date_start.placeholder = "วันที่นำเสนอ : 01-01-2014";
                budget.placeholder = "ค่าใช้จ่าย (บาท)";

//                document.getElementById("dv_author").style.display = "block";
                document.getElementById("dv_institution").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_date_only").style.display = "none";
                document.getElementById("dv_date_start").style.display = "block";
                document.getElementById("dv_date_end").style.display = "block";
                document.getElementById("dv_location").style.display = "block";
                document.getElementById("dv_budget").style.display = "block";


                break;

            case "1" :
                lb_subject = "ชื่อผลงาน";
//                lb_authors = "ชื่อผู้วิจัย";
                lb_institution = "หน่วยงานที่ให้ทุน";
                lb_budget = "งบประมาณที่สนับสนุน (บาท)";
                lb_date = "ระยะเวลาที่ระบุในสัญญา";
                lb_file = "เอกสาร/หลักฐานการได้รับทุนวิจัย";

                subject.placeholder = "ชื่อผลงาน";
//                author.placeholder = "ชื่อผู้วิจัย";
                institution.placeholder = "หน่วยงานที่ให้ทุน";
                budget.placeholder = "งบประมาณที่สนับสนุน (บาท)";
                date_start.placeholder = "เริ่มต้น : 01-01-2014";

//                document.getElementById("dv_author").style.display = "block";
                document.getElementById("dv_institution").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_date_only").style.display = "none";
                document.getElementById("dv_date_start").style.display = "block";
                document.getElementById("dv_date_end").style.display = "block";
                document.getElementById("dv_budget").style.display = "block";
                document.getElementById("dv_location").style.display = "none";


                break;

            case "2" :
                lb_subject = "ชื่อผลงานวิจัย";
                lb_institution = "หน่วยงาน/ชุมชนที่ใช้ประโยชน์";
                lb_detail = "รายละเอียดการใช้ประโยชน์";
                lb_date = "ช่วงเวลาที่ใช้";
                lb_budget = "ค่าใช้จ่าย (บาท)";
                lb_file = "เอกสาร/หลักฐานที่นำไปใช้ประโยชน์";


                subject.placeholder = "ชื่อผลงานวิจัย";
                institution.placeholder = "หน่วยงาน/ชุมชนที่ใช้ประโยชน์";
                detail.placeholder = "รายละเอียดการใช้ประโยชน์";
                date_start.placeholder = "เริ่มต้น : 01-01-2014";

                document.getElementById("dv_author").style.display = "none";
                document.getElementById("dv_date_only").style.display = "none";
                document.getElementById("dv_institution").style.display = "block";
                document.getElementById("dv_detail").style.display = "block";
                document.getElementById("dv_date_start").style.display = "block";
                document.getElementById("dv_date_end").style.display = "block";
                document.getElementById("dv_location").style.display = "none";
                document.getElementById("dv_budget").style.display = "none";

                break;

        }

        document.getElementById("lb_subject").innerHTML = lb_subject;
        document.getElementById("lb_author").innerHTML = lb_authors;
        document.getElementById("lb_institution").innerHTML = lb_institution;
        document.getElementById("lb_detail").innerHTML = lb_detail;
        document.getElementById("lb_location").innerHTML = lb_location;
        document.getElementById("lb_date").innerHTML = lb_date;
        document.getElementById("lb_budget").innerHTML = lb_budget;
        document.getElementById("lbFile").innerHTML = lb_file;

    });
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
        $('#dateTimePickerOnly').datetimepicker({
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

<script type="text/javascript" >
    $(function () {

        var val = $('#sdd').val();

        var lb_subject;
        var lb_authors;
        var lb_institution;
        var lb_detail;
        var lb_location;
        var lb_date;
        var lb_budget;
        var lb_file;

        var subject = document.getElementById("subject");
        var author = document.getElementById("author");
        var institution = document.getElementById("institution");
        var detail = document.getElementById("detail");
        var location = document.getElementById("location");
        var date_start = document.getElementById("date_start");
        var date_end = document.getElementById("date_end");
        var budget = document.getElementById("budget");


        switch (val) {

            case "0" :
                lb_subject = "ชื่อผลงาน";
//                lb_authors = "ชื่อผู้จัดทำ";
                lb_institution = "หน่วยงานที่จัดประชุม/วารสารที่ตีพิมพ์";
                lb_location = "สถานที่จัดประชุม";
                lb_date = "วันที่นำเสนอ/วาระที่ออกของวารสาร";
                lb_budget = "ค่าใช้จ่าย (บาท)";
                lb_file = "บทความวิจัย/วิชาการที่ตีพิมพ์";

                subject.placeholder = "ชื่อผลงาน";
//                author.placeholder = "ชื่อผู้จัดทำ";
                institution.placeholder = "หน่วยงานที่จัดประชุม/วารสารที่ตีพิมพ์";
                location.placeholder = "สถานที่จัดประชุม";
                date_start.placeholder = "วันที่นำเสนอ : 01-01-2014";
                budget.placeholder = "ค่าใช้จ่าย (บาท)";

//                document.getElementById("dv_author").style.display = "block";
                document.getElementById("dv_institution").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_date_only").style.display = "none";
                document.getElementById("dv_date_start").style.display = "block";
                document.getElementById("dv_date_end").style.display = "block";
                document.getElementById("dv_location").style.display = "block";
                document.getElementById("dv_budget").style.display = "block";


                break;

            case "1" :
                lb_subject = "ชื่อผลงาน";
//                lb_authors = "ชื่อผู้วิจัย";
                lb_institution = "หน่วยงานที่ให้ทุน";
                lb_budget = "งบประมาณที่สนับสนุน (บาท)";
                lb_date = "ระยะเวลาที่ระบุในสัญญา";
                lb_file = "เอกสาร/หลักฐานการได้รับทุนวิจัย";

                subject.placeholder = "ชื่อผลงาน";
//                author.placeholder = "ชื่อผู้วิจัย";
                institution.placeholder = "หน่วยงานที่ให้ทุน";
                budget.placeholder = "งบประมาณที่สนับสนุน (บาท)";
                date_start.placeholder = "เริ่มต้น : 01-01-2014";

//                document.getElementById("dv_author").style.display = "block";
                document.getElementById("dv_institution").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_date_only").style.display = "none";
                document.getElementById("dv_date_start").style.display = "block";
                document.getElementById("dv_date_end").style.display = "block";
                document.getElementById("dv_budget").style.display = "block";
                document.getElementById("dv_location").style.display = "none";


                break;

            case "2" :
                lb_subject = "ชื่อผลงานวิจัย";
                lb_institution = "หน่วยงาน/ชุมชนที่ใช้ประโยชน์";
                lb_detail = "รายละเอียดการใช้ประโยชน์";
                lb_date = "ช่วงเวลาที่ใช้";
                lb_budget = "ค่าใช้จ่าย (บาท)";
                lb_file = "เอกสาร/หลักฐานที่นำไปใช้ประโยชน์";


                subject.placeholder = "ชื่อผลงานวิจัย";
                institution.placeholder = "หน่วยงาน/ชุมชนที่ใช้ประโยชน์";
                detail.placeholder = "รายละเอียดการใช้ประโยชน์";
                date_start.placeholder = "เริ่มต้น : 01-01-2014";

                document.getElementById("dv_author").style.display = "none";
                document.getElementById("dv_date_only").style.display = "none";
                document.getElementById("dv_institution").style.display = "block";
                document.getElementById("dv_detail").style.display = "block";
                document.getElementById("dv_date_start").style.display = "block";
                document.getElementById("dv_date_end").style.display = "block";
                document.getElementById("dv_location").style.display = "none";
                document.getElementById("dv_budget").style.display = "none";

                break;

        }

        document.getElementById("lb_subject").innerHTML = lb_subject;
        document.getElementById("lb_author").innerHTML = lb_authors;
        document.getElementById("lb_institution").innerHTML = lb_institution;
        document.getElementById("lb_detail").innerHTML = lb_detail;
        document.getElementById("lb_location").innerHTML = lb_location;
        document.getElementById("lb_date").innerHTML = lb_date;
        document.getElementById("lb_budget").innerHTML = lb_budget;
        document.getElementById("lb_file").innerHTML = lb_file;

    });
</script>


<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->


<!--$len = count($table_pk['COLUMN_NAME']);-->