
<div class="post-box clearfix" id="{{ 'post_'.$post->post_id }}">
    <ul class="post-list clearfix clearfix">
        <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
        
        
        @if($post->role == COMPANY_PROFILE)
        
        <li class="post-name">
            <a href="" class="people_name">{{ ucwords($post->posted_company_name) }}</a> <time>{{ $post->formatted_date }}</time>
            <span class="people_des">{{ ucwords($post->posted_company_type) }} at <a href="">{{ strtoupper($post->posted_company_country) }}</a></span>
        </li>
        @elseif($post->role == USER_PROFILE)
        <li class="post-name">
            <a href="" class="people_name">{{ ucwords($post->user_name) }}</a> <time>{{ $post->formatted_date }}</time>
            <span class="people_des">{{ ucwords($post->user_desig) }} at <a href="">{{ strtoupper($post->working_org) }}</a></span>
	</li>
        @endif
        
        
        <span class="dropdown">
            
            @if($post->publish_status==POST_PUBLIC)
                <span class="glyphicon dropdown-toggle glyphicon-globe" type="button" data-toggle="dropdown">
                </span>
            @elseif($post->publish_status==POST_FOLLOWERS)
                <span class="glyphicon dropdown-toggle glyphicon-user" type="button" data-toggle="dropdown">
                </span>
            @elseif($post->publish_status==POST_ONLYME)
                <span class="glyphicon dropdown-toggle glyphicon-lock" type="button" data-toggle="dropdown">
                </span>
            @endif
            
            <ul class="dropdown-menu dropdown-menu-right">
                <li>
                    <a class="pointer" href="{{ URL::to('changetype/'.$post->post_type.'/'.POST_PUBLIC) }}"><span class="glyphicon glyphicon-globe"></span> Show post to everyone</a>
                </li>
                <li>
                    <a class="pointer" href="{{ URL::to('changetype/'.$post->post_type.'/'.POST_FOLLOWERS) }}"><span class="glyphicon glyphicon-user"></span> Show post to followers</a>
                </li>
                <li>
                    <a class="pointer" href="{{ URL::to('changetype/'.$post->post_type.'/'.POST_ONLYME) }}"><span class="glyphicon glyphicon-lock"></span> Show post to only me</a>
                </li>
                <li>
                    <a class="pointer" onclick="deletePost('{{ URL::to('delpost/'.$post->post_id) }}','{{ 'post_'.$post->post_id }}')"> <span class="glyphicon glyphicon-remove"></span> Delete this post</a>                                 
                </li>
            </ul>
        </span>
    </ul>
    <ul class="post-item">
        <li><p>
             <?php echo $post->post_content ?> 
            </p>
        </li>
        <li>
             @if($post->post_type == INTERNAL_POST)
                    
                    @if($post->content_type == TYPE_IMAGE && $post->post_image)
                        <a href="">
                            <img src="{{ URL::to('images/posts/'.$post->post_image) }}">
                        </a>
                    @elseif($post->content_type == TYPE_VIDEO)

                        <video width="550" height="400" controls>
                            <source src="{{ URL::to('images/posts/'.$post->post_video) }}" type="video/mp4">
                               Your browser does not support the video tag.
                        </video>
                    @endif
                    
                    @elseif($post->post_type == EXTERNAL_POST)

                       @if($post->content_type == TYPE_IMAGE)
                        <a href="{{ $post->external_link }}" target='_blank'>
                            <img src="{{ $post->post_image }}">
                        </a>

                       @elseif($post->content_type == TYPE_VIDEO)

                            <iframe  src="{{ $post->external_link }}" frameborder="0" allowfullscreen style='width:550px;height:300px;'></iframe>

                        @endif

                   @endif
            
        </li>
    </ul>
    <ul class="post-soc">
        
        <li>
           @if($post->likedByMe)     
                <a class="pointer active_like" id="{{ 'like_text_'.$post->post_id }}" onclick="likeObject('{{ URL::to('like/'.$post->post_id."/".POST_LIKE) }}','{{ 'like_text_'.$post->post_id }}','{{ 'like_count_'.$post->post_id }}')"><i class="glyphicon glyphicon-thumbs-up "></i><span>Like</span></a> <i class="glyphicon glyphicon-badge pointer" onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$post->post_id."/".POST_LIKE) }}")' id='{{ 'like_count_'.$post->post_id }}'>{{ $post->like_count }}</i>
           @else   
                <a class="pointer" id="{{ 'like_text_'.$post->post_id }}" onclick="likeObject('{{ URL::to('like/'.$post->post_id."/".POST_LIKE) }}','{{ 'like_text_'.$post->post_id }}','{{ 'like_count_'.$post->post_id }}')"><i class="glyphicon glyphicon-thumbs-up "></i><span>Like</span></a> <i class="glyphicon glyphicon-badge pointer" onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$post->post_id."/".POST_LIKE) }}")' id='{{ 'like_count_'.$post->post_id }}'>{{ $post->like_count }}</i>
           @endif
           
           
           

         </li>

        <li><i class="glyphicon glyphicon-comment"></i><span>Comment</span></li>
        <li><i class="glyphicon glyphicon-bookmark"></i><span>Bookmark</span></li>
        <li onclick="sharePost('{{URL::to('sharepost/'.$post->post_id)}}','{{$post->post_id}}')" class="pointer"><i class="glyphicon glyphicon-share " ></i><span>Share</span> <i id="{{ 'share_post_count_'.$post->post_id }}" class="glyphicon glyphicon-badge " >{{$post->share_count}}</i></li>
    </ul>
    
    <?php if(count($post->post_comments)) { $display="block"; } else { $display="none"; }  ?>
    
    <div class="post-cmnt clearfix" id="{{ 'cmnt_father_'.$post->post_id }}" style='display:{{ $display }}'>
        @foreach($post->post_comments as $comment)
            @include('posts.comment')
        @endforeach
    </div>
    
    <div class="post-cmnt clearfix">
        <ul class="post-list clearfix">
            <li>
                <a href='#'>   
                    <img src="images/logos/1webcoir.png">    
                </a>
            </li>
            <li class="post-name"> 
                <p class="form-control cmnt_p cmnt_description" post_id="{{ $post->post_id }}" parent_id="{{ 'cmnt_father_'.$post->post_id }}" id="{{'post_cmnt_'.$post->post_id}}" contenteditable="true" required=""></p>
            </li>
            <span class="dropdown emog_icon">
                <span class="dropdown-toggle pointer" type="button" data-toggle="dropdown">
                    <img src="{{ URL::to('images/smile.jpg') }}"> 
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    @include('posts.emojies')
                    @for($i=2;$i< count($emoticons);$i++)
                    <?php continue ?>
                        <span class="pointer" value='{{$emoticons[$i]}}' onclick="addEmojies('{{'post_cmnt_'.$post->post_id}}','{{ URL::to('images/emoticons/'.$emoticons[$i])}}')"><img src="{{ URL::to('images/emoticons/'.$emoticons[$i]) }}"></span>
                    @endfor
                </div>
            </span>
        </ul>
    </div>
</div>



<!--<div class="post-box clearfix">
    <ul class="post-list clearfix clearfix">
        <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
        <li class="post-name"><a href="" class="people_name">Sarvesh Kr Yadav </a><time>Monday, 02 june 2016</time>
            <span class="people_des">Web Designer at <a href="">Webcoir IT Solutions Pvt Ltd</a></span>
        </li>
        <span class="dropdown">
            <span class="glyphicon dropdown-toggle glyphicon-globe" type="button" data-toggle="dropdown">
            </span>
            <ul class="dropdown-menu dropdown-menu-right">
                <li>
                    <a class="pointer"><span class="glyphicon glyphicon-globe"></span> Show post to everyone</a>
                </li>
                <li>
                    <a class="pointer"><span class="glyphicon glyphicon-user"></span> Show post to followers</a>
                </li>
                <li>
                    <a class="pointer"><span class="glyphicon glyphicon-lock"></span> Show post to only me</a>
                </li>
                <li>
                    <a class="pointer"> <span class="glyphicon glyphicon-remove"></span> Delete this post</a>                                 
                </li>
            </ul>
        </span>
    </ul>
    <ul class="post-item">
        <li><p>
                Visteco business network helps introduce your business to other businesses around you locally, nationally and internationally. You can now see and interconnect with businesses surrounding you in your local area much easier. Search for partnerships or introduce your services and receive feedback. Simply exchange your contacts by using Vcard technology.
            </p></li>
        <li><img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg"></li>
    </ul>
    <ul class="post-soc">
        <li><i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span></li>
        <li><i class="glyphicon glyphicon-comment"></i><span>Comment</span></li>
        <li><i class="glyphicon glyphicon-bookmark"></i><span>Bookmark</span></li>
        <li><i class="glyphicon glyphicon-share"></i><span>Share</span></li>
    </ul>
    <div class="post-cmnt clearfix">
        <ul class="post-list clearfix">
            <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
            <li class="post-name"><a href="" class="people_name">Sarvesh Kr Yadav </a><time>Monday, 02 june 2016</time>
                <span class="people_des">Web Designer at <a href="">Webcoir IT Solutions Pvt Ltd</a></span>
                <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI
                    <img src="images/people/p2.jpg" class="img-responsive" alt="">
                </p>
                <ul class="post-soc">
                    <li><i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span></li>
                    <li><i class="glyphicon glyphicon-pencil"></i><span>Reply</span></li>
                </ul>
                <div class="post-cmnt clearfix">
                    <ul class="post-list clearfix">
                        <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
                        <li class="post-name"> 
                            <p class="form-control cmnt_p" contenteditable="true" required=""></p>
                        </li>
                    </ul>
                </div>
                <ul class="post-list clearfix">
                    <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
                    <li class="post-name"><a href="" class="people_name">Sarvesh Kr Yadav </a><time>Monday, 02 june 2016</time>
                        <span class="people_des">Web Designer at <a href="">Webcoir IT Solutions Pvt Ltd</a></span>
                        <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg <img src="images/people/p4.jpg" class="img-responsive" alt="">
                        </p>
                        <ul class="post-soc">
                            <li><i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span></li>
                            <li><i class="glyphicon glyphicon-pencil"></i><span>Reply</span></li>
                        </ul>
                    </li>
                    <span class="dropdown">
                        <span class="glyphicon dropdown-toggle glyphicon-chevron-down" type="button" data-toggle="dropdown">
                        </span>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a class="pointer"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
                            </li>
                            <li>
                                <a class="pointer"><i class="glyphicon glyphicon-trash"></i>Delete</a>
                            </li>
                        </ul>
                    </span>
                </ul>
                <div class="post-cmnt clearfix">
                    <ul class="post-list clearfix">
                        <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
                        <li class="post-name"> 
                            <p class="form-control cmnt_p" contenteditable="true" required=""></p>
                        </li>
                    </ul>
                </div>
            </li>
            <span class="dropdown">
                <span class="glyphicon dropdown-toggle glyphicon-chevron-down" type="button" data-toggle="dropdown" aria-expanded="false">
                </span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a class="pointer"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
                    </li>
                    <li>
                        <a class="pointer"><i class="glyphicon glyphicon-trash"></i>Delete</a>
                    </li>
                </ul>
            </span>
        </ul>
    </div>
    <div class="post-cmnt clearfix">
        <ul class="post-list clearfix">
            <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
            <li class="post-name"> 
                <p class="form-control cmnt_p" contenteditable="true" required=""></p>
            </li>
        </ul>
    </div>
</div>--->