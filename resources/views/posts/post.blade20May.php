<?php
$emoticons = session('emoticons');
?>

<div class="post-box clearfix" id="{{ 'post_'.$post->post_id }}">
    <ul class="post-list clearfix clearfix">
        <li><a href="{{ $post->user_link }}"><img src="{{ $post->profilepic }}"></a></li>
        @if($post->role == COMPANY_PROFILE)

        <li class="post-name">
            <a href="{{ $post->user_link }}" class="people_name">{{ ucwords($post->posted_company_name) }} </a>
            <time>{{ $post->formatted_date }}</time>
            <span class="people_des">{{ ucwords($post->posted_company_type) }} at <a href="">@if(!empty($post->posted_company_country))<img class="flag_img" src="{{ URL::to("flags/".strtolower($post->posted_company_country.".png")) }}">@endif</a></span>    
        </li>
        
        @elseif($post->role == USER_PROFILE)
        <li class="post-name">
            <a href="{{ $post->user_link }}" class="people_name">{{ ucwords($post->user_name) }} </a> 
            <time>{{ $post->formatted_date }}</time>
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
                    <a class="pointer" href="{{ URL::to('changetype/'.$post->post_id.'/'.POST_PUBLIC) }}"><span class="glyphicon glyphicon-globe"></span> Show post to everyone</a>
                </li>
                <li>
                    <a class="pointer" href="{{ URL::to('changetype/'.$post->post_id.'/'.POST_FOLLOWERS) }}"><span class="glyphicon glyphicon-user"></span> Show post to followers</a>
                </li>
                <li>
                    <a class="pointer" href="{{ URL::to('changetype/'.$post->post_id.'/'.POST_ONLYME) }}"><span class="glyphicon glyphicon-lock"></span> Show post to only me</a>
                </li>
                <li>
                    @if(Auth::user()->id == $post->uid)
                        <a class="pointer" onclick="deletePost('{{ URL::to('delpost/'.$post->post_id) }}','{{ 'post_'.$post->post_id }}')"> <span class="glyphicon glyphicon-remove"></span> Delete this post</a>                                 
                    @endif
                </li>
            </ul>
        </span>
    </ul>
    <ul class="post-item">
        <li><p>
                <?php echo $post->post_content ?> 
            </p>
        </li>
        
        @if($post->post_type == SERVICE_POST)
        
            @include('posts.service')
        
        @else
        
        <li>
            @if($post->post_type == INTERNAL_POST)

            @if($post->content_type == TYPE_IMAGE && $post->post_image)
            <?php 
                $public_image = file_exists(public_path('images/posts/'.$post->post_image))?'public/images':'images';

            ?>
            <a href="">
                <img src="{{ URL::to($public_image.'/posts/'.$post->post_image) }}">
            </a>
            @elseif($post->content_type == TYPE_VIDEO)
                <?php 
                    $public_video = file_exists(public_path('images/posts/'.$post->post_video))?'public/images':'images';

                ?>
            <video width="100%" height="400" controls>
                <source src="{{ URL::to($public_video.'/posts/'.$post->post_video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            @endif

            @elseif($post->post_type == EXTERNAL_POST)

            @if($post->content_type == TYPE_IMAGE)
            <a href="{{ $post->external_link }}" target='_blank'>
                <img src="{{ $post->post_image }}">
            </a>

            @elseif($post->content_type == TYPE_VIDEO)

                <iframe  src="{{ $post->external_link }}" frameborder="0" allowfullscreen style='width:100%;height:300px;'></iframe>

            @endif

            @endif

        </li>
        @endif
    </ul>
    <ul class="post-soc">

        <li>
            @if($post->likedByMe)     
            <a class="pointer active_like" id="{{ 'like_text_'.$post->post_id }}" onclick="likeObject('{{ URL::to('like/'.$post->post_id."/".POST_LIKE) }}','{{ 'like_text_'.$post->post_id }}','{{ 'like_count_'.$post->post_id }}')"><i class="glyphicon glyphicon-thumbs-up "></i><span>Like</span></a>
            <a class="pointer"  onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$post->post_id."/".POST_LIKE) }}")'><comment id='{{ 'like_count_'.$post->post_id }}'>{{$post->like_count}}</comment><i class="fa fa-caret-down"></i></a>            
            @else   
            <a class="pointer" id="{{ 'like_text_'.$post->post_id }}" onclick="likeObject('{{ URL::to('like/'.$post->post_id."/".POST_LIKE) }}','{{ 'like_text_'.$post->post_id }}','{{ 'like_count_'.$post->post_id }}')"><i class="glyphicon glyphicon-thumbs-up "></i><span>Like</span></a>
            <a class="pointer"  onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$post->post_id."/".POST_LIKE) }}")'><comment id='{{ 'like_count_'.$post->post_id }}'>{{ $post->like_count }}</comment><i class="fa fa-caret-down"></i></a>             
            @endif
        </li>

        <li class="pointer" onclick="focusComment('{{ 'post_cmnt_'.$post->post_id }}')"><i class="glyphicon glyphicon-comment"></i><span>Comment</span></li>
        
        @if($post->isBookMarked)
            
            <li id="{{URL::to("dobookmark/".$post->post_id)}}" onclick="doBookMark(this)" class="pointer active_like"><i class="glyphicon glyphicon-bookmark"></i><span>Bookmark</span></li>
            
        @else 
            
            <li id="{{URL::to("dobookmark/".$post->post_id)}}" onclick="doBookMark(this)"  class="pointer"><i class="glyphicon glyphicon-bookmark"></i><span>Bookmark</span></li>
            
        @endif
        
        
        <li onclick="sharePost('{{URL::to('sharepost/'.$post->post_id)}}','{{$post->post_id}}')" class="pointer"><i class="glyphicon glyphicon-share"></i><span>Share</span> 
        <a class="pointer"><share id="{{ 'share_post_count_'.$post->post_id }}">{{$post->share_count}}</share><i class="fa fa-caret-down"></i></a>
        </li>    
    </ul>

    <?php
    if (count($post->post_comments)) {
        $display = "block";
    } else {
        $display = "none";
    }
    ?>
<div class="post-cmnt clearfix">
    <div id="{{ 'cmnt_father_'.$post->post_id }}" style='display:{{ $display }}'>
   
    <div>    
    @if($post->post_comments->hasMorePages)    
        <a class='pointer' onclick="loadMoreComments(this,'{{ $post->post_comments->nextPageUrl}}','{{ 'cmnt_father_'.$post->post_id }}')">view <?php echo $post->post_comments->remain?> previous comments</a>    
    @endif
   </div>
        
        @foreach($post->post_comments as $comment)
        @include('posts.comment')
        @endforeach
    
   </div>
    
    <div class="post-cmnt-box clearfix">
        <ul class="post-list clearfix">
            <li>
                <a href='#'>
                    <?php $profilepic= empty(Session::get('profilepic')) ? URL::to('public/images/user.png') : URL::to('public/userimages/user_'.Auth::user()->id."/medium/".Session::get('profilepic'))  ?>
                    <img src="{{$profilepic}}">    
                </a>
            </li>
            <li class="post-name"> 
                <p class="form-control cmnt_p cmnt_description"  post_id="{{ $post->post_id }}" parent_id="{{ 'cmnt_father_'.$post->post_id }}" id="{{'post_cmnt_'.$post->post_id}}" contenteditable="true" required=""></p>
            </li>
            <span class="dropdown emog_icon">
                <span class="emg_ic dropdown-toggle pointer" type="button" data-toggle="dropdown">
                    
                    <img src="{{ URL::to('public/images/smile.png') }}"> 
                </span>
                <div class="dropdown-menu dropdown-menu-right emo_dropbox">

                    <div class="emo_box emo_box1">


                        <!--<span class="pointer" value='' onclick="addEmojies('{{'post_cmnt_'.$post->post_id}}','URL::to('public/images/emoticons/')',this)"><img src="{{ URL::to('public/images/emoticons/') }}"></span>-->


                        @foreach($emoticons[1] as $emoticon)

                        <span class="pointer" value='{{$emoticon}}' onclick="addEmojies('{{'post_cmnt_'.$post->post_id}}','{{ URL::to('public/images/emoticons/'.$emoticon)}}')">
                            <img src="{{ URL::to('public/images/emoticons/'.$emoticon) }}">
                        </span>
                        @endforeach


                    </div>


                    <div class="emo_box">

                        @foreach($emoticons[2] as $emoticon)

                        <span class="pointer" value='{{$emoticon}}' onclick="addEmojies('{{'post_cmnt_'.$post->post_id}}','{{ URL::to("public/images/emoticons/".$emoticon)}}')">
                            <img src="{{ URL::to('public/images/emoticons/'.$emoticon) }}">
                        </span>
                        @endforeach

                    </div>


                    <div class="emo_box">

                        @foreach($emoticons[3] as $emoticon)

                        <span class="pointer" value='{{$emoticon}}' onclick="addEmojies('{{'post_cmnt_'.$post->post_id}}','{{ URL::to('public/images/emoticons/'.$emoticon)}}')">
                            <img src="{{ URL::to('public/images/emoticons/'.$emoticon) }}">
                        </span>
                        @endforeach

                    </div>

                    <div class="emo_box">

                        @foreach($emoticons[4] as $emoticon)

                        <span class="pointer" value='{{$emoticon}}' onclick="addEmojies('{{'post_cmnt_'.$post->post_id}}','{{ URL::to('public/images/emoticons/'.$emoticon)}}')">
                            <img src="{{ URL::to('public/images/emoticons/'.$emoticon) }}">
                        </span>
                        @endforeach 

                    </div>

                    <div class="emo_box">
                        @foreach($emoticons[5] as $emoticon)

                        <span class="pointer" value='{{$emoticon}}' onclick="addEmojies('{{'post_cmnt_'.$post->post_id}}','{{ URL::to('public/images/emoticons/'.$emoticon)}}')">
                            <img src="{{ URL::to('public/images/emoticons/'.$emoticon) }}">
                        </span>
                        @endforeach

                    </div>


                    <div class="emo_list">
                        <ul>
                            <li class="pointer"><img src="{{ URL::to('public/images/emoticons/white_smiling_face.svg') }}" style="width:20px"></li>
                            <li class="pointer"><img src="{{ URL::to('public/images/emoticons/pouting_cat_face.svg') }}" style="width:20px"></li>
                            <li class="pointer"><img src="{{ URL::to('public/images/emoticons/raised_hand.svg') }}" style="width:20px"></li>
                            <li class="pointer"><img src="{{ URL::to('public/images/emoticons/family_(man,man,girl,girl).svg') }}" style="width:20px"></li>
                            <li class="pointer"><img src="{{ URL::to('public/images/emoticons/kimono.svg') }}" style="width:20px"></li>
                        </ul>
                    </div>
                </div>
            </span>
        </ul>
    </div>
</div>    
</div>
<script>
    $('.emo_dropbox').on({
    "click":function(e){
    e.stopPropagation();
    }
    });
    $(document).ready(function(){
    $(".emo_box").hide();
    $(".emo_box1").show();
    $(".emo_list li").click(function(){
    $(".emo_box").hide();
    var ind = $(".emo_list li").index($(this));
    $(".emo_box").eq(ind).show();
    });
    });
</script>