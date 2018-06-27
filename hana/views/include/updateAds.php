<!-- Modal -->
<div class="modal fade model_offset in sarv-model" id="signup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog sarv-model" role="document">
		<div class="modal-content">
			<form>
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							 <div class="row">
                                    <div class="col-md-6">
                                        <label>Advertisement Title</label>
                                        <input type="text" class="form-control"  placeholder="Title *" id="title" name="title" required data-validation-required-message="Please enter Title.">
                                        <p class="help-block text-danger"></p>

                                        <label>Advertisement Time</label>
                                        <select name="time" id="time" class="form-control" required>
                                            <option value="">Time</option>
                                            @for ($i = 1; $i <= 30; $i++)
                                            <option value="{{ $i }}">{{ $i }} Day</option>
                                            @endfor

                                        </select>
                                        <p class="help-block text-danger"></p>
                                         
                                        <label>Upload Image/Paste </label>
                                        <select name="codeitem" id="codeitem" class="form-control" required>
                                             <option value="">Select Option</option>
                                             <option value="1">Upload Image</option>
                                             <option value="2">Paste Code</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                        
                                        
                                    <div id="imageShow">    
                                        <label>Advertisement Image</label>
                                        <input type="file" placeId="adimg" class="imgInp form-control" placeholder="" name="image" id="image">
                                        <p class="help-block text-danger"></p>
                                    </div>                                            
                                    <div class="col-md-6">
                                        <img id="adimg" src="" alt=""  class="showimg"/>
                                    </div>
                                    </div>
                                </div>	
			</div>			
			</form>
		</div>
	</div>
</div>