<?php
require_once (ABSPATH . 'src/vo/User.class.php');
class UserBaseDAO{

	public function __construct() {
		$vo = new User();
	}

	function insert($user) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(user_id,
					username,
					password,
					user_first_name,
					user_last_name,
					user_image,
					user_tel,
					user_position,
					time_create,
					time_update,
					major_id)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO user " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssssssi",
					$user->user_id,
					$user->username,
					$user->password,
					$user->user_first_name,
					$user->user_last_name,
					$user->user_image,
					$user->user_tel,
					$user->user_position,
					$user->time_create,
					$user->time_update,
					$user->major_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($user) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					username  = ?,
					password  = ?,
					user_first_name  = ?,
					user_last_name  = ?,
					user_image  = ?,
					user_tel  = ?,
					user_position  = ?,
					time_create  = ?,
					time_update  = ?,
					major_id = ?
					WHERE user_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  user SET ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("isssssssssi",
					$user->username,
					$user->password,
					$user->user_first_name,
					$user->user_last_name,
					$user->user_image,
					$user->user_tel,
					$user->user_position,
					$user->time_create,
					$user->time_update,
					$user->major_id,
					$user->user_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM user WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$user->user_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($user_id) {
		log_debug(get_class($this),"Input : [" . $user_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$user_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK user " . $user->user_id. " Success.");
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
			$query = "SELECT * FROM  user";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All user Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserId($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE user_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserId user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUsername($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE username = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find Username user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find Username Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPassword($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE password = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find Password user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find Password Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserFirstName($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE user_first_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserFirstName user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserFirstName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserLastName($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE user_last_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserLastName user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserLastName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserImage($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE user_image = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserImage user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserImage Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserTel($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE user_tel = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserTel user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserTel Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserPosition($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE user_position = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserPosition user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserPosition Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeCreate($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeCreate user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTimeUpdate($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TimeUpdate user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyMajorId($user) {
		log_debug(get_class($this),"Input : [" . $user . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM user WHERE major_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$user
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($user_id, $username, $password, $user_first_name, $user_last_name, $user_image, $user_tel, $user_position, $time_create, $time_update, $major_id);
				while($stmt->fetch()){
					$vo['user_id'][] = $user_id;
					$vo['username'][] = $username;
					$vo['password'][] = $password;
					$vo['user_first_name'][] = $user_first_name;
					$vo['user_last_name'][] = $user_last_name;
					$vo['user_image'][] = $user_image;
					$vo['user_tel'][] = $user_tel;
					$vo['user_position'][] = $user_position;
					$vo['time_create'][] = $time_create;
					$vo['time_update'][] = $time_update;
					$vo['major_id'][] = $major_id;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $user_id . "]\n"
											 . "[" . $username . "]\n"
											 . "[" . $password . "]\n"
											 . "[" . $user_first_name . "]\n"
											 . "[" . $user_last_name . "]\n"
											 . "[" . $user_image . "]\n"
											 . "[" . $user_tel . "]\n"
											 . "[" . $user_position . "]\n"
											 . "[" . $time_create . "]\n"
											 . "[" . $time_update . "]\n"
											 . "[" . $major_id . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find MajorId user " . $user->user_id. " Success.");
			}else{
				log_debug(get_class($this),"Find MajorId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}