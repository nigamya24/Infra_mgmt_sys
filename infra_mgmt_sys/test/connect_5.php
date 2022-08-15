<?php

$conn = mysqli_connect("localhost","root","","db");

if(isset($_POST['department'])){
    $department = $_POST['department'];
    $sql = mysqli_query($conn,"SELECT id, name FROM db_3 WHERE department='$department'");
    ?>
    <select name="assignee" id="assignee">
        <option value="">Select Assignee</option>
        <?php
        while($row = mysqli_fetch_array($sql)){
            ?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
            <?php
        }
        ?>
    </select>
    <?php
}
?>