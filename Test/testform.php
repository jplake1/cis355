<?php

	$digits = $_GET['number'];
	
	for($i = 0; $i<strlen($digits); $i++){
		$sum += $digits[$i];
	}
	
	echo "<br>The sum of the digits you entered is ", $sum;


?>