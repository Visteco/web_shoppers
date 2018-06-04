<!-- Modal -->
<div class="modal fade model_offset in sarv-model" id="postjob" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h3>Post Your Jobs</h3>
				<label>Its Free, Enjoy more...!!</label>
			</div>
			<form method="POST" action="{{ URL::to('company/jobs') }}">
                        {{ csrf_field() }}
			<div class="modal-body">
				<div class="form-group">
					<label for="usr">Job Title/Profile :</label>
					<input id="jobtitle" name="jobtitle" type="text" class="form-control" placeholder="Enter">
				</div>
				<div class="form-group">
					<label for="pwd">About The Company :</label>
					<textarea id="aboutcomp" name="aboutcomp" class="form-control" placeholder="Enter"></textarea>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="usr">Desired Experience :</label>
						<input id="experience" name="experience" type="text" class="form-control" placeholder="Enter">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Job Location :</label>
						<input id="location" name="location" type="text" class="form-control" placeholder="Enter">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="usr">Course Specialization :</label>
						<input id="specialization" name="specialization" type="text" class="form-control" placeholder="Enter">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Salary :</label>
						<input id="salary" name="salary" type="text" class="form-control" placeholder="Enter">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="usr">Industry :</label>
						<input id="industry" name="industry" type="text" class="form-control" placeholder="Enter">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Interview Process :</label>
						<input id="interviewprocess" name="interviewprocess" type="text" class="form-control" placeholder="Enter">
					</div>
				</div>
				<div class="form-group">
					<label for="usr">Skills & Experience :</label>
					<textarea id="skills" name="skills" class="form-control" placeholder="Enter"></textarea>
				</div>
				<div class="form-group">
					<label for="usr">Job Description :</label>
					<textarea id="desc" name="desc" class="form-control" placeholder="Enter"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Post</button>
			</div>			
			</form>
		</div>
	</div>
</div>