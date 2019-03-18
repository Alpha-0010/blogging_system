<?php 
date_default_timezone_get("Asia/Kolkata");
$current_time=time();
$datetime=strftime('%B-%d-%Y %H:%M:%S',$current_time);
echo $datetime;
?>