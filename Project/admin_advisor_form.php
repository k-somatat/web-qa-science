<?php session_start();
// 	Page Setup
define('ABSPATH', dirname(__FILE__) . '/');
$page_name = "ภาระงานอาจารย์ที่ปรึกษา";
$page_icon = "list-alt";
$page_admin_advisor_active = "active";

require_once(ABSPATH . "src/DAO/AdvisorDAO.class.php");
require_once(ABSPATH . "src/vo/Advisor.class.php");

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
                <li>ภาระงานอาจารย์ที่ปรึกษา</li>
                <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> เพิ่มข้อมูล</li>
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
                <li><a href="admin_advisor_class.php">อาจารย์ที่ปรึกษาชั้นปี</a></li>
                <li><a href="admin_advisor_project.php">อาจารย์ที่ปรึกษาโครงงาน</a></li>
                <li><a href="admin_advisor_cooperative_education.php">อาจารย์ที่ปรึกษาสหกิจศึกษา</a></li>
                <li class="active"><a href="#admin_advisor_form" data-toggle="tab">เพิ่มข้อมูล</a></li>
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Tab panes -->

    <div class="tab-pane active" id="advisor_project">

    </div>


    <div class="tab-pane" id="advisor_cooperative_education">

    </div>


    <?
    if (!empty($_GET['aid'])) {
        if($_GET['cancel'] == ""){
        $query_method = "admin_update_advisor";
        $control_select = 1;

        $advisorDAO = new AdvisorDAO();
        $advisor = new Advisor();
        $advisor = $advisorDAO->findbyPK($_GET['aid']);

            if($advisor['advisor_type_id'][0] == 3){

                $advisor_id = $advisor['advisor_id'][0];
                $advisor_detail = $advisor['advisor_name'][0];
                $advisor_class_year = $advisor['advisor_year'][0];
                $advisor_amount_person = $advisor['advisor_amount'][0];

                $split_date = explode('-',$advisor['advisor_date'][0]);
                $advisor_date = $split_date[2]."-".$split_date[1]."-".$split_date[0];

                $advisor_document = $advisor['advisor_document'][0];
                $user_id = $advisor['user_id'][0];
                $advisor_type_id = $advisor['advisor_type_id'][0];

            }else{

                $advisor_id = $advisor['advisor_id'][0];
                $advisor_name = $advisor['advisor_name'][0];

                $advisor_author = $advisor['advisor_author'][0];
                $advisor_author2 = $advisor['advisor_author2'][0];
                $advisor_author3 = $advisor['advisor_author3'][0];
                $advisor_author4 = $advisor['advisor_author4'][0];
                $advisor_author5 = $advisor['advisor_author5'][0];
    //        set values textfield advisor author 1
                $full_name = explode(" ",$advisor_author);
                $genders = $full_name[0];
                $firstName = $full_name[1];
                $lastName = $full_name[2];


    //        set values textfield advisor author 2
                $full_name2 = explode(" ",$advisor_author2);
    //            if($full_name2[0] == "นาย"){
    //                $genders2 = 0;
    //            }else{
    //                $genders2 = 1;
    //            }
                $genders2 = $full_name2[0];
                $firstName2 = $full_name2[1];
                $lastName2 = $full_name2[2];
    //        set values textfield advisor author 3
                $full_name3 = explode(" ",$advisor_author3);
                $genders3 = $full_name3[0];
                $firstName3 = $full_name3[1];
                $lastName3 = $full_name3[2];
    //        set values textfield advisor author 2
                $full_name4 = explode(" ",$advisor_author4);
                $genders4 = $full_name4[0];
                $firstName4 = $full_name4[1];
                $lastName4 = $full_name4[2];
    //        set values textfield advisor author 2
                $full_name5 = explode(" ",$advisor_author5);
                $genders5 = $full_name5[0];
                $firstName5 = $full_name5[1];
                $lastName5 = $full_name5[2];

                $advisor_amount = $advisor['advisor_amount'][0];
                $advisor_year = $advisor['advisor_year'][0];
                $advisor_location = $advisor['advisor_location'][0];
                $advisor_document = $advisor['advisor_document'][0];
                $user_id = $advisor['user_id'][0];
                $advisor_type_id = $advisor['advisor_type_id'][0];
            }
        }else{
            $advisor_name = "";

            // set values author case create
            $genders = "นาย";
            $firstName = "";
            $lastName = "";
            // set values author2 case create
            $genders2 = "นาย";
            $firstName2 = "";
            $lastName2 = "";
            // set values author3 case create
            $genders3 = "นาย";
            $firstName3 = "";
            $lastName3 = "";
            // set values author4 case create
            $genders4 = "นาย";
            $firstName4 = "";
            $lastName4 = "";
            // set values author5 case create
            $genders5 = "นาย";
            $firstName5 = "";
            $lastName5 = "";

            $advisor_amount = "";
            $advisor_location = "";
            $advisor_document = "";
        }

    } else {
        $query_method = "admin_create_advisor";
        $advisor_id = "";
        $advisor_name = "";

        $advisor_type_id = $_GET['atyid'];

        // set values author case create
        $genders = "นาย";
        $firstName = "";
        $lastName = "";
        // set values author2 case create
        $genders2 = "นาย";
        $firstName2 = "";
        $lastName2 = "";
        // set values author3 case create
        $genders3 = "นาย";
        $firstName3 = "";
        $lastName3 = "";
        // set values author4 case create
        $genders4 = "นาย";
        $firstName4 = "";
        $lastName4 = "";
        // set values author5 case create
        $genders5 = "นาย";
        $firstName5 = "";
        $lastName5 = "";

        $advisor_amount = "";
        $advisor_location = "";
        $advisor_document = "";
    }
    ?>

    <div class="tab-pane" id="admin_advisor_form">
        <p class="col-md-12"
           style="text-align: center; margin-bottom: 30px; margin-top: 30px; font-size: large; color: red">
            กรอกรายละเอียดที่ปรึกษา </p>

        <form class="form-horizontal" role="form" method="post"
              action="<?= site_url . "sqlfunction.php?method=$query_method&id=$advisor_id&advisor_type_id=$advisor_type_id" ?>"
              enctype="multipart/form-data">

            <div class="form-group">
                <label class="col-sm-4 control-label">ประเภทที่ปรึกษา</label>

                <div class="col-sm-5">
                    <select class="form-control" id="sdd" name="sdd" <?=$control_select == 1 ? disabled : enabled ?>>
                        <option value="2" <?= $advisor_type_id == 3 ? 'selected="selected"' : '' ?>>
                            อาจารย์ที่ปรึกษาชั้นปี
                        </option>
                        <option value="0" <?= $advisor_type_id == 1 ? 'selected="selected"' : '' ?>>ที่ปรึกษาโครงงาน
                        </option>
                        <option value="1" <?= $advisor_type_id == 2 ? 'selected="selected"' : '' ?>>
                            ที่ปรึกษาสหกิจศึกษา
                        </option>
                    </select>
                </div>
            </div>

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

            <div class="form-group" id="dv_name" style="display: none">
                <label for="lb_subject" id="lb_name" class="col-sm-4 control-label">ชื่อโครงการ</label>

                <div class="col-sm-5 input-group">
                    <input type="text" class="form-control" id="name" name="name"
                           value="<? echo $advisor_name ?>" placeholder="ชื่อโครงการ">
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
                <input type="text" name="amount" id="amount" value="<?=$advisor_amount?>" style="display: none">
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
                    <div class="col-sm-3" id="dv_checked4" style="display: none">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox4" name="inlineCheckbox4" onclick="calc(4);"> 4 คน
                        </label>
                    </div>
                    <div class="col-sm-3" id="dv_checked5" style="display: none">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox5" name="inlineCheckbox5" onclick="calc(5);"  > 5 คน
                        </label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>
            <!--      ข้อมูลผู้จัดทำตนที่ 1    -->
            <div class="form-group" id="dv_fullName" style="display: none">
                <label for="lb_author" id="lb_author" class="col-sm-4 control-label">ชื่อผู้จัดทำ</label>

                <div class="col-sm-5">
                    <div class="col-sm-4">
                        <select class="form-control" id="gender" name="gender">
                            <option value="นาย" <?=$genders == "นาย" ? 'selected="selected"' : ''?>>นาย</option>
                            <option value="นางสาว" <?=$genders == "นางสาว" ? 'selected="selected"' : '' ?>>นางสาว</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               value="<? echo $firstName ?>"
                               placeholder="ชื่อ">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               value="<? echo $lastName ?>"
                               placeholder="นามสกุล">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>
            <!--      ข้อมูลผู้จัดทำตนที่ 2    -->
            <div class="form-group" id="dv_author2" style="display: none">
                <label for="lb_author" id="lb_author" class="col-sm-4 control-label">ชื่อผู้จัดทำ</label>
                <div class="col-sm-5">
                    <div class="col-sm-4">
                        <select class="form-control" id="gender2" name="gender2">
                            <option value="นาย" <?=$genders2 == "นาย" ? 'selected="selected"' : ''?>>นาย</option>
                            <option value="นางสาว" <?=$genders2 == "นางสาว" ? 'selected="selected"' : '' ?>>นางสาว</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first_name2" name="first_name2"
                               value="<? echo $firstName2 ?>"
                               placeholder="ชื่อ">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last_name2" name="last_name2"
                               value="<? echo $lastName2 ?>"
                               placeholder="นามสกุล">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>
            <!--      ข้อมูลผู้จัดทำตนที่ 3    -->
            <div class="form-group" id="dv_author3" style="display: none">
                <label for="lb_author" id="lb_author" class="col-sm-4 control-label">ชื่อผู้จัดทำ</label>

                <div class="col-sm-5">
                    <div class="col-sm-4">
                        <select class="form-control" id="gender3" name="gender3">
                            <option value="นาย" <?=$genders3 == "นาย" ? 'selected="selected"' : ''?>>นาย</option>
                            <option value="นางสาว" <?=$genders3 == "นางสาว" ? 'selected="selected"' : '' ?>>นางสาว</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first_name3" name="first_name3"
                               value="<? echo $firstName3 ?>"
                               placeholder="ชื่อ">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last_name3" name="last_name3"
                               value="<? echo $lastName3 ?>"
                               placeholder="นามสกุล">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>
            <!--      ข้อมูลผู้จัดทำตนที่ 4      -->
            <div class="form-group" id="dv_author4" style="display: none">
                <label for="lb_author" id="lb_author4" class="col-sm-4 control-label">ชื่อผู้จัดทำ</label>

                <div class="col-sm-5">
                    <div class="col-sm-4">
                        <select class="form-control" id="gender4" name="gender4">
                            <option value="นาย" <?=$genders4 == "นาย" ? 'selected="selected"' : ''?>>นาย</option>
                            <option value="นางสาว" <?=$genders4 == "นางสาว" ? 'selected="selected"' : '' ?>>นางสาว</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first_name4" name="first_name4"
                               value="<? echo $firstName4 ?>"
                               placeholder="ชื่อ">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last_name4" name="last_name4"
                               value="<? echo $lastName4 ?>"
                               placeholder="นามสกุล">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>
            <!--      ข้อมูลผู้จัดทำตนที่ 5      -->
            <div class="form-group" id="dv_author5" style="display: none">
                <label for="lb_author" id="lb_author5" class="col-sm-4 control-label">ชื่อผู้จัดทำ</label>

                <div class="col-sm-5">
                    <div class="col-sm-4">
                        <select class="form-control" id="gender5" name="gender5">
                            <option value="นาย" <?=$genders5 == "นาย" ? 'selected="selected"' : ''?>>นาย</option>
                            <option value="นางสาว" <?=$genders5 == "นางสาว" ? 'selected="selected"' : '' ?>>นางสาว</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first_name5" name="first_name5"
                               value="<? echo $firstName5 ?>"
                               placeholder="ชื่อ">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last_name5" name="last_name5"
                               value="<? echo $lastName5 ?>"
                               placeholder="นามสกุล">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>



            <div class="form-group" id="dv_year" style="display: none">
                <label for="lb_institution" id="lb_year" class="col-sm-4 control-label">ปีการศึกษา</label>

                <div class="col-sm-5 input-group">
                    <input type="text" class="form-control" id="year" name="year"
                           value="<? echo $advisor_year ?>"
                           placeholder="ปีการศึกษา ตัวอย่างเช่น 2556" pattern="[2]{1}[5-9]{1}[0-9]{2}">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>

            <div class="form-group" id="dv_location" style="display: none">
                <label for="lb_location" id="lb_location" class="col-sm-4 control-label">ชื่อสถานประกอบการ</label>

                <div class="col-sm-5 input-group">
                    <input type="text" class="form-control" id="location" name="location"
                           value="<? echo $advisor_location ?>"
                           placeholder="ชื่อสถานประกอบการ">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>

            <!--      ********* Advisor class form *******      -->




            <div class="form-group" id="dv_class_year">
                <label for="lb_class_year" id="lb_class_year" class="col-sm-4 control-label">ชั้นปี</label>

                <div class="col-sm-5">

                    <select id="classYear" name="classYear" class="form-control">
                        <option value="ชั้นปีที่ 1" <?=$advisor_class_year == "ชั้นปีที่ 1" ? 'selected="selected"' : ''?>>ชั้นปีที่ 1</option>
                        <option value="ชั้นปีที่ 2" <?=$advisor_class_year == "ชั้นปีที่ 2" ? 'selected="selected"' : ''?>>ชั้นปีที่ 2</option>
                        <option value="ชั้นปีที่ 3" <?=$advisor_class_year == "ชั้นปีที่ 3" ? 'selected="selected"' : ''?>>ชั้นปีที่ 3</option>
                        <option value="ชั้นปีที่ 4" <?=$advisor_class_year == "ชั้นปีที่ 4" ? 'selected="selected"' : ''?>>ชั้นปีที่ 4</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>

            <div class="form-group" id="dv_amount_person">
                <label for="lb_class_year" id="lb_amount_person" class="col-sm-4 control-label">จำนวนนักศึกษา/คน</label>

                <div class="col-sm-5 input-group">
                    <input type="text" class="form-control" id="amountPerson" name="amountPerson"
                           value="<? echo $advisor_amount_person ?>"
                           placeholder="จำนวนนักศึกษา">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
                </div>
            </div>

            <div class="form-group" id="dv_detail">
                <label for="lb_detail" id="lb_detail" class="col-sm-4 control-label">รายละเอียดการเข้าพบ</label>

                <div class="col-sm-5">
                    <textarea class="form-control" id="detail" name="detail"

                              placeholder="รายละเอียดการเข้าพบ"><? echo $advisor_detail ?></textarea>
                </div>
                <div class="col-sm-3">
                    <label style="font-size: large; color: red">*</label>
                </div>
            </div>

            <div class="form-group" id="dv_date">
                <label for="lb_date" id="lb_date" class="col-sm-4 control-label">วันที่เข้าพบ</label>

                <div class="col-sm-5">

                        <div id="dateTimePicker" class="input-append">
                            <div class="input-group col-xs-12 no-pad add-on">
                                <input type="text" class="form-control" id="date" name="date"
                                       value="<? echo $advisor_date ?>"
                                       data-format="dd-MM-yyyy"
                                       placeholder="วันที่เข้าพบ ตัวอย่าง 30-01-2014">

                                <div class="input-group-addon">
                                    <div class="glyphicon glyphicon-time"></div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-sm-3">
                    <label style="font-size: small; margin-top: 7px">( ถ้ามี )</label>
                </div>
            </div>

            <!--       end form advisor class      -->

            <div class="form-group">
                <label for="lbFile" id="lbFile" class="col-sm-4 control-label">เอกสารอ้างอิง</label>

                <div class="col-sm-5">
                    <div class="col-sm-10">
                        <input type="file" id="file" name="file"
                               value="<? echo $advisor_document ?>"
                               placeholder="เอกสารอ้างอิง">
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
                        <button type="reset" id="clear" class="btn btn-default btn-lg"

                                onclick="window.history.back();
                                    ">
                            ยกเลิก
                        </button>
                        <!--                                onclick="window.open('advisor_form.php?cancel=1&aid=--><?//=$advisor_id?><!--')-->
                    </div>
                </div>
            </div>


        </form>

    </div>

</div>

<script type="text/javascript">
    $(function () {
        var val = $('#sdd').val();

        var year = document.getElementById("year");
        var lb_file;

        switch (val) {

            case "0" :

                year.placeholder = "ปีการศึกษา ตัวอย่างเช่น 2556"
                document.getElementById("dv_name").style.display = "block";
                document.getElementById("dv_amount").style.display = "block";
                document.getElementById("dv_fullName").style.display = "block";
                document.getElementById("dv_year").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_class_year").style.display = "none";
                document.getElementById("dv_amount_person").style.display = "none";
                document.getElementById("dv_date").style.display = "none";
                document.getElementById("dv_location").style.display = "none";
                document.getElementById("dv_checked4").style.display = "none";
                document.getElementById("dv_checked5").style.display = "none";



                lb_file = "เอกสารอ้างอิง";

                break;

            case "1" :
                year.placeholder = "ภาคเรียน / ปีการศึกษา ตัวอย่างเช่น 1/2557";
                year.pattern="[1-2]{1}[/]{1}[0-9]{4}";
                document.getElementById("dv_name").style.display = "block";
                document.getElementById("dv_amount").style.display = "block";
                document.getElementById("dv_fullName").style.display = "block";
                document.getElementById("dv_year").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_class_year").style.display = "none";
                document.getElementById("dv_amount_person").style.display = "none";
                document.getElementById("dv_date").style.display = "none";
                document.getElementById("dv_location").style.display = "block";
                document.getElementById("dv_checked4").style.display = "block";
                document.getElementById("dv_checked5").style.display = "block";



                lb_file = "เอกสารอ้างอิง";

                break;
            case "2" :
                lb_file = "เอกสารรายชื่อนักศึกษาที่เข้าพบ";
                document.getElementById("dv_detail").style.display = "block";
                document.getElementById("dv_class_year").style.display = "block";
                document.getElementById("dv_amount_person").style.display = "block";
                document.getElementById("dv_date").style.display = "block";

                document.getElementById("dv_name").style.display = "none";
                document.getElementById("dv_amount").style.display = "none";
                document.getElementById("dv_fullName").style.display = "none";
                document.getElementById("dv_year").style.display = "none";
                document.getElementById("dv_location").style.display = "none";
                document.getElementById("dv_checked4").style.display = "none";
                document.getElementById("dv_checked5").style.display = "none";



                break;
        }
        document.getElementById("lbFile").innerHTML = lb_file;

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
            case "4" :
                document.getElementById('inlineCheckbox4').checked = true;
                calc(4);
                break;
            case "5" :
                document.getElementById('inlineCheckbox5').checked = true;
                calc(5);
                break;
        }
    })
</script>

<script type="text/javascript">

    function calc(isCheck){

        switch (isCheck){
            case 1 :
                if(document.getElementById('inlineCheckbox1').checked == true){
                    document.getElementById('inlineCheckbox2').checked = false;
                    document.getElementById('inlineCheckbox3').checked = false;
                    document.getElementById('inlineCheckbox4').checked = false;
                    document.getElementById('inlineCheckbox5').checked = false;

                    /// set data author 2

                    document.getElementById('gender2').value = "นาย";
                    document.getElementById('first_name2').value = "";
                    document.getElementById('last_name2').value = "";

                    /// set data author 3

                    document.getElementById('gender3').value = "นาย";
                    document.getElementById('first_name3').value = "";
                    document.getElementById('last_name3').value = "";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";


                    /// set amount author
                    document.getElementById('amount').value = "1";

                    document.getElementById('dv_fullName').style.display = "block";
                    document.getElementById('dv_author2').style.display = "none";
                    document.getElementById('dv_author3').style.display = "none";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }else{

                    /// set data author 1

                    document.getElementById('gender').value = "นาย";
                    document.getElementById('first_name').value = "";
                    document.getElementById('last_name').value = "";

                    /// set data author 2

                    document.getElementById('gender2').value = "นาย";
                    document.getElementById('first_name2').value = "";
                    document.getElementById('last_name2').value = "";

                    /// set data author 3

                    document.getElementById('gender3').value = "นาย";
                    document.getElementById('first_name3').value = "";
                    document.getElementById('last_name3').value = "";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";

                    document.getElementById('dv_fullName').style.display = "none";
                    document.getElementById('dv_author2').style.display = "none";
                    document.getElementById('dv_author2').style.display = "none";
                    document.getElementById('dv_author3').style.display = "none";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }

                break;

            case 2 :
                if(document.getElementById('inlineCheckbox2').checked == true){
                    document.getElementById('inlineCheckbox1').checked = false;
                    document.getElementById('inlineCheckbox3').checked = false;
                    document.getElementById('inlineCheckbox4').checked = false;
                    document.getElementById('inlineCheckbox5').checked = false;

                    /// set data author 3

                    document.getElementById('gender3').value = "นาย";
                    document.getElementById('first_name3').value = "";
                    document.getElementById('last_name3').value = "";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";


                    /// set amount author
                   document.getElementById('amount').value = "2";

                    document.getElementById('dv_fullName').style.display = "block";
                    document.getElementById('dv_author2').style.display = "block";
                    document.getElementById('dv_author3').style.display = "none";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }else{

                    /// set data author 1

                    document.getElementById('gender').value = "นาย";
                    document.getElementById('first_name').value = "";
                    document.getElementById('last_name').value = "";

                    /// set data author 2

                    document.getElementById('gender2').value = "นาย";
                    document.getElementById('first_name2').value = "";
                    document.getElementById('last_name2').value = "";

                    /// set data author 3

                    document.getElementById('gender3').value = "นาย";
                    document.getElementById('first_name3').value = "";
                    document.getElementById('last_name3').value = "";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";

                    document.getElementById('dv_fullName').style.display = "none";
                    document.getElementById('dv_author2').style.display = "none";
                    document.getElementById('dv_author3').style.display = "none";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }

                break;
            case 3 :
                if(document.getElementById('inlineCheckbox3').checked == true){
                    document.getElementById('inlineCheckbox1').checked = false;
                    document.getElementById('inlineCheckbox2').checked = false;
                    document.getElementById('inlineCheckbox4').checked = false;
                    document.getElementById('inlineCheckbox5').checked = false;

                    /// set amount author
                    document.getElementById('amount').value = "3";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";


                    document.getElementById('dv_fullName').style.display = "block";
                    document.getElementById('dv_author2').style.display = "block";
                    document.getElementById('dv_author3').style.display = "block";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }else{

                    /// set data author 1

                    document.getElementById('gender').value = "นาย";
                    document.getElementById('first_name').value = "";
                    document.getElementById('last_name').value = "";

                    /// set data author 2

                    document.getElementById('gender2').value = "นาย";
                    document.getElementById('first_name2').value = "";
                    document.getElementById('last_name2').value = "";

                    /// set data author 3

                    document.getElementById('gender3').value = "นาย";
                    document.getElementById('first_name3').value = "";
                    document.getElementById('last_name3').value = "";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";

                    document.getElementById('dv_fullName').style.display = "none";
                    document.getElementById('dv_author2').style.display = "none";
                    document.getElementById('dv_author3').style.display = "none";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }

                break;
            case 4 :
                if(document.getElementById('inlineCheckbox4').checked == true){
                    document.getElementById('inlineCheckbox1').checked = false;
                    document.getElementById('inlineCheckbox2').checked = false;
                    document.getElementById('inlineCheckbox3').checked = false;
                    document.getElementById('inlineCheckbox5').checked = false;

                    /// set amount author
                    document.getElementById('amount').value = "4";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";

                    document.getElementById('dv_fullName').style.display = "block";
                    document.getElementById('dv_author2').style.display = "block";
                    document.getElementById('dv_author3').style.display = "block";
                    document.getElementById('dv_author4').style.display = "block";
                    document.getElementById('dv_author5').style.display = "none";
                }else{


                    /// set data author 1

                    document.getElementById('gender').value = "นาย";
                    document.getElementById('first_name').value = "";
                    document.getElementById('last_name').value = "";

                    /// set data author 2

                    document.getElementById('gender2').value = "นาย";
                    document.getElementById('first_name2').value = "";
                    document.getElementById('last_name2').value = "";

                    /// set data author 3

                    document.getElementById('gender3').value = "นาย";
                    document.getElementById('first_name3').value = "";
                    document.getElementById('last_name3').value = "";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";

                    document.getElementById('dv_fullName').style.display = "none";
                    document.getElementById('dv_author2').style.display = "none";
                    document.getElementById('dv_author3').style.display = "none";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }

                break;
            case 5 :
                if(document.getElementById('inlineCheckbox5').checked == true){
                    document.getElementById('inlineCheckbox1').checked = false;
                    document.getElementById('inlineCheckbox2').checked = false;
                    document.getElementById('inlineCheckbox3').checked = false;
                    document.getElementById('inlineCheckbox4').checked = false;

                    /// set amount author
                    document.getElementById('amount').value = "5";


                    document.getElementById('dv_fullName').style.display = "block";
                    document.getElementById('dv_author2').style.display = "block";
                    document.getElementById('dv_author3').style.display = "block";
                    document.getElementById('dv_author4').style.display = "block";
                    document.getElementById('dv_author5').style.display = "block";
                }else{



                    /// set data author 1

                    document.getElementById('gender').value = "นาย";
                    document.getElementById('first_name').value = "";
                    document.getElementById('last_name').value = "";

                    /// set data author 2

                    document.getElementById('gender2').value = "นาย";
                    document.getElementById('first_name2').value = "";
                    document.getElementById('last_name2').value = "";

                    /// set data author 3

                    document.getElementById('gender3').value = "นาย";
                    document.getElementById('first_name3').value = "";
                    document.getElementById('last_name3').value = "";

                    /// set data author 4

                    document.getElementById('gender4').value = "นาย";
                    document.getElementById('first_name4').value = "";
                    document.getElementById('last_name4').value = "";

                    /// set data author 5

                    document.getElementById('gender5').value = "นาย";
                    document.getElementById('first_name5').value = "";
                    document.getElementById('last_name5').value = "";


                    document.getElementById('dv_fullName').style.display = "none";
                    document.getElementById('dv_author2').style.display = "none";
                    document.getElementById('dv_author3').style.display = "none";
                    document.getElementById('dv_author4').style.display = "none";
                    document.getElementById('dv_author5').style.display = "none";
                }

                break;


        }
    }
</script>

<script type="text/javascript">

    $('#sdd').change(function () {

        var val = $('#sdd').val();

        var year = document.getElementById("year");
        var lb_file;

        switch (val) {

            case "0" :

                year.placeholder = "ปีการศึกษา ตัวอย่างเช่น 2556";
                document.getElementById("dv_name").style.display = "block";
                document.getElementById("dv_amount").style.display = "block";
//                document.getElementById("dv_fullName").style.display = "block";
                document.getElementById("dv_year").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_class_year").style.display = "none";
                document.getElementById("dv_amount_person").style.display = "none";
                document.getElementById("dv_date").style.display = "none";
                document.getElementById("dv_location").style.display = "none";
                document.getElementById("dv_checked4").style.display = "none";
                document.getElementById("dv_checked5").style.display = "none";

                document.getElementById("dv_fullName").style.display = "none";
                document.getElementById("dv_author2").style.display = "none";
                document.getElementById("dv_author3").style.display = "none";
                document.getElementById("dv_author4").style.display = "none";
                document.getElementById("dv_author5").style.display = "none";

                document.getElementById('gender').value = "นาย";
                document.getElementById('first_name').value = "";
                document.getElementById('last_name').value = "";

                document.getElementById('gender2').value = "นาย";
                document.getElementById('first_name2').value = "";
                document.getElementById('last_name2').value = "";

                /// set data author 3

                document.getElementById('gender3').value = "นาย";
                document.getElementById('first_name3').value = "";
                document.getElementById('last_name3').value = "";

                /// set data author 4

                document.getElementById('gender4').value = "นาย";
                document.getElementById('first_name4').value = "";
                document.getElementById('last_name4').value = "";

                /// set data author 5

                document.getElementById('gender5').value = "นาย";
                document.getElementById('first_name5').value = "";
                document.getElementById('last_name5').value = "";

                document.getElementById('inlineCheckbox1').checked = false;
                document.getElementById('inlineCheckbox2').checked = false;
                document.getElementById('inlineCheckbox3').checked = false;
                document.getElementById('inlineCheckbox4').checked = false;
                document.getElementById('inlineCheckbox5').checked = false;

                lb_file = "เอกสารอ้างอิง";

                break;

            case "1" :
                year.placeholder = "ภาคเรียน / ปีการศึกษา ตัวอย่างเช่น 1/2557";
                year.pattern="[1-2]{1}[/]{1}[0-9]{4}";
                document.getElementById("dv_name").style.display = "block";
                document.getElementById("dv_amount").style.display = "block";
//                document.getElementById("dv_fullName").style.display = "block";
                document.getElementById("dv_year").style.display = "block";
                document.getElementById("dv_detail").style.display = "none";
                document.getElementById("dv_class_year").style.display = "none";
                document.getElementById("dv_amount_person").style.display = "none";
                document.getElementById("dv_date").style.display = "none";
                document.getElementById("dv_location").style.display = "block";
                document.getElementById("dv_checked4").style.display = "block";
                document.getElementById("dv_checked5").style.display = "block";

                document.getElementById("dv_fullName").style.display = "none";
                document.getElementById("dv_author2").style.display = "none";
                document.getElementById("dv_author3").style.display = "none";
                document.getElementById("dv_author4").style.display = "none";
                document.getElementById("dv_author5").style.display = "none";

                document.getElementById('gender').value = "นาย";
                document.getElementById('first_name').value = "";
                document.getElementById('last_name').value = "";

                document.getElementById('gender2').value = "นาย";
                document.getElementById('first_name2').value = "";
                document.getElementById('last_name2').value = "";

                /// set data author 3

                document.getElementById('gender3').value = "นาย";
                document.getElementById('first_name3').value = "";
                document.getElementById('last_name3').value = "";

                /// set data author 4

                document.getElementById('gender4').value = "นาย";
                document.getElementById('first_name4').value = "";
                document.getElementById('last_name4').value = "";

                /// set data author 5

                document.getElementById('gender5').value = "นาย";
                document.getElementById('first_name5').value = "";
                document.getElementById('last_name5').value = "";

                document.getElementById('inlineCheckbox1').checked = false;
                document.getElementById('inlineCheckbox2').checked = false;
                document.getElementById('inlineCheckbox3').checked = false;
                document.getElementById('inlineCheckbox4').checked = false;
                document.getElementById('inlineCheckbox5').checked = false;

                lb_file = "เอกสารอ้างอิง";

                break;
            case "2" :
                lb_file = "เอกสารรายชื่อนักศึกษาที่เข้าพบ";
                document.getElementById("dv_detail").style.display = "block";
                document.getElementById("dv_class_year").style.display = "block";
                document.getElementById("dv_amount_person").style.display = "block";
                document.getElementById("dv_date").style.display = "block";

                document.getElementById("dv_name").style.display = "none";
                document.getElementById("dv_amount").style.display = "none";
                document.getElementById("dv_fullName").style.display = "none";
                document.getElementById("dv_year").style.display = "none";
                document.getElementById("dv_location").style.display = "none";
                document.getElementById("dv_checked4").style.display = "none";
                document.getElementById("dv_checked5").style.display = "none";


                document.getElementById("dv_author2").style.display = "none";
                document.getElementById("dv_author3").style.display = "none";
                document.getElementById("dv_author4").style.display = "none";
                document.getElementById("dv_author5").style.display = "none";

                document.getElementById('gender').value = "นาย";
                document.getElementById('first_name').value = "";
                document.getElementById('last_name').value = "";

                document.getElementById('gender2').value = "นาย";
                document.getElementById('first_name2').value = "";
                document.getElementById('last_name2').value = "";

                /// set data author 3

                document.getElementById('gender3').value = "นาย";
                document.getElementById('first_name3').value = "";
                document.getElementById('last_name3').value = "";

                /// set data author 4

                document.getElementById('gender4').value = "นาย";
                document.getElementById('first_name4').value = "";
                document.getElementById('last_name4').value = "";

                /// set data author 5

                document.getElementById('gender5').value = "นาย";
                document.getElementById('first_name5').value = "";
                document.getElementById('last_name5').value = "";

                document.getElementById('inlineCheckbox1').checked = false;
                document.getElementById('inlineCheckbox2').checked = false;
                document.getElementById('inlineCheckbox3').checked = false;
                document.getElementById('inlineCheckbox4').checked = false;
                document.getElementById('inlineCheckbox5').checked = false;

                break;
        }
        document.getElementById("lbFile").innerHTML = lb_file;



    });
</script>


<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR'
    });
</script>


<script>
    $(function () {
        $('#myTab a:last').tab('show')
    })
</script>

<script type="text/javascript">
    $(function () {
        $('#dateTimePicker').datetimepicker({
            pickTime: false
        });
    });
</script>

<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
