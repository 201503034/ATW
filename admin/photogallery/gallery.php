<?php
session_start();
include("../dbconnection.php");
include("../checklogin.php");
check_login();
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>Admin | User Access Log </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="../assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="../assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>

<body class="">
  <?php include("header.php"); ?>
  <div class="page-container row">

    <?php include("leftbar.php"); ?>

    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>
  </div>
  <?php
  include "includes/_process_include.php";
  $galleryObj = new Gallery();
  $result = $galleryObj->getAllGallery();
  ?>

  <div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Photo Gallery</a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>Photo Gallery</h3>
      </div>

      <?php
      $_SESSION["type"] = "admin";
      if ($_SESSION['type'] == "admin") {
      ?>
        <div class="row">
          <div class="col-lg-4">
            <div class="input-group">
              <input type="text" id="galleryName" class="form-control" placeholder="Add Gallery">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" id="addGallerybtn">Add</button>
              </span>
              <div id="loader"></div>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      <?php  } ?>

      <br />
      <div id="galleriesList">
        <?php
        if (!empty($result)) {
          foreach ($result as $gallery) {
        ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
              <?php
              if ($_SESSION['type'] == "admin") {
              ?>
                <!-- Dropdown action -->
                <div class="btn-group">
                  <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="" data-name="<?= $gallery ?>" data-toggle="modal" data-target="#myModal" data-name="<?= $gallery ?>" id="editGallerybtn">Edit Name</a></li>
                    <li><a href="" data-galleryname="<?= $gallery ?>" id="deleteGallerybtn">Delete Gallery</a></li>
                  </ul>
                </div> <!-- End Dropdown action -->
              <?php } ?>
              <a class="thumbnail" href="<?= Photos_Page_Link ?>?gallery=<?= $gallery ?>">
                <img class="img-responsive" src="default-thumbnail.jpg" alt="">
                <p><?= $gallery ?></p>
              </a>

            </div>
        <?php
          }
        } else {
          echo '<div class="col-lg-3"><p class="alert alert-info">No Galleries Found</p></div>';
        }
        ?>
      </div>


      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Gallery Name</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-8">
                  <div class="input-group">
                    <input type="text" id="newGalleryName" class="form-control" placeholder="Add Gallery">
                    <input type="hidden" id="oldGalleryName" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" id="editGalleryModalBtn">Edit</button>
                    </span>
                    <div id="loader"></div>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="addNewRow"></div>
  </div> <!-- End row -->

  <script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
  <script src="../assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="../assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
  <script type="text/javascript" src="../assets/plugins/datatables-responsive/js/lodash.min.js"></script>
  <script src="../assets/js/datatables.js" type="text/javascript"></script>
  <script src="../assets/js/core.js" type="text/javascript"></script>
  <script src="../assets/js/chat.js" type="text/javascript"></script>
  <script src="../assets/js/demo.js" type="text/javascript"></script>
  <script src="js/myscript.js"></script>
</body>

</html>