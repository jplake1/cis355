<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
	<body>
	</body>
    <?php
        include 'database.php';
        Database::displayTable();
		Database::populateTable();
    ?>
</html>