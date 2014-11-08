<?php 
	require_once (ABSPATH . 'commons/page-include.php');
	require_once (ABSPATH . 'src/function/checklogin.class.php');
	$checklogin = new CheckLoginAction();
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
          <a class="navbar-brand hidden-xs" href="index.php"><img src="<?= site_url ?>images/web_logo.png" class="logo-header" />ระบบสารสนเทศเพื่อการบริหาร คณะวิทยาศาสตร์</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="<?=$page_home_active; ?>"><a href="index.php"><i class="fa fa-home"></i> หน้าแรก</a></li>
            <li class="<?=$page_time_schedule_active?>"><a href="time_schedule.php"><i class="fa fa-table"></i> ตารางปฏิบัติงาน</a></li>
              <li class="dropdown <?=$page_dropdown_open; ?>" >
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> แฟ้มสะสมงาน <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li class="<?=$page_conference_active?>"><a href="conference.php">การอบรม/สัมมนา/ประชุมวิชาการ</a></li>
                      <li class="<?=$page_research_active?>"><a href="research_academic.php">งานวิจัย</a></li>
                     <!-- <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> ภาระงานหลัก <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                              <li><a href="#">อาจารย์ที่ปรึกษา</a></li>
                              <li><a href="#">งานวิจัย</a></li>
                              <li><a href="#">Last Item</a></li>
                          </ul>
                      </li> -->
                      <li class="<?=$page_advisor_active?>"><a href="advisor_class.php">ภาระงานอาจารย์ที่ปรึกษา</a></li>
                  </ul>
              </li>
              <li class="<?=$page_TQF_active; ?>"><a href="<?=site_url; ?>TQF.php"><i class="fa fa-list-alt"></i> มคอ. </a></li>
            <li class="<?=$page_project_active?>"><a href="project.php"><i class="fa fa-font"></i> โครงการ</a></li>

<!--            <li class="--><?//=$page_maintenance_active; ?><!--"><a href="--><?//=site_url; ?><!--manual.php"><i class="fa fa-list-alt"></i> นิยาม/คำศัพท์ที่ใช้ในระบบสารสนเทศ</a></li>-->

            <li class="<?=$page_project_report_active; ?>"><a href="<?=site_url; ?>project_report.php"><i class="fa fa-list-alt"></i> สรุปโครงการ</a></li>
              <li class="<?=$page_course_active; ?>"><a href="<?=site_url; ?>course.php"><i class="fa fa-list-alt"></i> แบบฟอร์มเอกสาร</a></li>
              <li class="<?=$page_list_name_active; ?>"><a href="<?=site_url; ?>list_name.php"><i class="fa fa-list-alt"></i> รายชื่อบุคลากรคณะวิทยาศาสตร์</a></li>
<!--            <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li>-->
<!--            <li><a href="bootstrap-grid.html"><i class="fa fa-wrench"></i> Bootstrap Grid</a></li>-->
<!--            <li><a href="blank-page.html"><i class="fa fa-file"></i> Blank Page</a></li>-->
<!--            <li class="dropdown">-->
<!--              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>-->
<!--              <ul class="dropdown-menu">-->
<!--                <li><a href="#">Dropdown Item</a></li>-->
<!--                <li><a href="#">Another Item</a></li>-->
<!--                <li><a href="#">Third Item</a></li>-->
<!--                <li><a href="#">Last Item</a></li>-->
<!--              </ul>-->
<!--            </li>-->
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user navbar-black">
<!--            <li class="dropdown messages-dropdown">-->
<!--              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>-->
<!--              <ul class="dropdown-menu">-->
<!--                <li class="dropdown-header">7 New Messages</li>-->
<!--                <li class="message-preview">-->
<!--                  <a href="#">-->
<!--                    <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
<!--                    <span class="name">--><?// echo $_SESSION['USER']['username'][0]?><!--</span>-->
<!--                    <span class="message">Hey there, I wanted to ask you something...</span>-->
<!--                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
<!--                  </a>-->
<!--                </li>-->
<!--                <li class="divider"></li>-->
<!--                <li class="message-preview">-->
<!--                  <a href="#">-->
<!--                    <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
<!--                    <span class="name">John Smith:</span>-->
<!--                    <span class="message">Hey there, I wanted to ask you something...</span>-->
<!--                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
<!--                  </a>-->
<!--                </li>-->
<!--                <li class="divider"></li>-->
<!--                <li class="message-preview">-->
<!--                  <a href="#">-->
<!--                    <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
<!--                    <span class="name">John Smith:</span>-->
<!--                    <span class="message">Hey there, I wanted to ask you something...</span>-->
<!--                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
<!--                  </a>-->
<!--                </li>-->
<!--                <li class="divider"></li>-->
<!--                <li><a href="#">View Inbox <span class="badge">7</span></a></li>-->
<!--              </ul>-->
<!--            </li>-->
<!--            <li class="dropdown alerts-dropdown">-->
<!--              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>-->
<!--              <ul class="dropdown-menu">-->
<!--                <li><a href="#">Default <span class="label label-default">Default</span></a></li>-->
<!--                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>-->
<!--                <li><a href="#">Success <span class="label label-success">Success</span></a></li>-->
<!--                <li><a href="#">Info <span class="label label-info">Info</span></a></li>-->
<!--                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>-->
<!--                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>-->
<!--                <li class="divider"></li>-->
<!--                <li><a href="#">View All</a></li>-->
<!--              </ul>-->
<!--            </li>-->
            <li class="dropdown user-dropdown">
                <?
                $split_name = explode(" ",$_SESSION['USER']['user_first_name'][0]);
                $firstName = $split_name[0].$split_name[1];
                ?>
              <a href="#" class="dropdown-toggle font-color-white" data-toggle="dropdown"><i class="fa fa-user"></i> ชื่อผู้ใช้งาน <?echo $firstName ? $firstName : $_SESSION['USER']['username'][0]?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php?method=onload"><i class="fa fa-user"></i> โปรไฟล์ <span class="badge">+</span></a></li>
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