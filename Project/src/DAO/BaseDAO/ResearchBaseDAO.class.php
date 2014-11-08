<?php
require_once (ABSPATH . 'src/vo/Research.class.php');
class ResearchBaseDAO{

	public function __construct() {
		$vo = new Research();
	}

	function insert($research) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(research_id,
					research_name,
					research_author,
					research_institution,
					research_location,
					research_detail,
					research_date,
					research_date_end,
					research_budget,
					research_document,
					research_time_create,
					research_time_update,
					user_id,
					research_type_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO research " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssssdsssii",
					$research->research_id,
					$research->research_name,
					$research->research_author,
					$research->research_institution,
					$research->research_location,
					$research->research_detail,
					$research->research_date,
					$research->research_date_end,
					$research->research_budget,
					$research->research_document,
					$research->research_time_create,
					$research->research_time_update,
					$research->user_id,
					$research->research_type_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($research) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					research_name  = ?,
					research_author  = ?,
					research_institution  = ?,
					research_location  = ?,
					research_detail  = ?,
					research_date  = ?,
					research_date_end  = ?,
					research_budget  = ?,
					research_document  = ?,
					research_time_create  = ?,
					research_time_update  = ?,
					user_id  = ?,
					research_type_id = ?
					WHERE research_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  research ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("sssssssdsssiii",
					$research->research_name,
					$research->research_author,
					$research->research_institution,
					$research->research_location,
					$research->research_detail,
					$research->research_date,
					$research->research_date_end,
					$research->research_budget,
					$research->research_document,
					$research->research_time_create,
					$research->research_time_update,
					$research->user_id,
					$research->research_type_id,
					$research->research_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($research) {
//		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM research WHERE research_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$research->research_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($research_id) {
		log_debug(get_class($this),"Input : [" . $research_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$research_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK research " . $research->research_id. " Success.");
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
			$query = "SELECT * FROM  research";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All research Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchId($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchId research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchName($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchName research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchAuthor($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_author = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchAuthor research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchAuthor Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchInstitution($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_institution = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchInstitution research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchInstitution Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchLocation($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_location = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchLocation research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchLocation Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchDetail($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_detail = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchDetail research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchDetail Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchDate($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_date = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchDate research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchDate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchDateEnd($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_date_end = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchDateEnd research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchDateEnd Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchBudget($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_budget = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("d",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchBudget research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchBudget Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchDocument($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_document = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchDocument research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchDocument Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchTimeCreate($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchTimeCreate research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchTimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchTimeUpdate($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchTimeUpdate research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchTimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserId($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserId research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyResearchTypeId($research) {
		log_debug(get_class($this),"Input : [" . $research . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM research WHERE research_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$research
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($research_id, $research_name, $research_author, $research_institution, $research_location, $research_detail, $research_date, $research_date_end, $research_budget, $research_document, $research_time_create, $research_time_update, $user_id, $research_type_id);
				while($stmt->fetch()){
					$vo['research_id'][] = $research_id;
					$vo['research_name'][] = $research_name;
					$vo['research_author'][] = $research_author;
					$vo['research_institution'][] = $research_institution;
					$vo['research_location'][] = $research_location;
					$vo['research_detail'][] = $research_detail;
					$vo['research_date'][] = $research_date;
					$vo['research_date_end'][] = $research_date_end;
					$vo['research_budget'][] = $research_budget;
					$vo['research_document'][] = $research_document;
					$vo['research_time_create'][] = $research_time_create;
					$vo['research_time_update'][] = $research_time_update;
					$vo['user_id'][] = $user_id;
					$vo['research_type_id'][] = $research_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $research_id . "]\n"
											 . "[" . $research_name . "]\n"
											 . "[" . $research_author . "]\n"
											 . "[" . $research_institution . "]\n"
											 . "[" . $research_location . "]\n"
											 . "[" . $research_detail . "]\n"
											 . "[" . $research_date . "]\n"
											 . "[" . $research_date_end . "]\n"
											 . "[" . $research_budget . "]\n"
											 . "[" . $research_document . "]\n"
											 . "[" . $research_time_create . "]\n"
											 . "[" . $research_time_update . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $research_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ResearchTypeId research " . $research->research_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ResearchTypeId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}