
<table class="table table-striped tbl_list">
    <tbody id="flux" class="list_modal">
      
       @if(count($users)) 
      
       @foreach($users as $user)
       
       <?php
       $userName = $user->username;
       
       $profile  = $user->profilepic;
       
       $followtext = ($user->alreadyFollow > 0 ) ? "Following" : "Follow";
       
       $followLink = $user->follow_link;
       ?>
            
            <tr>
                <td width="50">
                    <img src="{{ $profile }}" alt="">
                </td>
                <td>
                    <strong>{{ $userName }}</strong>
                </td>
                <td width="100px">
                    <button class="skybtn pull-right" onclick="doFollow('{{ $followLink }}',this)">{{ $followtext }}</button>
                </td>
            </tr>
            
            
      @endforeach 
       @else
         <tr>
            
          <td>
             <div class="ntxt">
                 <strong>No user liked this post !!</strong>
             </div>
          </td>
         
        </tr>
       @endif
      
</tbody>
</table>
