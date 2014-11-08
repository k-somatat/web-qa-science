<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 1/23/14
 * Time: 2:56 PM
 */
include("president/commons/page-header1.0.php");
class president_searchResearch
{

    public function __construct()
    {

        switch($_GET['NoData']){
            case 1 :
                $page = 'president_research.php';
                break;
            case 2 :
                $page = 'president_research_graph_academic.php';
                break;
            case 3 :
                $page = 'president_research_graph_funded.php';
                break;
            case 4 :
                $page = 'president_research_graph_applied.php';
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

        $researchDAO = new ResearchDAO();
        $research = new Research();

        $research = $researchDAO->findAll();

        $countYear = 0;
        for($in = 0; $in < count($research['research_id']); $in++){

            $spiltYear = explode('-',$research['research_date'][$in]);

            if($year[0] == $spiltYear[0]+543){
                $conferenceYear[$countYear] = $research['research_id'][$in];
                $countYear ++;
            }else if($year[1] == $spiltYear[0]+543){
                $conferenceYear[$countYear] = $research['research_id'][$in];
                $countYear ++;
            }else if($year[2] == $spiltYear[0]+543){
                $conferenceYear[$countYear] = $research['research_id'][$in];
                $countYear ++;
            }
        }

        $urlPortion = 'NoCo='.urlencode(serialize($year));

     echo  "<script>"."window.location=\"" . site_url . "$page?$urlPortion\""."</script>";
}


}