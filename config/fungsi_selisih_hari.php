<?php
function IntervalDays($CheckIn,$CheckOut){
	$CheckInX = explode("-", $CheckIn);
	$CheckOutX =  explode("-", $CheckOut);
	$date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
	$date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
	$interval =($date2 - $date1)/(3600*24);
	// returns numberofdays
	return  $interval ;
	}
?>