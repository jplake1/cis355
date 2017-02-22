<?php

ini_set('file-uploads',true);
if($_FILES['file1']['size']>0 && $_FILES['file1']['size']<2000000){
		
		$filename=$_FILES['file1']['name'];
		$tempname=$_FILES['file1']['tmp_name'];
		$filesize=$_FILES['file1']['size'];
		$filetype=$_FILES['file1']['type'];
		
		$filetype = (get_magic_quotes_gpc() == 0
			? mysql_real_escape_string($filetype)
			: mysql_real_escape_string(stripslashes($_FILES['file1'])));
		
		
		$fp = fopen($tempname, 'r');
		$content = fread($fp, filesize($tempname));
		$content = addslashes($content);
		
		echo 'filename : ' . $filename . '<br>';
		echo 'size : ' . $filesize . '<br>';
		echo 'type : ' . $filetype . '<br>';
	
		fclose($fp);
		
		
		if(!get_magic_quotes_gpc()) {
			$filename = addslashes($filename);			
		}
		
		$con = mysql_connect('localhost','jplake1','Stealme1') or die (mysql_error());
		
		$db = mysql_select_db('jplake1',$con);
		if($db) {
			$query = "INSERT INTO customers (name, size, type, content) VALUES ('$filename', '$filesize', '$filetype', '$content')";
			mysql_query($query) or die('query failes');
			mysql_close();
			echo "upload successful";
		}
		else echo "upload failed: " . mysql_error();
}
?>