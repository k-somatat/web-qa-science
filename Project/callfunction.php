<?php 
	session_start();
	define( 'ABSPATH', dirname(__FILE__) . '/' );
	require_once (ABSPATH . 'commons/page-include.php');

	if($_GET['method'] == 'login'){
		require_once(ABSPATH . 'src/function/login.class.php');
		$login = new LoginAction();
	}else if($_GET['method'] == 'register'){
        require_once(ABSPATH . 'src/function/register.class.php');
        $register = new RegisterAction();
    }
	else if($_GET['method'] == 'logout'){
		require_once(ABSPATH . 'src/function/logout.class.php');
		$logout = new LogoutAction();
	}
	else if($_GET['method'] == 'upload'){
		require_once(ABSPATH . 'src/function/upload-file.class.php');
		$upload = new UploadAction();
		$path = $upload->UploadSingleFile("file","test");
	}
    else if($_GET['method'] == 'upload2'){

        echo $_FILES['file2'];
        require_once(ABSPATH . 'src/function/upload-file.class.php');
        $upload2 = new UploadAction();
        $path2 = $upload2->UploadSingleFile("file2","Anni");
    }

?>