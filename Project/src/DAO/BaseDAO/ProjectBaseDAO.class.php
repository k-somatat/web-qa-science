<?php
require_once (ABSPATH . 'src/vo/Project.class.php');
class ProjectBaseDAO{

	public function __construct() {
		$vo = new Project();
	}

	function insert($project) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_insert = "(project_id,
					project_pre,
					project_name,
					project_author,
					project_author2,
					project_author3,
					project_author_amount,
					project_date,
					project_date_end,
					project_process,
					project_budget,
					project_final_budget,
					project_document_approve,
					project_document_charges,
					project_document_conclusion,
					project_document_image,
					project_time_create,
					project_time_update,
					plan_id,
					user_create,
					user_update)";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "INSERT INTO project " . $db_insert . " VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("issiiiisssddssssssiii",
					$project->project_id,
					$project->project_pre,
					$project->project_name,
					$project->project_author,
					$project->project_author2,
					$project->project_author3,
					$project->project_author_amount,
					$project->project_date,
					$project->project_date_end,
					$project->project_process,
					$project->project_budget,
					$project->project_final_budget,
					$project->project_document_approve,
					$project->project_document_charges,
					$project->project_document_conclusion,
					$project->project_document_image,
					$project->project_time_create,
					$project->project_time_update,
					$project->plan_id,
					$project->user_create,
					$project->user_update
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Insert Table project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Insert Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function update($project) {
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		$db_update = "SET
					project_pre  = ?,
					project_name  = ?,
					project_author  = ?,
					project_author2  = ?,
					project_author3  = ?,
					project_author_amount  = ?,
					project_date  = ?,
					project_date_end  = ?,
					project_process  = ?,
					project_budget  = ?,
					project_final_budget  = ?,
					project_document_approve  = ?,
					project_document_charges  = ?,
					project_document_conclusion  = ?,
					project_document_image  = ?,
					project_time_create  = ?,
					project_time_update  = ?,
					plan_id  = ?,
					user_create  = ?,
					user_update = ?
					WHERE project_id = ?";
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "UPDATE  project ". $db_update;
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("ssiiiisssddssssssiiii",
					$project->project_pre,
					$project->project_name,
					$project->project_author,
					$project->project_author2,
					$project->project_author3,
					$project->project_author_amount,
					$project->project_date,
					$project->project_date_end,
					$project->project_process,
					$project->project_budget,
					$project->project_final_budget,
					$project->project_document_approve,
					$project->project_document_charges,
					$project->project_document_conclusion,
					$project->project_document_image,
					$project->project_time_create,
					$project->project_time_update,
					$project->plan_id,
					$project->user_create,
					$project->user_update,
					$project->project_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Update Table project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Update Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function delete($project) {
//		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "DELETE FROM project WHERE project_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project->project_id
				);

			if($stmt->execute()){
				log_debug(get_class($this),"Delete Table project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Delete Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPK($project_id) {
		log_debug(get_class($this),"Input : [" . $project_id . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project_id
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find By PK project " . $project->project_id. " Success.");
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
			$query = "SELECT * FROM  project";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find All project Success.");
			}else{
				log_debug(get_class($this),"Find All Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectId($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectId project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectPre($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_pre = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectPre project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectPre Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectName($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_name = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectName project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectName Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectAuthor($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_author = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectAuthor project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectAuthor Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectAuthor2($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_author2 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectAuthor2 project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectAuthor2 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectAuthor3($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_author3 = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectAuthor3 project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectAuthor3 Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectAuthorAmount($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_author_amount = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectAuthorAmount project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectAuthorAmount Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectDate($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_date = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectDate project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectDate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectDateEnd($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_date_end = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectDateEnd project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectDateEnd Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectProcess($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_process = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectProcess project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectProcess Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectBudget($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_budget = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("d",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectBudget project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectBudget Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectFinalBudget($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_final_budget = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("d",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectFinalBudget project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectFinalBudget Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectDocumentApprove($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_document_approve = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectDocumentApprove project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectDocumentApprove Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectDocumentCharges($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_document_charges = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectDocumentCharges project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectDocumentCharges Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectDocumentConclusion($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_document_conclusion = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectDocumentConclusion project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectDocumentConclusion Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectDocumentImage($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_document_image = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectDocumentImage project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectDocumentImage Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectTimeCreate($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_time_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectTimeCreate project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectTimeCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyProjectTimeUpdate($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE project_time_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("s",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find ProjectTimeUpdate project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find ProjectTimeUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyPlanId($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE plan_id = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find PlanId project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find PlanId Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserCreate($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE user_create = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserCreate project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserCreate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
	function findbyUserUpdate($project) {
		log_debug(get_class($this),"Input : [" . $project . "].");
		$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$DB_CONNECT->set_charset('utf8');
		try{
			if($DB_CONNECT){
				log_debug(get_class($this),"Database Connected.");
			}else{
				log_debug(get_class($this),"Database Connect Failed.");
			}
			$query = "SELECT * FROM project WHERE user_update = ?";
			log_debug(get_class($this),$query);
			if (!($stmt = $DB_CONNECT->prepare($query))) {
				log_debug(get_class($this),"Prepare failed: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
			$stmt->bind_param("i",
					$project
				);

			if($stmt->execute()){
				$row = $stmt->bind_result($project_id, $project_pre, $project_name, $project_author, $project_author2, $project_author3, $project_author_amount, $project_date, $project_date_end, $project_process, $project_budget, $project_final_budget, $project_document_approve, $project_document_charges, $project_document_conclusion, $project_document_image, $project_time_create, $project_time_update, $plan_id, $user_create, $user_update);
				while($stmt->fetch()){
					$vo['project_id'][] = $project_id;
					$vo['project_pre'][] = $project_pre;
					$vo['project_name'][] = $project_name;
					$vo['project_author'][] = $project_author;
					$vo['project_author2'][] = $project_author2;
					$vo['project_author3'][] = $project_author3;
					$vo['project_author_amount'][] = $project_author_amount;
					$vo['project_date'][] = $project_date;
					$vo['project_date_end'][] = $project_date_end;
					$vo['project_process'][] = $project_process;
					$vo['project_budget'][] = $project_budget;
					$vo['project_final_budget'][] = $project_final_budget;
					$vo['project_document_approve'][] = $project_document_approve;
					$vo['project_document_charges'][] = $project_document_charges;
					$vo['project_document_conclusion'][] = $project_document_conclusion;
					$vo['project_document_image'][] = $project_document_image;
					$vo['project_time_create'][] = $project_time_create;
					$vo['project_time_update'][] = $project_time_update;
					$vo['plan_id'][] = $plan_id;
					$vo['user_create'][] = $user_create;
					$vo['user_update'][] = $user_update;
					log_debug(get_class($this),"Select Item: \n"
											 . "[" . $project_id . "]\n"
											 . "[" . $project_pre . "]\n"
											 . "[" . $project_name . "]\n"
											 . "[" . $project_author . "]\n"
											 . "[" . $project_author2 . "]\n"
											 . "[" . $project_author3 . "]\n"
											 . "[" . $project_author_amount . "]\n"
											 . "[" . $project_date . "]\n"
											 . "[" . $project_date_end . "]\n"
											 . "[" . $project_process . "]\n"
											 . "[" . $project_budget . "]\n"
											 . "[" . $project_final_budget . "]\n"
											 . "[" . $project_document_approve . "]\n"
											 . "[" . $project_document_charges . "]\n"
											 . "[" . $project_document_conclusion . "]\n"
											 . "[" . $project_document_image . "]\n"
											 . "[" . $project_time_create . "]\n"
											 . "[" . $project_time_update . "]\n"
											 . "[" . $plan_id . "]\n"
											 . "[" . $user_create . "]\n"
											 . "[" . $user_update . "]\n");
				}
				return $vo;
				log_debug(get_class($this),"Find UserUpdate project " . $project->project_id. " Success.");
			}else{
				log_debug(get_class($this),"Find UserUpdate Error: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
			}
		}catch(Exception $e){
			log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
		}
		mysqli_close($DB_CONNECT);
	}
}