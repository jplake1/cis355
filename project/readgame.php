<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: game.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM game_night where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
		include 'functions.php';
		Functions::drawHeader(0);
	?>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read a Host</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Game Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['game_date'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Game Time</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['game_time'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Game Location</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['game_location'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Game Description</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['game_description'];?>
                            </label>
                        </div>
                      </div>
					  
					  <div class="control-group">
                        <label class="control-label">Host</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php $tempFlag = true;
								$tempSQL = "SELECT name FROM host WHERE id='".$data['host_id']."'";
								foreach ($pdo->query($tempSQL) as $row2) {
									$tempFlag = false;
									echo '<td>'. $row2['name'] . '</td>';
									}
								if($tempFlag){
									echo '<td></td>';
								}?>
                            </label>
                        </div>
                      </div>
					  
					  <div class="control-group">
                        <label class="control-label">Player</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php $tempFlag = true;
								$tempSQL = "SELECT name FROM players WHERE id='".$data['player_id']."'";
								foreach ($pdo->query($tempSQL) as $row3) {
									$tempFlag = false;
									echo '<td>'. $row3['name'] . '</td>';
									}
								if($tempFlag){
									echo '<td></td>';
								}?>
                            </label>
                        </div>
                      </div>
					  
					  <div class="control-group">
                        <label class="control-label">Attached File</label>
                        <div class="controls">
                            <a href="fileDownload2.php?id=<?php echo $data['id'];?>"><?php echo $data['file_name']; ?></a>
                        </div>
                      </div>
					  
                        <div class="form-actions">
                          <a class="btn btn-danger" href="game.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>