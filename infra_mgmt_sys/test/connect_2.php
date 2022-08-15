<?php

$name = $_POST['name'];
$email = $_POST['email'];
$contact_no = $_POST['contact_no'];
$department = $_POST['department'];
$role = $_POST['role'];
$status = $_POST['status'];
$password = $_POST['password'];


$conn = mysqli_connect("localhost","root","","db");

if(isset($_POST['save'])){
    if($conn->connect_error){
        die('Connect Failed :' .$conn->connect_error);
    }
    else{
        
        if(mysqli_query($conn,"INSERT INTO db_3 (name, email, contact_no, department, role, status, password)
         VALUES ('$name','$email','$contact_no','$department','$role', '$status','$password')")
        ){
            echo "Success";
        }
                       
    }
    $conn->close();
}

?>