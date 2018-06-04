<li class="clearfix">
    <div class="service_box col-md-12 no-gutter">
        <div class="service_image">
            <img src="{{ URL::to('images/services/'.$post->service->image) }}" class="img-responsive">
            <ul class="service_soc">
                <li>
                    <a href=""><i class="glyphicon glyphicon-thumbs-up"></i> <span> Like</span></a>
                </li>
                <li>
                    <div class="star_review">
                        <div class="star_disabled"></div>
                        <div class="star_active"></div>
                    </div>
                </li> 
            </ul>
        </div>
        <div class="service_content">
            <a href=""><h4>{{ $post->service->service_title }}</h4></a>
            <p>{{ $post->service->service_decription }}</p>
        </div>
    </div>
</li>