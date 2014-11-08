<?php session_start();
// 	Page Setup
define( 'ABSPATH', dirname(__FILE__) . '/' );
$page_name="ภาระงานอาจารย์ที่ปรึกษา";
$page_icon="list-alt";
$page_advisor_active = "active";
$page_dropdown_open = "open";
// Page Setup END
?>

<!-- Header Include Here -->
<?php include("./commons/page-header1.0.php"); ?>
<!-- End Header Include -->
<!-- content -->
      <div id="page-wrapper" class="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 style="color: #003bb3"><?=$page_name; ?> <small></small></h1>
            <ol class="breadcrumb">
                <li>หน้าแรก</li>
                <li>แฟ้มสะสมงาน</li>
              <li class="active"><i class="fa fa-<?=$page_icon; ?>"></i> <?=$page_name; ?></li>
            </ol>
            <div class="alert alert-success alert-dismissable hide">
              <button type="button" class="closse" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
          </div>
        </div><!-- /.row -->
          <div class="row">
              <div class="col-lg-12">
                  <!-- Nav tabs -->
                  <ul class="nav nav-pills">
                      <li class="active"><a href="#student_class" data-toggle="tab">ข้อมูลนักศึกษา</a></li>
                      <li><a href="advisor_class.php" >อาจารย์ที่ปรึกษาชั้นปี</a></li>
                      <li><a href="advisor_project.php" >อาจารย์ที่ปรึกษาโครงงาน</a></li>
                      <li><a href="advisor_cooperative_education.php" >อาจารย์ที่ปรึกษาสหกิจศึกษา</a></li>
                      <li><a href="advisor_form.php" >เพิ่มข้อมูล</a></li>
                  </ul>
              </div>
          </div><!-- /.row -->

          <!-- Tab panes -->

           <div class="tab-pane active" id="student_class">

<!--               <iframe id="pc"  src="open.php" height="800px" style="margin-top: 10%; margin-left: 10%; width: 80%";  ></iframe>-->
<!--               <iframe id="tablet" width="60%" src="open.php" ></iframe>-->
<!--               <iframe id="mobile" width="30%" src="open.php" ></iframe>-->
                <?
                echo "<script type='text/javascript'>
            bootbox.alert('Welcome to Siam University Website !',function(){

               window.open('https://home.sis.siam.edu/registrar/login.asp', 's', 'resizable=yes, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, copyhistory=no').blur();
window.focus();
            })
            </script>";


                ?>

            </div>

            <div class="tab-pane active" id="advisor_project">

            </div>


            <div class="tab-pane" id="advisor_cooperative_education">

                </div>

            </div>

            <div class="tab-pane" id="add_advisor">


            </div>

<!--          </div>-->
<!---->
<!---->
<!--      </div><!-- /#page-wrapper -->
<!---->
<!---->
<!---->
<!--})-->
<!---->
<!--</script>-->
<!-- END Content -->
<!-- Footer Include Here-->
<?php include("./commons/page-footer1.0.php"); ?>
<!-- END Footer Include -->
