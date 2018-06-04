<h4>{{ $tag }}<a class="pull-right pointer" onclick="getGallery('{{ URL::to("getgallery/".$userID) }}')" >Back</a></h4>
<ul class="projects-list">
@foreach($images as $key => $image)
<li>
    <div class="projects-item">
        <a href="{{ "#pr".$key}}" data-toggle="modal"><img src="{{ $image }}" class="img-responsive" alt="" /></a>
       
    </div>
</li>
@endforeach
</ul>



@foreach($images as $key => $image)
  <!-- Start Portfolio Modal Section -->
        <div class="section-modal modal fade" id="{{ "pr".$key}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ $image }}" class="img-responsive" alt="..">
                        </div>
                    </div><!-- /.row -->
                </div>                
            </div>
        </div>
        <!-- End Portfolio Modal Section -->

@endforeach