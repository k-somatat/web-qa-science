<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 1/23/14
 * Time: 2:56 PM
 */
include("president/commons/page-header1.0.php");
class president_searchAdvisor
{

    public function __construct()
    {

        switch($_GET['NoData']){
            case 1 :
                $page = 'president_advisor.php';
                break;
            case 2 :
                $page = 'president_advisor_graph.php';
                break;
        }

        if($_POST['startYear'] > $_POST['endYear']){
            echo "<script type='text/javascript'>
                                    bootbox.alert('กรุณากรอกช่วงเวลาให้ถูกต้อง',function(){
                                       window.location=\"" . site_url . "$page\"
                                    })
                                    </script>";
            exit;
        }

          $compareYear = $_POST['endYear'] - $_POST['startYear'];

        if($compareYear > 3){
            echo "<script type='text/javascript'>
                                    bootbox.alert('เปรียบเทียบได้ไม่เกิน 3 ปีการศึกษา',function(){
                                       window.location=\"" . site_url . "$page\"
                                    })
                                    </script>";
            exit;
        }


        $startYear = $_POST['startYear'];
        $endYear = $_POST['endYear'];

        $count = 0;
        for($index = $startYear; $index <= $endYear; $index++){
            $year[$count] = (int)$index;
            $count++;
        }

//        print_r($year);

        $advisorDAO = new AdvisorDAO();
        $advisor = new Advisor();

        $advisor = $advisorDAO->findAll();

        $countYear = 0;
        for($in = 0; $in < count($advisor['advisor_id']); $in++){

//            $spiltYear = explode('-',$research['research_date'][$in]);

            if(strlen($advisor['advisor_year'][$index]) <= 6){
                if(strlen($advisor['advisor_year'][$index]) == 4){

                    $date = $advisor['advisor_year'][$index];

                    if($year[0] == $date){
                        $conferenceYear[$countYear] = $advisor['advisor_id'][$in];
                        $countYear ++;
                    }else if($year[1] == $date){
                        $conferenceYear[$countYear] = $advisor['advisor_id'][$in];
                        $countYear ++;
                    }else if($year[2] == $date){
                        $conferenceYear[$countYear] = $advisor['advisor_id'][$in];
                        $countYear ++;
                    }

                }else if(strlen($advisor['advisor_year'][$index]) == 6){
                    $date = explode('/',$advisor['advisor_year'][$index]);

                    if($year[0] == $date[1]){
                        $conferenceYear[$countYear] = $advisor['advisor_id'][$in];
                        $countYear ++;
                    }else if($year[1] == $date[1]){
                        $conferenceYear[$countYear] = $advisor['advisor_id'][$in];
                        $countYear ++;
                    }else if($year[2] == $date[1]){
                        $conferenceYear[$countYear] = $advisor['advisor_id'][$in];
                        $countYear ++;
                    }

                }
        }

        $urlPortion = 'NoCo='.urlencode(serialize($year));

     echo  "<script>"."window.location=\"" . site_url . "$page?$urlPortion\""."</script>";
}


}}