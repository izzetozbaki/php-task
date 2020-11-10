<?php 
ob_start();
session_start();
include 'baglan.php';
$firmasor=$db->prepare("SELECT * FROM company where cid=:cid");
$firmasor->execute(array(
  'cid' => $_GET['cid']
));
$firmacek=$firmasor->fetch(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>PHP Eğitim Sitesi</title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <div class="col-md-10">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kişi Ekleme Sayfası <small>

                      <?php 

                      if ($_GET['durum']=="ok") {?>

                        <b style="color:green;">İşlem Başarılı...</b>

                      <?php } elseif ($_GET['durum']=="no") {?>

                        <b style="color:red;">İşlem Başarısız...</b>

                      <?php }

                      ?>


                    </small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

                    <form action="islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adı <span class="required">:</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" name="pname" placeholder="Adınızı giriniz" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyadı <span class="required">:</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" name="psurname" placeholder="Soyadınızı giriniz" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ünvan <span class="required">:</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" name="title" placeholder="Ünvanınızı giriniz" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail <span class="required">:</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" name="mail" placeholder="E-postanızı giriniz" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gsm <span class="required">:</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" name="gsm" placeholder="Telefon Numaranızı giriniz" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>




                    <input type="hidden" name="cid" value="<?php echo $firmacek['cid'] ?>">
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="kisiekle" class="btn btn-success">Kaydet</button>
                      </div>
                    </div>

                  </form>



                </div>
              </div>
            </div>
          </div>




        </div>
      </div>
      <!-- /page content -->

    </div>
  </div>
</body>
</html>