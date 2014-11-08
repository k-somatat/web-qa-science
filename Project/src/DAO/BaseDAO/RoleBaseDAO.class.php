<?php
require_once (ABSPATH . 'src/vo/Role.class.php');
define('table_name', 'role');

class RoleBaseDAO{

	public function __construct() {
		$vo = new Role();
	}

	function insert($role) {
		log_debug(get_class($this),"Input : [" . $role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$db_insert = "(role_id,
					role_name)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO " . table_name . $db_insert . " VALUES ( ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("ss",
					$role->role_id,
					$role->role_name
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table " . table_name . " " . $role->role_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($role) {
		log_debug(get_class($this),"Input : [" . $role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$db_update = "role_id = ?,
					role_name = ?
					WHERE role_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE " . table_name . $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("ss",
					$role->role_id,
					$role->role_name,
					$role->role_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table  " . table_name . " " . $role->role_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($role) {
		log_debug(get_class($this),"Input : [" . $role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM " . table_name . " WHERE role_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$role->role_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table  " . table_name . " " . $role->role_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($role) {
		log_debug(get_class($this),"Input : [" . $role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM " . table_name . " WHERE role_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$role
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($role_id, $role_name);
				while($stmt->fetch()){
					$vo['role_id'][] = $role_id;
					$vo['role_name'][] = $role_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $role_id . "]\n"
											 . "[" . $role_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK  " . table_name . " " . $role->role_id. " Success.");
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
			$query = "SELECT * FROM " . table_name;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($role_id, $role_name);
				while($stmt->fetch()){
					$vo['role_id'][] = $role_id;
					$vo['role_name'][] = $role_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $role_id . "]\n"
											 . "[" . $role_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All  " . table_name . " Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyRoleId($role) {
		log_debug(get_class($this),"Input : [" . $role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM " . table_name . " WHERE role_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$role
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($role_id, $role_name);
				while($stmt->fetch()){
					$vo['role_id'][] = $role_id;
					$vo['role_name'][] = $role_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $role_id . "]\n"
											 . "[" . $role_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find RoleId  " . table_name . " " . $role->role_id. " Success.");
			}else{
				log_debug(get_class($this),"Find RoleId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyRoleName($role) {
		log_debug(get_class($this),"Input : [" . $role . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM " . table_name . " WHERE role_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$role
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($role_id, $role_name);
				while($stmt->fetch()){
					$vo['role_id'][] = $role_id;
					$vo['role_name'][] = $role_name;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $role_id . "]\n"
											 . "[" . $role_name . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find RoleName  " . table_name . " " . $role->role_id. " Success.");
			}else{
				log_debug(get_class($this),"Find RoleName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}