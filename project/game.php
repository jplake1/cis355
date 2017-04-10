<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include 'database.php';
		Database::drawHeader(1);
	?>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Game Night</h3>
            </div>
            <div class="row">
                <?php
					if($_SESSION['type'] == 1 | $_SESSION['type'] == 2){
						echo '<p>';
						echo '<a href="creategame.php" class="btn btn-success">Create</a>';
						echo '</p>';
					}
                ?> 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Location</th>
                          <th>Time</th>
						  <th>Host</th>
						  <th>Player</th>
						  <th>Action<th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       $pdo = Database::connect();
					   
						$userID = $_SESSION['user_id'];
						$stmt = $pdo->prepare('SELECT id FROM host WHERE user_id = ?');
						$stmt->execute([$userID]);
						$temp = $stmt->fetch();
						$host_id = $temp['id'];
						
						$stmt = $pdo->prepare('SELECT id FROM players WHERE user_id = ?');
						$stmt->execute([$userID]);
						$temp = $stmt->fetch();
						$player_id = $temp['id'];
					   
                       $sql = 'SELECT * FROM game_night ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td width=100>'. $row['game_date'] . '</td>';
                                echo '<td>'. $row['game_description'] . '</td>';
                                echo '<td>'. $row['game_location'] . '</td>';
								echo '<td>'. $row['game_time'] . '</td>';
								$tempFlag = true;
								$tempSQL = "SELECT name FROM host WHERE id='".$row['host_id']."'";
								foreach ($pdo->query($tempSQL) as $row2) {
									$tempFlag = false;
									echo '<td width=100>'. $row2['name'] . '</td>';
									}
								if($tempFlag){
									echo '<td width=100></td>';
								}
								$tempSQL = "SELECT name FROM players WHERE id='".$row['player_id']."'";
								$tempFlag = true;
								foreach ($pdo->query($tempSQL) as $row3) {
									$tempFlag = false;
									echo '<td width=100>'. $row3['name'] . '</td>';
									}
								if($tempFlag){
									echo '<td width=100></td>';
								}
								echo '<td width=250>';
                                echo '<a class="btn" href="readgame.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
								if($_SESSION['type'] == 1 | $_SESSION['type'] == 2){
									if($host_id == $row['host_id']){
										echo '<a class="btn btn-success" href="updategame.php?id='.$row['id'].'">Update</a>';
										echo ' ';
										echo '<a class="btn btn-danger" href="deletegame.php?id='.$row['id'].'">Delete</a>';
									}
									if($_SESSION['type'] == 2){
										echo '<a class="btn btn-success" href="updategame2.php?id='.$row['id'].'">Update</a>';
										echo ' ';
										echo '<a class="btn btn-danger" href="deletegame.php?id='.$row['id'].'">Delete</a>';
									}
								}
								if($_SESSION['type'] == 0){
									if($player_id == $row['player_id']){
										echo '<a class="btn btn-warning" href="leavegame.php?id='.$row['id'].'">Leave</a>';
										echo ' ';
									}
									if($row['player_id'] == null){
										echo '<a class="btn btn-warning" href="joingame.php?id='.$row['id'].'">Join</a>';
										echo ' ';
									}
								}
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?></tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>