<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="ตารางสอน";
$page_icon="list-alt";
$page_home_active = "";
$page_room_timetable_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("./commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->
      <div id="page-wrapper" class="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1><?=$page_name; ?> <small></small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> <?=$page_name; ?></li>
            </ol>
            <div class="alert alert-success alert-dismissable hide">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
          </div>
        </div><!-- /.row -->



<!--
        <!--        <script language="JavaScript">-->
<!--            <!-- hide code-->
<!--            // this array gives the weekday names-->
<!--            var Weekday = new Array();-->
<!--            Weekday[0] = "Sunday";-->
<!--            Weekday[1] = "Monday";-->
<!--            Weekday[2] = "Tuesday";-->
<!--            Weekday[3] = "Wednesday";-->
<!--            Weekday[4] = "Thursday";-->
<!--            Weekday[5] = "Friday";-->
<!--            Weekday[6] = "Saturday";-->
<!--            // this array gives month names-->
<!--            var MonthA = new Array();-->
<!--            MonthA[0] = "January";-->
<!--            MonthA[1] = "February";-->
<!--            MonthA[2] = "March";-->
<!--            MonthA[3] = "April";-->
<!--            MonthA[4] = "May";-->
<!--            MonthA[5] = "June";-->
<!--            MonthA[6] = "July";-->
<!--            MonthA[7] = "August";-->
<!--            MonthA[8] = "September";-->
<!--            MonthA[9] = "October";-->
<!--            MonthA[10] = "November";-->
<!--            MonthA[11] = "December";-->
<!--            // this array gives the number of days in each month-->
<!--            var Mdays = new Array();-->
<!--            Mdays[0] = 31;-->
<!--            Mdays[1] = 28;-->
<!--            Mdays[2] = 31;-->
<!--            Mdays[3] = 30;-->
<!--            Mdays[4] = 31;-->
<!--            Mdays[5] = 30;-->
<!--            Mdays[6] = 31;-->
<!--            Mdays[7] = 31;-->
<!--            Mdays[8] = 30;-->
<!--            Mdays[9] = 31;-->
<!--            Mdays[10] = 30;-->
<!--            Mdays[11] = 31;-->
<!--            // this code gets current date information-->
<!--            var Today = new Date();-->
<!--            var Date = Today.getDate();-->
<!--            var Month = Today.getMonth();-->
<!--            var dow = Today.getDay();-->
<!--            var Year = Today.getYear();-->
<!--            // these are variables for-->
<!--            var day = 1;-->
<!--            var i, j;-->
<!--            // adjust year for browser differences-->
<!--            if (Year < 2000) {-->
<!--                Year += 1900;-->
<!--            }-->
<!--            // account for leap year-->
<!--            if ((Year % 400 == 0) || ((Year % 4 == 0) && (Year % 100 !=0)))-->
<!--                Mdays[1] = 29;-->
<!--            // determine day of week for first day of the month-->
<!--            var Mfirst = Today;-->
<!--            Mfirst.setDate(1);-->
<!--            var dow1 = Mfirst.getDay();-->
<!--            // write out current date-->
<!--            document.write("Today is " + Weekday[dow] + ", " + MonthA[Month]);-->
<!--            document.write(" " + Date + ", " + Year);-->
<!--            // construct calendar for current month-->
<!--            document.write("<BR><BR><TABLE BORDER=5 BORDERCOLOR=INDIGO>" +-->
<!--                "<TR><TH COLSPAN=7 ALIGN=CENTER>" + MonthA[Month] + " " + Year + "</TH></TR>");-->
<!--            document.write("<TR><TH>Sun</TH><TH>Mon</TH><TH>Tue</TH><TH>Wed</TH>" +-->
<!--                "<TH>Thu</TH><TH>Fri</TH><TH>Sat</TH></TR>");-->
<!--            for (i = 0; i < 6; i++) {-->
<!--// this loop writes one row of days Sun-Sat-->
<!--                document.write("<TR>");-->
<!--                for (j = 0; j < 7; j++) {-->
<!--// this loop determines which dates to display and in which column-->
<!--                    if ((i == 0 && j < dow1) || (day > Mdays[Month])) {-->
<!--// this puts in blank cells at the beginning an end of the month-->
<!--                        document.write("<TD><BR></TD>");-->
<!--                    } else {-->
<!--                        if (day == Date) {-->
<!--// highlight the current day and display the date for this cell-->
<!--                            document.write("<TD><FONT COLOR=red>" + day + "</FONT></TD>");-->
<!--                        } else {-->
<!--// display the date for this cell-->
<!--                            document.write("<TD>" + day + "</TD>");-->
<!--                        }-->
<!--// increment day counter-->
<!--                        day++;-->
<!--                    }-->
<!--                }-->
<!--// end of row; determine if more rows needed-->
<!--                document.write("</TR>");-->
<!--                if (day > Mdays[Month]) {-->
<!--                    i = 6;-->
<!--                }-->
<!--            }-->
<!--            // end of table-->
<!--            document.write("</TABLE>");-->
<!--            // end hiding -->-->
<!--        </script>-->

<?
          $timeArr = array(
          0 => array( "start" => "08:30", "stop" => "09:20"),
          1 => array( "start" => "09:20", "stop" => "10:10"),
          2 => array( "start" => "10:15", "stop" => "11:05"),
          3 => array( "start" => "11:05", "stop" => "11:55"),
          4 => array( "start" => "11:55", "stop" => "12:45"),
          5 => array( "start" => "12:45", "stop" => "13:35"),
          6 => array( "start" => "13:35", "stop" => "14:30"),
          7 => array( "start" => "14:30", "stop" => "15:20"),
          8 => array( "start" => "15:20", "stop" => "16:10"),
          9 => array( "start" => "16:10", "stop" => "17:00"),
          10 => array( "start" => "17:00", "stop" => "17:50")
          );

          //DATABASE to Array
          //วนลูปฐานข้อมูล มาเก็บในรูปแบบ Array
          $timeTeach = array(
          0 => array(
          array('time' => '08:30-11:55', 'title' => '4312405 เทคโนโลยีสารสนเทศ และการสื่อสาร'),
          array('time' => '13:35-15:20', 'title' => '4312605 ระบบฐานข้อมูล')
          ),
          1 => array(
          array('time' => '12:45-16:10', 'title' => '4312502 หัวข้อพิเศษเกี่ยวกับวิทยาการคอมพิวเตอร์')
          ),
          2 => array(),
          3 => array(),
          4 => array(),
          5 => array(),
          6 => array(),
          7 => array()
          );
          //End การจัดรูปแบบข้อมูล

          /* Head Column */
          function createCol($arr){
          $row = "";
          foreach( $arr as $data )
          {
          $row .= '<td>' . $data['start'] . '-' . $data['stop'] . '</td>';
          }
          return $row;
          }

          /* Key Positon */
          function getCol($haystack, $keyNeedle)
          {
          $i = 0;
          foreach($haystack as $arr)
          {
          if($arr['start'] == $keyNeedle)
          {
          return $i;
          }
          $i++;
          }
          }

          /* Time Range */
          function getTimeRange($timeT, $timeCol){
          $data = array();
          foreach($timeT as $timeA){
          $time = $timeA['time'];
          if(!$time) continue;
          $tm = explode("-", $time);
          //echo '
          ', print_r($tm,true) ,';
          $start = getCol($timeCol, $tm[0]);
          $end = getCol($timeCol, $tm[1] );
          $colspan = $end - $start;
          $data[$tm[0]] = array('colspan' => $colspan, 'title' => $timeA['title']);
          }
          return $data;
          }

          $list = "";
          echo '<table border="1" width="90%" align="center" cellspacing="0">';
              echo '<tr><td> </td><td> </td>'. createCol( $timeArr ) .'</tr>';
              foreach($timeTeach as $i=>$arr){

              //ค้นหาข้อมูลในตารางลงทะเบียน
              //นับช่วงเวลา start_time กับ stop_time ว่ามีกี่ช่อง
              $timeT = $timeTeach[$i];

              $arrRange = getTimeRange($timeT, $timeArr);

              //echo '
              ', print_r($arrRange,true) ,';

              $no = $i + 1;

              $list = '<tr>';
                  $list.= '<td rowspan="2" class="no">'.$no.'</td>';
                  $list.= '<td>ลายเซ็น</td>';
                  $chkCol = 0;
                  $col = 0;
                  foreach( $timeArr as $timeA )
                  {
                  $highlight = "";
                  $colspan = "";
                  if($chkCol < ($col-1) && $col != 0){
                  $chkCol++;
                  continue;
                  }
                  $col = 0;
                  $chkCol = 0;
                  if(!empty($arrRange[trim($timeA['start'])])){
                  $col = $arrRange[trim($timeA['start'])]['colspan'];
                  $highlight = "highlight";
                  $colspan = 'colspan="'.$col.'"';
                  }
                  $list.= '<td '.$colspan.' class="'. $highlight .'"> </td>';
                  }
                  $list.= '</tr>';

              $list.= '<tr>';
                  $list.= '<td>เอก/รุ่น/ห้อง</td>';
                  foreach( $timeArr as $timeA )
                  {
                  $highlight = "";
                  $colspan = "";
                  if($chkCol < ($col-1) && $col != 0){
                  $chkCol++;
                  continue;
                  }
                  $title = " ";
                  $col = 0;
                  $chkCol = 0;
                  if(!empty($arrRange[trim($timeA['start'])])){
                  $col = $arrRange[trim($timeA['start'])]['colspan'];
                  $title = $arrRange[trim($timeA['start'])]['title'];
                  $highlight = "highlight";
                  $colspan = 'colspan="'.$col.'"';
                  }

                  $list .= '<td '.$colspan.' class="'. $highlight .' title">' . $title . '</td>';
                  }
                  $list .= '</tr>';
              echo $list;

              }
              echo '</table>';

          ?>

        

      </div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->