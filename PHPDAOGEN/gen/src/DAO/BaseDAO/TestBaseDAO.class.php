<?php
require_once (ABSPATH . 'src/vo/Test.class.php');
class TestBaseDAO{

	public function __construct() {
		$vo = new Test();
	}

	function insert($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$db_insert = "(test_id,
					test_name_TH,
					test_name_En,
					test_asd,
					test_fgh)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO test " . $db_insert . " VALUES ( ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("issss",
					$test->test_id,
					$test->test_name_TH,
					$test->test_name_En,
					$test->test_asd,
					$test->test_fgh
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$db_update = "test_id = ?,
					test_name_TH  = ?,
					test_name_En  = ?,
					test_asd  = ?,
					test_fgh = ?
					WHERE test_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  test ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("issss",
					$test->test_id,
					$test->test_name_TH,
					$test->test_name_En,
					$test->test_asd,
					$test->test_fgh,
					$test->test_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM test WHERE test_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$test->test_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($test_id, $test_name_TH, $test_name_En) {
		log_debug(get_class($this),"Input : [" . $test_id . ", ". $test_name_TH . ", ". $test_name_En . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM test WHERE test_id = ? AND test_name_TH = ? AND test_name_En = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("iss",
					$test_id,
					$test_name_TH,
					$test_name_En
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($test_id, $test_name_TH, $test_name_En, $test_asd, $test_fgh);
				while($stmt->fetch()){
					$vo['test_id'][] = $test_id;
					$vo['test_name_TH'][] = $test_name_TH;
					$vo['test_name_En'][] = $test_name_En;
					$vo['test_asd'][] = $test_asd;
					$vo['test_fgh'][] = $test_fgh;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $test_id . "]\n"
											 . "[" . $test_name_TH . "]\n"
											 . "[" . $test_name_En . "]\n"
											 . "[" . $test_asd . "]\n"
											 . "[" . $test_fgh . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK test " . $test->test_id. " Success.");
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
			$query = "SELECT * FROM  test";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($test_id, $test_name_TH, $test_name_En, $test_asd, $test_fgh);
				while($stmt->fetch()){
					$vo['test_id'][] = $test_id;
					$vo['test_name_TH'][] = $test_name_TH;
					$vo['test_name_En'][] = $test_name_En;
					$vo['test_asd'][] = $test_asd;
					$vo['test_fgh'][] = $test_fgh;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $test_id . "]\n"
											 . "[" . $test_name_TH . "]\n"
											 . "[" . $test_name_En . "]\n"
											 . "[" . $test_asd . "]\n"
											 . "[" . $test_fgh . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All test Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTestId($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM test WHERE test_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$test
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($test_id, $test_name_TH, $test_name_En, $test_asd, $test_fgh);
				while($stmt->fetch()){
					$vo['test_id'][] = $test_id;
					$vo['test_name_TH'][] = $test_name_TH;
					$vo['test_name_En'][] = $test_name_En;
					$vo['test_asd'][] = $test_asd;
					$vo['test_fgh'][] = $test_fgh;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $test_id . "]\n"
											 . "[" . $test_name_TH . "]\n"
											 . "[" . $test_name_En . "]\n"
											 . "[" . $test_asd . "]\n"
											 . "[" . $test_fgh . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TestId test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TestId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTestNameTH($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM test WHERE test_name_TH = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$test
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($test_id, $test_name_TH, $test_name_En, $test_asd, $test_fgh);
				while($stmt->fetch()){
					$vo['test_id'][] = $test_id;
					$vo['test_name_TH'][] = $test_name_TH;
					$vo['test_name_En'][] = $test_name_En;
					$vo['test_asd'][] = $test_asd;
					$vo['test_fgh'][] = $test_fgh;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $test_id . "]\n"
											 . "[" . $test_name_TH . "]\n"
											 . "[" . $test_name_En . "]\n"
											 . "[" . $test_asd . "]\n"
											 . "[" . $test_fgh . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TestNameTH test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TestNameTH Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTestNameEn($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM test WHERE test_name_En = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$test
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($test_id, $test_name_TH, $test_name_En, $test_asd, $test_fgh);
				while($stmt->fetch()){
					$vo['test_id'][] = $test_id;
					$vo['test_name_TH'][] = $test_name_TH;
					$vo['test_name_En'][] = $test_name_En;
					$vo['test_asd'][] = $test_asd;
					$vo['test_fgh'][] = $test_fgh;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $test_id . "]\n"
											 . "[" . $test_name_TH . "]\n"
											 . "[" . $test_name_En . "]\n"
											 . "[" . $test_asd . "]\n"
											 . "[" . $test_fgh . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TestNameEn test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TestNameEn Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTestAsd($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM test WHERE test_asd = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$test
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($test_id, $test_name_TH, $test_name_En, $test_asd, $test_fgh);
				while($stmt->fetch()){
					$vo['test_id'][] = $test_id;
					$vo['test_name_TH'][] = $test_name_TH;
					$vo['test_name_En'][] = $test_name_En;
					$vo['test_asd'][] = $test_asd;
					$vo['test_fgh'][] = $test_fgh;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $test_id . "]\n"
											 . "[" . $test_name_TH . "]\n"
											 . "[" . $test_name_En . "]\n"
											 . "[" . $test_asd . "]\n"
											 . "[" . $test_fgh . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TestAsd test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TestAsd Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyTestFgh($test) {
		log_debug(get_class($this),"Input : [" . $test . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM test WHERE test_fgh = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$test
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($test_id, $test_name_TH, $test_name_En, $test_asd, $test_fgh);
				while($stmt->fetch()){
					$vo['test_id'][] = $test_id;
					$vo['test_name_TH'][] = $test_name_TH;
					$vo['test_name_En'][] = $test_name_En;
					$vo['test_asd'][] = $test_asd;
					$vo['test_fgh'][] = $test_fgh;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $test_id . "]\n"
											 . "[" . $test_name_TH . "]\n"
											 . "[" . $test_name_En . "]\n"
											 . "[" . $test_asd . "]\n"
											 . "[" . $test_fgh . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find TestFgh test " . $test->test_id. " Success.");
			}else{
				log_debug(get_class($this),"Find TestFgh Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}