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
        $filename ="ข้อมูลที่ปรึกษาสหกิจศึกษา ".$current_date.' '.$academic_rank.$firstName.' '.$_SESSION['USER']['user_last_name'][0].".xls";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);

        echo "<center><table  width=100% border=1>";
        echo "<tr><td align=center width=5% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ลำดับที่</font></td> ";
        echo "<td align=center width=20% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่อโครงการ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ผู้จัดทำ</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ปีการศึกษา</td> ";
        echo "<td align=center width=10%  style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>สถานประกอบการ</td> ";
        echo "<td align=center width=10% style='font-size: 21px; font-weight: bold'><font face='Angsana New' color=#000099>ชื่ออาจารย์ที่ปรึกษา</td></tr> ";

        $count = 1;
        for($index = 0; $index<count($_SESSION['advisorCooperative_education']['advisor_id']); $index++){
            if($_SESSION['advisorCooperative_education']['advisor_type_id'][$index] == 2){
            echo "<tr> <td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $count."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['advisorCooperative_education']['advisor_name'][$index]."</td>";
                $amount = $_SESSION['advisorCooperative_education']['advisor_amount'][$index];
                switch($amount){
                    case 1 :
                        $spilt_author1 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author'][$index]);
                        echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2]."</td>";
                        break;
                    case 2 :
                        $spilt_author1 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author'][$index]);
                        $spilt_author2 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author2'][$index]);
                        echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2]. '<br>'
                            . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] ."</td>";
                        break;
                    case 3 :
                        $spilt_author1 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author'][$index]);
                        $spilt_author2 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author2'][$index]);
                        $spilt_author3 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author3'][$index]);

                        echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2]. '<br>'
                            . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] . '<br>'
                            . $spilt_author3[0].$spilt_author3[1]." ".$spilt_author3[2] . '</td>' ;
                        break;
                    case 4 :
                        $spilt_author1 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author'][$index]);
                        $spilt_author2 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author2'][$index]);
                        $spilt_author3 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author3'][$index]);
                        $spilt_author4 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author4'][$index]);

                        echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2]. '<br>'
                            . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] . '<br>'
                            . $spilt_author3[0].$spilt_author3[1]." ".$spilt_author3[2] . '<br>'
                            . $spilt_author4[0].$spilt_author4[1]." ".$spilt_author4[2] . '</td>' ;
                        break;
                    case 5 :
                        $spilt_author1 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author'][$index]);
                        $spilt_author2 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author2'][$index]);
                        $spilt_author3 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author3'][$index]);
                        $spilt_author4 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author4'][$index]);
                        $spilt_author5 = explode(' ',$_SESSION['advisorCooperative_education']['advisor_author5'][$index]);

                        echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>". $spilt_author1[0].$spilt_author1[1]." ".$spilt_author1[2]. '<br>'
                            . $spilt_author2[0].$spilt_author2[1]." ".$spilt_author2[2] . '<br>'
                            . $spilt_author3[0].$spilt_author3[1]." ".$spilt_author3[2] . '<br>'
                            . $spilt_author4[0].$spilt_author4[1]." ".$spilt_author4[2] . '<br>'
                            . $spilt_author5[0].$spilt_author5[1]." ".$spilt_author5[2] . '</td>' ;
                        break;
                }
            $splitDate = explode('/',$_SESSION['advisorCooperative_education']['advisor_year'][$index]);
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".'ภาคเรียนที่ '.$splitDate[0].' '.'ปีการศึกษา '.$splitDate[1]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$_SESSION['advisorCooperative_education']['advisor_location'][$index]."</td>";
            echo "<td align=center style='font-size: 21px'><font face='Angsana New' color=#fff>".$academic_rank.$firstName.' '.$_SESSION['USER']['user_last_name'][0]."</td></tr></center>";
            $count++;
            }
        }




 ?>