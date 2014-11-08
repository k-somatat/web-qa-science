<?php
require_once (ABSPATH . 'src/vo/Advisor.class.php');
class AdvisorBaseDAO{

	public function __construct() {
		$vo = new Advisor();
	}

	function insert($advisor) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(advisor_id,
					advisor_name,
					advisor_author,
					advisor_author2,
					advisor_author3,
					advisor_author4,
					advisor_author5,
					advisor_amount,
					advisor_date,
					advisor_year,
					advisor_location,
					advisor_document,
					advisor_time_create,
					advisor_time_update,
					advisor_type_id,
					user_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO advisor " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssssssssssii",
					$advisor->advisor_id,
					$advisor->advisor_name,
					$advisor->advisor_author,
					$advisor->advisor_author2,
					$advisor->advisor_author3,
					$advisor->advisor_author4,
					$advisor->advisor_author5,
					$advisor->advisor_amount,
					$advisor->advisor_date,
					$advisor->advisor_year,
					$advisor->advisor_location,
					$advisor->advisor_document,
					$advisor->advisor_time_create,
					$advisor->advisor_time_update,
					$advisor->advisor_type_id,
					$advisor->user_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($advisor) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					advisor_name  = ?,
					advisor_author  = ?,
					advisor_author2  = ?,
					advisor_author3  = ?,
					advisor_author4  = ?,
					advisor_author5  = ?,
					advisor_amount  = ?,
					advisor_date  = ?,
					advisor_year  = ?,
					advisor_location  = ?,
					advisor_document  = ?,
					advisor_time_create  = ?,
					advisor_time_update  = ?,
					advisor_type_id  = ?,
					user_id = ?
					WHERE advisor_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  advisor SET ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssssssssssii",
					$advisor->advisor_name,
					$advisor->advisor_author,
					$advisor->advisor_author2,
					$advisor->advisor_author3,
					$advisor->advisor_author4,
					$advisor->advisor_author5,
					$advisor->advisor_amount,
					$advisor->advisor_date,
					$advisor->advisor_year,
					$advisor->advisor_location,
					$advisor->advisor_document,
					$advisor->advisor_time_create,
					$advisor->advisor_time_update,
					$advisor->advisor_type_id,
					$advisor->user_id,
					$advisor->advisor_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM advisor WHERE advisor_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$advisor->advisor_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($advisor_id) {
		log_debug(get_class($this),"Input : [" . $advisor_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$advisor_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK advisor " . $advisor->advisor_id. " Success.");
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
			$query = "SELECT * FROM  advisor";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All advisor Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorId($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorId advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorName($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorName advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorAuthor($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_author = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorAuthor advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorAuthor Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorAuthor2($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_author2 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorAuthor2 advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorAuthor2 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorAuthor3($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_author3 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorAuthor3 advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorAuthor3 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorAuthor4($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_author4 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorAuthor4 advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorAuthor4 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorAuthor5($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_author5 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorAuthor5 advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorAuthor5 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorAmount($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_amount = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorAmount advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorAmount Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorDate($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_date = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorDate advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorDate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorYear($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_year = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorYear advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorYear Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorLocation($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_location = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorLocation advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorLocation Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorDocument($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_document = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorDocument advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorDocument Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorTimeCreate($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorTimeCreate advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorTimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorTimeUpdate($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorTimeUpdate advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorTimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAdvisorTypeId($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE advisor_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AdvisorTypeId advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AdvisorTypeId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserId($advisor) {
		log_debug(get_class($this),"Input : [" . $advisor . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM advisor WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$advisor
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($advisor_id, $advisor_name, $advisor_author, $advisor_author2, $advisor_author3, $advisor_author4, $advisor_author5, $advisor_amount, $advisor_date, $advisor_year, $advisor_location, $advisor_document, $advisor_time_create, $advisor_time_update, $advisor_type_id, $user_id);
				while($stmt->fetch()){
					$vo['advisor_id'][] = $advisor_id;
					$vo['advisor_name'][] = $advisor_name;
					$vo['advisor_author'][] = $advisor_author;
					$vo['advisor_author2'][] = $advisor_author2;
					$vo['advisor_author3'][] = $advisor_author3;
					$vo['advisor_author4'][] = $advisor_author4;
					$vo['advisor_author5'][] = $advisor_author5;
					$vo['advisor_amount'][] = $advisor_amount;
					$vo['advisor_date'][] = $advisor_date;
					$vo['advisor_year'][] = $advisor_year;
					$vo['advisor_location'][] = $advisor_location;
					$vo['advisor_document'][] = $advisor_document;
					$vo['advisor_time_create'][] = $advisor_time_create;
					$vo['advisor_time_update'][] = $advisor_time_update;
					$vo['advisor_type_id'][] = $advisor_type_id;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $advisor_id . "]\n"
											 . "[" . $advisor_name . "]\n"
											 . "[" . $advisor_author . "]\n"
											 . "[" . $advisor_author2 . "]\n"
											 . "[" . $advisor_author3 . "]\n"
											 . "[" . $advisor_author4 . "]\n"
											 . "[" . $advisor_author5 . "]\n"
											 . "[" . $advisor_amount . "]\n"
											 . "[" . $advisor_date . "]\n"
											 . "[" . $advisor_year . "]\n"
											 . "[" . $advisor_location . "]\n"
											 . "[" . $advisor_document . "]\n"
											 . "[" . $advisor_time_create . "]\n"
											 . "[" . $advisor_time_update . "]\n"
											 . "[" . $advisor_type_id . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserId advisor " . $advisor->advisor_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}