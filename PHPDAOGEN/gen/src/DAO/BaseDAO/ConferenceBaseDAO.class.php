<?php
require_once (ABSPATH . 'src/vo/Conference.class.php');
class ConferenceBaseDAO{

	public function __construct() {
		$vo = new Conference();
	}

	function insert($conference) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(conference_id,
					conference_name,
					conference_institution,
					conference_date,
					conference_date_end,
					conference_location,
					conference_budget,
					conference_tech_name,
					conference_document,
					user_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO conference " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssdssi",
					$conference->conference_id,
					$conference->conference_name,
					$conference->conference_institution,
					$conference->conference_date,
					$conference->conference_date_end,
					$conference->conference_location,
					$conference->conference_budget,
					$conference->conference_tech_name,
					$conference->conference_document,
					$conference->user_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($conference) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					conference_name  = ?,
					conference_institution  = ?,
					conference_date  = ?,
					conference_date_end  = ?,
					conference_location  = ?,
					conference_budget  = ?,
					conference_tech_name  = ?,
					conference_document  = ?,
					user_id = ?
					WHERE conference_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  conference ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("sssssdssii",
					$conference->conference_name,
					$conference->conference_institution,
					$conference->conference_date,
					$conference->conference_date_end,
					$conference->conference_location,
					$conference->conference_budget,
					$conference->conference_tech_name,
					$conference->conference_document,
					$conference->user_id,
					$conference->conference_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($conference) {
//		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM conference WHERE conference_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$conference->conference_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($conference_id) {
		log_debug(get_class($this),"Input : [" . $conference_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$conference_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK conference " . $conference->conference_id. " Success.");
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
			$query = "SELECT * FROM  conference";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All conference Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceId($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceId conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceName($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceName conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceInstitution($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_institution = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceInstitution conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceInstitution Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceDate($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_date = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceDate conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceDate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceDateEnd($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_date_end = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceDateEnd conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceDateEnd Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceLocation($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_location = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceLocation conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceLocation Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceBudget($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_budget = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("d",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceBudget conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceBudget Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceTechName($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_tech_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceTechName conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceTechName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyConferenceDocument($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE conference_document = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ConferenceDocument conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ConferenceDocument Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserId($conference) {
		log_debug(get_class($this),"Input : [" . $conference . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM conference WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$conference
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($conference_id, $conference_name, $conference_institution, $conference_date, $conference_date_end, $conference_location, $conference_budget, $conference_tech_name, $conference_document, $user_id);
				while($stmt->fetch()){
					$vo['conference_id'][] = $conference_id;
					$vo['conference_name'][] = $conference_name;
					$vo['conference_institution'][] = $conference_institution;
					$vo['conference_date'][] = $conference_date;
					$vo['conference_date_end'][] = $conference_date_end;
					$vo['conference_location'][] = $conference_location;
					$vo['conference_budget'][] = $conference_budget;
					$vo['conference_tech_name'][] = $conference_tech_name;
					$vo['conference_document'][] = $conference_document;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $conference_id . "]\n"
											 . "[" . $conference_name . "]\n"
											 . "[" . $conference_institution . "]\n"
											 . "[" . $conference_date . "]\n"
											 . "[" . $conference_date_end . "]\n"
											 . "[" . $conference_location . "]\n"
											 . "[" . $conference_budget . "]\n"
											 . "[" . $conference_tech_name . "]\n"
											 . "[" . $conference_document . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserId conference " . $conference->conference_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}