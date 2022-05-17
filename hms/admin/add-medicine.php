<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $medName = $_POST['medName'];
    $note = $_POST['note'];
    $pharmacy_Qty = $_POST['pharmacy_Qty'];
    $exp_date = $_POST['exp_date'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $instruct = $_POST['instruct'];
    $data = [ $medName, $pharmacy_Qty, $exp_date, $price, $unit, $note, $instruct];
   
    $sql = mysqli_query($con, "INSERT INTO medicine (medName, note, pharmacy_Qty, exp_date, price, instruct, unit) VALUES ('$medName', '$note', '$pharmacy_Qty', '$exp_date', '$price', '$instruct', '$unit')");
    // var_dump($data);
    // exit();
    if ($sql) {
        echo "<script>alert('Thêm mới thuốc thành công!');</script>";
        header("Location: manage-medicine.php");
    }else{
        var_dump($sql);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Thêm thuốc</title>

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

    <script>
        function checkmed() {
            $("#loaderIcon").show();
            var medName =  $("#addMed").val()
            var pharmacy_Qty = $("#pharmacy_Qty").val()

            jQuery.ajax({
                url: "include/check_med.php",
                data: {medName:medName, pharmacy_Qty:pharmacy_Qty},
                type: "POST",
                success: function(data) {
                    $("#medicine-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">

            <?php include('include/header.php'); ?>

            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Thêm thuốc</h1>
                            </div>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="post" action="add-medicine.php">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Tên thuốc</label>
                                            <input type="text" class="form-control" id="addMed" name="medName" required onBlur="checkmed()">
                                            <span id="medicine-availability-status"></span>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer02">Đơn vị tính</label>
                                            <input type="text" class="form-control" name="unit" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer02">Giá tiền</label>
                                            <input type="text" class="form-control" name="price" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3  margin-top-10">
                                            <label for="validationServerUsername">Nhà sản xuất</label>
                                            <input type="text" class="form-control" id="pharmacy_Qty" name="pharmacy_Qty"  required>
                                         </div>
                                        <div class="col-md-6 mb-3 margin-top-10">
                                            <label for="validationServer02">Ngày hết hạn</label>
                                            <input class="form-control datepicker" name="exp_date" required="required">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3  margin-top-10">
                                            <label for="validationServerUsername">Chỉ định</label>
                                            <input type="text" class="form-control" name="note"  required>
                                         </div>
                                        <div class="col-md-6 mb-3 margin-top-10">
                                            <label for="validationServer02">Liều lượng dùng</label>
                                            <input  type="text" class="form-control" name="instruct" required="required">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary margin-top-10 margin-left-15">
                                            Thêm
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php include('include/footer.php'); ?>
    <!-- end: FOOTER -->

    <!-- start: SETTINGS -->
    <?php include('include/setting.php'); ?>

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