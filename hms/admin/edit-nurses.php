<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$nid = intval($_GET['id_nurse']); // get doctor id
if (isset($_POST['submit'])) {
    $nurseName = $_POST['nurseName'];
    $address = $_POST['address'];
    $contactNo = $_POST['contactNo'];
    $nurseEmail = $_POST['nurseEmail'];
    // var_dump($nurseName, $address, $contactNo, $nurseEmail, $nursePassword);
    // exit();  
    // $nursePass = md5($_POST['nursePass']);
    $sql = mysqli_query($con, "Update nurses set nurseName='$nurseName', address='$address', contactNo='$contactNo', nurseEmail='$nurseEmail' where id_nurse='$nid' ");
    if ($sql) {
        $msg = "Cập nhật thông tin nhân viên thành công!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Cập nhật thông tin nhân viên</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />


</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">

            <?php include('include/header.php'); ?>
            <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->

            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin |Chỉnh sửa thông tin nhân viên</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Chỉnh sửa thông tin nhân viên</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                    <div class="row" style="background-color: #c7f9cc">
                            <div class="col-md-12">
                                <h5 style="font-size:18px; padding-top: 10px">
                                    <?php if ($msg) {
                                        echo htmlentities($msg);
                                    } ?> </h5>
                            </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Chỉnh sửa thông tin nhân viên</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php $sql = mysqli_query($con, "select * from nurses where id_nurse='$id'");
                                                while ($data = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <h4><?php echo htmlentities($data['nurseName']); ?></h4>
                                                    <p><b>Ngày cập nhật:
                                                        </b><?php echo htmlentities($data['creationDate']); ?></p>
                                                    <?php if ($data['updationDate']) { ?>
                                                        <p><b>Lần cập nhật trước:
                                                            </b><?php echo htmlentities($data['updationDate']); ?></p>
                                                    <?php } ?>
                                                    <hr />
                                                    <form role="form" name="adddoc" method="post" onSubmit="return valid();">

                                                        <div class="form-group">
                                                            <label for="doctorname">
                                                                Tên nhân viên
                                                            </label>
                                                            <input type="text" name="nurseName" class="form-control" value="<?php echo htmlentities($data['nurseName']); ?>">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="address">
                                                                Địa chỉ
                                                            </label>
                                                            <textarea name="address" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fess">
                                                                Số điện thoại
                                                            </label>
                                                            <input type="text" name="contactNo" class="form-control" required="required" value="<?php echo htmlentities($data['contactNo']); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fess">
                                                                Email
                                                            </label>
                                                            <input type="email" name="nurseEmail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['nurseEmail']); ?>">
                                                        </div>
                                                     <?php } ?>


                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                        Cập nhật
                                                    </button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: BASIC EXAMPLE -->






            <!-- end: SELECT BOXES -->

        </div>
    </div>
    </div>
    <!-- start: FOOTER -->
    <?php include('include/footer.php'); ?>
    <!-- end: FOOTER -->

    <!-- start: SETTINGS -->
    <?php include('include/setting.php'); ?>
    <>
        <!-- end: SETTINGS -->
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/modernizr/modernizr.js"></script>
        <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="vendor/switchery/switchery.min.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="vendor/autosize/autosize.min.js"></script>
        <script src="vendor/selectFx/classie.js"></script>
        <script src="vendor/selectFx/selectFx.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <!-- start: CLIP-TWO JAVASCRIPTS -->
        <script src="assets/js/main.js"></script>
        <!-- start: JavaScript Event Handlers for this page -->
        <script src="assets/js/form-elements.js"></script>
        <script>
            jQuery(document).ready(function() {
                Main.init();
                FormElements.init();
            });
        </script>
        <!-- end: JavaScript Event Handlers for this page -->
        <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>