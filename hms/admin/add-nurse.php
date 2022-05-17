<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $nurseName = $_POST['nurseName'];
    $address = $_POST['address'];
    // $nurseFees = $_POST['nurseFees'];
    $contactNo = $_POST['contactNo'];
    $nurseEmail = $_POST['nurseEmail'];
    $nursePass = md5($_POST['nursePass']);
    // var_dump($nurseName, $address, $contactNo, $nurseEmail, $nursePassword);
      
    //KIỂM TRA TỒN TẠI USER
    $check = mysqli_query($con, "SELECT * FROM nurses WHERE nuserEmail = $nurseEmail");
    // var_dump($sql);
    // exit();
    if($check == NULL){
        $sql = mysqli_query($con, "INSERT INTO nurses (nurseName,address,contactNo,nurseEmail,nursePass) VALUES('$nurseName','$address','$contactNo','$nurseEmail','$nursePass')");
        if ($sql) {
            echo "<script>alert('Thêm tài khoản cho nhân viên Y tế thành công !');</script>";
            echo "<script>window.location.href ='manage-nurses.php'</script>";
        }
        else{
            echo "<script>alert('Đã xảy ra lỗi!');</script>";
            echo "<script>window.location.href ='add-nurse.php'</script>";
        }
    }
    else{
        echo "<script>alert('Email này đã dùng để đăng ký tài khoản!');</script>";
        echo "<script>window.location.href ='add-nurse.php'</script>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Thêm nhân viên Y tế</title>

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
    <script type="text/javascript">
        function valid() {
            if (document.addnurse.npass.value != document.addnurse.cfpass.value) {
                alert("Xác nhận mật khẩu không chính xác !");
                document.addnurse.cfpass.focus();
                return false;
            }
            return true;
        }
    </script>


    <script>
        function checkemailAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#nurseEmail").val(),
                type: "POST",
                success: function(data) {
                    $("#email-availability-status").html(data);
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
                                <h1 class="mainTitle">Admin | Thêm tài khoản nhân viên Y tế</h1>
                            </div>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Thêm nhân viên Y tế</h5>
                                            </div>
                                            <div class="panel-body">

                                                <form role="form" name="addnurse" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="doctorname">
                                                            Tên nhân viên
                                                        </label>
                                                        <input type="text" name="nurseName" class="form-control" placeholder="Nhập tên nhân viên" required="true">
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="address">
                                                            Địa chỉ
                                                        </label>
                                                        <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ" required="true"></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fess">
                                                            Số điện thoại
                                                        </label>
                                                        <input type="text" name="contactNo" class="form-control" placeholder="Nhập Số điện thoại" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fess">
                                                            Email Nhân viên Y tế
                                                        </label>
                                                        <input type="email" id="nurseEmail" name="nurseEmail" class="form-control" placeholder="Nhập vào email của nhân viên" required="true" onBlur="checkemailAvailability()">
                                                        <span id="email-availability-status"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">
                                                            Mật khẩu
                                                        </label>
                                                        <input type="password" name="nursePass" class="form-control" placeholder="Mật khẩu mới" required="required" id="password_check">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword2">
                                                            Xác nhận mật khẩu
                                                        </label>
                                                        <input type="password" name="cfpass" class="form-control" placeholder="Xác nhận mật khẩu" required="required" id="repassword_check" onkeyup="check_password()">
                                                    </div>
                                                    <button type=" submit" name="submit" id="submit" class="btn btn-o btn-primary">
                                                        Xác nhận
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