<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
	<div class="container">
		<div class="btn-group btn-group-justified">
				<a class="btn btn-primary" role="button" href="host.php" >Host</a>
				<a class="btn btn-success" role="button" href="game.php" disabled="true" >Game</a>
				<a class="btn btn-warning" role="button" href="player.php">Player</a>
		</div>
	</div>
    <div class="container">
            <div class="row">
                <h3>Game Night</h3>
            </div>
            <div class="row">
                <p>
                    <a href="creategame.php" class="btn btn-success">Create</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Location</th>
                          <th>Time</th>
						  <th>Host</th>
						  <th>Player</ht>
						  <th>Action<th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbo<tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM game_night ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['game_date'] . '</td>';
                                echo '<td>'. $row['game_description'] . '</td>';
                                echo '<td>'. $row['game_location'] . '</td>';
								echo '<td>'. $row['game_time'] . '</td>';
								$tempFlag = true;
								$tempSQL = "SELECT name FROM host WHERE id='".$row['host_id']."'";
								foreach ($pdo->query($tempSQL) as $row2) {
									$tempFlag = false;
									echo '<td>'. $row2['name'] . '</td>';
									}
								if($tempFlag){
									echo '<td></td>';
								}
								$tempSQL = "SELECT name FROM players WHERE id='".$row['player_id']."'";
								$tempFlag = true;
								foreach ($pdo->query($tempSQL) as $row3) {
									$tempFlag = false;
									echo '<td>'. $row3['name'] . '</td>';
									}
								if($tempFlag){
									echo '<td></td>';
								}
                                echo '<td width=250>';
                                echo '<a class="btn" href="readgame.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="updategame.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deletegame.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>