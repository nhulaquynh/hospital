<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
include('libs/phpqrcode/qrlib.php');
function getUsernameFromEmail($email)
{
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}
if (isset($_POST['submit'])) {
	$tempDir = 'temp/';
	// $specilization = $_POST['Doctorspecialization'];
	$doctorid = $_POST['doctor'];
	$userid = $_SESSION['id'];
	$fees = $_POST['fees'];
	$appdate = $_POST['appdate'];
	$time = $_POST['apptime'];
	$userstatus = 1;
	$docstatus = 2;
	$address = $_POST['address'];
	$name = $_POST['name'];
	$numberphone = $_POST['numberphone'];
	$email = $_POST['email'];
	$filename = getUsernameFromEmail($email);
	$cmnd = $_POST['cmnd'];
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];
	$medhis1 = $_POST['medhis'];
	$codeContents = '
- Họ và tên: ' . $name . '
- Giới tính: ' . ($gender) . '
- Tuổi: ' . ($dob) . '
- Số điện thoại: ' . ($numberphone) . '
- Email: ' . ($email) . '
- CMND/CCCD: ' . ($cmnd) . '
- Địa chỉ: ' . ($address) . '
- Phí thăm khám: ' . ($fees) . '
- Ngày thăm khám: ' . ($appdate) . '
- Thời gian: ' . ($time) . '
- Triệu chứng ban đầu: ' . ($medhis1);

$check = mysqli_query($con, "SELECT * FROM appointment WHERE doctorId = '$doctorid' AND appointmentDate = '$appdate' AND appointmentTime = '$time' AND doctorStatus = '1' ");
$num=mysqli_fetch_array($check);

if( $num  > 0){
	echo "<script>alert('Bác sĩ đã có lịch hẹn vào giờ đó, vui lòng hẹn giờ khác');</script>";
	echo "<script>window.location.href ='book-appointment.php'</script>";
}
else{
	$query = mysqli_query($con, "INSERT INTO appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,Address,Name,Numberphone,Email,CMND,Gender,Dob,Medhis,Images)
	 												VALUES('','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus','$address','$name','$numberphone','$email','$cmnd','$gender','$dob','$medhis1','$filename')");
		$_SESSION['id_booking'] = $con->insert_id;
		// var_dump($con->insert_id);
		// exit();
	if ($query) {
		?>
		<script>alert('Lịch khám bệnh của bạn đã được tạo')</script>
		<script>window.location.href ='booking-success.php?id=<?php echo $_SESSION['id_booking']?>'</script>
		<?php 
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>ĐĂNG KÝ KHÁM BỆNH</title>
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
	<script src="timejs/navbarclock.js"></script>
	<link rel="stylesheet" href="timejs/style.css">
	<script>
		function getdoctor(val) {
			$.ajax({
				type: "POST",
				url: "get_doctor.php",
				data: 'specilizationid=' + val,
				success: function(data) {
					$("#doctor").html(data);
				}
			});
		}
	</script>

	<script>
		function getfee(val) {
			$.ajax({
				type: "POST",
				url: "get_doctor.php",
				data: 'doctor=' + val,
				success: function(data) {
					$("#fees").html(data);
				}
			});
		}
	</script>
</head>

<body onload="startTime()">
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
								<h1 class="mainTitle">ĐĂNG KÝ KHÁM BỆNH TRỰC TUYẾN</h1>
							</div>
							<div class="col-sm-4">
								<div id="clockdate">
									<div class="clockdate-wrapper">
										<div id="clock"></div>
										<div id="date"><?php echo date('l, F j, Y'); ?></div>
									</div>
								</div>
							</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-6">
								<div class="row margin-top-30">
									<div class="col-lg-12 col-md-12">
										<div class="panel panel-white">
											<div class="panel-heading">
												<h5 class="panel-title">ĐĂNG KÝ NGAY</h5>
											</div>
											<div class="panel-body">
												<p style="color:red;"><?php echo htmlentities($_SESSION['msg1']); ?>
													<?php echo htmlentities($_SESSION['msg1'] = ""); ?></p>
												<form role="form" name="book" method="post">
													
													<div class="form-group">
														<label for="doctor">
															Bác sĩ
														</label>
														<select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
															<option value="">Chọn bác sĩ</option>
															<?php $ret = mysqli_query($con, "SELECT * FROM doctors");
															while ($row = mysqli_fetch_array($ret)) {
															?>
																<option value="<?php echo htmlentities($row['id_doctor']); ?>">
																	<?php echo htmlentities($row['doctorName']); ?>
																</option>
															<?php } ?>
														</select>
													</div>
													<div class="form-group">
														<label for="consultancyfees">
															Phí khám bệnh
														</label>
														<select name="fees" class="form-control" id="fees" readonly>
														</select>
													</div>
													<div class="form-group">
														<label for="AppointmentDate">
															Ngày thăm khám
														</label>
														<input class="form-control datepicker" name="appdate" required="required" data-date-format="yyyy-mm-dd">
													</div>
													<div class="form-group">
														<label for="Appointmenttime">
															Thời gian
														</label>
														<input class="form-control" name="apptime" id="timepicker1" required="required">
													</div>

													<!--LẤY THÔNG TIN NGƯỜI DÙNG-->
													<?php 
														$sql=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
														while($data=mysqli_fetch_array($sql))
														{
													?>
													<div class="form-group">
														<label>
															Họ và tên
														</label>
														<input type="text" class="form-control" name="name" value="<?php echo htmlentities($data['fullName'])?>">
													</div>
													<div class="form-group">
														<label>Giới tính</label>
														<div class="clip-radio radio-primary">
															<?php 
																if($data['gender'] == 'Nam'){
															?>
																<input type="radio" id="rg-male" name="gender" value="nam" checked>
																<label for="rg-male">Nam</label>
																<input type="radio" id="rg-female" name="gender" value="nữ">
																<label for="rg-female">Nữ</label>
																
															<?php } else{ ?>
																<input type="radio" id="rg-male" name="gender" value="nam">
																<label for="rg-male">Nam</label>
																<input type="radio" id="rg-female" name="gender" value="nữ"  checked>
																<label for="rg-female">Nữ</label>
															<?php }?>
														</div>
													</div>
													<div class="form-group">
														<label>Tuổi</label>
														<input type="number" name="dob" class="form-control">
													</div>
													<div class="form-group">
														<label>
															Số Điện Thoại
														</label>
														<input type="number" class="form-control" name="numberphone">
													</div>
													<div class="form-group">
														<label>
															Email
														</label>
														<input type="email" class="form-control" name="email" value="<?php echo htmlentities($data['email'])?>">
													</div>
													<div class="form-group">
														<label>
															CMND / CCCD
														</label>
														<input type="text" class="form-control" name="cmnd">
													</div>
													<div class="form-group">
														<label">
															Địa chỉ thường trú
															</label>
															<input type="text" class="form-control" name="address" value="<?php echo htmlentities($data['address'])?>">
													</div>
													<?php } ?>
													<div class="form-group">
														<label>
															Triệu chứng bệnh
														</label>
														<textarea type="text" class="form-control" name="medhis" placeholder="Miêu tả Những triệu chứng, biểu hiện (nếu có)"></textarea>
													</div>
													<button type="submit" name="submit" class="btn btn-o btn-primary">
														Đăng ký ngay
													</button>

												</form>
											</div>
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

		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			startDate: '0d'
		});
	</script>
	<script type="text/javascript">
		$('#timepicker1').timepicker();
	</script>
	<!-- end: JavaScript Event Handlers for this page -->
	<!-- end: CLIP-TWO JAVASCRIPTS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>

</html>