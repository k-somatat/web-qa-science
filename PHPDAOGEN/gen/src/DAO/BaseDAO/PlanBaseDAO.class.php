<?php
require_once (ABSPATH . 'src/vo/Plan.class.php');
class PlanBaseDAO{

	public function __construct() {
		$vo = new Plan();
	}

	function insert($plan) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(plan_id,
					plan_name,
					plan_time_create,
					plan_time_update,
					plan_user_create,
					plan_user_update)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO plan " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssii",
					$plan->plan_id,
					$plan->plan_name,
					$plan->plan_time_create,
					$plan->plan_time_update,
					$plan->plan_user_create,
					$plan->plan_user_update
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($plan) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					plan_name  = ?,
					plan_time_create  = ?,
					plan_time_update  = ?,
					plan_user_create  = ?,
					plan_user_update = ?
					WHERE plan_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  plan SET ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssii",
					$plan->plan_name,
					$plan->plan_time_create,
					$plan->plan_time_update,
					$plan->plan_user_create,
					$plan->plan_user_update,
					$plan->plan_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($plan) {
		log_debug(get_class($this),"Input : [" . $plan . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM plan WHERE plan_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$plan->plan_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($plan_id) {
		log_debug(get_class($this),"Input : [" . $plan_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM plan WHERE plan_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$plan_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK plan " . $plan->plan_id. " Success.");
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
			$query = "SELECT * FROM  plan";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All plan Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPlanId($plan) {
		log_debug(get_class($this),"Input : [" . $plan . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM plan WHERE plan_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$plan
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find PlanId plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Find PlanId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPlanName($plan) {
		log_debug(get_class($this),"Input : [" . $plan . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM plan WHERE plan_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$plan
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find PlanName plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Find PlanName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPlanTimeCreate($plan) {
		log_debug(get_class($this),"Input : [" . $plan . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM plan WHERE plan_time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$plan
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find PlanTimeCreate plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Find PlanTimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPlanTimeUpdate($plan) {
		log_debug(get_class($this),"Input : [" . $plan . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM plan WHERE plan_time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$plan
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find PlanTimeUpdate plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Find PlanTimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPlanUserCreate($plan) {
		log_debug(get_class($this),"Input : [" . $plan . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM plan WHERE plan_user_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$plan
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find PlanUserCreate plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Find PlanUserCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPlanUserUpdate($plan) {
		log_debug(get_class($this),"Input : [" . $plan . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM plan WHERE plan_user_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$plan
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($plan_id, $plan_name, $plan_time_create, $plan_time_update, $plan_user_create, $plan_user_update);
				while($stmt->fetch()){
					$vo['plan_id'][] = $plan_id;
					$vo['plan_name'][] = $plan_name;
					$vo['plan_time_create'][] = $plan_time_create;
					$vo['plan_time_update'][] = $plan_time_update;
					$vo['plan_user_create'][] = $plan_user_create;
					$vo['plan_user_update'][] = $plan_user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $plan_name . "]\n"
											 . "[" . $plan_time_create . "]\n"
											 . "[" . $plan_time_update . "]\n"
											 . "[" . $plan_user_create . "]\n"
											 . "[" . $plan_user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find PlanUserUpdate plan " . $plan->plan_id. " Success.");
			}else{
				log_debug(get_class($this),"Find PlanUserUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}