<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 4/11/14
 * Time: 1:34 PM
 */
        $userName = $_SESSION['USER']['user_first_name'][0];
        $splitName = explode(' ',$userName);
        $academic_rank = $splitName[0];
        $firstName = $splitName[1];
        $current_date = date('d-m-Y');
        $filename ="ข้อมูลที่ปรึกษาชั้นปี ".$current_date.' '.$academic_rank.$firstName.' '.$_SESSION['USER']['user_last_name'][0].".xls";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);

        echo "<center><table  width=100% border=1>";
        echo "<tr><td align=center width=5% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ลำดับที่</font></td> ";
        echo "<td align=center width=20% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>รายละเอียดการเข้าพบ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชั้นปี</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>จำนวนนักศึกษา/คน</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่ออาจารย์ที่ปรึกษา</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>วันที่เข้าพบ</td></tr> ";

        $count = 1;
        for($index = 0; $index<count($_SESSION['advisorClass']['advisor_id']); $index++){
            if($_SESSION['advisorClass']['advisor_type_id'][$index] == 3){
            echo "<tr> <td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $count."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['advisorClass']['advisor_name'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['advisorClass']['advisor_year'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['advisorClass']['advisor_amount'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$academic_rank.$firstName.' '.$_SESSION['USER']['user_last_name'][0]."</td>";
                $split_date = explode('-', $_SESSION['advisorClass']['advisor_date'][$index]);
                $split_date[0] = $split_date[0]+543;
                $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
                echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$date."</td></tr></center>";
            $count++;
            }
        }




 ?>