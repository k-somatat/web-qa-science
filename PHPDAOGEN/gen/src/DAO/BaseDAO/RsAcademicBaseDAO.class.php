<?php
require_once (ABSPATH . 'src/vo/RsAcademic.class.php');
class RsAcademicBaseDAO{

	public function __construct() {
		$vo = new RsAcademic();
	}

	function insert($rs_academic) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(academic_id,
					academic_name,
					academic_author,
					academic_institution,
					academic_location,
					academic_date,
					academic_budget,
					academic_document)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO rs_academic " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssds",
					$rs_academic->academic_id,
					$rs_academic->academic_name,
					$rs_academic->academic_author,
					$rs_academic->academic_institution,
					$rs_academic->academic_location,
					$rs_academic->academic_date,
					$rs_academic->academic_budget,
					$rs_academic->academic_document
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($rs_academic) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					academic_name  = ?,
					academic_author  = ?,
					academic_institution  = ?,
					academic_location  = ?,
					academic_date  = ?,
					academic_budget  = ?,
					academic_document = ?
					WHERE academic_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  rs_academic SET ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssds",
					$rs_academic->academic_name,
					$rs_academic->academic_author,
					$rs_academic->academic_institution,
					$rs_academic->academic_location,
					$rs_academic->academic_date,
					$rs_academic->academic_budget,
					$rs_academic->academic_document,
					$rs_academic->academic_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM rs_academic WHERE academic_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$rs_academic->academic_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($academic_id) {
		log_debug(get_class($this),"Input : [" . $academic_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$academic_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK rs_academic " . $rs_academic->academic_id. " Success.");
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
			$query = "SELECT * FROM  rs_academic";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All rs_academic Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicId($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicId rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicName($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicName rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicAuthor($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_author = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicAuthor rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicAuthor Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicInstitution($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_institution = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicInstitution rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicInstitution Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicLocation($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_location = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicLocation rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicLocation Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicDate($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_date = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicDate rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicDate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicBudget($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_budget = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("d",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicBudget rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicBudget Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyAcademicDocument($rs_academic) {
		log_debug(get_class($this),"Input : [" . $rs_academic . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM rs_academic WHERE academic_document = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$rs_academic
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($academic_id, $academic_name, $academic_author, $academic_institution, $academic_location, $academic_date, $academic_budget, $academic_document);
				while($stmt->fetch()){
					$vo['academic_id'][] = $academic_id;
					$vo['academic_name'][] = $academic_name;
					$vo['academic_author'][] = $academic_author;
					$vo['academic_institution'][] = $academic_institution;
					$vo['academic_location'][] = $academic_location;
					$vo['academic_date'][] = $academic_date;
					$vo['academic_budget'][] = $academic_budget;
					$vo['academic_document'][] = $academic_document;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $academic_id . "]\n"
											 . "[" . $academic_name . "]\n"
											 . "[" . $academic_author . "]\n"
											 . "[" . $academic_institution . "]\n"
											 . "[" . $academic_location . "]\n"
											 . "[" . $academic_date . "]\n"
											 . "[" . $academic_budget . "]\n"
											 . "[" . $academic_document . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find AcademicDocument rs_academic " . $rs_academic->academic_id. " Success.");
			}else{
				log_debug(get_class($this),"Find AcademicDocument Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}