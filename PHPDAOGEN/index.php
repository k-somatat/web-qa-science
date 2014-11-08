<?php
	// 	Page Setup
	define( 'ABSPATH', dirname(__FILE__) . '/' );
	$page_name="Login";
	// Page Setup END
	require_once (ABSPATH . 'commons/page-include.php');
  ?>
	<title>PHPDAOGEN</title>

</head>
<body id="login-page">
	<div class="">
		<div class="login-form col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
			<div class="box-inner">
				<form class="form-horizontal" role="form" name="submit" method="post" action="table.php">
					<h1 class="font-times text-center">PHP DAO Generate</h1>
					<div class="form-group text-center">
						<input type="submit" class="btn btn-primary btn-custom1 btn-lg" value="Create DAO and VO"/>
					</div>
				</form>
			</div>
			<div class="box-bottom">
				PHPDAOGEN BY BAKERYLAND.
			</div>
		</div>
	</div>
</body>
  