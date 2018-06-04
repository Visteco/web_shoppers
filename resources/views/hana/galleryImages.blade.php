<ul class="projects-list">
    <li>
       @foreach($userGallery as $userdata) 
         @if($userdata->image_Type==$img_type)
            <div class="projects-item">
                <img src="{{ URL::to('userProfilePic/user_'.$userdata->user_id.'/medium/'.$userdata->image ) }}" class="img-responsive" alt="" />
                <div class="projects-caption">
                    <h4>neha</h4>
                    <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                    <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                    <span class="glyphicon glyphicon-remove"></span>
                </div>
            </div>
         @endif
        @endforeach
    </li>
</ul>


