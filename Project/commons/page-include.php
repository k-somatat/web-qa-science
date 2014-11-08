<?php
require_once(ABSPATH . 'conf/url_config.conf');
require_once(ABSPATH . 'conf/db_config.conf');
require_once(ABSPATH . 'conf/server_config.conf');
require_once(ABSPATH . 'conf/log_config.conf');
require_once(ABSPATH . "src/DAO/AdvisorDAO.class.php");
require_once(ABSPATH . "src/vo/Advisor.class.php");
require_once(ABSPATH . 'src/DAO/ConferenceDAO.class.php');
require_once(ABSPATH . 'src/vo/Conference.class.php');
require_once(ABSPATH . "src/DAO/CourseDAO.class.php");
require_once(ABSPATH . "src/vo/Course.class.php");
require_once(ABSPATH . "src/DAO/ProjectDAO.class.php");
require_once(ABSPATH . "src/vo/Project.class.php");
require_once(ABSPATH . 'src/DAO/UserDAO.class.php');
require_once(ABSPATH . 'src/DAO/TsTimeScheduleDAO.class.php');
require_once(ABSPATH . 'src/DAO/UserRoleDAO.class.php');
require_once(ABSPATH . 'src/vo/User.class.php');
require_once(ABSPATH . 'src/vo/UserRole.class.php');
require_once(ABSPATH . 'src/DAO/MajorDAO.class.php');
require_once(ABSPATH . 'src/vo/Major.class.php');
require_once(ABSPATH . 'src/DAO/RoleDAO.class.php');
require_once(ABSPATH . 'src/vo/Role.class.php');
require_once(ABSPATH . "src/DAO/ResearchDAO.class.php");
require_once(ABSPATH . "src/vo/Research.class.php");
require_once(ABSPATH . "src/DAO/TqfDAO.class.php");
require_once(ABSPATH . "src/vo/Tqf.class.php");
require_once(ABSPATH . 'src/DAO/FacultyDAO.class.php');
require_once(ABSPATH . 'src/vo/Faculty.class.php');
require_once(ABSPATH . 'src/DAO/NewsDAO.class.php');
require_once(ABSPATH . 'src/vo/News.class.php');
require_once(ABSPATH . 'src/DAO/CourseTypeDAO.class.php');
require_once(ABSPATH . 'src/vo/CourseType.class.php');
require_once(ABSPATH . 'src/DAO/PlanDAO.class.php');
require_once(ABSPATH . 'src/vo/Plan.class.php');

require_once(ABSPATH . "src/function/upload-file.class.php");
require_once(ABSPATH . "src/function/addComma.class.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= site_url; ?>dist/css/bootstrap.css" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="<?= site_url; ?>dist/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= site_url; ?>dist/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= site_url; ?>dist/css/misc.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="<?= site_url; ?>dist/css/morris-0.4.3.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?= site_url; ?>dist/css/bootstrap-datetimepicker.min.css">
    <!-- Javascript -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?= $site_url; ?>dist/js/jquery-2.0.2.js"></script>
    <script src="<?= $site_url; ?>dist/js/bootstrap.js"></script>
    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="<?= site_url; ?>dist/js/morris/chart-data-morris.js"></script>
    <script src="<?= site_url; ?>dist/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?= site_url; ?>dist/js/tablesorter/tables.js"></script>
    <script src="<?= site_url; ?>dist/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= site_url; ?>dist/js/bootstrap-datetimepicker.pt-BR.js"></script>
    <script src="<?= site_url; ?>dist/js/bootbox.min.js"></script>
    <script src="<?= site_url; ?>dist/js/highcharts.js"></script>
    <script src="<?= site_url; ?>dist/js/highcharts-3d.js"></script>
    <script src="<?= site_url; ?>dist/js/modules/exporting.js"></script>
    <script src="<?= site_url; ?>dist/js/jsapi.js"></script>