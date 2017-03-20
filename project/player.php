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
				<a class="btn btn-success" role="button" href="game.php">Game</a>
				<a class="btn btn-warning" role="button" href="player.php" disabled="true" >Player</a>
		</div>
	</div>
    <div class="container">
            <div class="row">
                <h3>Players</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createplayer.php" class="btn btn-success">Create</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email Address</th>
                          <th>Phone Number</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbo<tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM players ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['email_address'] . '</td>';
                                echo '<td>'. $row['phone_number'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readplayer.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="updateplayer.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteplayer.php?id='.$row['id'].'">Delete</a>';
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