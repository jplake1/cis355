<?php
class Database
{
    private static $dbName = 'jplake1' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'jplake1';
    private static $dbUserPassword = 'Stealme1';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
	
	public static function populateTable()
	{
		$pdo = Database::connect();
		$sql = 'SELECT * FROM customers ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['email'] . '</td>';
                                echo '<td>'. $row['mobile'] . '</td>';
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
	}
	
	public static function displayTable()
	{
		echo '<body><div class="container"><div class="row"><h3>PHP CRUD Grid</h3></div><div class="row"><p> <a href="create.php" class="btn btn-success">Create</a></p><table class="table table-striped table-bordered"><thead><tr><th>Name</th><th>Email Address</th><th>Mobile Number</th><th>Action</th></tr></thead><tbody></tbody></table></div></div></body>';
		
	}
}
?>