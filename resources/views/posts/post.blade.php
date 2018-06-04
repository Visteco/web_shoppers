<?php
$emoticons = session('emoticons');
?>
<!---------single_post 1--------->
<div class="single_post" id="{{ 'post_'.$post->post_id }}">
    <div class="user_post_info"><a href="#" class="pro-pic"><img src="{{ $post->profilepic }}"></a>
        @if($post->role == COMPANY_PROFILE)
            <h2>{{ ucwords($post->posted_company_name) }} <br>
            <span>{{ $post->post_created_date }}</span></h2>
        @elseif($post->role == USER_PROFILE)
            <h2>{{ ucwords($post->user_name) }} <br>
            <span>{{ $post->post_created_date }}</span></h2>
        @endif
    </div>

    <div class="user_post_right"><img src="{{url('public/asset/plugins/dist/images/publish.png')}}"></div>
    @if($post->post_type == SERVICE_POST)
        @include('posts.service')
    @else
        @if($post->post_type == INTERNAL_POST)
            @if($post->content_type == TYPE_IMAGE && $post->post_image)
                @if(count(explode(",",$post->post_image)) > 1)
                    <?php 
                        $post_image_arr = explode(",",$post->post_image);
                        $total_image = count($post_image_arr)-1;
                        $img_countt = (count($post_image_arr) == 4)?count($post_image_arr):$total_image;
                        $minus_hight = (count($post_image_arr) == 4 || count($post_image_arr) == 5)?30:0;
                        // $minus_hight = (count($post_image_arr) == 4)?30:((count($post_image_arr) == 5)?30:0);
                        $main_height = $img_countt*200-$minus_hight;
                        $main_height_style = 'style=height:'.$main_height.'px;';
                    ?>
                    <div class="post-div" {{$main_height_style}}>
                        @foreach($post_image_arr as $key => $post_image)
                        <?php 
                            $public_image = file_exists(public_path('images/posts/'.$post_image))?'public/images':'images';
                            $first_class = ($key == 0)?'post-image-first':'post-image-after-first';

                            $most_width = ($key != 0)?round(100/2,4):'0';
                            if($total_image == 2){
                                $width = ($key == 0)?'width:50%;':'width:'.$most_width.'%;';
                                $height = ($key == 0)?'height:400px;padding-right: 5px;':'height:195px;padding-left:5px;';
                            }else if($total_image == 1){
                                $width = ($key == 0)?'width:50%;':'width:'.$most_width.'%;';
                                $height = ($key == 0)?'height:200px;padding-right:5px;':'height:200px;padding-left:5px;';
                            }else{
                                $width = ($key == 0)?'width:100%;':'width:'.$most_width.'%;';
                                $padding = ($key != 0 && $key % 2 == 0)?'padding-left:5px;':'padding-right:5px';
                                $height = ($key == 0)?'height:350px;'.$padding.'':'height:200px;'.$padding.'';
                                //$main_height = 
                            }
                            $style = $width.$height;
                        ?>
                        <div class="post_image {{$first_class}}" style ="{{$style}}">
                            <img src="{{ URL::to($public_image.'/posts/'.$post_image) }}"> 
                        </div>
                        @endforeach
                    </div>
                @else
                    <?php $public_image = file_exists(public_path('images/posts/'.$post->post_image))?'public/images':'images';?>
                    <div class="post_image">
                        <img src="{{ URL::to($public_image.'/posts/'.$post->post_image) }}"> 
                    </div>
                @endif

            @elseif($post->content_type == TYPE_VIDEO)
                @if(count(explode(",",$post->post_video)) > 1)
                    <?php 
                        $post_video_arr = explode(",",$post->post_video);
                        $total_video = count($post_video_arr)-1;
                        $video_countt = (count($post_video_arr) == 4)?count($post_video_arr):$total_video;
                        $minus_hight = (count($post_video_arr) == 4 || count($post_video_arr) == 5)?30:0;
                        $main_height = $video_countt*200-$minus_hight;
                        $main_height_style = 'style=height:'.$main_height.'px;';
                    ?>
                    <div class="post-div" {{$main_height_style}}>
                        @foreach($post_video_arr as $key => $post_video)
                            <?php 
                                $public_video = file_exists(public_path('images/posts/'.$post_video))?'public/images':'images'; 
                                $first_class = ($key == 0)?'post-image-first':'post-image-after-first';
                                $most_width = ($key != 0)?round(100/2,4):'0';
                                if($total_video == 2){
                                    $width = ($key == 0)?'width:50%;':'width:'.$most_width.'%;';
                                    $height = ($key == 0)?'height:400px;padding-right: 5px;':'height:195px;padding-left:5px;';
                                }else if($total_video == 1){
                                    $width = ($key == 0)?'width:50%;':'width:'.$most_width.'%;';
                                    $height = ($key == 0)?'height:200px;padding-right:5px;':'height:200px;padding-left:5px;';
                                }else{
                                    $width = ($key == 0)?'width:100%;':'width:'.$most_width.'%;';
                                    $padding = ($key != 0 && $key % 2 == 0)?'padding-left:5px;':'padding-right:5px';
                                    $height = ($key == 0)?'height:350px;'.$padding.'':'height:200px;'.$padding.'';
                                    //$main_height = 
                                }
                                $style = $width.$height;
                            ?>
                            <div class="post_image {{$first_class}}" style ="{{$style}}">
                                <video width="100%" height="400" controls>
                                    <source src="{{ URL::to($public_video.'/posts/'.$post_video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endforeach
                    </div>
                @else
                    <?php $public_video = file_exists(public_path('images/posts/'.$post->post_video))?'public/images':'images'; ?>
                    <div class="post_image">
                        <video width="100%" height="400" controls>
                            <source src="{{ URL::to($public_video.'/posts/'.$post->post_video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
            @endif 
        @elseif($post->post_type == EXTERNAL_POST)
            @if($post->content_type == TYPE_IMAGE)  
                <div class="post_image">
                    <a href="{{ $post->external_link }}" target='_blank'>
                        <img src="{{ $post->post_image }}">
                    </a>
                </div>    
            @elseif($post->content_type == TYPE_VIDEO)
                <div class="post_image">
                    <iframe  src="{{ $post->external_link }}" frameborder="0" allowfullscreen style='width:100%;height:300px;'></iframe>
                </div>
            @endif
        @endif
        <div class="post_heading">
            <h2>{{$post->post_content}}</h2>
            <p>#buzzfeedanimals #dog #doggie #dogsofinstagram #maltese #malshi #shihtzu #boo #instagramdogs #surpised #hi #love #malshi #shihtzu #boo #instagramdogs #surpised #hi #love</p>
        </div>
    @endif
    <div class="public_filed">
        <div class="sumup_left">
            <ul class="follow_us">
            <!----------like---------------->
                @if($post->likedByMe) 
                    <li class="open_list">
                        <div class="likes"> <i class="fa fa-star active_like" id="{{ 'like_text_'.$post->post_id }}" onclick="likeObject('{{ URL::to('like/'.$post->post_id."/".POST_LIKE) }}','{{ 'like_text_'.$post->post_id }}','{{ 'like_count_'.$post->post_id }}')" aria-hidden="true"></i> Like <comment id='{{ 'like_count_'.$post->post_id }}'>{{$post->like_count}}</comment></div>
                    </li>
                @else
                    <li class="open_list">
                        <div class="likes"> <i id="{{ 'like_text_'.$post->post_id }}" onclick="likeObject('{{ URL::to('like/'.$post->post_id."/".POST_LIKE) }}','{{ 'like_text_'.$post->post_id }}','{{ 'like_count_'.$post->post_id }}')" class="fa fa-star user-post-like" aria-hidden="true"></i> Like <comment id='{{ 'like_count_'.$post->post_id }}'>{{$post->like_count}}</comment></div>
                    </li>
                @endif
                <!----------like----------------><!----------comment---------------->
                <li class="open_list">
                    <div class="comment_box">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-commenting-o" aria-hidden="true"></i> Comment 5 <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <div class="user_post_info"><a href="#"><img src="{{ $post->profilepic }}"></a>
                                    <h2>Kittu Rathor <br>
                                    <span>1 hour ago</span></h2>
                                </div>
                                <div class="user_post_right"><img src="{{url('public/asset/plugins/dist/images/publish.png')}}"></div>
                                <li class="dropdown-submenu comment2">
                                    <i onclick="myFunction(this)" class="fa fa-star"></i> Like 0
                                    <a class="test" tabindex="-1" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Reply <span class="caret"></span></a>
                                    <ul class="dropdown-menu reply">
                                        <form>
                                            <input type="text" placeholder="Write a Reply">
                                        </form>
                                    </ul>
                                </li>
                                <form class="write">
                                    <a href="#"><img src="{{ $post->profilepic }}"></a>
                                    <input type="text" class="cmnt_description" post_id="{{ $post->post_id }}" parent_id="{{ 'cmnt_father_'.$post->post_id }}" id="{{'post_cmnt_'.$post->post_id}}" contenteditable="true" placeholder="Write a Comment.....">
                                </form>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-------------end comment-----------------><!-------------share----------------->
                <li class="open_list">
                    <div class="share">
                        <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i><span>Share 2</span></a>
                    </div>
                </li>
                <!-------------end share----------------->
            </ul>
        </div>
        <div class="sumup_right"><a href="#">
            <i class="fa fa-bookmark-o" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
<!---------end single_post 1---------> 
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