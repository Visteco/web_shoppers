<div class="row">
    <div class="col-md-7">
        <h5>Users </h5>
    </div>    
</div>

@foreach ($listOfUser as $row)

<div class="row">
    <div class="col-lg-12 no-gutter table-responsive">
        <table class="table table-striped tbl_list">
            <tbody>
                <tr>
                    <?php if($row->image){ ?>
                    <td><img src="{{ URL::to('userimages/user_'.$row->id.'/small/'.$row->image ) }}" alt="...">
                    </td>
                    <?php } else { ?>
                     <td><img src="{{ URL::to('/images/user.png')}}" alt="...">
                    </td>   
                    <?php } ?>
                    <td width="45%">
                        <a href=""><div class="people_name">{{$row->fname}} {{$row->lname}}</div></a>
                    </td>
                    <td width="45%" style="text-align:right;"><button class="skybtn" onclick="blockThisUser({{$row->id}})">Block</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endforeach
<script>
function blockThisUser(user_id)
{
    //alert(user_id);
    
     var id=user_id;
      var url="/public/settings/blockListReady/"+id;
      // alert(url);
      bootbox.confirm({
    message: "Are you sure?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
        if(result==true)
        {
         $('#blockuser').modal('hide');   
         $.get(url, function(data){
             //alert(data.blockuserArray['name']);
             $("#blockUserDiv").html(data);
             });
        
   }
       if(result==false)
        {
           // alert("shit"); 
        }
    }
});
    
    
    
    
}
</script>