<table class="table table-striped tbl_list">
    <tbody>
        
       @if(count($users)) 
       @foreach($users as $user)
            <tr>
                <td>
                    <img src="images/people/p8.jpg" alt="">
                    <strong> Ankur Sharma </strong><button class="skybtn pull-right">Follow</button>
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
