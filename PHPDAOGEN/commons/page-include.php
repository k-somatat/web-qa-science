<?php
	require_once (ABSPATH . 'conf/url_config.conf');
	require_once (ABSPATH . 'conf/db_config.conf');
	require_once (ABSPATH . 'conf/server_config.conf');
	require_once (ABSPATH . 'conf/log_config.conf');
  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="<?=site_url; ?>dist/css/bootstrap.css" rel="stylesheet">
	<!-- Add custom CSS here -->
	<link href="<?=site_url; ?>dist/css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=site_url; ?>dist/css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=site_url; ?>dist/css/misc.css">
	<!-- Page Specific CSS -->
	<link rel="stylesheet" href="<?=site_url; ?>dist/css/morris-0.4.3.min.css">
	<link rel="stylesheet" type="text/css" media="screen"href="<?=site_url; ?>dist/css/bootstrap-datetimepicker.min.css">
	<!-- Javascript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?=$site_url; ?>dist/js/jquery-2.0.2.js"></script>    
    <script src="<?=$site_url; ?>dist/js/bootstrap.js"></script>
    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="<?=site_url; ?>dist/js/morris/chart-data-morris.js"></script>
    <script src="<?=site_url; ?>dist/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?=site_url; ?>dist/js/tablesorter/tables.js"></script>
	<script src="<?=site_url; ?>dist/js/bootstrap-datetimepicker.min.js"> </script>
	<script src="<?=site_url; ?>dist/js/bootstrap-datetimepicker.pt-BR.js"></script>