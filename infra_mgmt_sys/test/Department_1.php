<?php
include('inc/header.php');
?>
<title>Infrastructre Management System</title>

<link rel="stylesheet" href="css/style.css" />


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
                <h2>Department Particulars</h2>
            </div>
            <div class="form1">
            <form action="connect.php" method="POST">
                <div class="form-group">
                    <label for="dept_name" class="control-Label">Department Name</label>
                    <br><input type="text" id="dept_name" name="dept_name" class="control-form" placeholder="Department Name" required>
                <div class="form-group">
                    <label for="status" class="control-label">Status</label>
                    <br><select name="status" id="status" class="control-form" required>
                        <option value="" selected disabled hidden>Choose Status</option>
                        <option value="Direct">Enable</option>
                        <option value="Walk-In">Diable</option>
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