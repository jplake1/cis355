<?php
mysql_connect("localhost","jplake1","Stealme1");
mysql_select_db("jplake1");
if(isset($_GET['id'])) { // if id is set then get the file with the id from database
$id = $_GET['id'];
$query = "SELECT file_name, type, size, content FROM game_night WHERE id = $id";
$result = mysql_query($query) or die('Error, query failed');
list($file_name, $type, $size, $content) =
mysql_fetch_array($result);
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$file_name");
echo $content; exit;
}
header("Location: game.php");
?>
	