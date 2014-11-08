<?php
require_once (ABSPATH . 'src/vo/UserRole.class.php');
class UserRoleBaseDAO{

	public function __construct() {
		$vo = new UserRole();
	}

	function insert($user_role) {
		log_debug(get_class($this),"Input : [" . $user_role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$db_insert = "(username,
					role_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO user_role " . $db_insert . " VALUES ( ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("ss",
					$user_role->username,
					$user_role->role_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table user_role " . $user_role->username. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($user_role) {
		log_debug(get_class($this),"Input : [" . $user_role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$db_update = "username = ?,
					role_id = ?
					WHERE username = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  user_role ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("ss",
					$user_role->username,
					$user_role->role_id,
					$user_role->username
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table user_role " . $user_role->username. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($user_role) {
		log_debug(get_class($this),"Input : [" . $user_role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM user_role WHERE username = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user_role->username
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table user_role " . $user_role->username. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($user_role) {
		log_debug(get_class($this),"Input : [" . $user_role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user_role WHERE username = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user_role
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($username, $role_id);
				while($stmt->fetch()){
					$vo['username'][] = $username;
					$vo['role_id'][] = $role_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $username . "]\n"
											 . "[" . $role_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK user_role " . $user_role->username. " Success.");
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
			$query = "SELECT * FROM  user_role";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($username, $role_id);
				while($stmt->fetch()){
					$vo['username'][] = $username;
					$vo['role_id'][] = $role_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $username . "]\n"
											 . "[" . $role_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All user_role Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUsername($user_role) {
		log_debug(get_class($this),"Input : [" . $user_role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user_role WHERE username = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user_role
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($username, $role_id);
				while($stmt->fetch()){
					$vo['username'][] = $username;
					$vo['role_id'][] = $role_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $username . "]\n"
											 . "[" . $role_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find Username user_role " . $user_role->username. " Success.");
			}else{
				log_debug(get_class($this),"Find Username Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyRoleId($user_role) {
		log_debug(get_class($this),"Input : [" . $user_role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user_role WHERE role_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user_role
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($username, $role_id);
				while($stmt->fetch()){
					$vo['username'][] = $username;
					$vo['role_id'][] = $role_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $username . "]\n"
											 . "[" . $role_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find RoleId user_role " . $user_role->username. " Success.");
			}else{
				log_debug(get_class($this),"Find RoleId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}