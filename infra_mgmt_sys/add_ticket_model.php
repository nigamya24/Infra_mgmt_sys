<script>

$(document).ready(function(){

function loadData(){
	$.ajax({
		url : "Ticket_1.php",
		type : "POST",
		success : function(data){
			$("#dept").append(data);
		}
	});
}

loadData();

});

	function show(e){
    var yes = document.getElementById("open");
    var ss = document.getElementById("sub_status");
    ss.disabled = yes.checked ? false : true;
    if(!ss.disabled){
        ss.focus();
    }
}

function show_1(e){
        var no = document.getElementById("close");
        var ss = document.getElementById("sub_status");
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

    if(impact == 'Extensive/Widespread'  && urgency == 'Critical'){
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
		$("#dept").change(function(){
			var department = $("#dept").val();
			$.ajax({
				url: "Tickets_1.php",
				method: "POST",
				data: {department : department},
				success:function(data){
					$("#assignee").html(data);
				}
        	});
    	});
	});

	
</script>

<div id="ticketModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="ticketForm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Ticket</h4>
				</div>
					<div class="modal-body">
					<div class="form-group">
						<label for="customer" class="control-label">Customer</label>							
						<select id="customer" name="customer" class="form-control" placeholder="Customer...">					
						<option value="" selected disabled hidden>Choose Customer</option>	
						<?php $tickets->getUsers(); ?>
						</select>						
					</div>	
					<div class="form-group">
						<label for="subject" class="control-label">Subject</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>			
					</div>
											
					<div class="form-group">
						<label for="message" class="control-label">Message</label>							
						<textarea class="form-control" rows="5" id="message" name="message"></textarea>							
					</div>	
					<div class="form-group">
						<label for="impact" class="control-label">Impact</label>							
						<select id="impact" name="impact" class="form-control" placeholder="Impact..." required onchange="show_2()">					
						<option value="" selected disabled hidden>Choose Impact</option>
                        <option value="Extensive/Widespread">Extensive/Widespread</option>
                        <option value="Significant/Large">Significant/Large</option>
                        <option value="Moderate/Limited">Moderate/Limited</option>
                        <option value="Minor/Localized">Minor/Localized</option>
						</select>						
					</div>
					<div class="form-group">
						<label for="Urgency" class="control-label">Urgency</label>							
						<select id="urgency" name="urgency" class="form-control" placeholder="Urgency..." required onchange="show_2()">					
						<option value="" selected disabled hidden>Choose Urgency</option>
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
						</select>						
					</div>
					<div class="form-group">
						<label for="priority" class="control-label">Priority</label>
						<br><input type="text" class="form-control" id="priority" name="priority" placeholder="Priority" disabled>
					</div>	
					<div class="form-group">
						<label for="status" class="control-label">Status</label>							
						<label class="radio-inline">
							<input type="radio" name="status" id="open" value="0" onclick="show()" required>Open
						</label>
						<?php if(isset($_SESSION["admin"])) { ?>
							<label class="radio-inline">
								<input type="radio" name="status" id="close" value="1" required onclick="show_1()">Close
							</label>
						<?php } ?>	
					</div>
					<div class="form-group">
						<label for="sub_status" class="control-label">Sub Status</label>
						<br><select name="sub_status" id="sub_status" class="form-control" required disabled>
							<option value="" selected disabled hidden>Choose Sub Status</option>
							<option value="In-Progess">In-Progess</option>
							<option value="Pending">Pending</option>
							<option value="Assigned">Assigned</option>

						</select>
					</div>

					<div class="form-group">
						<label for="dept" class="control-label">Department</label>							
						<select id="dept" name="dept" class="form-control" placeholder="Department...">					
						<option value="" selected disabled hidden>Choose Department</option>	
						<?php
							$conn = mysqli_connect("localhost","root","","infra_mgmt_sys");
                            $query = "SELECT * FROM departments WHERE status='1'";
                            $rs = mysqli_query($conn,$query);
                            while($rs1=$rs->fetch_assoc()){
                            echo "<option value=$rs1[name]>$rs1[name]</option>";
                            }?>
						</select>						
					</div>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="ticketId" id="ticketId" />
					<input type="hidden" name="action" id="action" value="" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>