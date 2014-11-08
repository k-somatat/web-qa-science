<?php
require_once (ABSPATH . 'src/vo/Faculty.class.php');
class FacultyBaseDAO{

	public function __construct() {
		$vo = new Faculty();
	}

	function insert($faculty) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(faculty_id,
					faculty_name)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO faculty " . $db_insert . " VALUES ( ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("is",
					$faculty->faculty_id,
					$faculty->faculty_name
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table faculty " . $faculty->faculty_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($faculty) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					faculty_name = ?
					WHERE faculty_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  faculty SET ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("is",
					$faculty->faculty_name,
					$faculty->faculty_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table faculty " . $faculty->faculty_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($faculty) {
		log_debug(get_class($this),"Input : [" . $faculty . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM faculty WHERE faculty_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$faculty->faculty_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table faculty " . $faculty->faculty_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($faculty_id) {
		log_debug(get_class($this),"Input : [" . $faculty_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM faculty WHERE faculty_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$faculty_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($faculty_id, $faculty_name);
				while($stmt->fetch()){
					$vo['faculty_id'][] = $faculty_id;
					$vo['faculty_name'][] = $faculty_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $faculty_id . "]\n"
											 . "[" . $faculty_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK faculty " . $faculty->faculty_id. " Success.");
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
			$query = "SELECT * FROM  faculty";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($faculty_id, $faculty_name);
				while($stmt->fetch()){
					$vo['faculty_id'][] = $faculty_id;
					$vo['faculty_name'][] = $faculty_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $faculty_id . "]\n"
											 . "[" . $faculty_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All faculty Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyFacultyId($faculty) {
		log_debug(get_class($this),"Input : [" . $faculty . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM faculty WHERE faculty_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$faculty
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($faculty_id, $faculty_name);
				while($stmt->fetch()){
					$vo['faculty_id'][] = $faculty_id;
					$vo['faculty_name'][] = $faculty_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $faculty_id . "]\n"
											 . "[" . $faculty_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find FacultyId faculty " . $faculty->faculty_id. " Success.");
			}else{
				log_debug(get_class($this),"Find FacultyId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyFacultyName($faculty) {
		log_debug(get_class($this),"Input : [" . $faculty . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM faculty WHERE faculty_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$faculty
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($faculty_id, $faculty_name);
				while($stmt->fetch()){
					$vo['faculty_id'][] = $faculty_id;
					$vo['faculty_name'][] = $faculty_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $faculty_id . "]\n"
											 . "[" . $faculty_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find FacultyName faculty " . $faculty->faculty_id. " Success.");
			}else{
				log_debug(get_class($this),"Find FacultyName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}