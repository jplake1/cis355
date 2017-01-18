<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $event_descriptionError = null;
        $event_locationError = null;
        $event_dateError = null;
		$event_timeError = null;
         
        // keep track post values
        $event_description = $_POST['event_description'];
        $event_location = $_POST['event_location'];
        $event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
         
        // validate input
        $valid = true;
        if (empty($event_description)) {
            $event_descriptionError = 'Please enter Name';
            $valid = false;
        }
		
		if (empty($event_location)) {
            $event_locationError = 'Please enter Name';
            $valid = false;
        }
		
		if (empty($event_date)) {
            $event_dateError = 'Please enter Name';
            $valid = false;
        }
		
		if (empty($event_time)) {
            $event_timeError = 'Please enter Name';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO events (event_description,event_location,event_date,event_time) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($event_description,$event_location,$event_date,$event_time));
            Database::disconnect();
            header("Location: index.php");
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
                        <h3>Create an Event</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($event_descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="event_description" type="text"  placeholder="event description" value="<?php echo !empty($event_description)?$event_description:'';?>">
                            <?php if (!empty($event_descriptionError)): ?>
                                <span class="help-inline"><?php echo $event_descriptionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($event_locationError)?'error':'';?>">
                        <label class="control-label">Location</label>
                        <div class="controls">
                            <input name="event_location" type="text"  placeholder="event location" value="<?php echo !empty($event_location)?$event_location:'';?>">
                            <?php if (!empty($event_locationError)): ?>
                                <span class="help-inline"><?php echo $event_locationError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($event_date)?'error':'';?>">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input name="event_date" type="text"  placeholder="YYYY-MM-DD" value="<?php echo !empty($event_date)?$event_date:'';?>">
                            <?php if (!empty($event_dateError)): ?>
                                <span class="help-inline"><?php echo $event_dateError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($event_time)?'error':'';?>">
                        <label class="control-label">Time</label>
                        <div class="controls">
                            <input name="event_time" type="text"  placeholder="event time" value="<?php echo !empty($event_time)?$event_time:'';?>">
                            <?php if (!empty($event_timeError)): ?>
                                <span class="help-inline"><?php echo $event_timeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>