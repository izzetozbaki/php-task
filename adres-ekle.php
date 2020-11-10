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

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGiilJhV-jHyb_YVSK2Ag3x8Mr3ESYhpw&callback=initMap&libraries=places&v=weekly"
  defer
  ></script>
  <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
    </style>
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: 41.0082376, lng: 28.9783589 },
          zoom: 10,
        });
        const card = document.getElementById("pac-card");
        const input = document.getElementById("pac-input");
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
        const autocomplete = new google.maps.places.Autocomplete(input);
        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo("bounds", map);
        // Set the data fields to return when the user selects a place.
        autocomplete.setFields([
          "address_components",
          "formatted_address",
          "geometry",
          "icon",
          "name",
          ]);
        const infowindow = new google.maps.InfoWindow();
        const infowindowContent = document.getElementById("infowindow-content");
        infowindow.setContent(infowindowContent);
        const marker = new google.maps.Marker({
          map,
          anchorPoint: new google.maps.Point(0, -29),
        });
        autocomplete.addListener("place_changed", () => {
          infowindow.close();
          marker.setVisible(false);
          const place = autocomplete.getPlace();

          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert(
              "No details available for input: '" + place.name + "'"
              );
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var item_Lat =place.geometry.location.lat();
          var item_Lng= place.geometry.location.lng();
          var item_Location= place.formatted_address;

          document.getElementById("place_Lat").value=item_Lat;
          document.getElementById("place_Lng").value=item_Lng;
          document.getElementById("place_Location").value=item_Location;
          /*$("#lat").val(item_Lat);
          $("#lng").val(item_Lng);
          $("#location").val(item_Location);
          //console.log($("#lat").value);
          */
          let address = "";

          if (place.address_components) {
            address = [
            (place.address_components[0] &&
              place.address_components[0].short_name) ||
            "",
            (place.address_components[1] &&
              place.address_components[1].short_name) ||
            "",
            (place.address_components[2] &&
              place.address_components[2].short_name) ||
            "",
            ].join(" ");
          }
          infowindowContent.children["place-icon"].src = place.icon;
          infowindowContent.children["place-name"].textContent = place.name;
          infowindowContent.children["place-address"].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          const radioButton = document.getElementById(id);
          radioButton.addEventListener("click", () => {
            autocomplete.setTypes(types);
          });
        }
        setupClickListener("changetype-all", []);
        setupClickListener("changetype-address", ["address"]);
        setupClickListener("changetype-establishment", ["establishment"]);
        setupClickListener("changetype-geocode", ["geocode"]);
        document
        .getElementById("use-strict-bounds")
        .addEventListener("click", function () {
          console.log("Checkbox clicked! New state=" + this.checked);
          autocomplete.setOptions({ strictBounds: this.checked });
        });
      }
    </script>

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
                      <h2>Adres Ekleme Sayfası
                        <small>

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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres Başlığı <span class="required">:</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="first-name" name="name" placeholder="Adresin Başlığını Giriniz" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="pac-card" id="pac-card">
                            <div>
                              <div id="title">Autocomplete search</div>

                              <input type="hidden" name="place_Lat" id="place_Lat">
                              <input type="hidden" name="place_Lng" id="place_Lng">
                              <input type="hidden" name="place_Location" id="place_Location">

                              <div id="type-selector" class="pac-controls">
                                <input
                                type="radio"
                                name="type"
                                id="changetype-all"
                                checked="checked"
                                />
                                <label for="changetype-all">All</label>
                              </div>
                            </div>
                            <div id="pac-container">
                              <input id="pac-input" type="text" placeholder="Enter a location" />
                            </div>
                          </div>
                          <div id="map" style="height: 600px;width: 900px"></div>
                          <div id="infowindow-content">
                            <img src="" width="16" height="16" id="place-icon" />
                            <span id="place-name" class="title"></span><br />
                            <span id="place-address"></span>
                          </div>



                          <input type="hidden" name="cid" value="<?php echo $firmacek['cid'] ?>">

                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button type="submit" name="adreskaydet" class="btn btn-success">Kaydet</button>
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