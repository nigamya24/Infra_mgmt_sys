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
						<label for="department" class="control-label">Department</label>							
						<select id="department" name="department" class="form-control" placeholder="Department...">					
						<option value="" selected disabled hidden>Choose Department</option>	
						<?php $tickets->getDepartments(); ?>
						</select>						
					</div>						
					<div class="form-group">
						<label for="message" class="control-label">Message</label>							
						<textarea class="form-control" rows="5" id="message" name="message"></textarea>							
					</div>	
					<div class="form-group">
						<label for="impact" class="control-label">Impact</label>							
						<select id="impact" name="impact" class="form-control" placeholder="Impact..." required>					
						<option value="" selected disabled hidden>Choose Impact</option>
                        <option value="Extensive/Widespread">Extensive/Widespread</option>
                        <option value="Significant/Large">Significant/Large</option>
                        <option value="Moderate/Limited">Moderate/Limited</option>
                        <option value="Minor/Localized">Minor/Localized</option>
						</select>						
					</div>
					<div class="form-group">
						<label for="Urgency" class="control-label">Urgency</label>							
						<select id="urgency" name="urgency" class="form-control" placeholder="Urgency..." required>					
						<option value="" selected disabled hidden>Choose Urgency</option>
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
						</select>						
					</div>	
					<div class="form-group">
						<label for="status" class="control-label">Status</label>							
						<label class="radio-inline">
							<input type="radio" name="status" id="open" value="0" checked required>Open
						</label>
						<?php if(isset($_SESSION["admin"])) { ?>
							<label class="radio-inline">
								<input type="radio" name="status" id="close" value="1" required>Close
							</label>
						<?php } ?>
						<label for="sub-status" class="control-label">Sub Status</label>
                    	<br><select name="sub-status" id="sub-status" class="control-form" required>
                        <option value="" selected disabled hidden>Choose Sub Status</option>
                        <option value="In-Progess">In-Progess</option>
                        <option value="Pending">Pending</option>
                        <option value="Assigned">Assigned</option>
                    	</select>	
					</div>
					<div class="form-group">
                    	
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