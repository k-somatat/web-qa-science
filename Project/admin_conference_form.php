<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "สรุปผลการอบรม/สัมมนา/ประชุมวิชาการ";
$page_icon = "list-alt";
$page_admin_conference_active = "active";
// Page Setup END

?>
<!-- Header Include Here -->
<?php include("admin/commons/page-header1.0.php");
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
            <li>หน้าแรก</li>
            <li>สรุปผลการอบรม/สัมมนา/ประชุมวิชาการ</li>
            <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> เพิ่มข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการ</li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
            <li><a href="admin_conference.php">ข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการทั้งหมด</a></li>
            <li class="active"><a class="active" href="#admin_conference_form" data-toggle="tab">เพิ่มข้อมูลสรุปผลการอบรม/สัมมนา/ประชุมวิชาการ</a>
            </li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Tab panes -->
<!--    <div class="tab-content">-->
<!---->
<!--        <div class="tab-pane" id="conference_form">-->

<?



if (!empty($_GET['cid'])) {
    $query_method = "admin_update_conference";

    $conferenceDao = new ConferenceDAO();
    $conferences = $conferenceDao->findbyPK($_GET['cid']);

    $conference_id = $conferences['conference_id'][0];
    $conference_name = $conferences['conference_name'][0];
    $conference_institution = $conferences['conference_institution'][0];

    $split_date = explode('-',$conferences['conference_date'][0]);
    $split_date_end = explode('-',$conferences['conference_date_end'][0]);
    $conference_date = $split_date[2]."-".$split_date[1]."-".$split_date[0];
    $conference_date_end = $split_date_end[2]."-".$split_date_end[1]."-".$split_date_end[0];

    $conference_location = $conferences['conference_location'][0];
    $conference_topic = $conferences['conference_topic'][0];
    $conference_budget = $conferences['conference_budget'][0];
    $conference_tech_name = $conferences['conference_tech_name'][0];
    $conference_document = $conferences['conference_document'][0];
    $user_id = $conferences['user_id'][0];

} else {
    $query_method = "admin_create_conference";
    $conference_id = "";
    $conference_name = "";
    $conference_institution = "";
    $conference_date = "";
    $conference_date_end = "";
    $conference_location = "";
    $conference_topic = "";
    $conference_budget = "";
    $conference_tech_name = "";
}


?>


<p class="col-md-12"
   style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
    กรอกรายละเอียดสรุปผลการอบรม/สัมมนา/ประชุมวิชาการ </p>

<form class="form-horizontal" role="form" method="post"
      action="<?= site_url . "sqlfunction.php?method=$query_method&id=$conference_id" ?>" enctype="multipart/form-data">


    <div class="form-group">
        <label for="lbAuthor" class="col-sm-4 control-label" >ชื่อผู้จัดทำ</label>

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
                          <option value='<?=$users['user_id'][$index]?>' <?=$users['user_id'][$index] == $user_id ? 'selected = "selected"' : ''; ?>>
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

    <div class="form-group">
        <label for="lbTask" class="col-sm-4 control-label">ชื่องาน</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="task" name="task"
                   value="<? echo $conference_name ?>" placeholder="ชื่องาน">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lbMajor" class="col-sm-4 control-label">หน่วยงาน</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="major" name="major"
                   value="<? echo $conference_institution ?>" placeholder="หน่วยงานที่จัด">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>


    <div class="form-group">
        <label for="lb_date" id="lb_date" class="col-sm-4 control-label">วันที่เข้าร่วมงาน</label>

        <div class="col-sm-5">

            <div class="col-sm-6 no-pad" id="dv_date_start" >

                <div id="dateTimePicker" class="input-append" >
                    <div class="input-group col-xs-12 no-pad add-on">
                        <input type="text" class="form-control" id="date" name="date"
                               data-format="dd-MM-yyyy" placeholder="วันที่นำเสนอ : 01-01-2014"
                               value="<?=$conference_date; ?>" />
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
                                   data-format="dd-MM-yyyy" placeholder="สิ้นสุด : 30-01-2014"
                                   value="<?=$conference_date_end; ?>" />
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
        <label for="lbLocation" class="col-sm-4 control-label">สถานที่</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="location" name="location"
                   value="<? echo $conference_location ?>" placeholder="สถานที่">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group" style="display: none">
        <label for="lbTechName" class="col-sm-4 control-label">ชื่ออาจารย์</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="techName" name="techName"
                   value="<? echo $conference_tech_name ?>" placeholder="ชื่ออาจารย์">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: large; color: red">*</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_budget" class="col-sm-4 control-label">ชื่อการประชุม</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="topic" name="topic"
                   value="<? echo $conference_topic ?>" placeholder="ชื่อการประชุม">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lb_budget" class="col-sm-4 control-label">ค่าใช้จ่าย (บาท)</label>

        <div class="col-sm-5 input-group">
            <input type="text" class="form-control" id="budget" name="budget"
                   value="<? echo $conference_budget ?>" placeholder="ค่าใช้จ่าย (บาท)">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
        </div>
    </div>

    <div class="form-group">
        <label for="lbFile" class="col-sm-4 control-label">เอกสารสรุปผลการอบรม/สัมมนา/ประชุมวิชาการ</label>

        <div class="col-sm-5">
            <div class="col-sm-10">
                <input type="file" class="file" id="file" name="file"
                       value="" placeholder="เอกสารอ้างอิง">
            </div>
            <div class="col-sm-10">
                <label>( doc, docx, pdf, ppt, pptx, gif ,jpg, png )</label>
            </div>

        </div>
        <div class="col-sm-3">
            <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 12px">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align: right">
                <button type="submit" id="submit" class="btn btn-primary btn-lg">ยืนยัน</button>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<!--                <button type="reset" id="clear" class="btn btn-default" onclick="window.open('conference_form.php')">ยกเลิก</button>-->
                <button type="reset" id="clear" class="btn btn-default btn-lg" onclick="window.history.back();">ยกเลิก</button>
            </div>
        </div>
    </div>


</form>

<!--        </div>-->

<!--    </div>-->

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




</div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->