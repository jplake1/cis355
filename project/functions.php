<?php

class Functions{
	
	public static function drawHeader($pageType)
	{
	session_start();
	//echo 'Session User ID is :' . $_SESSION["user_id"];
		if (!isset($_SESSION['user_id']))
			{
			header("location: login.php");
			}
		echo '<meta charset="utf-8">';
		echo '<link   href="css/bootstrap.min.css" rel="stylesheet">';
		echo '<script src="js/bootstrap.min.js"></script>';
		echo '<div class="container">';
		echo '<div class="btn-group btn-group-justified">';
		
		switch ($pageType){
			
			case 0 :
				echo '<a class="btn btn-primary" role="button" href="host.php" disabled="true" >Host</a>';
				echo '<a class="btn btn-success" role="button" href="game.php">Game</a>';
				echo '<a class="btn btn-warning" role="button" href="player.php">Player</a>';
				echo '<a class="btn btn-danger" role="button" href="logout.php">Logout</a>';
				break;
				
			case 1 :
				echo '<a class="btn btn-primary" role="button" href="host.php" >Host</a>';
				echo '<a class="btn btn-success" role="button" href="game.php" disabled="true" >Game</a>';
				echo '<a class="btn btn-warning" role="button" href="player.php">Player</a>';
				echo '<a class="btn btn-danger" role="button" href="logout.php">Logout</a>';
				break;
				
			case 2 :
				echo '<a class="btn btn-primary" role="button" href="host.php" >Host</a>';
				echo '<a class="btn btn-success" role="button" href="game.php">Game</a>';
				echo '<a class="btn btn-warning" role="button" href="player.php" disabled="true" >Player</a>';
				echo '<a class="btn btn-danger" role="button" href="logout.php">Logout</a>';
				break;
				
			default:
				echo '<a class="btn btn-primary" role="button" href="host.php" >Host</a>';
				echo '<a class="btn btn-success" role="button" href="game.php">Game</a>';
				echo '<a class="btn btn-warning" role="button" href="player.php">Player</a>';
				echo '<a class="btn btn-danger" role="button" href="logout.php">Logout</a>';
		}
		
		echo '</div>';
		echo '<h3>Welcome back ' . $_SESSION['name'] . '!</h3>';
		echo '</div>';
		
	}
	

}



?>