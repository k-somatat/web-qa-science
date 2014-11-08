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
        $filename ="ข้อมูลข่าว ประชาสัมพันธ์ คณะวิทยาศาสตร์ ".$current_date.' ผู้ดูแลระบบ '.$academic_rank.$firstName.' '.$_SESSION['USER']['user_last_name'][0].".xls";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);

        echo "<center><table  width=100% border=1>";
        echo "<tr><td align=center width=5% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ลำดับที่</font></td> ";
        echo "<td align=center width=20% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>หัวเรื่อง</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>รายละเอียด</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>วันที่จัดทำข้อมูล</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>วันที่ปรับปรุงข้อมูล</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ผู้จัดทำข้อมูล</td> ";
        echo "<td align=center width=5%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ผู้ปรับปรุงข้อมูล</td></tr>";

        $count = 1;
        for($index = 0; $index<count($_SESSION['News']['news_id']); $index++){
            echo "<tr> <td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $count."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['News']['news_headline'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['News']['news_detail'][$index]."</td>";

            $split_date = explode('-', $_SESSION['News']['news_time_create'][$index]);
            $split_date_end = explode('-', $_SESSION['News']['news_time_update'][$index]);
            $split_date[0] = $split_date[0]+543;
            $split_date_end[0] = $split_date_end[0]+543;
            $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
            if($_SESSION['News']['news_time_update'][$index] != ''){
            $date_end = $split_date_end[2] . "-" . $split_date_end[1] . "-" . $split_date_end[0];
            }else{
                $date_end = '';
            }
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$date."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$date_end."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['News']['userCreate'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['News']['userUpdate'][$index]."</td></tr></center>";
            $count++;
        }


 ?>