<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
include('../libs/phpqrcode/qrlib.php');
function getUsernameFromEmail($email)
{
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}
if (isset($_POST['submit'])) {
	$bid = $_SESSION['id'];
	$tempDir = '../temp/';
	$specilization = $_POST['Doctorspecialization'];
	$doctorid = $_POST['doctor'];
	$userid = $_SESSION['id_nurse'];
	$fees = $_POST['fees'];
	$appdate = $_POST['appdate'];
	$time = $_POST['apptime'];
	$userstatus = 1;
	$docstatus = 1;
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
	echo "<script>window.location.href ='edit-booking.php'</script>";

}
else{
	$query = mysqli_query($con, "UPDATE  appointment SET doctorSpecialization = '$specilization',
                                                                                                    doctorId = '$doctorid',
                                                                                                    userId = '$userid',
                                                                                                    consultancyFees = '$fees',
                                                                                                    appointmentDate = '$appdate',
                                                                                                    appointmentTime = '$time',
                                                                                                    userStatus ='$userstatus',
                                                                                                    doctorStatus = '$docstatus',
                                                                                                    Address = '$address',
                                                                                                    Name = '$name',
                                                                                                    Numberphone = '$numberphone',
                                                                                                    Email = '$email',
                                                                                                    CMND = '$cmnd',
                                                                                                    Gender = '$gender',
                                                                                                    Dob = '$dob',
                                                                                                    Medhis = '$medhis1',
                                                                                                    Images ='$filename' 
                                                        WHERE id =$bid " );
		// var_dump($query, $bid);
		// exit();
	if ($query) {
		QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5);
		echo "<script>alert('Lịch khám bệnh của bạn đã được tạo');</script>";
		echo "<script>window.location.href ='booking-success.php'</script>";

	}
}
	
}
?>