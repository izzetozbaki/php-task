<?php 
ob_start();
session_start();
include 'baglan.php';

$firmasor=$db->prepare("SELECT * FROM company where cid=:cid");
$firmasor->execute(array(
  'cid' => $_GET['cid']
));
$firmacek=$firmasor->fetch(PDO::FETCH_ASSOC);

$kisisor=$db->prepare("SELECT * FROM persons where cid=:cid");
$kisisor->execute(array(
  'cid' => $_GET['cid']
));

$adressor=$db->prepare("SELECT * FROM adress where cid=:cid");
$adressor->execute(array(
  'cid' => $_GET['cid']
));
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
                    <h2>Kullanıcı Listeleme <small>

                    </small></h2>

                    <div class="clearfix"></div>
                    <div align="right">          
                      <a href="kisi-ekle.php?cid=<?php echo $firmacek['cid'] ?>"><button class="btn btn-success btn-xs" >Kişi Ekle</button></a>
                    </div>
                  </div>
                  <div class="x_content">


                    <!-- Div İçerik Başlangıç -->

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Person ID</th>
                          <th>Ad</th>
                          <th>Soyad</th>
                          <th>Title</th>
                          <th>Mail</th>                        
                          <th>Telefon</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>

                        <?php 



                        while($kisicek=$kisisor->fetch(PDO::FETCH_ASSOC)) {?>


                          <tr>
                            <td><?php echo $kisicek['pid'] ?></td>
                            <td><?php echo $kisicek['pname'] ?></td>
                            <td><?php echo $kisicek['psurname'] ?></td>
                            <td><?php echo $kisicek['title'] ?></td>
                            <td><?php echo $kisicek['mail'] ?></td>
                            <td><?php echo $kisicek['gsm'] ?></td>
                            <td><center><a href="kisi-duzenle.php?pid=<?php echo $kisicek['pid'] ?>?cid=<?php echo $kisicek['cid'] ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                            <td><center><a href="islem.php?pid=<?php echo $kisicek['pid'] ?>&kisisil=ok&cid=<?php echo $kisicek['cid'] ?>"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                          </tr>



                        <?php  }

                        ?>


                      </tbody>
                    </table>



                  </div>
                </div>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Şirket Adresleri</h2>

                    <div class="clearfix"></div>



                    <div align="right">          
                      <a href="adres-ekle.php?cid=<?php echo $firmacek['cid'] ?>"><button class="btn btn-success btn-xs" >Adres Ekle</button></a>
                    </div>


                    <div class="x_content">


                      <!-- Div İçerik Başlangıç -->

                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th><center>Başlık</center></th>  
                            <th><center>Adres</center></th>                        
                          </tr>
                        </thead>

                        <tbody>

                          <?php 



                          while($adrescek=$adressor->fetch(PDO::FETCH_ASSOC)) {?>


                            <tr>
                              <td><?php echo $adrescek['name'] ?></td>
                              <td><?php echo $adrescek['place_Location'] ?></td>
                            </tr>



                          <?php  }

                          ?>


                        </tbody>
                      </table>



                    </div>

                  </div>

                </div> 

                <form action="" method="POST">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Şirket Sitesi</h2>
                      <div class="clearfix"></div>   

                      <div align="right">          
                        <button class="btn btn-success btn-xs" name="sitaac">Site Görünümünü Aç</button>
                      </div>


                      <?php  
                      if (isset($_POST['sitaac'])) {                      
                        ?>
                        <iframe src="<?php echo $firmacek['siteurl'] ?>" width="900" height="600"></iframe>

                        <?php
                      }
                      ?>




                    </div>

                  </div>
                </form>
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