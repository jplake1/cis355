<div class="container">
		<div class="btn-group btn-group-justified">
				<a class="btn btn-primary" role="button" href="host.php" disabled="true">Host</a>
				<a class="btn btn-success" role="button" href="game.php">Game</a>
				<a class="btn btn-warning" role="button" href="player.php" >Player</a>
		</div>
	</div>
    <div class="container">
		<div class="row">
                <h3>Hosts</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Create</a>
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
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM host ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['email_address'] . '</td>';
                                echo '<td>'. $row['phone_number'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
					  </tbody>
                </table>
        </div>
    </div> <!-- /container -->