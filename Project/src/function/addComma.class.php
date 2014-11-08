<?php
/**
 * Created by PhpStorm.
 * User: Somatat_tai
 * Date: 4/3/14
 * Time: 7:43 PM
 */



//$result = split_decimal(1234567891.24);
//echo "\n".$result;
//          $budget = "2500112111555.25";

function add_comma($budget){
    $splitBudget = explode(".",$budget);
    $decimalNumber = $splitBudget[1];
    $integerNumber = $splitBudget[0];
    $strLength = strlen($integerNumber);
    $splitInteger = $strLength % 3;

    if($strLength > 3){
        switch($splitInteger){
            case 0 :
                $sum = substr(chunk_split($integerNumber,3,","),0,-1);
                $result = $sum.".".$decimalNumber;
                break;
            case 1 :
                $firstNum = substr($integerNumber,0,1);
                $secondNum = substr($integerNumber,1);
                $sum = substr(chunk_split($secondNum,3,","),0,-1);
                $sum = $firstNum.",".$sum;
                $result = $sum.".".$decimalNumber;
                break;
            case 2 :
                $firstNum = substr($integerNumber,0,2);
                $secondNum = substr($integerNumber,2);
                $sum = substr(chunk_split($secondNum,3,","),0,-1);
                $sum = $firstNum.",".$sum;
                $result = $sum.".".$decimalNumber;
        }
    }else{
        $result = $integerNumber.".".$decimalNumber;
    }
    return $result;
}
?>