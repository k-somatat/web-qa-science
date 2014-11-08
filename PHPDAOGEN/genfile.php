<?php
	// 	Page Setup
	define( 'ABSPATH', dirname(__FILE__) . '/' );
	$page_name="Login";
	// Page Setup END
	require_once (ABSPATH . 'commons/page-include.php');
	require_once('src/action/TableAction.class.php');
  ?>
	<title>PHPDAOGEN</title>

</head>
<body id="login-page">
	<?php 
		$tablelist = new TableAction($_POST['inputTable']);
	?>
	<div class="login-form col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
		<div class="box-inner">
			<form class="form-horizontal" role="form">
				<h1 class="font-times text-center">PHP DAO Generate</h1>
				<div class="form-group text-center">
					Generate File Successful <a href="<?=log_db?>" target="_blank">View log file</a>
				</div>
				<div class="form-group text-center">
					<a href="<?=site_url . "table.php"; ?>" class="btn btn-primary btn-custom1 btn-lg">Back</a>
				</div>
			</form>
		</div>
		<div class="box-bottom">
			PHPDAOGEN BY BAKERYLAND.
		</div>
	</div>
</body>