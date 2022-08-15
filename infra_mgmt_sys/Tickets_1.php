<?php

$conn = mysqli_connect("localhost","root","","infra_mgmt_sys");

if(isset($_POST['department'])){
    $department = $_POST['department'];
    $query = "SELECT id, name FROM users WHERE department='$department'";
    
    $sql = mysqli_query($conn, $query);
    ?>
    <select name="assignee" id="assignee">
        <?php
        while($row = mysqli_fetch_array($sql)){
            ?>
            <option value="<?php $row['name']?>"><?php echo $row['name'];?></option>
            <?php
        }
        ?>
    </select>
    <?php

}

?>
