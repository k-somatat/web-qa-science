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
        $filename ="ข้อมูลผู้ใช้งานทั้งหมด ".$current_date.' ผู้ดูแลระบบ '.$academic_rank.$firstName.' '.$_SESSION['USER']['user_last_name'][0].".xls";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);

        echo "<center><table  width=100% border=1>";
        echo "<tr><td align=center width=5% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ไอดีผู้ใช้</font></td> ";
        echo "<td align=center width=20% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>อีเมล์</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>รหัสผ่าน</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่อ - นามสกุล</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ตำแหน่ง</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>คณะ</td> ";
echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>สาขา</td> ";
        echo "<td align=center width=5%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>เบอร์โทรติดต่อ</td></tr>";

        $count = 1;
        for($index = 0; $index<count($_SESSION['UserId']['user_id']); $index++){
            echo "<tr> <td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $_SESSION['UserId']['user_id'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['UserId']['username'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['UserId']['password'][$index]."</td>";

            $splitName = explode(' ',$_SESSION['UserId']['user_first_name'][$index]);
            $user_firstName = $splitName[0].$splitName[1];

            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$user_firstName.' '.$_SESSION['UserId']['user_last_name'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['UserId']['user_position'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['UserId']['faculty'][$index] ."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['UserId']['major'][$index] ."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['UserId']['user_tel'][$index]."</td></tr></center>";
            $count++;
        }


 ?>