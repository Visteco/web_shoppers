<!-- Modal -->
<div class="modal fade model_offset in sarv-model" id="forgotpass" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h3>Forgot Password</h3>
				<label>Password send in your email ID.</label>
			</div>
			<form id="forgotPassword" action="{{ URL::to('forgotpassword') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
			<div class="modal-body">
				<div class="form-group">
					<label for="usr">User Email Id:</label>
					<input type="mail" name="email" class="form-control" placeholder="Enter Email Id">
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Send Password</button>
			</div>			
			</form>
		</div>
	</div>
</div>