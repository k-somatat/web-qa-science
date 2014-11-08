<?php
require_once (ABSPATH . 'src/vo/News.class.php');
class NewsBaseDAO{

	public function __construct() {
		$vo = new News();
	}

	function insert($news) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(news_id,
					news_headline,
					news_detail,
					news_time_create,
					news_time_update,
					user_create,
					user_update,
					news_document,
					news_type_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO news " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("issssiisi",
					$news->news_id,
					$news->news_headline,
					$news->news_detail,
					$news->news_time_create,
					$news->news_time_update,
					$news->user_create,
					$news->user_update,
					$news->news_document,
					$news->news_type_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($news) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					news_headline  = ?,
					news_detail  = ?,
					news_time_create  = ?,
					news_time_update  = ?,
					user_create  = ?,
					user_update  = ?,
					news_document  = ?,
					news_type_id = ?
					WHERE news_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  news ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("ssssiisii",
					$news->news_headline,
					$news->news_detail,
					$news->news_time_create,
					$news->news_time_update,
					$news->user_create,
					$news->user_update,
					$news->news_document,
					$news->news_type_id,
					$news->news_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($news) {
//		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM news WHERE news_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news->news_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($news_id) {
		log_debug(get_class($this),"Input : [" . $news_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find By PK Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findAll() {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM  news";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All news Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsId($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsId news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsHeadline($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_headline = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsHeadline news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsHeadline Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsDetail($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_detail = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsDetail news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsDetail Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsTimeCreate($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsTimeCreate news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsTimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsTimeUpdate($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsTimeUpdate news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsTimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserCreate($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE user_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserCreate news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserUpdate($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE user_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserUpdate news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsDocument($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_document = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsDocument news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsDocument Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsTypeId($news) {
		log_debug(get_class($this),"Input : [" . $news . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news WHERE news_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_id, $news_headline, $news_detail, $news_time_create, $news_time_update, $user_create, $user_update, $news_document, $news_type_id);
				while($stmt->fetch()){
					$vo['news_id'][] = $news_id;
					$vo['news_headline'][] = $news_headline;
					$vo['news_detail'][] = $news_detail;
					$vo['news_time_create'][] = $news_time_create;
					$vo['news_time_update'][] = $news_time_update;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['news_document'][] = $news_document;
					$vo['news_type_id'][] = $news_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_id . "]\n"
											 . "[" . $news_headline . "]\n"
											 . "[" . $news_detail . "]\n"
											 . "[" . $news_time_create . "]\n"
											 . "[" . $news_time_update . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $news_document . "]\n"
											 . "[" . $news_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsTypeId news " . $news->news_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsTypeId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}