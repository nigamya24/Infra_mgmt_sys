<?php

$conn = mysqli_connect("localhost","root","","db");

if(isset($_POST['login'])){
    if($conn->connect_error){
        die('Connect Failed : ' .$conn->connect_error);
    }
    else{
        
        $uemail = $_POST['email'];
        $password = $_POST['password'];
        $uemail = stripcslashes($uemail);
        $password = stripcslashes($password);
        
        $uemail = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if($uemail !="" & $password !=""){
            
            $sql_query = "SELECT * from db_2 where email='".$uemail."' and password='".$password."'";
            $rs = mysqli_query($conn,$sql_query);
            $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
            $count = mysqli_num_rows($rs);

            if($count == 1){
                echo "Success";
                $_SESSION['email']=$uemail;
                header("location: homepage_1.php");
            }
            else{
                echo " Invalid";
            }
        }
    }
}

?>