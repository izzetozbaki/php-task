<?php 
ob_start();
session_start();
include 'baglan.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gentelella Alela! | </title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">

    <div class="col-md-10">


      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">


          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Media Gallery</h2>                    
                  <div class="clearfix"></div>
                  <div align="right">          
                    <a href="firma-ekle.php"><button class="btn btn-success btn-xs" >Şirket Ekle</button></a>
                  </div>
                </div>
                <div class="x_content">
                  <div class="row">


                    <?php 

                    $firmasor=$db->prepare("SELECT * FROM company order by cid ASC");
                    $firmasor->execute();

                    

                    while($firmacek=$firmasor->fetch(PDO::FETCH_ASSOC)) {
                      ?>

                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <a href=""><img style="width: 100%; display: block;" src="production/images/media.jpg" alt="image" />
                              <div class="mask">
                                <p><?php echo $firmacek['cname'] ?></p>
                                <div class="tools tools-bottom">
                                  <a href="firma.php?cid=<?php echo $firmacek['cid'] ?>"><i class="fa fa-users"></i></a>
                                  <a href="firma-duzenle.php?cid=<?php echo $firmacek['cid'] ?>"><i class="fa fa-pencil"></i></a>
                                  <a href="islem.php?cid=<?php echo $firmacek['cid'] ?>&firmasil=ok"><i class="fa fa-times"></i></a>
                                </div>
                              </div>
                            </div>
                            <div class="caption">
                              <p><b><center><?php echo $firmacek['url'] ?></center></b></p>
                            </div>
                          </div>
                        </div>


                      <?php } ?>


                      
                      

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


      </div>

      <!-- jQuery -->
      <script src="vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="vendors/nprogress/nprogress.js"></script>

      <!-- Custom Theme Scripts -->
      <script src="build/js/custom.min.js"></script>
    </body>
    </html>