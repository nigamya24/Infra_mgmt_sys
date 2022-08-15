<?php
include('inc/header.php');
?>
<title>Infrastructre Management System</title>

<link rel="stylesheet" href="css/style.css" />
<script>
    function show(e){
    var yes = document.getElementById("open");
    var ss = document.getElementById("sub-status");
    ss.disabled = yes.checked ? false : true;
    if(!ss.disabled){
        ss.focus();
    }
}

    function show_1(e){
        var no = document.getElementById("close");
        var ss = document.getElementById("sub-status");
        if(no.checked == true){
            ss.disabled = true;
        }
}

    function show_2(e){
        var impact1 = document.getElementById("impact");
        var impact = impact1.options[impact1.selectedIndex].text;
        var urgency1 = document.getElementById("urgency");
        var urgency = urgency1.options[urgency1.selectedIndex].text;
        var priority = document.getElementById("priority");

        if(impact == 'Extensive/Widespread'  && urgency == 'Critical' || impact == 'Extensive/Widespread'  && urgency == 'High'){
            priority.setAttribute('value', 'Critical');
        }

        else if (impact == 'Significant/Large'  && urgency == 'Critical'  || impact == 'Significant/Large'  && urgency == 'High'){
            priority.setAttribute('value', 'High');
        }

        else if (impact == 'Moderate/Limited'  && urgency == 'Critical'  || impact == 'Moderate/Limited'  && urgency == 'High' || impact == 'Moderate/Limited' && urgency == 'Medium'){
            priority.setAttribute('value', 'Medium');
        }

        else if (impact == 'Minor/Localized'  && urgency == 'Critical'  || impact == 'Minor/Localized'  && urgency == 'High' || impact == 'Minor/Localized' && urgency == 'Medium' || impact == 'Minor/Localized' && urgency == 'Low'){
            priority.setAttribute('value', 'Low');
        }
}

</script>
<script>
    $(document).ready(function(){
    $("#department").change(function(){
        var department = $(this).val();
        $.ajax({
            url: "connect_5.php",
            method: "POST",
            data: {department:department},
            success:function(data){
                $("#assignee").html(data);
            }
        });
    });
});
</script>

<style>
    .form{
        align-items: center;
        background-color: white;
        justify-content: center;
        padding-left: 300px;
        padding-top: 20px;
        margin-top: 50px;
        
    }

    .form-group{
        align-items: center;
        justify-content: center;
        padding-right: 500px;

    }

    .form1{
        padding-top: 20px;
    }
</style>
</head>
<body style="background-image: url(./pic3.jpg);">
    <div class="container">
        <div class="form" style="min-height:500px; ">
            <div>
                <h2>Incident Particulars</h2>
            </div>
            <div class="form1">
            <form action="connect.php" method="POST">
                <div class="form-group">
                    <label for="customer" class="control-Label">Customer</label>
                    <br><select name="customer" id="customer" class="control-form" required>
                        <option value="" selected disabled hidden>Choose Customer</option>
                        <option value="customer 1">customer 1</option>
                        <option value="customer 2">customer 2</option>
                        <option value="customer 3">customer 3</option>
                        <option value="customer 4">customer 4</option>
                    </select>
                </div>
                <div class="form-group"> 
                    <label for="subject" class="control-Label">Subject</label>
                    <br><input type="text" class="control-form" id="subject" name="subject" placeholder="Subject" required>
                        
                </div>
                <div class="form-group">
                    <label for="department" class="control-Label">Department</label>
                    <br><select name="department" id="department" class="control-form"  required>
                        <option value="" selected disabled hidden>Choose Department</option>                                                
                        <?php

                            $conn = mysqli_connect("localhost","root","","db");
                            $query = "SELECT DISTINCT (department) as department from db_3";
                            $rs = $conn->query($query);
                            while($rs1=$rs->fetch_assoc()){
                            echo "<option value=$rs1[department]>$rs1[department]</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="assignee" class="control-label">Assignee</label>
                    <br><select name='assignee' id='assignee' class="control-form" required>
                    <option value="" selected disabled hidden>Choose Assignee</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="impact" class="control-label">Impact</label>
                    <br><select name="impact" id="impact" class="control-form" required  onchange="show_2()">
                        <option value="" selected disabled hidden>Choose Impact</option>
                        <option value="Extensive/Widespread">Extensive/Widespread</option>
                        <option value="Significant/Large">Significant/Large</option>
                        <option value="Moderate/Limited">Moderate/Limited</option>
                        <option value="Minor/Localized">Minor/Localized</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="urgency" class="control-label">Urgency</label>
                    <br><select name="urgency" id="urgency" class="control-form" required  onchange="show_2()">
                        <option value="" selected disabled hidden>Choose Urgency</option>
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priority" class="control-label">Priority</label>
                    <br><input type="text" class="control-form" id="priority" name="priority" placeholder="Priority" disabled>
                </div>
                <div class="form-group">
                    <label for="incident-type" class="control-label">Incident Type</label>
                    <br><select name="incident-type" id="incident-type" class="control-form" required>
                        <option value="" selected disabled hidden>Choose Incident Type</option>
                        <option value="Direct">Direct</option>
                        <option value="Walk-In">Walk-In</option>
                        <option value="Call">Call</option>
                        <option value="Email">Email</option>
                    </select>
                </div>  
                
                <div class="form-group">
                    <label for="summary" class="control-label">Summary</label>
                    <textarea class="form-control" id="summary" col="50" rows="6" name="summary" placeholder="Summary"></textarea>
                </div>  
                <div class="form-group">
                    <label for="status" class="control-label">Status</label>
                        <div>
                        <label class="radio-inline">
                        <input type="radio" name="status" id="open" value="0" required onclick="show()">Open</label>
                        <label for="status" class="control-label">
                        <input type="radio" name="status" id="close" value="1" required onclick="show_1()">Close</label>
                        </div>
                </div>
                <div class="form-group">
                    <label for="sub-status" class="control-label">Sub Status</label>
                    <br><select name="sub-status" id="sub-status" class="control-form" required disabled>
                        <option value="" selected disabled hidden>Choose Sub Status</option>
                        <option value="In-Progess">In-Progess</option>
                        <option value="Pending">Pending</option>
                        <option value="Assigned">Assigned</option>

                    </select>
                </div>
                   
                <div class="modal-footer">
                    <input type="submit" name="save" id="save" class="btn-default" value="Save" />

                </div>
            </form>
        </div>
    </div>
</body>
<?php
include('inc/footer.php');
?>
