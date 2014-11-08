<?php
require_once (ABSPATH . 'commons/page-include.php');
require_once (ABSPATH . 'src/function/checkloginAdmin.class.php');
$checklogin = new CheckLoginAdmin();
?>
<title><?=$page_name; ?> | Science Management</title>
</head>

<body>
<div id="wrapper">

    <!-- Header -->
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" style="width:100%;">
                <img src="<?= site_url ?>images/web_logo.png" class="logo-header" />ระบบสารสนเทศเพื่อการบริหาร คณะวิทยาศาสตร์
            </button>
            <a class="navbar-brand hidden-xs" href="admin_index.php"><img src="<?= site_url ?>images/web_logo.png" class="logo-header" />ระบบสารสนเทศเพื่อการบริหาร คณะวิทยาศาสตร์</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="<?=$page_admin_home_active; ?>"><a href="admin_index.php"><i class="fa fa-home"></i> หน้าแรก</a></li>
                <li class="<?=$page_admin_user_active?>"><a href="admin_user.php"><i class="fa fa-user"></i> จัดการข้อมูลผู้ใช้งาน</a></li>
                <li class="<?=$page_admin_time_schedule_active?>"><a href="admin_time_schedule.php"><i class="fa fa-table"></i> ตารางปฏิบัติงาน</a></li>
                <li class="<?=$page_admin_conference_active?>"><a href="admin_conference.php"><i class="fa fa-table"></i> การอบรม/สัมมนา/ประชุมวิชาการ</a></li>
                <li class="<?=$page_admin_research_active?>"><a href="admin_research_academic.php"><i class="fa fa-table"></i> งานวิจัย</a></li>
                <li class="<?=$page_admin_advisor_active?>"><a href="admin_advisor_class.php"><i class="fa fa-table"></i> ภาระงานอาจารย์ที่ปรึกษา</a></li>
                <li class="<?=$page_admin_TQF_active; ?>"><a href="<?=site_url; ?>admin_TQF.php"><i class="fa fa-list-alt"></i> มคอ.</a></li>
                <li class="<?=$page_admin_project_active?>"><a href="admin_plan.php"><i class="fa fa-font"></i> โครงการ</a></li>
                <li class="<?=$page_admin_project_report_active; ?>"><a href="<?=site_url; ?>admin_project_report.php"><i class="fa fa-list-alt"></i> สรุปโครงการ</a></li>
                <li class="<?=$page_admin_course_active; ?>"><a href="<?=site_url; ?>admin_course_project.php"><i class="fa fa-list-alt"></i> แบบฟอร์มเอกสาร</a></li>
                <li class="<?=$page_admin_list_name_active; ?>"><a href="<?=site_url; ?>admin_list_name.php"><i class="fa fa-list-alt"></i> รายชื่อบุคลากรคณะวิทยาศาสตร์</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right navbar-user navbar-black">

                <li class="dropdown user-dropdown">
                    <?
                    $split_name = explode(" ",$_SESSION['USER']['user_first_name'][0]);
                    $firstName = $split_name[0].$split_name[1];
                    ?>
                    <a href="#" class="dropdown-toggle font-color-white" data-toggle="dropdown"><i class="fa fa-user"></i> ชื่อผู้ดูแลระบบ <?=$firstName ? $firstName : $_SESSION['USER']['username'][0]?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_profile.php?method=onload"><i class="fa fa-user"></i> โปรไฟล์ <span class="badge">+</span></a></li>
                        <!--                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>-->
                        <!--                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>-->
                        <li class="divider"></li>
                        <li><a href="<?=site_url; ?>callfunction.php?method=logout"><i class="fa fa-power-off"></i> ออกจากระบบ </a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <!-- Header END -->