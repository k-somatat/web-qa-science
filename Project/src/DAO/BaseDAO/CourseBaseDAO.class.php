<?php
require_once (ABSPATH . 'src/vo/Course.class.php');
class CourseBaseDAO{

	public function __construct() {
		$vo = new Course();
	}

	function insert($course) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(course_id,
					course_field,
					course_year,
					course_url,
					user_create,
					user_update,
					time_create,
					time_update,
					course_type_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO course " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssiissi",
					$course->course_id,
					$course->course_field,
					$course->course_year,
					$course->course_url,
					$course->user_create,
					$course->user_update,
					$course->time_create,
					$course->time_update,
					$course->course_type_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($course) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					course_field  = ?,
					course_year  = ?,
					course_url  = ?,
					user_create  = ?,
					user_update  = ?,
					time_create  = ?,
					time_update  = ?,
					course_type_id = ?
					WHERE course_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  course ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("sssiissii",
					$course->course_field,
					$course->course_year,
					$course->course_url,
					$course->user_create,
					$course->user_update,
					$course->time_create,
					$course->time_update,
					$course->course_type_id,
					$course->course_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($course) {
//		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM course WHERE course_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course->course_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($course_id) {
		log_debug(get_class($this),"Input : [" . $course_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE course_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK course " . $course->course_id. " Success.");
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
			$query = "SELECT * FROM  course";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All course Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyCourseId($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE course_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find CourseId course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find CourseId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyCourseField($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE course_field = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find CourseField course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find CourseField Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyCourseYear($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE course_year = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find CourseYear course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find CourseYear Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyCourseUrl($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE course_url = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find CourseUrl course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find CourseUrl Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserCreate($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE user_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserCreate course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserUpdate($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE user_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserUpdate course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeCreate($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeCreate course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeUpdate($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeUpdate course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyCourseTypeId($course) {
		log_debug(get_class($this),"Input : [" . $course . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM course WHERE course_type_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$course
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($course_id, $course_field, $course_year, $course_url, $user_create, $user_update, $time_create, $time_update, $course_type_id);
				while($stmt->fetch()){
					$vo['course_id'][] = $course_id;
					$vo['course_field'][] = $course_field;
					$vo['course_year'][] = $course_year;
					$vo['course_url'][] = $course_url;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['course_type_id'][] = $course_type_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $course_id . "]\n"
											 . "[" . $course_field . "]\n"
											 . "[" . $course_year . "]\n"
											 . "[" . $course_url . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $course_type_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find CourseTypeId course " . $course->course_id. " Success.");
			}else{
				log_debug(get_class($this),"Find CourseTypeId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}