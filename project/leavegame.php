<?php
	include 'database.php';
	$gameID = $_GET['id'];
	$pdo = Database::connect();
	$stmt = $pdo->prepare('UPDATE game_night SET player_id = NULL WHERE id = ?');
	$stmt->execute([$gameID]);
	Database::disconnect();
	echo $gameID;
	header("Location: game.php");
?>