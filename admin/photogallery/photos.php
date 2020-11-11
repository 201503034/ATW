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

    $gallery = htmlspecialchars(trim($_GET['gallery']));

    $photosObj = new Photos();
    $result    = $photosObj->getAllGalleryPhotos($gallery);

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
                <li><a href="#" class="active">Photos from Gallery</a> </li>
            </ul>
            <div class="page-title"> <i class="icon-custom-left"></i>
                <h3>Photo Gallery</h3>
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <h1 class="page-header">Photos</h1>
                </div>

                <?php
                $_SESSION['type'] = "admin";
                if ($_SESSION['type'] == "admin") {
                ?>
                    <form action="image_upload.php" method="post" enctype="multipart/form-data">
                        <div><strong>Only Jpeg allowed</strong></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control" placeholder="Upload photo" accept="image/jpeg">
                                    <input type="hidden" name="galleryName" value="<?= $gallery ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Upload</button>
                                    </span>
                                </div><!-- /input-group -->

                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                    </form>
                <?php } ?>
                <hr>

                <?php
                if (!empty($result)) {
                    foreach ($result as $photo) {
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
                                        <li><a href="javascript:void(0)" data-galleryname="<?= $gallery ?>" data-photoname="<?= $photo ?>" id="deletePhotobtn">Delete Photo</a></li>
                                    </ul>
                                </div> <!-- End Dropdown action -->
                            <?php } ?>
                            <a class="thumbnail" href="javascript:void(0)" id="popImage" data-imgsrc="<?= Gallery_Folder . $gallery . "/" . $photo ?>">
                                <img class="img-responsive" src="<?= Gallery_Folder . $gallery . "/" . $photo ?>" alt="">
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="col-lg-3"><p class="alert alert-info">No Photos Found</p></div>';
                }
                ?>
            </div> <!-- End row -->



            <div id="imagemodal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="" id="imagepreview" class="img-responsive">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="addNewRow"></div>
    </div>
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