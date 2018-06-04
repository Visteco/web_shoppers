@foreach ($updateAd as $row)
<form name="adboard" method="POST" id="adboard" action="{{ URL::to('adboardUpdate/'.$row->Advertisement_id ) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<div class="row">
    <div class="col-md-6">

        

        <label>Advertisement Title</label>
        <input type="text" class="form-control"  placeholder="Title *" id="title" name="title" value='{{ $row->title }}'  required data-validation-required-message="Please enter Title.">
        <p class="help-block text-danger"></p>
        <label>Advertisement Time</label>
        <?php $timeAd = $row->time; ?>
        <select name="time" id="time" class="form-control" required>
            <option value="">Time</option>

            @for ($i = 1; $i <= 30; $i++)

            <option  value="{{ $i }}" <?php if ($timeAd == $i) echo 'selected="selected"'; ?>>{{ $i }} Day</option>
            @endfor

        </select>
        <p class="help-block text-danger"></p>

        <label>Upload Image/Paste </label>
        <select name="codeitem" id="codeitem" class="form-control" required>
            <option value="">Select Option</option>

            <option value="1" <?php if ($row->image != '' or $row->image != NULL) echo 'selected="selected"'; ?>>Upload Image</option>
            <option value="2" <?php if ($row->url != '' or $row->url != NULL) echo 'selected="selected"'; ?>>Paste Code</option>
        </select>
        <p class="help-block text-danger"></p>


        <div id="imageShow" <?php if ($row->image == '' or $row->image == NULL) echo 'style="display: none"'; ?>>    
            <label>Advertisement Image</label>
            <input type="file" placeId="adimg" class="imgInp form-control" placeholder="" name="image" id="image">
            <p class="help-block text-danger"></p>
        </div>                                            
        
    </div>
    <div id="showImage" class="col-md-6" <?php if ($row->image == '' or $row->image == NULL) echo 'style="display: none"'; ?>>
            <img id="adimg" src="{{ URL::to('/') }}/images/adboard/{{ $row->image }}" alt=""  class="showimg"/>
        </div>
</div>	
<div class="row" <?php if ($row->image == '' or $row->image == NULL) echo 'style="display: none"'; ?>>
    <div class="col-md-12" id="imageDesc" <?php if ($row->image == '' or $row->image == NULL) echo 'style="display: none"'; ?>>
        <label>Advertisement Description</label>
        <textarea class="form-control" id="description" name="description" >{{ $row->description }}</textarea>
        <p class="help-block text-danger"></p>
    </div>
</div>
<div class="row" id="codeUrlShow" <?php if ($row->url == '' or $row->url == NULL) echo 'style="display: none"'; ?>>
    <div class="col-md-12">
        <label>Advertisement URL</label>
        <input type="text" class="form-control" placeholder="URL" id="url" name="url" value='{{ $row->url }}'>
        <p class="help-block text-danger"></p>
    </div>
</div>
@endforeach
<div class="row">                               
    <div class="col-md-12">
        <input type="submit" class="skybtn" value="Submit">
        <p>&nbsp;</p>
    </div>
</div>

</form>
<script>
$(document).ready(function () {
            
        $('#codeitem').change(function () {
            var e = document.getElementById("codeitem");
            var strUser = e.options[e.selectedIndex].value;
            if (strUser == 1)
            {
                $('#imageShow').show();
                $('#imageDesc').show();
                $('#showImage').show();
                $('#codeUrlShow').hide();
                uploadImageFunction();
            } else if (strUser == 2)
            {
                $('#imageShow').hide();
                $('#imageDesc').hide();
                $('#showImage').hide();
                $('#codeUrlShow').show();
                codePasteFunction();
            }
            else
            {
                $('#imageShow').hide();
                $('#imageDesc').hide();
                $('#codeUrlShow').hide();
                
            }
        });
    });
</script>