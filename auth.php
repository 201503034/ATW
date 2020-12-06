<?php
/*
 * Google Authenticator files:
 */

declare(strict_types=1);
require 'vendor/autoload.php';
session_start();
include("dbconnection.php");
$email = $_SESSION['login'];
$query = mysqli_query($con, "select secret from authentication where email_id='$email'");
if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
    $secret = $row["secret"];
}
if (isset($_POST['login'])) {
    $code = $_POST['pass-code'];
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
    if ($g->checkCode($secret, $code)) {
        $_SESSION['code'] = $code;
        $extra = "dashboard.php";
        echo "<script>window.location.href='" . $extra . "'</script>";
    } else {
        echo "<script>window.alert('Wrong code, try again');</script>";
        session_unset();
        session_destroy();
        $extra = "index.php";
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    }
}
/*
* Session files
*/

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>CRM | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />

</head>

<body class="error-body no-top">
    <div class="container">
        <div class="row login-container column-seperation">
            <div class="col-md-5 col-md-offset-1">
                <h2>Sign in to CRM</h2>
                <p>
                    <a href="registration.php">Sign up Now!</a> for a webarch account,It's free and always will be..</p>
                <br>
            </div>
            <div class="col-md-5 "> <br>
                <p style="color:#F00"><?php echo $_SESSION['action1']; ?><?php echo $_SESSION['action1'] = ""; ?></p>
                <form id="login-form" class="login-form" action="" method="post">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label class="form-label">Insert Code from Google Authenticator App</label>
                            <div class="controls">
                                <div class="input-with-icon  right">
                                    <i class=""></i>
                                    <input type="text" name="pass-code" id="txtcode" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <button class="btn btn-primary btn-cons pull-right" name="login" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="assets/js/login.js" type="text/javascript"></script>
</body>

</html>