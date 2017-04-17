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
		
		$q = $pdo->prepare($sql);
        $q->execute(array());
        $data = $q->fetchALL(PDO::FETCH_ASSOC);
		Database::disconnect();
		
		echo json_encode($data);

?>