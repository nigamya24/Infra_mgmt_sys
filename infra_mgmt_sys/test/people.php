<?php
include('inc/header.php');
?>
<title>Infrastructre Management System</title>

<link rel="stylesheet" href="css/style.css" />

<head>
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
                <h2>User Particulars</h2>
            </div>
            <div class="form1">
            <form action="connect_2.php" method="POST">
                <div class="form-group">
                    <label for="name" class="control-Label">Name*</label>
                    <br><input type="text" id="name" class="control-form" placeholder="Name" require*>
                </div>
                <div class="form-group"> 
                    <label for="email" class="control-Label">Email*</label>
                    <br><input type="text" class="control-form" id="email" name="email" placeholder="Email" required>
                        
                </div>
                <div class="form-group">
                    <label for="contact" class="control-Label">Contact Number</label>
                    <br><input type="tel" class="control-form" id="contact" name="contact" placeholder="Contact Number">
                </div>
                <div class="form-group">
                    <label for="department" class="control-Label">Department</label>
                    <br><select name="department" id="department" class="control-form" required>
                        <option value="" selected disabled hidden>Choose Department</option>
                        <option value="technical">Techinal</option>
                        <option value="Operations">Operations</option>
                        <option value="Application Managenemt">Application Management</option>
                        <option value="Dev Ops">Dev OPs</option>
                    </select>
                    </select>
                </div>
                
                <div class="form-group">
					<label for="role" class="control-label">Role</label>				
					<br><select id="role" name="role" class="control-form">
				    	<option value="" selected disabled hidden>Choose Role</option>
					    <option value="admin">Admin</option>				
						<option value="user">Customer</option>	
					</select>						
				</div>

                <div class="form-group">
					<label for="status" class="control-label">Status</label>				
					<br><select id="status" name="status" class="control-form">
						<option value="" selected disabled hidden>Choose Status</option>
						<option value="1">Active</option>				
						<option value="0">Inactive</option>	
					</select>						
				</div>

				<div class="form-group"
					<label for="username" class="control-label">New Password</label>
					<br><input type="password" class="control-form" id="newPassword" name="newPassword" placeholder="Password">			
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