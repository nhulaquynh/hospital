//Kiểm tra lịch hẹn trùng
<?php
$check = mysqli_query($con, "SELECT * FROM appointment WHERE doctorId = '$doctorid' AND appointmentDate = '$appdate' AND appointmentTime = '$time' AND doctorStatus = '1' ");
$num=mysqli_fetch_array($check);

if( $num  > 0){
	echo "<script>alert('Bác sĩ đã có lịch hẹn vào giờ đó, vui lòng hẹn giờ khác');</script>";
	echo "<script>window.location.href ='book-appointment.php'</script>";
	// $data = [
	// 	//LƯU LẠI THÔNG TIN TẠM
	// 	$ss_date = $_SESSION['appdate'],
	// 	$ss_time = $_SESSION['apptime'],
	// 	$ss_name = $_SESSION['name'],
	// 	$ss_age = $_SESSION['dob'],
	// 	$ss_age = $_SESSION['numberphone'],
	// 	$ss_cmnd = $_SESSION['cmnd'],
	// 	$ss_address = $_SESSION['address'],
	// 	$ss_medhis1 = $_SESSION['medhis']
	// ];
}
else{
	$query = mysqli_query($con, "INSERT INTO appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,Address,Name,Numberphone,Email,CMND,Gender,Dob,Medhis,Images)
	 												VALUES('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus','$address','$name','$numberphone','$email','$cmnd','$gender','$dob','$medhis1','$filename')");
		$_SESSION['id_booking'] = $con->insert_id;
	if ($query) {
		QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5);
		echo "<script>alert('Lịch khám bệnh của bạn đã được tạo');</script>";
		echo "<script>window.location.href ='booking-success.php'</script>";

	}
}
?>