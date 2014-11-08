<?php
	require_once('BaseDao/TsTimeScheduleBaseDAO.class.php');

	class TsTimeScheduleDAO extends TsTimeScheduleBaseDAO{

	function findbyTimeStartAndUserIdAll($date1,$date2,$userId) {
			log_debug(get_class($this),"Input : [" . $date . " , " . $userId . "].");
			$DB_CONNECT = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
				mysqli_query($DB_CONNECT,"SET NAMES UTF8");
				$query = "SELECT * FROM ts_time_schedule WHERE date >= '$date1' and date <= '$date2' and user_id = '$userId' ORDER BY date, ts_type, time_start" ;
				$result = mysqli_query($DB_CONNECT,$query);
				log_debug(get_class($this),"$query");
			
			while($row = mysqli_fetch_array($result)){
				$vo['ts_id'][] = $row['ts_id'];
				$vo['user_id'][] = $row['user_id'];
				$vo['ts_name'][] = $row['ts_name'];
				$vo['ts_description'][] = $row['ts_description'];
				$vo['ts_type'][] = $row['ts_type'];
				$vo['time_start'][] = $row['time_start'];
				$vo['time_end'][] = $row['time_end'];
				$vo['date'][] = $row['date'];
				$vo['time_create'][] = $row['time_create'];
				$vo['time_update'][] = $row['time_update'];

			}
			return $vo;
			mysqli_close($DB_CONNECT);
		}
		function findbyTimeStartAndUserId($ts_type,$date,$userId) {
			log_debug(get_class($this),"Input : [" . $date . " , " . $userId . "].");
			$DB_CONNECT = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
			mysqli_query($DB_CONNECT,"SET NAMES UTF8");
			$query = "SELECT * FROM ts_time_schedule WHERE ts_type = '$ts_type' and date = '$date' and user_id = '$userId' ORDER BY time_start" ;
			$result = mysqli_query($DB_CONNECT,$query);
			log_debug(get_class($this),"$query");
				
			while($row = mysqli_fetch_array($result)){
				$vo['ts_id'][] = $row['ts_id'];
				$vo['user_id'][] = $row['user_id'];
				$vo['ts_name'][] = $row['ts_name'];
				$vo['ts_description'][] = $row['ts_description'];
				$vo['ts_type'][] = $row['ts_type'];
				$vo['time_start'][] = $row['time_start'];
				$vo['time_end'][] = $row['time_end'];
				$vo['date'][] = $row['date'];
				$vo['time_create'][] = $row['time_create'];
				$vo['time_update'][] = $row['time_update'];
		
			}
			return $vo;
			mysqli_close($DB_CONNECT);
		}
		function findbyTimeStartAndUserIdRange($ts_type,$date1,$date2,$userId) {
			log_debug(get_class($this),"Input : [" . $date . " , " . $userId . "].");
			$DB_CONNECT = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
			mysqli_query($DB_CONNECT,"SET NAMES UTF8");
			$query = "SELECT * FROM ts_time_schedule WHERE ts_type = '$ts_type' and date >= '$date1' and date <= '$date2' and user_id = '$userId' ORDER BY date, time_start" ;
			$result = mysqli_query($DB_CONNECT,$query);
			log_debug(get_class($this),"$query");
				
			while($row = mysqli_fetch_array($result)){
				$vo['ts_id'][] = $row['ts_id'];
				$vo['user_id'][] = $row['user_id'];
				$vo['ts_name'][] = $row['ts_name'];
				$vo['ts_description'][] = $row['ts_description'];
				$vo['ts_type'][] = $row['ts_type'];
				$vo['time_start'][] = $row['time_start'];
				$vo['time_end'][] = $row['time_end'];
				$vo['date'][] = $row['date'];
				$vo['time_create'][] = $row['time_create'];
				$vo['time_update'][] = $row['time_update'];
		
			}
			return $vo;
			mysqli_close($DB_CONNECT);
		}
	}
?>