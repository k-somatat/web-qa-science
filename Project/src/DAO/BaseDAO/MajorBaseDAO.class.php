<?php
require_once (ABSPATH . 'src/vo/Major.class.php');
class MajorBaseDAO{

	public function __construct() {
		$vo = new Major();
	}

	function insert($major) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(major_id,
					major_name,
					faculty_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO major " . $db_insert . " VALUES ( ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isi",
					$major->major_id,
					$major->major_name,
					$major->faculty_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table major " . $major->major_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($major) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					major_name  = ?,
					faculty_id = ?
					WHERE major_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  major ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("sii",
					$major->major_name,
					$major->faculty_id,
					$major->major_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table major " . $major->major_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($major) {
//		log_debug(get_class($this),"Input : [" . $major . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM major WHERE major_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$major->major_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table major " . $major->major_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($major_id) {
		log_debug(get_class($this),"Input : [" . $major_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM major WHERE major_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$major_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($major_id, $major_name, $faculty_id);
				while($stmt->fetch()){
					$vo['major_id'][] = $major_id;
					$vo['major_name'][] = $major_name;
					$vo['faculty_id'][] = $faculty_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $major_id . "]\n"
											 . "[" . $major_name . "]\n"
											 . "[" . $faculty_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK major " . $major->major_id. " Success.");
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
			$query = "SELECT * FROM  major";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($major_id, $major_name, $faculty_id);
				while($stmt->fetch()){
					$vo['major_id'][] = $major_id;
					$vo['major_name'][] = $major_name;
					$vo['faculty_id'][] = $faculty_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $major_id . "]\n"
											 . "[" . $major_name . "]\n"
											 . "[" . $faculty_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All major Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyMajorId($major) {
		log_debug(get_class($this),"Input : [" . $major . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM major WHERE major_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$major
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($major_id, $major_name, $faculty_id);
				while($stmt->fetch()){
					$vo['major_id'][] = $major_id;
					$vo['major_name'][] = $major_name;
					$vo['faculty_id'][] = $faculty_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $major_id . "]\n"
											 . "[" . $major_name . "]\n"
											 . "[" . $faculty_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find MajorId major " . $major->major_id. " Success.");
			}else{
				log_debug(get_class($this),"Find MajorId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyMajorName($major) {
		log_debug(get_class($this),"Input : [" . $major . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM major WHERE major_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$major
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($major_id, $major_name, $faculty_id);
				while($stmt->fetch()){
					$vo['major_id'][] = $major_id;
					$vo['major_name'][] = $major_name;
					$vo['faculty_id'][] = $faculty_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $major_id . "]\n"
											 . "[" . $major_name . "]\n"
											 . "[" . $faculty_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find MajorName major " . $major->major_id. " Success.");
			}else{
				log_debug(get_class($this),"Find MajorName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyFacultyId($major) {
		log_debug(get_class($this),"Input : [" . $major . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM major WHERE faculty_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$major
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($major_id, $major_name, $faculty_id);
				while($stmt->fetch()){
					$vo['major_id'][] = $major_id;
					$vo['major_name'][] = $major_name;
					$vo['faculty_id'][] = $faculty_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $major_id . "]\n"
											 . "[" . $major_name . "]\n"
											 . "[" . $faculty_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find FacultyId major " . $major->major_id. " Success.");
			}else{
				log_debug(get_class($this),"Find FacultyId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}