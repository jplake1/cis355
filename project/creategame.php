<?php
     
    require 'database.php';
 if ( !empty($_POST)) {
        // keep track validation errors
        $game_dateError = null;
        $game_descriptionError = null;
        $game_locationError = null;
		$game_timeError = null;
	
         
        // keep track post values
        $game_date = $_POST['game_date'];
        $game_description = $_POST['game_description'];
        $game_location = $_POST['game_location'];
		$game_time = $_POST['game_time'];
		$host_id = $_POST['host_id'];
		$player_id = $_POST['player_id'];
         
        // validate input
        $valid = true;
        if (empty($game_date)) {
            $game_dateError = 'Please enter a Date';
            $valid = false;
        }
         
        if (empty($game_description)) {
            $game_descriptionError = 'Please enter a Description';
            $valid = false;
        }
         
        if (empty($game_location)) {
            $game_locationError = 'Please enter a Location';
            $valid = false;
        }
		
		if (empty($game_time)) {
            $game_timeError = 'Please enter a time';
            $valid = false;
        }
		
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO game_night (game_date,game_time,game_location,game_description,host_id,player_id) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($game_date,$game_time,$game_location,$game_description,$host_id,$player_id));
            Database::disconnect();
			header("Location: game.php");

		}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Game</h3>
                    </div>
             
                    <form class="form-horizontal" action="creategame.php?id=<?php echo $id?>" method="post">
                      
					  <div class="control-group <?php echo !empty($game_dateError)?'error':'';?>">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input name="game_date" type="text"  placeholder="YYYY-MM-DD" value="<?php echo !empty($game_date)?$game_date:'';?>">
                            <?php if (!empty($game_dateError)): ?>
                                <span class="help-inline"><?php echo $game_dateError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($game_timeError)?'error':'';?>">
                        <label class="control-label">Time</label>
                        <div class="controls">
                            <input name="game_time" type="text"  placeholder="HH:MM:SS" value="<?php echo !empty($game_time)?$game_time:'';?>">
                            <?php if (!empty($game_time)): ?>
                                <span class="help-inline"><?php echo $game_timeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($game_locationError)?'error':'';?>">
                        <label class="control-label">Location</label>
                        <div class="controls">
                            <input name="game_location" type="text" value="<?php echo !empty($game_location)?$game_location:'';?>">
                            <?php if (!empty($game_location)): ?>
                                <span class="help-inline"><?php echo $game_locationError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($game_descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="game_description" type="text" value="<?php echo !empty($game_description)?$game_description:'';?>">
                            <?php if (!empty($game_description)): ?>
                                <span class="help-inline"><?php echo $game_descriptionError;?></span>
                            <?php endif; ?>
                        </div>
                      
					  </div><div class="control-group <?php echo !empty($game_hostErrorError)?'error':'';?>">
                        <label class="control-label">Host</label>
                        <div class="controls">
							<select name="host_id">
							<?php	
								$pdo = Database::connect();
								$sql = 'SELECT * FROM host ORDER BY id DESC';
								$tempflag = true;
								foreach ($pdo->query($sql) as $row) {
										echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
								}
							?>
							</select>
						</div>
                      </div>
					  
					<div class="control-group <?php echo !empty($game_playerErrorError)?'error':'';?>">
                        <label class="control-label">Player</label>
                        <div class="controls">
							<select name="player_id">
							<?php	
								$pdo = Database::connect();
								$sql = 'SELECT * FROM players ORDER BY id DESC';
								$tempflag = true;
								foreach ($pdo->query($sql) as $row) {
									echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";	
								}
							?>
							</select>
						</div>
                    </div>
					
					
					  
                    <div class="form-actions">
                         <button type="submit" class="btn btn-success">Create</button>
                         <a class="btn" href="game.php">Back</a>
                    </div>
                    </form>
                </div>
    </div> <!-- /container -->
  </body>
</html>