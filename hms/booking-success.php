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
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>THÀNH CÔNG</title>
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

	<!-- <script>
		function getbooking(val) {
			$.ajax({
				type: "POST",
				url: "get_booking.php",
				data: 'specilizationid=' + val,
				success: function(data) {
					$("#booking").html(data);
				}
			});
		}
	</script> -->

	<script src="timejs/navbarclock.js"></script>
	<link rel="stylesheet" href="timejs/style.css">
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
							<h1 class="mainTitle">ĐẶT LỊCH HẸN THÀNH CÔNG!</h1>
							<br>
						</div>
						<div class="row" >
							<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-radius: 16px;">
										<div class="well profile col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 text-center">
												<?php
													$get = mysqli_query($con, "SELECT * FROM appointment INNER JOIN doctors ON  appointment.doctorId = doctors.id_doctor ORDER BY  appointment.id DESC LIMIT 1");
													// var_dump(mysqli_fetch_array($get));
                                                    // exit();
                                                    while($row = mysqli_fetch_array($get)){
													
														$filename = $row['Images'];				
													echo '<img src="temp/' . @$filename . '.png" style="width:200px; height:200px;"><br>';
													echo '<a class="btn btn-primary submitBtn" style="width:200px; margin:5px 0;"
													href="download.php?file=' . $filename . '.png ">Download QR Code</a>';
												?>
											</div>
											
											<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
												<div class="row"  style="margin-top: 10px">
													<h5 style="overflow-wrap: break-word;">
														
															<?php 
																if($row['userStatus'] == 1 && $row['doctorStatus'] == 1){
																	echo '<small class="label label-success">Đã duyệt</small>';
																}
																else{echo '<small class="label label-warning">Chờ duyệt</small>' ;}   
															?>
															</small>
													</h5>
													<h5 id="user-frid">Mã lịch hẹn: 
													<?php echo $row['id']?></h5>
													<h5 >Bệnh nhân:
														<strong id="user-name" style="text-transform: uppercase">
															<?php echo $row['Name']?> - <?php echo $row['Dob']?> tuổi
														</strong>
													</h5>

													<h5 style="overflow-wrap: break-word;">Bác sĩ: 
														<strong><?php echo $row['doctorName']?></strong>
													</h5>
													<h5 style="overflow-wrap: break-word;">Thời gian: <small class="label label-default"><?php echo $row['appointmentTime']?></small> ngày: <small class="label label-default"><?php echo date('d/m/Y', strtotime($row['appointmentDate']))?></small></h5>
													<h5 style="padding-top: 5px">Triệu chứng:  <?php echo $row['Medhis']?></h5>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			</section>
		</div>
	</div>
	</div>
	</div>
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