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
        $filename ="ข้อมูลโครงการ ".$current_date.".xls";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);

        echo "<center><table  width=100% border=1>";
        echo "<tr><td align=center width=5% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ลำดับที่</font></td> ";
        echo "<td align=center width=20% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่อโครงการ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่อผู้รับผิดชอบ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ระยะเวลาที่เริ่มดำเนินการ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ระยะเวลาที่สิ้นสุดการดำเนินการ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>การดำเนินการ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>งบประมาณได้รับการอนุมัติ</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>งบประมาณใช้จริง</td></tr> ";

        $count = 1;
        for($index = 0; $index<count($_SESSION['projectXls']['project_id']); $index++){
            if ($_SESSION['projectXls']['project_author'][$index] == $_SESSION["USER"]["user_id"][0] || $_SESSION['projectXls']['project_author2'][$index] == $_SESSION["USER"]["user_id"][0] || $_SESSION['projectXls']['project_author3'][$index] == $_SESSION["USER"]["user_id"][0])
            {
            echo "<tr> <td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $_SESSION['projectXls']['project_pre'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['projectXls']['project_name'][$index]."</td>";

            switch($_SESSION['projectXls']['project_author_amount'][$index]){
                case 1 :
                    echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['projectXls']['author'][$index]."</td>";
                    break;
                case 2 :
                    echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>"
                        .$_SESSION['projectXls']['author'][$index].'<br>'
                        .$_SESSION['projectXls']['author2'][$index].'</td>' ;
                    break;
                case 3 :
                    echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>"
                        .$_SESSION['projectXls']['author'][$index].'<br>'
                        .$_SESSION['projectXls']['author2'][$index]. '<br>'
                        .$_SESSION['projectXls']['author3'][$index].  '</td>' ;
                    break;

            }

            $split_date = explode('-', $_SESSION['projectXls']['project_date'][$index]);
            $split_date_end = explode('-', $_SESSION['projectXls']['project_date_end'][$index]);
            $split_date[0] = $split_date[0]+543;
            $split_date_end[0] = $split_date_end[0]+543;

            if($_SESSION['projectXls']['project_date'][$index] != '0000-00-00') {
            $date = $split_date[2] . "-" . $split_date[1] . "-" . $split_date[0];
            }else{
                $date = '';
            }

            if($_SESSION['projectXls']['project_date_end'][$index] != '0000-00-00') {
                $date_end = $split_date_end[2] . "-" . $split_date_end[1] . "-" . $split_date_end[0];
            }else{
                $date_end = '';
            }

            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$date."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$date_end."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['projectXls']['project_process'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['projectXls']['project_budget'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['projectXls']['project_final_budget'][$index]."</td></tr></center>";
            $count++;
            }
        }



 ?>