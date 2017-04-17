<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include 'database.php';
		include 'functions.php';
		Functions::drawHeader(0)
	?>
</head>
 
<body>
	
    <div class="container">
		<div class="row">
                <h3>Hosts</h3>
            </div>
            <div class="row">
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
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM host ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['email_address'] . '</td>';
                                echo '<td>'. $row['phone_number'] . '</td>';
								echo '<td width=250>';
								echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Read</a>';
								echo ' ';
								if($_SESSION['type'] == 1 | $_SESSION['type'] == 2){
									if($_SESSION['user_id'] == $row['user_id'] | $_SESSION['type'] == 2){
									echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
									echo ' ';
									echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
									}
								}
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
					  </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>