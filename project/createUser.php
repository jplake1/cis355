<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $passwordError = null;
		$emailError = null;
		$mobileError = null;

        // keep track post values
        $name = $_POST['userName'];
        $password = $_POST['password'];
		$passwordHash = md5($password);
		$type = $_POST['type'];
		$fullName = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter a User Name';
            $valid = false;
        }
        
        if (empty($password)) {
            $passwordError = 'Please enter a Password';
            $valid = false;
        }
		
		if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Users (user_name,password,type) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$passwordHash,$type));
			if ($type == 1){
				$stmt = $pdo->prepare('SELECT ID FROM Users WHERE user_name = ?');
				$stmt->execute([$name]);
				$temp = $stmt->fetch();
				$User_ID = $temp['ID'];
				$sql = "INSERT INTO host (name,email_address,phone_number,user_id) values(?, ?, ?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($fullName,$email,$mobile,$User_ID));
			}
			if ($type == 0){
				$stmt = $pdo->prepare('SELECT ID FROM Users WHERE user_name = ?');
				$stmt->execute([$name]);
				$temp = $stmt->fetch();
				$User_ID = $temp['ID'];
				$sql = "INSERT INTO players (name,email_address,phone_number,user_id) values(?, ?, ?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($fullName,$email,$mobile,$User_ID));
			}
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
                        <h3>Register</h3>
                    </div>
             
                    <form class="form-horizontal" action="createUser.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">User Name</label>
                        <div class="controls">
                            <input name="userName" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($fullNameErrornameError)?'error':'';?>">
                        <label class="control-label">Full Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($fullName)?$fullName:'';?>">
                            <?php if (!empty($fullNameError)): ?>
                                <span class="help-inline"><?php echo $fullNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input name="password" type="password" placeholder="**************" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Phone Number</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Host</label>
                        <div class="controls">
							<select name="type">
							<option value="0">Player</option>
							<option value="1">Host</option>
							</select>
						</div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn btn-danger" href="login.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>