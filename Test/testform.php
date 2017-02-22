<?php

	$digits = $_GET['number'];
	$ip = $_SERVER['REMOTE_ADDR'];
	
	for($i = 0; $i<strlen($digits); $i++){
		$sum += $digits[$i];
	}
	
	echo "<br>The sum of the digits you entered is ", $sum,"<br>";
	echo "Your ip address is : ",$ip,"<br>";

	echo "<br>GET:<br>";
	print_r($_GET);
	echo "<br>POST:<br>";
	print_r($_POST);
	echo "<br>SERVER:<br>";
	print_r($_SERVER);
	echo "<br>COOKIE<br>";
	print_r($_COOKIE);
	echo "<br>FILES:<br>";
	print_r($_FILES);
	echo "<br>SESSION:<br>";
	print_r($_SESSION);
	echo "<br>REQUEST:<br>";
	print_r($_REQUEST);
	echo "<br>ENV:<br>";
	print_r($_ENV);
	echo "<br>GLOBALS:<br>";
	print_r($GLOBALS);

?>