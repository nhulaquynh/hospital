<?php
	session_start();
	error_reporting(0);
	include('include/config.php');
	include('include/checklogin.php');
	check_login();
    // var_dump($_SESSION['id_doctor']);
    // exit();
	if(isset($_GET['del']))
		{
			mysqli_query($con,"delete from appointment where id='".$_GET['id']."'");
			$_SESSION['msg']="Tài khoản đã bị xóa !";
		}

if(isset($_POST['predict'])){
	$doctorId = $_SESSION['id_doctor'];
	$userId = $_POST['userId'];
	$drug =  $_POST['medName'];
	$dose = $_POST['dose'];
	$note =   $_POST['instruct'];
	$date = $_POST['date'];
	$predict = $_POST['prediction'];	
	$userName = $_POST['Name'];
	// var_dump($doctorId , $userId, $drug, $dose, $note, $date, $predict, $userName );
	// exit();
	$sql = mysqli_query($con, "INSERT INTO prescription(doctorId, userId, drug, dose, note, date, predict, userName) VALUES ('$doctorId','$useId','$drug','$dose','$note','$date','$predict','$userName')");
	// echo $sql;
	// exit();
	if($sql){
		echo "<script>alert('Tạo toa thành công!');</script>";
        header("Location: appointment.php");
	}
}
	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>LỊCH HẸN KHÁM MỚI</title>
		<meta charset="utf-8">
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstr	ap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<script>
		// function getunit(val) {
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "include/get_unit.php",
		// 		data: 'medName=' + val,
		// 		success: function(data) {
		// 			$("#unit").html(data);
		// 			$("#instruct").html(data);
		// 		}
		// 	});
		// }
	</script>
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
								<div class="col-sm-8">
									<h1 class="mainTitle">LỊCH HẸN MỚI</h1>
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
												<th class="hidden-xs">Thông tin bệnh nhân</th>
												<th>Triệu chứng ban đầu (Nếu có)</th>
												<th>Trạng thái</th>	
                                                <th>Hành động</th>
											
											</tr>
										</thead>
										<tbody>
											<?php
												$sql=mysqli_query($con,"SELECT * FROM appointment  WHERE doctorId=' ".$_SESSION['id_doctor']." ' AND userStatus =1 AND doctorStatus = 1 ORDER BY id desc");
												$cnt=1;
												while($row=mysqli_fetch_array($sql))
												{
											?>
											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $row['Name'];?></td>
												<td><?php echo $row['Medhis'];?></td>
												<td>
													<?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														{
															echo ('<span class="label label-success">Đã duyệt</span>');
														}
														if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
														{
															echo ('<p style="color:red">Đã hủy !</p>');
														}												
													?>
												</td>
												<td>
												
													<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal<?php echo $row['userId']?>" title="Kê toa">
														<i class="fa fa-medkit"></i>
													</button>
													<!--MODAL KÊ TOA-->
													<div class="modal fade" id="exampleModal<?php echo $row['userId']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-lg" role="document">
															<div class="modal-content" style="background-color: white">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">TOA THUỐC</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form action = "appointment.php" method="POST" class="form-cotrol">
																	<div class="form-group row">
																		<div class="col-md-6 mb-3">
																		<label for="validationServer01">Họ tên</label>
																		<input type="text" class="form-control" name="Name" value="<?php echo $row['Name']?>" required>
																		<input type="hidden" name="userId" value="<?php echo $row['userId']?>" required>
																		
																		</div>
																		<div class="col-md-6 mb-3">
																		<label for="validationServer02">Tuổi</label>
																		<input type="text" class="form-control" name="Dob" value="<?php echo $row['Dob']?>" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-md-6 mb-3">
																		<label for="validationServerUsername">Di động</label>
																		<div class="input-group">
																			<input type="text" class="form-control" name="numberphone" value="<?php echo $row['Numberphone']?>" required>
																		</div>
																		</div>
																		<div class="col-md-6 mb-3">
																			<label for="validationServer02">Giới tính</label>
																			<div class="clip-radio radio-primary">
																				<?php
																					if($row['Gender'] == 'nam'){
																					
																				?>
																					<input type="radio" id="rg-male" name="gender" value="nam" checked>
																					<label for="rg-male">Nam</label>
																					<input type="radio" id="rg-female" name="gender" value="nữ">
																					<label for="rg-female">Nữ</label>
																				<?php }else {?>
																					<input type="radio" id="rg-male" name="gender" value="nam">
																					<label for="rg-male">Nam</label>
																					<input type="radio" id="rg-female" name="gender" value="nữ" checked>
																					<label for="rg-female">Nữ</label>
																				<?php }?>

																			</div>
																		</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-md-12 mb-3">
																			<label for="validationServer03">Địa chỉ</label>
																			<input type="text" class="form-control" value="<?php echo $row['Address']?>" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-md-12 mb-3">
																			<label for="validationServer03">Chẩn đoán</label>
																			<input type="text" class="form-control" name="prediction" required>
																		</div>
																	</div>
																	<hr>
																	<div class="form-group row">
																		<div class="col-md-3 mb-3">
																			<label for="validationServer03">Toa (ngày)</label>
																			<input type="number" class="form-control" name="date" required>
																		</div>
																	</div>

																	<div id="dynamic_field_append">
																		<div class="form-group row ">
																			<div class="col-md-3">
																				<label >Tên thuốc</label>
																			</div>
																			<div class="col-md-2">
																				<label for="validationServer03">Số lượng</label>
																			</div>
																			<div class="col-md-2">
																				<label for="validationServer03">Đơn vị tính</label>
																			</div>
																			<div class="col-md-3">
																				<label for="validationServer03">Liều dùng</label>
																			</div>
																			
																		</div>

																		<div class="form-group row">
																			<div class="col-md-3">
																				<select class="form-control" name="medName" id="medName" onChange="getunit(this.value);">
																					<option value="">Chọn</option>
																					<?php
																						$med = mysqli_query($con, "SELECT * FROM medicine ");
																						while($getm = mysqli_fetch_array($med)){
																					?>
																						<option value="<?php echo $getm['id_med']?>"><?php echo $getm['medName']?></option>
																					<?php } ?>
																				</select>
																			</div>

																			<div class="col-md-2">
																				<input type="number" class="form-control" name="dose" placeholder="1">
																			</div>

																			<div class="col-md-2">
																				<input type="text"  class="form-control" name="unit">
																			</div>

																			<div class="col-md-3">
																				<input type="text"  class="form-control" name="instruct">
																			</div>
																			
																			<div class="col-md-2">
																				<button type="button" name="add" id="add_field" class="btn btn-success"> Thêm (+) </button>
																			</div>

																		</div>

																		<div class="form-group row">
																	</div>
																		
																	</div>
																</div>
																	
																
															
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">HỦY</button>
																	<button type="submit" class="btn btn-primary" name="predict">KÊ TOA</button>
																</div>
															</form>
															</div>
														</div>
													</div>
													<!--END-->
													
														<button type="button" class="btn btn-default  btn-xs" data-toggle="modal" data-target="#Modal<?php echo $row['userId']?>" title="Xem toa"><i class="fa fa-eye"></i></button>

														<div class="modal fade" id="Modal<?php echo $row['userId']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-sm" role="document">
															<div class="modal-content" style="background-color: white">
															<div class="modal-header">
																<h5 class="modal-title" id="ModalLabel">TOA THUỐC</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<?php 
																	$userId=$row['userId'];
																	$get = mysqli_query($con, "SELECT * FROM prescription INNER JOIN medicine ON prescription.drug = medicine.id_med INNER JOIN appointment ON prescription.userId = appointment.userId WHERE  prescription.userId =$userId LIMIT 1");
																	// var_dump($userId);
																	// exit();
																	while($exe=mysqli_fetch_array($get)){
																?>
																		<p>Họ tên: <?php echo $exe['Name']?></p>
																		<p>Tuổi: <?php echo $exe['Dob']?></p>
																		<p>Chẩn đoán: <?php echo $exe['predict']?></p>
																		<p>Toa uống trong: <?php echo $exe['date']?> ngày</p>
																		<p>Loại thuốc: <?php echo $exe['medName']?> - <?php echo $exe['unit']?></p>
																		<p>Liều dùng: <?php echo $exe['noted']?></p>
																<?php } ?>
															</div>
															</div>
														</div>
														</div>
																				
														
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
			<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
			<!-- start: SETTINGS -->
			<?php include('include/setting.php');?>
			<!-- end: SETTINGS -->
		</div>

		<script>
          $(document).ready(function(){ 
               var i = 1;
               $('#add_field').click(function(){  
                   i++;  
                   $('#dynamic_field_append').append('<div class ="margin-top-10" id="row_remove'+i+'"><div class="form-group row "><div class="col-md-3"><label >Tên thuốc</label></div><div class="col-md-2"><label for="validationServer03">Số lượng</label></div><div class="col-md-3"><label for="validationServer03">Đơn vị tính</label></div><div class="col-md-3"><label for="validationServer03">Liều dùng</label></div></div><div class="form-group row"><div class="col-md-3"><select class="form-control" name="medName" id="medName" onChange="getunit(this.value);"><option value="">Chọn</option><?php $med = mysqli_query($con, "SELECT * FROM medicine ");while($getm = mysqli_fetch_array($med)){?><option value="<?php echo $getm['id_med']?>"><?php echo $getm['medName']?></option><?php } ?></select></div><div class="col-md-2"><input type="number" class="form-control" name="dose" placeholder="1"></div><div class="col-md-2"  id="unit" ><input type="text"  class="form-control" name="unit"></div><div class="col-md-3"  id="instruct" ><input type="text"  class="form-control" name="instruct"></div><div class="col-md-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"> Xóa (-) </button></div></div></div>');
               });
               $(document).on('click', '.btn_remove', function() {
                   var button_id = $(this).attr("id");
                   $('#row_remove'+button_id+'').remove();
               });
               $('#submit').click(function() {
                   $.ajax({
                       url:"process.php",
                       method:"POST",
                       data:$('#dynamic_form').serialize(),
                       success:function(data) {  
                           alert(data);
                           $('#dynamic_form')[0].reset();
                       }
                   });
               });
        })
;
      </script>

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
