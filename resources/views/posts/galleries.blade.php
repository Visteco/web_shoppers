<ul class="projects-list">



    @if(count($profilePics))
    @foreach($profilePics as $pic)
    <li>
        <div class="projects-item">
            <img src="{{ $pic }}" class="img-responsive" alt="" />
            <div class="projects-caption">
                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/3/".$userID) }}', 'portfolio')">Profile Pics</h4>
            </div>
        </div>
    </li>
    @endforeach
    @endif

    @if(count($coverPics))
    @foreach($coverPics as $pic)
    <li>
        <div class="projects-item">
            <img src="{{ $pic }}" class="img-responsive" alt="" />
            <div class="projects-caption">
                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/4/".$userID) }}', 'portfolio')" >Cover Pics</h4>
            </div>
        </div>
    </li>
    @endforeach
    @endif


    @if(count($serviceImages))
    @foreach($serviceImages as $pic)
    <li>
        <div class="projects-item">
            <img src="{{ $pic }}" class="img-responsive" alt="" />
            <div class="projects-caption">
                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/2/".$userID) }}', 'portfolio')">Services</h4>
            </div>
        </div>
    </li>
    @endforeach
    @endif

    @if(count($postImages))
    @foreach($postImages as $pic)
    <li>
        <div class="projects-item">
            <img src="{{ $pic }}" class="img-responsive" alt="" />
            <div class="projects-caption">
                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/1/".$userID) }}', 'portfolio')">Uploads</h4>
            </div>
        </div>
    </li>
    @endforeach
    @endif




</ul>