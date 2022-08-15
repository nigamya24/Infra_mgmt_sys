<?php

$subject=$_POST['subject'];
$department=$_POST['department'];
$impact=$_POST['impact'];
$urgency=$_POST['urgency'];
$incident_type=$_POST['incident-type'];
$summary=$_POST['summary'];
$status=$_POST['status'];
$sub_status=$_POST['sub-status'];

$conn = mysqli_connect("localhost","root","","db");

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

if(isset($_POST['save'])){
    if($conn->connect_error){
        die('Connect Failed :' .$conn->connect_error);
    }
    else{
        
        if(mysqli_query($conn,"INSERT INTO db_1 (subject, department, impact, urgency,incident_type, summary, status, sub_status, priority)
         VALUES ('$subject','$department','$impact','$urgency','$incident_type', '$summary','$status','$sub_status', '$priority')")
        ){
            echo "Success";
            echo $priority;
        }
                       
    }
    $conn->close();
}



?>

