<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="ระบบกำลังอยู่หว่างปรับปรุง";
$page_icon="list-alt";
$page_maintenance_active = "active";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("./commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->
      <div id="page-wrapper" class="page-wrapper">


<!-- function add comma integer -->
<!--          --><?//
//
//          $result = split_decimal(1234567891.24);
//          echo "\n".$result;
////          $budget = "2500112111555.25";
//
//          function split_decimal($budget){
//              $splitBudget = explode(".",$budget);
//              $decimalNumber = $splitBudget[1];
//              $integerNumber = $splitBudget[0];
//               $strLength = strlen($integerNumber);
//               $splitInteger = $strLength % 3;
//
//              if($strLength > 3){
//                  switch($splitInteger){
//                      case 0 :
//                          $sum = substr(chunk_split($integerNumber,3,","),0,-1);
//                          $result = $sum.".".$decimalNumber;
//                          break;
//                      case 1 :
//                          $firstNum = substr($integerNumber,0,1);
//                          $secondNum = substr($integerNumber,1);
//                          $sum = substr(chunk_split($secondNum,3,","),0,-1);
//                          $sum = $firstNum.",".$sum;
//                          $result = $sum.".".$decimalNumber;
//                          break;
//                      case 2 :
//                          $firstNum = substr($integerNumber,0,2);
//                          $secondNum = substr($integerNumber,2);
//                          $sum = substr(chunk_split($secondNum,3,","),0,-1);
//                          $sum = $firstNum.",".$sum;
//                          $result = $sum.".".$decimalNumber;
//                  }
//              }else{
//                  $result = $integerNumber.".".$decimalNumber;
//              }
//            return $result;
//          }
//          $str = 'aAbBcCdDeEfFg';
//          print_r( str_split($str,5)); // return: {'aAbBc','CdDeE','fFg'}
//          print_r( str_rsplit($str,5)); // return: {'aAbBc','CdDeE','fFg'}
//          echo str_rsplit($str,-5); // return: {'aAb','BcCdD','eEfFg'}

          ?>

          <div class="row">
              <div class="col-lg-12">
                  <h1 style="color: #003bb3"><?= $page_name; ?>
                      <small></small>
                  </h1>
                  <ol class="breadcrumb">
                      <li class="active"><i class="fa fa-<?= $page_icon; ?>"></i> <?= $page_name; ?></li>
                  </ol>
                  <div class="alert alert-success alert-dismissable hide">
                      <button type="button" class="closse" data-dismiss="alert" aria-hidden="true">&times;</button>
                      Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel
                      free to use this template for your admin needs! We are using a few different plugins to handle the
                      dynamic tables and charts, so make sure you check out the necessary documentation links provided.
                  </div>
              </div>
          </div>

        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
            <img src="images/maintenance.jpg">
            </div>
            <div class="col-lg-4">
            </div>
         </div>

      </div><!-- /#page-wrapper -->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
