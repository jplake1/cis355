<?php
	include 'database.php';
	
	$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($_GET['date']){
			$sql = "SELECT game_date, game_description, game_location, game_time FROM game_night WHERE game_date = '" . $_GET['date'] . "'";
		}
		else {
			$sql = "SELECT game_date, game_description, game_location, game_time FROM game_night";
		}
		
		$arr = array();
		foreach ($pdo->query($sql) as $row) {
			array_push($arr, $row['game_date'] . ", " . $row['game_time'] . ", " . $row['game_location'] . ", " . $row['game_description']);
		}
		
		Database::disconnect();
		
		echo '["Games: "' . json_encode($arr) . ']';

?>