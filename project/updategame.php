<?php
	require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: game.php");
    }
     
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
            $sql = "UPDATE game_night  set game_date = ?, game_time = ?, game_location =?, game_description =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($game_date,$game_time,$game_location,$game_description,$id));
            
			if($_FILES['userfile']['size'] > 0){
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
			
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);
			
				if(!get_magic_quotes_gpc()){
				$fileName = addslashes($fileName);
				}
			
				$sql = "UPDATE game_night  set file_name = ?, size = ?, type =?, content =? WHERE id = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($fileName,$fileSize,$fileType,$content,$id));
			
			}
			
			Database::disconnect();
            header("Location: game.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM game_night where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $game_date = $data['game_date'];
        $game_time = $data['game_time'];
        $game_location = $data['game_location'];
		$game_description = $data['game_description'];
		$host_id = $data['host_id'];
		$player_id = $data['player_id'];
		$file_Name = $data['file_name'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		Database::drawHeader(1);
	?>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Game</h3>
                    </div>
             
                    <form class="form-horizontal" enctype="multipart/form-data" action="updategame.php?id=<?php echo $id?>" method="post">
                      
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
                      </div>
					  <div class="control-group">
                        <label class="control-label">File Upload</label>
						<div class="controls">
							<input name="current" type="text" value="<?php echo "" . $file_Name . ""; ?>">
							<br>
							<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
							<input class="help-inline" name="userfile" type="file" id="userfile">
						</div>
					</div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn btn-danger" href="game.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>