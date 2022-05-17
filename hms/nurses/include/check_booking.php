<?php
function check_booking()
{
if($_SESSION['id_booking'] == null)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="./book-appointment.php";		
		header("Location: http://$host$uri/$extra");
	}
}
?>