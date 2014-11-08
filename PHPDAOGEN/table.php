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
		<div class="login-form col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
			<div class="box-inner">
				<form class="form-horizontal" role="form" name="submit" method="post" action="genfile.php">
					<h1 class="font-times text-center">PHP DAO Generate</h1>
					<div class="form-group">
						<label for="inputUsername" class="col-xs-12 col-sm-12 col-md-3 col-lg-3 margin-top-10">
							Table Name
						</label>
						<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
							<input type="text" id="inputTable" name="inputTable" class="form-control" placeholder="Enter Table Name..."/>
						</div>
					</div>
					<div class="form-group">
						<div style="text-align: center;">
							<input type="submit" class="btn btn-primary btn-custom1 btn-lg"/>
						</div>
					</div>
				</form>
			</div>
			<div class="box-bottom">
				PHPDAOGEN BY BAKERYLAND.
			</div>
		</div>
</body>
  