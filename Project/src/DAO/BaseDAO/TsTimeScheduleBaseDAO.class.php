<?php
require_once (ABSPATH . 'src/vo/TsTimeSchedule.class.php');
class TsTimeScheduleBaseDAO{

	public function __construct() {
		$vo = new TsTimeSchedule();
	}

	function insert($ts_time_schedule) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(ts_id,
					user_id,
					ts_name,
					ts_description,
					ts_type,
					time_start,
					time_end,
					date,
					time_create,
					time_update)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO ts_time_schedule " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("iissssssss",
					$ts_time_schedule->ts_id,
					$ts_time_schedule->user_id,
					$ts_time_schedule->ts_name,
					$ts_time_schedule->ts_description,
					$ts_time_schedule->ts_type,
					$ts_time_schedule->time_start,
					$ts_time_schedule->time_end,
					$ts_time_schedule->date,
					$ts_time_schedule->time_create,
					$ts_time_schedule->time_update
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($ts_time_schedule) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$db_update = "ts_id = ?,
					user_id  = ?,
					ts_name  = ?,
					ts_description  = ?,
					ts_type  = ?,
					time_start  = ?,
					time_end  = ?,
					date  = ?,
					time_create  = ?,
					time_update = ?
					WHERE ts_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  ts_time_schedule SET ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("iissssssssi",
					$ts_time_schedule->ts_id,
					$ts_time_schedule->user_id,
					$ts_time_schedule->ts_name,
					$ts_time_schedule->ts_description,
					$ts_time_schedule->ts_type,
					$ts_time_schedule->time_start,
					$ts_time_schedule->time_end,
					$ts_time_schedule->date,
					$ts_time_schedule->time_create,
					$ts_time_schedule->time_update,
					$ts_time_schedule->ts_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM ts_time_schedule WHERE ts_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$ts_time_schedule->ts_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($ts_id) {
		log_debug(get_class($this),"Input : [" . $ts_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE ts_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$ts_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
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
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM  ts_time_schedule";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All ts_time_schedule Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTsId($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE ts_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TsId ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TsId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserId($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserId ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTsName($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE ts_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TsName ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TsName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTsDescription($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE ts_description = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TsDescription ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TsDescription Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTsType($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE ts_type = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TsType ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TsType Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeStart($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE time_start = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeStart ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeStart Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeEnd($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE time_end = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeEnd ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeEnd Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyDate($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE date = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find Date ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find Date Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeCreate($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeCreate ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeUpdate($ts_time_schedule) {
		log_debug(get_class($this),"Input : [" . $ts_time_schedule . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM ts_time_schedule WHERE time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$ts_time_schedule
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($ts_id, $user_id, $ts_name, $ts_description, $ts_type, $time_start, $time_end, $date, $time_create, $time_update);
				while($stmt->fetch()){
					$vo['ts_id'][] = $ts_id;
					$vo['user_id'][] = $user_id;
					$vo['ts_name'][] = $ts_name;
					$vo['ts_description'][] = $ts_description;
					$vo['ts_type'][] = $ts_type;
					$vo['time_start'][] = $time_start;
					$vo['time_end'][] = $time_end;
					$vo['date'][] = $date;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $ts_id . "]\n"
											 . "[" . $user_id . "]\n"
											 . "[" . $ts_name . "]\n"
											 . "[" . $ts_description . "]\n"
											 . "[" . $ts_type . "]\n"
											 . "[" . $time_start . "]\n"
											 . "[" . $time_end . "]\n"
											 . "[" . $date . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeUpdate ts_time_schedule " . $ts_time_schedule->ts_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}