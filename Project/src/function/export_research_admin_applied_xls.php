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
        $filename ="ข้อมูลผลงานวิจัยที่นำไปใช้ประโยชน์ ".$current_date.' ผู้ดูแลระบบ '.$academic_rank.$firstName.' '.$_SESSION['USER']['user_last_name'][0].".xls";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);

        echo "<center><table  width=100% border=1>";
        echo "<tr><td align=center width=5% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ลำดับที่</font></td> ";
        echo "<td align=center width=20% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่อผลงานวิจัย</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่อผู้วิจัย</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>หน่วยงาน/ชุมชนที่ใช้ประโยชน์</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>รายละเอียดการใช้ประโยชน์</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ช่วงเวลาที่เริ่มใช้ประโยชน์</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ช่วงเวลาที่สิ้นสุดการใช้ประโยชน์</td></tr> ";

        $count = 1;
        for($index = 0; $index<count($_SESSION['researchApplied']['research_id']); $index++){
            if($_SESSION['researchApplied']['research_type_id'][$index] == 3){
            echo "<tr> <td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $count."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['researchApplied']['research_name'][$index]."</td>";
            $spiltTechName = explode(' ',$_SESSION['researchApplied']['research_author'][$index]);
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$spiltTechName[0].$spiltTechName[1].' '.$spiltTechName[2]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['researchApplied']['research_institution'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['researchApplied']['research_detail'][$index]."</td>";
                $split_date = explode('-', $_SESSION['researchApplied']['research_date'][$index]);
                $split_date_end = explode('-', $_SESSION['researchApplied']['research_date_end'][$index]);
                $split_date[0] = $split_date[0]+543;
                $split_date_end[0] = $split_date_end[0]+543;
                $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
                $date_end = $split_date_end[2] . "-" . $split_date_end[1] . "-" . $split_date_end[0];

                echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$date."</td>";
                echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$date_end."</td></tr></center>";
            $count++;
            }
        }




 ?>