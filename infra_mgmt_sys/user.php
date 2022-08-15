<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: login.php");	
}
include('inc/header.php');
$user = $users->getUserInfo();
?>
<title>Infrastructre Management System</title>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/user.js"></script>

<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<style>
	#listUser{
		background-color: white;
	}
</style>

<div class="container">	
	<div class="row home-sections">
	<h2>Infrastructre Management System</h2>	
	<?php include('menus.php'); ?>		
	</div> 
	
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2" align="right">
				<button type="button" name="add" id="addUser" class="btn btn-success btn-xs">Add New</button>
			</div>
		</div>
	</div>
			
	<table id="listUser" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>S/N</th>
				<th>Name</th>					
				<th>Email</th>
				<th>Contact Number</th>
				<th>Created</th>
				<th>Role</th>
				<th>Department</th>
				<th>Status</th>
				<th></th>
				<th></th>				
			</tr>
		</thead>
	</table>
	
	<div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="userForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="username" class="control-label">Name*</label>
							<input type="text" class="form-control" id="userName" name="userName" placeholder="User name" required>			
						</div>
						
						<div class="form-group">
							<label for="username" class="control-label">Email*</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>			
						</div>

						<div class="form-group">
							<label for="contact_no" class="control-label">Contact Number</label>
							<input type="contact_no" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number" required>			
						</div>
						
						<div class="form-group">
							<label for="role" class="control-label">Role</label>				
							<select id="role" name="role" class="form-control">
							<option value="" selected disabled hidden>Choose Role</option>
							<option value="Admin">Admin</option>				
							<option value="Customer">Customer</option>	
							</select>						
						</div>
						
						<div class="form-group">
							<label for="department" class="control-label">Department</label>				
							<select id="department" name="department" class="form-control">
							<option value="" selected disabled hidden>Choose Department</option>
							<?php $tickets->getDepartments();?>	
							</select>						
						</div>
						
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
							<option value="" selected disabled hidden>Choose Status</option>
							<option value="1">Active</option>				
							<option value="0">Inactive</option>	
							</select>						
						</div>

						<div class="form-group">
							<label for="username" class="control-label">New Password</label>
							<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password">			
						</div>											
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="userId" id="userId" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('inc/footer.php');?>