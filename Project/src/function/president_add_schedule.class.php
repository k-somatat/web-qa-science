<?php session_start();

include("president/commons/page-header1.0.php");

	class president_AddSchedule {
		public function __construct() {

                        $tsTimeScheduleDAO = new TsTimeScheduleDAO ();
                        $tsTimeschedule = new TsTimeSchedule ();

                        $tsTimeschedule->user_id = $_SESSION['USER']['user_id'][0];
                        $tsTimeschedule->ts_name = $_POST['ts_name'];
                        $tsTimeschedule->ts_description = $_POST['ts_description'];
                        $tsTimeschedule->ts_type = $_POST['ts_type'];
                        $tsTimeschedule->date = $_POST['date'];
                        $timestart = new DateTime($_POST['time_start']);
                        $timeend = new DateTime($_POST['time_end']);
                        $tsTimeschedule->time_start = $timestart->format('H:i:s');
                        $tsTimeschedule->time_end = $timeend->format('H:i:s');
                        $tsTimeschedule->time_update = date("Y-m-d H:i:s");

                        $tsTimeScheduleDAO->insert($tsTimeschedule);

                        echo "<script type='text/javascript'>
                        bootbox.alert('เพิ่มข้อมูลกิจกรรมเรียบร้อยแล้ว',function(){
                            window.location=\"" . site_url . "president_time_schedule.php?\"
                        })
                        </script>";


	    }
    }
?>