<?php
	show_source(__FILE__);
	
	$a = $_GET['a'];
	$b = $_GET['b'];
	$c = $_GET['c'];
	$d = $_GET['d'];
	
	$q = sqrt((2 * $b * $b * $b - 9 * $a * $b * $c + 27 * $a * $a * $d) * (2 * $b * $b * $b - 9 * $a * $b * $c + 27 * $a * $a * $d) - 4 * ($b * $b - 3 * $a * $c) * ($b * $b - 3 * $a * $c) * ($b * $b - 3 * $a * $c));

	$bigC = pow(.5 * ($q + 2 * $b * $b * $b - 9 * $a * $b * $c + 27 * $a * $a * $d),1/3);
	
	$x = (0 - $b / ( 3 * $a)) - ($bigC / ( 3 * $a)) - (($b * $b - 3 * $a * $c) / (3 * $a * $bigC));
	
	echo "<br>";
	echo "Q = ";
	echo $q;
	echo "<br>";
	echo "C = ";
	echo $bigC;
	echo "<br>";
	echo "First root = ";
	echo $x;

?>