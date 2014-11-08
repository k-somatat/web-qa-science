<?php
require_once (ABSPATH . 'src/vo/NewsType.class.php');
class NewsTypeBaseDAO{

	public function __construct() {
		$vo = new NewsType();
	}

	function insert($news_type) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(news_type_id,
					news_type_name)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO news_type " . $db_insert . " VALUES ( ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("is",
					$news_type->news_type_id,
					$news_type->news_type_name
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table news_type " . $news_type->news_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($news_type) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					news_type_name = ?
					WHERE news_type_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  news_type SET ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("is",
					$news_type->news_type_name,
					$news_type->news_type_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table news_type " . $news_type->news_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($news_type) {
		log_debug(get_class($this),"Input : [" . $news_type . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM news_type WHERE news_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news_type->news_type_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table news_type " . $news_type->news_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($news_type_id) {
		log_debug(get_class($this),"Input : [" . $news_type_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news_type WHERE news_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news_type_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_type_id, $news_type_name);
				while($stmt->fetch()){
					$vo['news_type_id'][] = $news_type_id;
					$vo['news_type_name'][] = $news_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_type_id . "]\n"
											 . "[" . $news_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK news_type " . $news_type->news_type_id. " Success.");
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
			$query = "SELECT * FROM  news_type";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($news_type_id, $news_type_name);
				while($stmt->fetch()){
					$vo['news_type_id'][] = $news_type_id;
					$vo['news_type_name'][] = $news_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_type_id . "]\n"
											 . "[" . $news_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All news_type Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsTypeId($news_type) {
		log_debug(get_class($this),"Input : [" . $news_type . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news_type WHERE news_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$news_type
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_type_id, $news_type_name);
				while($stmt->fetch()){
					$vo['news_type_id'][] = $news_type_id;
					$vo['news_type_name'][] = $news_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_type_id . "]\n"
											 . "[" . $news_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsTypeId news_type " . $news_type->news_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsTypeId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyNewsTypeName($news_type) {
		log_debug(get_class($this),"Input : [" . $news_type . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM news_type WHERE news_type_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$news_type
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($news_type_id, $news_type_name);
				while($stmt->fetch()){
					$vo['news_type_id'][] = $news_type_id;
					$vo['news_type_name'][] = $news_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $news_type_id . "]\n"
											 . "[" . $news_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find NewsTypeName news_type " . $news_type->news_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Find NewsTypeName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}