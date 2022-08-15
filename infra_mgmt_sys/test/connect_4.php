<?php

$conn = mysqli_connect("localhost","root","","db");
class Ticket{

    private $db_3 = 'db_3';

    public function dbConnect() {        
        static $DBH = null;      
        if (is_null($DBH)) {              
			$connection = new mysqli(HOST, USER, PASSWORD, DATABASE);			
			if($connection->connect_error){
				die("Error failed to connect to MySQL: " . $connection->connect_error);
			} else {
				$DBH = $connection;
			}         
        }
        return $DBH;    
    }

    private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 

    function getAssignee(){

        $sqlQuery = "SELECT * FROM ".$this->db_3." WHERE department =  ";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        while($user = mysqli_fetch_assoc($result) ) {       
            echo '<option id="s1" value="' . $user['name'] . '">' . $user['name']  . '</option>';           
        }
    
    }
}



?>