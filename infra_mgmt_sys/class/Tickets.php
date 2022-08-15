<?php

class Tickets extends Database {  
    private $ticketTable = 'tickets';
	private $ticketRepliesTable = 'ticket_replies';
	private $departmentsTable = 'departments';
	private $userTable = 'users';
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function showTickets(){
		$sqlWhere = '';	
		if(!isset($_SESSION["admin"])) {
			$sqlWhere .= " WHERE t.user = '".$_SESSION["userid"]."' ";
			if(!empty($_POST["search"]["value"])){
				$sqlWhere .= " and ";
			}
		} else if(isset($_SESSION["admin"]) && !empty($_POST["search"]["value"])) {
			$sqlWhere .= " WHERE ";
		} 		
		$time = new time;  			 
		$sqlQuery = "SELECT t.id, t.uniqid, t.title, t.init_msg as message, t.date, t.last_reply, t.resolved, t.priority as priority, u.name as creater, t.department as department, u.user_type, t.user, t.user_read, t.admin_read, t.customer as customer, t.sub_status as sub_status
			FROM tickets t 
			LEFT JOIN users u ON t.user = u.id
			LEFT JOIN departments d ON t.department = d.id $sqlWhere ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' (uniqid LIKE "%'.$_POST["search"]["value"].'%" ';					
			$sqlQuery .= ' OR title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR last_reply LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		
			$ticketRows = array();			
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}
			$disbaled = '';
			if(!isset($_SESSION["admin"])) {
				$disbaled = 'disabled';
			}			

			$ticketRows[] = $ticket['uniqid'];
			$ticketRows[] = $title;
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['creater']; 
			$ticketRows[] = $ticket['customer'];			
			$ticketRows[] = $ticket['date'];
			$ticketRows[] = $status;
			$ticketRows[] = $ticket['sub_status'];
			$ticketRows[] = $ticket['priority']; 
			$ticketRows[] = '<a href="view_ticket.php?id='.$ticket["uniqid"].'" class="btn btn-success btn-xs update">View Ticket</a>';	
			$ticketRows[] = '<button type="button" name="update" id="'.$ticket["id"].'" class="btn btn-warning btn-xs update" >Edit</button>';
			$ticketRows[] = '<button type="button" name="delete" id="'.$ticket["id"].'" class="btn btn-danger btn-xs delete"  '.$disbaled.'>Close</button>';
			
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}	
	public function getRepliedTitle($title) {
		$title = $title.'<span class="answered">Answered</span>';
		return $title; 		
	}
	public function createTicket() {      
		
		$urgency=$_POST['urgency'];
		$impact=$_POST['impact'];

		if($impact === 'Extensive/Widespread'  && $urgency === 'Critical'){
			$priority = 'Critical';
		}

		elseif ($impact === 'Significant/Large'  && $urgency === 'Critical'  || $impact === 'Significant/Large'  && $urgency === 'High'){
			$priority = 'High';
		}

		elseif ($impact === 'Moderate/Limited'  && $urgency === 'Critical'  || $impact === 'Moderate/Limited'  && $urgency === 'High' || $impact === 'Moderate/Limited' && $urgency === 'Medium'){
			$priority = 'Medium';
		}

		elseif ($impact === 'Minor/Localized'  && $urgency === 'Critical'  || $impact === 'Minor/Localized'  && $urgency === 'High' || $impact === 'Minor/Localized' && $urgency === 'Medium' || $impact === 'Minor/Localized' && $urgency === 'Low'){
			$priority = 'Low';
		}

		if(!empty($_POST['subject']) && !empty($_POST['message'])) {                
			$date = new DateTime();
			$date = $date->getTimestamp();
			$uniqid = uniqid();                
			$message = strip_tags($_POST['subject']);              
			$queryInsert = "INSERT INTO ".$this->ticketTable." (uniqid, user, customer, title, init_msg, department, last_reply, user_read, admin_read, resolved, priority,sub_status) 
			VALUES('".$uniqid."', '".$_SESSION["userid"]."', '".$_POST['customer']."', '".$_POST['subject']."', '".$_POST['message']."', '".$_POST['dept']."', '".$_SESSION["userid"]."', 0, 0, '".$_POST['status']."', '$priority', '".$_POST['sub_status']."')";			
			mysqli_query($this->dbConnect, $queryInsert);			
			echo 'success ' . $uniqid;
		} else {
			echo '<div class="alert error">Please fill in all fields.</div>';
		}
	}	
	public function getTicketDetails(){
		if($_POST['ticketId']) {	
			$sqlQuery = "
				SELECT * FROM ".$this->ticketTable." 
				WHERE id = '".$_POST["ticketId"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}
	public function updateTicket() {
		if($_POST['ticketId']) {	

			$urgency=$_POST['urgency'];
			$impact=$_POST['impact'];

			if($impact === 'Extensive/Widespread'  && $urgency === 'Critical'){
				$priority = 'Critical';
			}

			elseif ($impact === 'Significant/Large'  && $urgency === 'Critical'  || $impact === 'Significant/Large'  && $urgency === 'High'){
				$priority = 'High';
			}

			elseif ($impact === 'Moderate/Limited'  && $urgency === 'Critical'  || $impact === 'Moderate/Limited'  && $urgency === 'High' || $impact === 'Moderate/Limited' && $urgency === 'Medium'){
				$priority = 'Medium';
			}

			elseif ($impact === 'Minor/Localized'  && $urgency === 'Critical'  || $impact === 'Minor/Localized'  && $urgency === 'High' || $impact === 'Minor/Localized' && $urgency === 'Medium' || $impact === 'Minor/Localized' && $urgency === 'Low'){
				$priority = 'Low';
			}

			$updateQuery = "UPDATE ".$this->ticketTable." 
			SET title = '".$_POST["subject"]."', department = '".$_POST["dept"]."', init_msg = '".$_POST["message"]."', resolved = '".$_POST["status"]."', priority = '$priority', sub_status = '".$_POST["sub_status"]."'
			WHERE id ='".$_POST["ticketId"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}		
	public function closeTicket(){
		if($_POST["ticketId"]) {
			$sqlDelete = "UPDATE ".$this->ticketTable." 
				SET resolved = '1'
				WHERE id = '".$_POST["ticketId"]."'";		
			mysqli_query($this->dbConnect, $sqlDelete);		
		}
	}	
	public function getDepartments() {       
		$sqlQuery = "SELECT * FROM ".$this->departmentsTable;
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while($department = mysqli_fetch_assoc($result) ) {       
            echo '<option value="' . $department['name'] . '">' . $department['name']  . '</option>';           
        }
    }	    
    public function ticketInfo($id) {  		
		$sqlQuery = "SELECT t.id, t.uniqid, t.title, t.user, t.init_msg as message, t.date, t.last_reply, t.resolved, u.name as creater, d.name as department 
			FROM ".$this->ticketTable." t 
			LEFT JOIN users u ON t.user = u.id 
			LEFT JOIN departments d ON t.department = d.id 
			WHERE t.uniqid = '".$id."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
        $tickets = mysqli_fetch_assoc($result);
        return $tickets;        
    }    
	public function saveTicketReplies () {
		if($_POST['message']) {
			$date = new DateTime();
			$date = $date->getTimestamp();
			$queryInsert = "INSERT INTO ".$this->ticketRepliesTable." (user, text, ticket_id) 
				VALUES('".$_SESSION["userid"]."', '".$_POST['message']."', '".$_POST['ticketId']."')";
			mysqli_query($this->dbConnect, $queryInsert);				
			$updateTicket = "UPDATE ".$this->ticketTable." 
				SET last_reply = '".$_SESSION["userid"]."', user_read = '0', admin_read = '0' 
				WHERE id = '".$_POST['ticketId']."'";				
			mysqli_query($this->dbConnect, $updateTicket);
		} 
	}	
	public function getTicketReplies($id) {  		
		$sqlQuery = "SELECT r.id, r.text as message, r.date, u.name as creater, d.name as department, u.user_type  
			FROM ".$this->ticketRepliesTable." r
			LEFT JOIN ".$this->ticketTable." t ON r.ticket_id = t.id
			LEFT JOIN users u ON r.user = u.id 
			LEFT JOIN departments d ON t.department = d.id 
			WHERE r.ticket_id = '".$id."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
       	$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
        return $data;
    }
	public function updateTicketReadStatus($ticketId) {
		$updateField = '';
		if(isset($_SESSION["admin"])) {
			$updateField = "admin_read = '1'";
		} else {
			$updateField = "user_read = '1'";
		}
		$updateTicket = "UPDATE ".$this->ticketTable." 
			SET $updateField
			WHERE id = '".$ticketId."'";				
		mysqli_query($this->dbConnect, $updateTicket);
	}

	public function getUsers() {       
		$sqlQuery = "SELECT * FROM ".$this->userTable." WHERE user_type='customer' ";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while($user = mysqli_fetch_assoc($result) ) {       
            echo '<option value="' . $user['name'] . '">' . $user['name']  . '</option>';           
        }
    }	

}