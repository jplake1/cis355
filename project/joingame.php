<?php
	session_start();
	include 'database.php';
	$gameID = $_GET['id'];
	$userID = $_SESSION['user_id'];
	$pdo = Database::connect();
	
	$stmt = $pdo->prepare('SELECT id FROM players WHERE user_id = ?');
	$stmt->execute([$userID]);
	$temp = $stmt->fetch();
	$player_id = $temp['id'];
	
	$stmt = $pdo->prepare('UPDATE game_night SET player_id=? WHERE id=?');
	$stmt->execute(array($player_id,$gameID));
	Database::disconnect();
	header("Location: game.php");
?>