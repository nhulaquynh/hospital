<?php
	session_start();
	error_reporting(0);
	include('include/config.php');
	include('include/checklogin.php');
	check_login();
	if(isset($_GET['del']))
		{
			$sql=mysqli_query($con,"UPDATE  appointment  SET userStatus = '0', doctorStatus= '0' WHERE id='".$_GET['id']."'");
			$_SESSION['msg']="Lịch hẹn đã hủy!";

			}
//DUYỆT LỊCH HẸN
if(isset($_GET['ok'])){
	$bid = intval($_GET['id']);

	//Lấy dữ liệu lịch hẹn cần duyệt
	$check = mysqli_query($con, "SELECT * FROM appointment WHERE id=$bid");
	// var_dump($check);
	// exit();
	if($num = mysqli_fetch_array($check)){
		$id = $num['id'];
		$doctorSpecialization = $num['doctorSpecialization'];
		$doctorId = $num['doctorId'];
		$appointmentDate = $num['appointmentDate '];
		$appointmentTime = $num['appointmentTime'];
		// $postingDate = $num['postingDate'];
		$doctorStatus = $num['doctorStatus'];
		// var_dump($appointmentDate);
		// exit();
		$ql = mysqli_query($con, "SELECT * FROM appointment WHERE doctorSpecialization = '$doctorSpecialization'
																										AND doctorId = '$doctorId'
																										AND appointmentDate = '$appointmentDate'
																										AND appointmentTime = '$appointmentTime'
																										AND doctorStatus = '1'
																										");
		$exe = mysqli_fetch_array($sql);
		
		if($exe > 0 ){
			echo "<script>alert('Bác sĩ đã có lịch hẹn vào giờ đó, vui lòng hẹn giờ khác');</script>";
			echo "<script>window.location.href ='book-unaccept.php'</script>";
		}
		else{
			$sql=mysqli_query($con,"UPDATE  appointment  SET userStatus = '1', doctorStatus= '1' WHERE id= $bid ");
			
			$_SESSION['id_booking'] = $con->insert_id;
			if ($query) {
				QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5);
				echo "<script>alert('Lịch khám bệnh của bạn đã được tạo');</script>";
				$_SESSION['msg']="Duyệt thành công!";
				echo "<script>window.location.href ='appointment-history.php'</script>";
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>LỊCH HẸN ĐANG CHỜ</title>
		<meta charset="utf-8">
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
			<?php include('include/sidebar.php');?>
			<div class="app-content">
				

					<?php include('include/header.php');?>
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-10">
									<h1 class="mainTitle">LỊCH HẸN ĐANG CHỜ DUYỆT</h1>
								</div>		
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">						
							<div class="row">
								<div class="col-md-12">									
									<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
									<?php echo htmlentities($_SESSION['msg']="");?></p>
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">STT</th>
												<th class="hidden-xs">Tên bệnh nhân</th>
												<th>Email</th>
												<th>Thời gian đăng ký</th>
												<th>CMND/CCCD</th>
												<th>Triệu chứng ban đầu (Nếu có)</th>
												<th>Người đặt</th>
												<th>Trạng thái</th>	
											
											</tr>
										</thead>
										<tbody>
											<?php
												$sql=mysqli_query($con,"SELECT * FROM appointment INNER JOIN doctors ON appointment.doctorId =doctors.id_doctor WHERE appointment.doctorStatus = '2' ");
												$cnt=1;
												while($row=mysqli_fetch_array($sql))
												{
											?>
											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs">
                                                    <?php echo $row['Name'];?>
                                                    <br>
                                                    Tuổi: <?php echo $row['Dob'];?> 
                                                    <br>
                                                   Giới tính: <?php echo $row['Gender'];?>
                                                </td>
												<td><?php echo $row['Email'];?></td>
												<td><?php echo date('d/m/Y', strtotime($row['appointmentDate']))?> - <?php echo $row['appointmentTime'];?></td>
												<td><?php echo $row['CMND'];?></td>
												<td><?php echo $row['Medhis'];?></td>
												<td>
													<?php 
														$sql = mysqli_query($con, "SELECT * FROM appointment INNER JOIN nurses ON appointment.userId = nurses.id_nurse WHERE appointment.id =' ".$row['id']." ' ");
														$execute = mysqli_fetch_array($sql);
														if($execute['nurseName'] == NULL){
															echo 'Đặt qua hệ thống';
														}else{
															echo 'Nhân viên: ' .$row['nurseName']; }?>
												</td>
												<td>
													<!---XEM CHI TIẾT-->
													<a  data-toggle="modal" data-target="#exampleModal<?php $row['id']?>">
														<i class="fa fa-eye"></i>
													</a>
													
													<a href="edit-booking.php?id=<?php echo $row['id']; ?>" class="nav-link" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i>
													</a>

													<a href="booking-unaccept.php?id=<?php echo $row['id'] ?>&ok=okok" onClick="return confirm('Bạn có muốn duyệt lịch hẹn này?')" class="nav-link" tooltip-placement="top" tooltip="Edit"><i class="fa fa-check"></i>
													</a>

													<a href="booking-unaccept.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Bạn có muốn xóa lịch hẹn này?')" class="nav-link" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i>
													</a>
													<!-- Modal -->
													<div class="modal fade" id="exampleModal<?php $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">CHI TIẾT LỊCH HẸN</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body text-center">
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
																<h5 style="overflow-wrap: break-word;" id="user-email">Chuyên khoa: <?php echo $row['doctorSpecialization']?> </h5>
																<h5 style="overflow-wrap: break-word;">Thời gian: <small class="label label-success"><?php echo $row['appointmentTime']?></small> ngày: <small class="label label-success"><?php echo date('d/m/Y', strtotime($row['appointmentDate']))?></small></h5>
																<h5 style="padding-top: 5px">Triệu chứng:  <small class="label label-warning"><?php echo $row['Medhis']?></small></h5>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
															</div>
														</div>
													</div>
													
													
                                                        
                                                    
													<!--END-->

													<!--DUYỆT-->

													<!--END-->

													<!--HỦY-->

													<!--END-->
												</td>
												
												
											</tr>
											<?php 
												$cnt=$cnt+1;
												}
											?>	
										</tbody>
									</table>
								</div>
							</div>
						</div>	
						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->	
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
        </div>
			 <?php include('include/footer.php');?> 
			<!-- end: FOOTER -->
			<!-- start: SETTINGS -->
			<?php include('include/setting.php');?>
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
