<?php
	session_start();
	error_reporting(0);
	include('include/config.php');
	include('include/checklogin.php');
	check_login();
	if(isset($_POST['submit']))
	{
		$docid=$_SESSION['id'];
		$specilization=$_POST['Doctorspecialization'];
		$doctorid=$_POST['doctor'];
		$userid=$_SESSION['id'];
		$fees=$_POST['fees'];
		$appdate=$_POST['appdate'];
		$time=$_POST['apptime'];
		$userstatus=1;
		$docstatus=1;
		$address=$_POST['address'];
		$name=$_POST['name'];
		$numberphone=$_POST['numberphone'];
		$email=$_POST['email'];
		$cmnd=$_POST['cmnd'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$medhis1=$_POST['medhis'];
		$query=mysqli_query($con,"insert into appointment(Docid,doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,Address,Name,Numberphone,Email,CMND,Gender,Dob,Medhis) values('$docid','$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus','$address','$name','$numberphone','$email','$cmnd','$gender','$dob','$medhis1')");
		if($query)
		{
			echo "<script>alert('Thêm mới bệnh nhân thành công !');</script>";
			
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>THÊM BỆNH NHÂN</title>
    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet" type="text/css" />
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
    function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#patemail").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">THÊM MỚI BỆNH NHÂN</h1>
                            </div>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Thêm Mới</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="" method="post">
                                                    <div class="form-group">
                                                        <label for="doctorname">Họ và tên Bệnh nhân</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Họ và tên đầy đủ" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Số điện thoại</label>
                                                        <input type="text" name="numberphone" class="form-control"
                                                            placeholder="+84" required="true" maxlength="10"
                                                            pattern="[0-9]+">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Email</label>
                                                        <input type="email" id="patemail" name="email"
                                                            class="form-control" placeholder="E-mail" required="true"
                                                            onBlur="userAvailability()">
                                                        <span id="user-availability-status1"
                                                            style="font-size:12px;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="block">Giới tính</label>
                                                        <div class="clip-radio radio-primary">
                                                            <input type="radio" id="rg-female" name="gender" value="nữ">
                                                            <label for="rg-female">Nữ</label>
                                                            <input type="radio" id="rg-male" name="gender" value="nam">
                                                            <label for="rg-male">Nam</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Địa chỉ</label>
                                                        <textarea name="address" class="form-control"
                                                            placeholder="Địa chỉ" required="true"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Tuổi</label>
                                                        <input type="text" name="dob" class="form-control"
                                                            placeholder="Tuổi" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>CMND / CCCD</label>
                                                        <input type="text" name="cmnd" class="form-control"
                                                            placeholder="CMND / CCCD" required="true" maxlength="10"
                                                            pattern="[0-9]+">
                                                    </div>
                                                    <div class="form-group">
															<label for="AppointmentDate">
																Ngày thăm khám
															</label>
															<input class="form-control datepicker" name="appdate"  required="required" data-date-format="yyyy-mm-dd">
														</div>	
                                                    <div class="form-group">
                                                        <label for="fess">Triệu chứng bệnh</label>
                                                        <textarea type="text" name="medhis" class="form-control"
                                                            placeholder="Miêu tả Những triệu chứng, biểu hiện (nếu có)"
                                                            required="true"></textarea>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-o btn-primary">Thêm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
    <!-- start: FOOTER -->
    <?php include('include/footer.php');?>
    <!-- end: FOOTER -->
    <!-- start: SETTINGS -->
    <?php include('include/setting.php');?>
    <!-- end: SETTINGS -->
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