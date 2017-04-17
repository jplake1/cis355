<?php
	require 'database.php';
	
	if(isset($_GET['id'])){
		
		$id = $_GET['id'];
		$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM game_night where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
		
		header("Content-length: $data['size']");
		header("Content-type: $data['type']");
		header("Content-Disposition: attachment; filename=$data['file_name']");
		echo $data['content'];
		
	}
?>