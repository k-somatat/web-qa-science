<?php
require_once (ABSPATH . 'src/vo/CourseType.class.php');
class CourseTypeBaseDAO{

	public function __construct() {
		$vo = new CourseType();
	}

	function insert($course_type) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(course_type_id,
					course_type_name)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO course_type " . $db_insert . " VALUES ( ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("is",
					$course_type->course_type_id,
					$course_type->course_type_name
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table course_type " . $course_type->course_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($course_type) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					course_type_name = ?
					WHERE course_type_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  course_type ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("si",
					$course_type->course_type_name,
					$course_type->course_type_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table course_type " . $course_type->course_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($course_type) {
//		log_debug(get_class($this),"Input : [" . $course_type . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM course_type WHERE course_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course_type->course_type_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table course_type " . $course_type->course_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($course_type_id) {
		log_debug(get_class($this),"Input : [" . $course_type_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course_type WHERE course_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course_type_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_type_id, $course_type_name);
				while($stmt->fetch()){
					$vo['course_type_id'][] = $course_type_id;
					$vo['course_type_name'][] = $course_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_type_id . "]\n"
											 . "[" . $course_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK course_type " . $course_type->course_type_id. " Success.");
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
			$query = "SELECT * FROM  course_type";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($course_type_id, $course_type_name);
				while($stmt->fetch()){
					$vo['course_type_id'][] = $course_type_id;
					$vo['course_type_name'][] = $course_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_type_id . "]\n"
											 . "[" . $course_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All course_type Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyCourseTypeId($course_type) {
		log_debug(get_class($this),"Input : [" . $course_type . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course_type WHERE course_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course_type
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_type_id, $course_type_name);
				while($stmt->fetch()){
					$vo['course_type_id'][] = $course_type_id;
					$vo['course_type_name'][] = $course_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_type_id . "]\n"
											 . "[" . $course_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find CourseTypeId course_type " . $course_type->course_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Find CourseTypeId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyCourseTypeName($course_type) {
		log_debug(get_class($this),"Input : [" . $course_type . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course_type WHERE course_type_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$course_type
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_type_id, $course_type_name);
				while($stmt->fetch()){
					$vo['course_type_id'][] = $course_type_id;
					$vo['course_type_name'][] = $course_type_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_type_id . "]\n"
											 . "[" . $course_type_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find CourseTypeName course_type " . $course_type->course_type_id. " Success.");
			}else{
				log_debug(get_class($this),"Find CourseTypeName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}