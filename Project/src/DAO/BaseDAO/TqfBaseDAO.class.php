<?php
require_once (ABSPATH . 'src/vo/Tqf.class.php');
class TqfBaseDAO{

	public function __construct() {
		$vo = new Tqf();
	}

	function insert($tqf) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(tqf_id,
					tqf_subject,
					tqf_semester,
					tqf_subject_update,
					tqf_time_create,
					tqf_time_update,
					tqf_document_tqf3,
					tqf_document_tqf5,
					user_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO tqf " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssssi",
					$tqf->tqf_id,
					$tqf->tqf_subject,
					$tqf->tqf_semester,
					$tqf->tqf_subject_update,
					$tqf->tqf_time_create,
					$tqf->tqf_time_update,
					$tqf->tqf_document_tqf3,
					$tqf->tqf_document_tqf5,
					$tqf->user_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($tqf) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					tqf_subject  = ?,
					tqf_semester  = ?,
					tqf_subject_update  = ?,
					tqf_time_create  = ?,
					tqf_time_update  = ?,
					tqf_document_tqf3  = ?,
					tqf_document_tqf5  = ?,
					user_id = ?
					WHERE tqf_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  tqf ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("sssssssii",
					$tqf->tqf_subject,
					$tqf->tqf_semester,
					$tqf->tqf_subject_update,
					$tqf->tqf_time_create,
					$tqf->tqf_time_update,
					$tqf->tqf_document_tqf3,
					$tqf->tqf_document_tqf5,
					$tqf->user_id,
					$tqf->tqf_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($tqf) {
//		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM tqf WHERE tqf_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$tqf->tqf_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($tqf_id) {
		log_debug(get_class($this),"Input : [" . $tqf_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$tqf_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK tqf " . $tqf->tqf_id. " Success.");
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
			$query = "SELECT * FROM  tqf";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All tqf Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfId($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfId tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfSubject($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_subject = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfSubject tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfSubject Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfSemester($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_semester = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfSemester tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfSemester Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfSubjectUpdate($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_subject_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfSubjectUpdate tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfSubjectUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfTimeCreate($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfTimeCreate tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfTimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfTimeUpdate($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfTimeUpdate tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfTimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfDocumentTqf3($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_document_tqf3 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfDocumentTqf3 tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfDocumentTqf3 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTqfDocumentTqf5($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE tqf_document_tqf5 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TqfDocumentTqf5 tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TqfDocumentTqf5 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserId($tqf) {
		log_debug(get_class($this),"Input : [" . $tqf . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM tqf WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$tqf
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($tqf_id, $tqf_subject, $tqf_semester, $tqf_subject_update, $tqf_time_create, $tqf_time_update, $tqf_document_tqf3, $tqf_document_tqf5, $user_id);
				while($stmt->fetch()){
					$vo['tqf_id'][] = $tqf_id;
					$vo['tqf_subject'][] = $tqf_subject;
					$vo['tqf_semester'][] = $tqf_semester;
					$vo['tqf_subject_update'][] = $tqf_subject_update;
					$vo['tqf_time_create'][] = $tqf_time_create;
					$vo['tqf_time_update'][] = $tqf_time_update;
					$vo['tqf_document_tqf3'][] = $tqf_document_tqf3;
					$vo['tqf_document_tqf5'][] = $tqf_document_tqf5;
					$vo['user_id'][] = $user_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $tqf_id . "]\n"
											 . "[" . $tqf_subject . "]\n"
											 . "[" . $tqf_semester . "]\n"
											 . "[" . $tqf_subject_update . "]\n"
											 . "[" . $tqf_time_create . "]\n"
											 . "[" . $tqf_time_update . "]\n"
											 . "[" . $tqf_document_tqf3 . "]\n"
											 . "[" . $tqf_document_tqf5 . "]\n"
											 . "[" . $user_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserId tqf " . $tqf->tqf_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}