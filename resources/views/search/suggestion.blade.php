
@foreach($users as $user)
<li class="list-group-item clearfix">
    
    <div class="people-img">
        <a href="{{ $user->user_link }}"><img src="{{ $user->profilepic }}" class="img-responsive" alt=""></a>
    </div>
    
    <div class="people-item">
        <div class="people_name"><a href="{{ $user->user_link }}">{{ $user->fname }}</a></div>
        <div class="people_des">{{ $user->pres_desg }}</div>
    </div>
    
    <!--<button class="followbtn" onclick="doFollow('{{ $user->follow_link }}',this)">Follow</button>-->
    
</li>
@endforeach

<li class="list-group-item">
    
    <a href="{{$all_link}}">See All</a>
    
</li>