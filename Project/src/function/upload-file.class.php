<?php
require_once (ABSPATH . 'src/function/randompassword.class.php');
require_once (ABSPATH . './commons/page-include.php');

	class UploadAction{
		public function __construct(){
			
		}
		public function UploadSingleFile($inputname,$folder){
			if($folder != ''){
				$folder .= "/";
			}
			$allowedExts = array("gif", "jpeg", "jpg", "png", "exe" , "doc", "docx", "pdf", "xls", "xlsx", "ppt", "pptx");
			$temp = explode(".", $_FILES[$inputname]["name"]);
			$extension = end($temp);
			
			if ($_FILES[$inputname]["error"] > 0){
				log_upload(get_class($this),"Return Code: " . $_FILES[$inputname]["error"]);
			}else{
				$randomcode = new randomPassword();
				$name = pathinfo($_FILES[$inputname]["name"]);

				$filename = $name['filename'] . $randomcode->rand(8) . "." . $name['extension'];
				$uploadpath = ABSPATH . "uploads/" . $folder . $filename;
				if (!file_exists(ABSPATH . "uploads/" . $folder)) {
					mkdir(ABSPATH . "uploads/" . $folder, 777, true);
				}
				if(move_uploaded_file($_FILES[$inputname]["tmp_name"], $uploadpath)){
					$file["name"] = $_FILES[$inputname]["name"];
					$file["type"] = $_FILES[$inputname]["type"];
					$file["size"] = $_FILES[$inputname]["size"];
					$file["tmp_name"] = $_FILES[$inputname]["tmp_name"];
					$file["path"] = $uploadpath;
					chmod($file["path"],777);
					log_upload(get_class($this),"File name : " . $file["name"]);
					log_upload(get_class($this),"File type : " . $file["type"]);
					log_upload(get_class($this),"File size : " . $file["size"]);
					log_upload(get_class($this),"Temp file name : " . $file["tmp_name"]);
					log_upload(get_class($this),"File Path " . $file["path"]);
					log_upload(get_class($this),"Upload Success");
					return $file;
				}else{
					log_upload(get_class($this),"Error to Upload File.");
				}
			}
		}
	}
 
?>