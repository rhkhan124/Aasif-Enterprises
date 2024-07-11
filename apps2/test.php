<?php
$time1 = strtotime('08:00:00 AM');
$time2 = strtotime('09:30:00 PM');
$difference = round(abs($time2 - $time1) / 3600,2);
echo $difference;

?>







