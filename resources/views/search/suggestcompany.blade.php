
@foreach($users as $user)
<?php 

if( empty($user->logo_img) ){
    $profilepic = URL::to("images/user.png");
}else{
    $profilepic = URL::to("userimages/user_".$user->uid."/medium/".$user->logo_img);
}

?>

<li class="list-group-item clearfix pointer" onclick="set('{{ $user->company_name }}','{{ $user->uid }}')">
    
    <div class="people-img pointer">
        <a><img src="{{ $profilepic }}" class="img-responsive" alt=""></a>
    </div>
   
    <div class="people-item pointer">
        <div class="people_name pointer"><a>{{ $user->company_name }}</a></div>
        <div class="people_des">{{ $user->company_type }}</div>
    </div>
    
    <!--<button class="followbtn" onclick="doFollow('{{ $user->follow_link }}',this)">Follow</button>-->
    
</li>
@endforeach
<script type="text/javascript">
    function set(company_name,uid){
        document.getElementById("company_name_id").value=company_name;
        document.getElementById("company_uid").value=uid;
        document.getElementById("suggestion_id2").innerHTML="";
    }
</script>
