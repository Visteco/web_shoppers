var taggedUser = {};

// taggedUser[0]='{"name":"ankur","id":"1"}';
// taggedUser[1]='{"name":"akash","id":"2"}';
taggedUser = TAGGED_USER;


var formData = new FormData();

var imagesArray = [];

var crawledData = {};

var postType    = 1;

var contentType = 1;

var uploadedImage = null;

var uploadedVideo = null;

window.onscroll = function(ev) {
    if(NEXT_PAGE_URL){
        
        document.getElementById("loader_post_id").style.display = "block";
        
        /*console.log(window.innerHeight + window.scrollY);
        console.log("windowheight : "+document.body.offsetHeight);*/
        if ((window.innerHeight + window.scrollY)+2 >= document.body.offsetHeight) {
            $.get(NEXT_PAGE_URL,function(data){
                
                document.getElementById("loader_post_id").style.display = "none";
                
                NEXT_PAGE_URL = data.next;
                
                $("#main_content").append(data.posts);
                
                initialise();
                
                    
            });
        }
    }
    
};

function sharePost(link,postId){
    bootbox.prompt({
    title: "Share post to",
    inputType: 'select',
    inputOptions: [
        {
            text: 'Public',
            value: '2',
        },
        {
            text: 'With Followers',
            value: '1',
        },
        {
            text: 'Only Me',
            value: '0',
        }
    ],
    callback: function (result) {
        
        $.get(link+'/'+result, function(data, status){
               if(data.success){
                   
                   bootbox.alert("This post has been shared to you wall!!");
                   $("#main_content").prepend(data.post);
                   $('#share_post_count_'+postId).html(data.share_count);
                       
               }else{
                   bootbox.alert(data.error);
               }
                
            }); 
    }
});
}

function deletePost(link,postId){
    bootbox.confirm({
    message: "Are you sure to delete this post ?",
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
        if(result){
          $.get(link, function(data, status){
               if(data){
                    var me = document.getElementById(postId);
                    me.parentNode.removeChild(me);   
               }else{
                   bootbox.alert('Sorry, error while deleting this post!');
               }
                
            });  
        }
    }
});
}

function deleteComment(link,cmntId){
    bootbox.confirm({
    message: "Are you sure to delete this comment ?",
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
        if(result){
          $.get(link, function(data, status){
               if(data){
                    var me = document.getElementById(cmntId);
                    me.parentNode.removeChild(me);   
               }else{
                   bootbox.alert('Sorry, error while deleting this comment!');
               }
                
            });  
        }
    }
});
}
                    
 function addEmojies(place,emoji,thisone){
     //alert(emoji);
     var placeHtml = $("#"+place).html();
     
     var newHtml   = placeHtml+'<img src="'+emoji+'"/>';
     
     
     $("#"+place).html(newHtml);
     
     
     $.get("http://visteco.in/emoji/"+$(thisone).attr("value")+"/1",function(success){
        if(success){
          thisone.parentNode.removeChild(thisone);
        } else{
            alert("error");
        }
     }); 
     
     
     
     
 }                   
 
 function createCrawlImage(link,title){
    
     var crawlImage  =   "<div class='col-md-12' >"
                         +           
                            "<img style='max-width:97%;min-height:308px;min-width:97%;max-height:308px' id='image_id' src='"+link+"' style='' />"
                         +
                        "</div>" 
                         +
                         "<div class='col-md-12'>"
                            +
                            "<div class='btn-group'>"
                                +
                                "<a id='prev' type='button' class='btn btn-default'><span class='fa fa-backward'></span></a>"
                                +
                                "<a id='next' type='button' class='btn btn-default'><span class='fa fa-forward'></span></a>"
                            +
                             "</div>"
                            +
                         "<div><b>"+title+"</b></div>"
                         +
                        "</div>";

   $("#external_content").html(crawlImage);                 

 }
                    
                    
                    
function createCrawlVideo(video,title){
    var crawlVideo =    
            
             
             
             "<div class='col-md-12' >"
             +  
             "<iframe id='video_id' width='400' height='240' src='"+video+"' frameborder='0' allowfullscreen></iframe>"
             +
             "<b>"+title+"</b>"
             +
             "</div>"
             
             
             
    ;
    
    
    document.getElementById("external_content").innerHTML = crawlVideo;
    /*$("#external_content").append(crawlVideo);                         */

}                    
                    
                    

function createPostImage(src){
    bootbox.alert(src);
    var postImage   =     /*"<li style='padding: 3px;'>" */
                        
                         "<img class='pro-pic' src="+src+"/>"
                         
                       /*"</li>";*/
    $("#file_preview").html(postImage);                                            

}
       

                     
    
var loadImage   =     "<img id='load_image' class='pro-pic' style='display:none;'  src='{{ URL::to('images/postloader.gif') }}' />";


function validateFile(thisone){
  var file_length = thisone.files.length;
  if(file_length > 5){
    alert('You can upload only maximum five image or video, Please select five or less than five image or video.');
    return false;
  }
  if(file_length < 2){
    var file = thisone.files[0];
    var fileType = file["type"];
    // $('ul#pro_list li').remove();
    $('#pro_list').html('<li id="file_preview"><img id="imagePreview" class="pro-pic" src="#"/><img id="load_image" class="pro-pic" style="display:none;width:20%"  src="'+PROJECT_URL+'/public/images/postloader.gif" /></li>');
  }else{
    var file = [];
    var fileType = [];
    var img_html = '';
    for (var im = 0; im < file_length; im++) {
      var file_struct = thisone.files[im];
      file.push(file_struct);
      fileType.push(file_struct['type']);
      var bottom_style = (im != (file_length-1))?'class="bottom_style"':'';
      // $('#file_preview').remove();
      img_html += '<li id="file_preview_'+im+'" '+bottom_style+'><img id="imagePreview_'+im+'" class="pro-pic pro-pic-img" src="#"/><img id="load_image_'+im+'" class="pro-pic" style="display:none;width:20%"  src="'+PROJECT_URL+'/public/images/postloader.gif" /></li>';
    }
    $('#pro_list').html(img_html);
  }
  // console.log(Array.isArray(file));
    
     var ValidImageTypes  = ["image/gif", "image/jpeg", "image/png"];

     var ValidVideoTypes  = ["video/mp4", "video/x-msvideo", "video/3gpp", "video/avi","video/x-ms-wmv","video/flv","video/mpg"];
    var file_type;
    if(Array.isArray(fileType)){
      fileType.forEach(function(type) {
        if(ValidImageTypes.indexOf(type) != -1){
          fileType = 'image';
        }
        if(ValidVideoTypes.indexOf(type) != -1){
          fileType = 'video';
        }
      });
    }else{
      for(var j=0;j < ValidImageTypes.length; j++){
        if(fileType==ValidImageTypes[j]){
          fileType="image";
        }
      }
      for(var i=0;i < ValidVideoTypes.length; i++){
         if(fileType==ValidVideoTypes[i]){
          fileType="video";
       }
      }
    }

    switch(fileType){
        
        case 'image':
                
                formData.append(fileType,file);
                
                contentType = 1;
                
                postType    = 1; 
                
                var files = !!thisone.files ? thisone.files : [];
                if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support
            if(Array.isArray(file)){
              var k = 0;
              file.forEach(function(file_name) {
                var l = k++;
                if (/^image/.test(file_name.type)) { // only image file
                  var reader = new FileReader(); // instance of the FileReader
                  reader.readAsDataURL(file_name); // read the local file

                  reader.onloadend = function () { // set image data as background of div
                    $("#imagePreview_"+l).attr("src", this.result);
                    document.getElementById("imagePreview_"+l).style.display = "block";
                    /*createPostImage(this.result)*/
                  }
                }
              });
            }else{
              if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                  $("#imagePreview").attr("src", this.result);
                  document.getElementById("imagePreview").style.display = "block";
                  /*createPostImage(this.result)*/
                }
              }
            }
            
            break;
            
        case 'video':
                contentType = 2;
                postType    = 1;
                // console.log(Array.isArray(file));
                // console.log('hhhhhhhhhhhhhh');
                // return false;
                formData.append(fileType,file); 
                if(Array.isArray(file)){
                  var k = 0;
                  file.forEach(function(file_name) {
                    var l = k++;
                    $("#imagePreview_"+l).attr("src", PROJECT_URL+"/public/images/"+"video_icon.png");
                    document.getElementById("imagePreview_"+l).style.display = "block";
                  });
                }else{
                  $("#imagePreview").attr("src", PROJECT_URL+"/public/images/"+"video_icon.png");
                  document.getElementById("imagePreview").style.display = "block";
                }
                
            break;    
            
        default:
            bootbox.alert("sorry, file is not an image or video!!");
            thisone.value='';
            document.getElementById("imagePreview").style.display = "none";
            document.getElementById("imagePreview").src = "";
        break;
    }
    // thisone.replaceWith(thisone.val('').clone(true));
}

function showAsModal(){
    
 //    $('#myModal').removeClass('modal-pre');
 //    $('#myModalContent').removeClass('modal-content-pre');
 //    $('#myModal').addClass('modal-active');
 //    $('#myModalContent').addClass('modal-content-active');
	// var height = $('#myModalContent').attr('height');
	
	// var element = document.getElementById('myModalContent');
	
	// var cpHeight = element.offsetHeight;
	
	// /*document.getElementById("cp_id").style.height = cpHeight; */
	// $("#cp_id").css({height:cpHeight});
	
	// $("#close_cp_id").removeClass("close_cp_hide");
	// console.log(height);
	
    /*$("#post_description").height("500px");*/
}


function closeAsModal(){
    
    $('#myModal').addClass('modal-pre');
    $('#myModalContent').addClass('modal-content-pre');
    $('#myModal').removeClass('modal-active');
    $('#myModalContent').removeClass('modal-content-active');
    $("#close_cp_id").addClass("close_cp_hide");
    $("#cp_id").css({height:0});
    /*$("#post_description").height("100px");*/
    $("#external_content").html("");
    $('#post_description').html("");
    $('#pro_list').html('<li id="file_preview"><img id="imagePreview" class="pro-pic" src="#"/><img id="load_image" class="pro-pic" style="display:none;width:20%"  src="'+PROJECT_URL+'public/images/postloader.gif" /></li>');
    document.getElementById('imagePreview').style.display="none";
    document.getElementById('imagePreview').src="";
    document.getElementById('post_file').value="";
    setPlaceHolder(document.getElementById('post_description'));
    
    formData = new FormData();

    imagesArray = [];

    crawledData = {};

    postType    = 1;

    contentType = 1 ;

    uploadedImage = null;

    uploadedVideo = null;
    
    taggedUser = {};

}


function setPlaceHolder(thisone){
    if( $(thisone).html().trim() == "" ){
        $(thisone).html("Whats's on your mind ?");
    }
}

function doPost(thisone){
    
   (thisone).disabled = true; 
   var post_text;
   // var post_text = $("#post_description").html();
    var post_text = $("#post_description").val();

    if($("#post_description").val().trim()=="" || $("#post_description").val().trim()=="Whats's on your mind ?"){
     //  bootbox.alert("Please write something!!");
      // return;
      post_text = "";
    } 
        var flag = false; 
        var total_image = $("#post_file")[0].files.length;
        if(total_image > 1){
          $.each($("#post_file")[0].files, function(i, file) {
            formData.append('image[]', file);
          });
        }       

        // for (var pair of formData.entries()) {
        for (var pair of formData.entries()) {
          if(pair[0]=='image' || pair[0]=='video' ){
              flag = true;
          }
        }
        
        if(post_text=="" && flag==false ){
            bootbox.alert("Post is empty !!");
             (thisone).disabled = false; 
            return;
        }
      
        formData.append("tagged_users",JSON.stringify(taggedUser));        
        formData.append("crawl_data"  ,JSON.stringify(crawledData));
        formData.append("post_text"  ,post_text);
        formData.append("post_type"  ,postType);
        formData.append("content_type"  ,contentType);
        formData.append("publish_status"  ,$('#publish_status').val());
        
        
        /*bootbox.alert($("#post_description").html());*/
        
        $('#do_post_submit').html('<i class="fa fa-refresh fa-spin"></i>Post');
        $('#do_post_submit').addClass('disable-class');
      
        showProgressBar()
        $.ajax({
                url : DO_POST,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success: function(response){
                   /*document.write(response);*/
                   (thisone).disabled = false; 
                    $('#do_post_submit').html('Post');
                    $('#do_post_submit').removeClass('disable-class');
                    $("#main_content").prepend(response);
                    closeAsModal();
                    initialise();
                    
                },
                xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                            myXhr.upload.addEventListener('progress', progress, false);
                        }
                        return myXhr;
                },
                error: function(e){
                    document.write(e.responseText);
                }
            });
}

function showProgressBar(){
       var progressBar ='<div class="progress" id="progress_id">'
                        +'<div id="progress_bar" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:0%">'
                        +'</div>'
                        +'</div>';    
       $("#pro_text_id").append(progressBar);    
}

function progress(e) {

    if (e.lengthComputable) {
        var max = e.total;
        var current = e.loaded;
        
        var Percentage = (current * 100) / max;
        console.log(Percentage);
        //alert(Percentage);
        var pBar = document.getElementById("progress_bar");
        if (Percentage >= 100)
        {
            // process completed 
            var progressDiv = document.getElementById("progress_id");
             pBar.innerHTML = "100%";
             pBar.style.width = "100%";
             progressDiv.parentNode.removeChild(progressDiv);
        }else{
            
                var per  = Math.ceil(Percentage)
                pBar.innerHTML = per+"%";
                pBar.style.width = per+"%";
                
                
        }
    }
}

function doComment(cmnt_text,post_id,parent_id,thisone){
    // console.log(thisone);
    // console.log('jhhhhhhhhhhhhhhhhhh');
    // console.log(cmnt_text);
    // console.log('kkkkkkkkkkkkkkkkkkkkkk');
    // return false;
    // if(cmnt_text.trim()=="" || $(thisone).html().trim() ){
    if(cmnt_text.val()=="" || $(thisone).val().trim() ){
       $(thisone).val('');
       bootbox.alert("Please write something!!");
       
       return;
    } 
    
        
        $(thisone).attr("disabled","true");
        
        cmntData = new FormData();
        cmntData.append("cmnt_text",cmnt_text);
        cmntData.append("post_id",post_id);
        $(thisone).html('');
        $.ajax({
                url : DO_COMMENT,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data : cmntData,
                success: function(response){
                    $(thisone).removeAttr("disabled");
                    if(response.success==false){
                        bootbox.alert(response.message);
                    }
                    /*document.write(JSON.stringify(response));*/
                    document.getElementById(parent_id).style.display="block";
                    
                    $("#"+parent_id).append(response);
                    console.log("{");
                    /*bootbox.alert($(thisone).html());*/
                    $(thisone).html('');
                    console.log("}");
                    
                    initialise();
                },
                
                error: function(e){
                    document.write(e.responseText);
                }
            });
}

function unsetPlaceHolder(thisone){
  if( $(thisone).html().trim() == "Whats's on your mind ?"){
   $(thisone).html('');
  } 
  showAsModal();
  
}

function searchTagsForUser(thisone){
    
    var Str = $(thisone).text();
    
    var res = Str.split("@");
    
    
    
    
}


function urlify(text) {

    var urlRegex = /(https?:\/\/[^\s]+)/g;
    //var res = text.match(urlRegex);
    //return res;
    return text.match(urlRegex, function(url) {
        return url;
    })
}

function isValidURL(url){
   var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	if(RegExp.test(url)){
		return true;
	}else{
		return false;
	}
  }
        
function getLink(link,type){

            if(!isValidURL(link)){
                  
                  console.log("in invalid case");

                  console.log(link);  

                return;
            }
            $("#load_image").css("display","block");
            console.log("in valid case");
            
            
            /*$("#image_link_images").css('display','block');

            $("#post_type").val('external');

            if(type=='image')
                 $("#file_type_id").val("image");
            else if(type=='video')
                 $("#file_type_id").val("video");
            else
                 $("#file_type_id").val("");

             $("#next").hide();
             $("#prev").hide();
            */
             
             /*console.log(LINK_CRAWL+link);*/

             $.get(LINK_CRAWL+link, function(data, status){
  
                console.log(data.urlType);
                    $("#load_image").css("display","none");
                    switch(data.urlType){
                       
                     case 'img':
                         
                         
                         console.log("data:"+JSON.stringify(data.images_array));
                 
                         
                 
                        imagesArray = data.images_array;
                 
                        if(imagesArray.length > 0){
                    
                            crawledData = {
                                                "image":imagesArray[0],
                                                "url_title":data.tags.description,
                                                "url":data.URL
                                            };
                                            
                    
                            
                            createCrawlImage(imagesArray[0],data.tags.description);
                 
                        }
                        
                         for(var i=0 ; i<imagesArray.length;i++){
                     
                            console.log(imagesArray[i]);
                         }
   
                         $("#next").show();
                         $("#prev").hide();
                         $("#next").attr("onclick","next(1)");
                         $("#prev").attr("onclick","prev(1)");

                         postType = 2;
                         contentType=1;
                         break;
                            
                        
                     case 'video':
                         
                         createCrawlVideo(data.embed_url,data.tags.title);
                         
                         console.log(data.embed_url);
                         
                         crawledData = {
                                                "video":data.embed_url,
                                                "url_title":data.tags.title,
                                                "url":data.URL
                                            };
                            
                            
                         postType       = 2;
                         contentType    = 2;
                         
                        break;
                        
                    }
  
  
                 
                 

            });
        }
        
       $("#post_description").keypress(function(e) {
                 
                if(e.which == 32 || e.which == 13 ) {
                    
                    console.log(e);
                    
                    var link= urlify($(this).text());
                    
                    console.log(link);
                    
                    getLink(link,'image');

                 }
        });
        
        
        $(document).ready(function(){
           
            initialise(); 
            
        });
        
        
function prev(id){

            try{
             if(id==0){
                $("#prev").hide();
            }
            $("#next").show();
            $("#next").attr("onclick","next("+(id+1)+")");
            $("#prev").attr("onclick","prev("+(id-1)+")");
            $("#image_id").attr("src",imagesArray[id]);
            crawledData['image']   =  imagesArray[id];
            $("#file_name_id").val(imagesArray[id]);
            }catch(e){
                alert(e);
            }
        }

function next(id){

        try{

            if(id == ( (imagesArray.length)-1) ){
                $("#next").hide();
            }

            $("#prev").show();
            $("#next").attr("onclick","next("+(id+1)+")");
            $("#prev").attr("onclick","prev("+(id-1)+")");
            $("#image_id").attr("src",imagesArray[id]);
            crawledData['image']       =   imagesArray[id];
            $("#file_name_id").val(imagesArray[id]);
        }catch(e){
            alert(e);
        }
    }
    
    function likeObject(link,idobject,idcount){
        
        $("#"+idobject).addClass('active_like');
        
        $.get(link,function(data){
        
            if(data.success == false){
              $("#"+idobject).removeClass('active_like');  
            }else{
                $("#"+idobject).addClass('active_like');
            }
            $("#"+idcount).html(data.count);
            
        });
    }
     
  function getImageSources(str){
      
    
       //str = JSON.stringify(str);
       
       // var str = "<img src='http://visteco.in/images/emoticons/athletic_shoe.svg'>"

        var regex = /<img.*?src="(.*?)"/;
    
        var src = regex.exec(str)[1];

        //console.log(src);
        //alert(src);
    
    //return;
    
    
    var m,
    urls = [], 
   // str = "<img src='http://visteco.in/images/emoticons/athletic_shoe.svg'>";
    rex = /<img[^>]+src="?([^"\s]+)"?\s*\/>/g;
    
    m = regex.exec( str )
    alert(m[1]);
    /*while ( m = regex.exec( str ) ) {
        urls.push( m[1] );
        
    }*/
    
    //bootbox.alert(urls);
    //console.log( urls ); 
    
  }
        
  function initialise(){
      
      
      $(".cmnt_description").unbind();
      
      $(".cmnt_description").on('keydown', function(e) {  
          if(e.keyCode == 13)  {
              
           var cmnt_text =  $(this).val();
           // var cmnt_text =  $(this).html();
           
           var post_id   =  $(this).attr('post_id');
           
           var parent_id   =  $(this).attr('parent_id');
           
           $(this).html('');
      
           doComment(cmnt_text,post_id,parent_id,this);
           console.log(e);
          
           e.preventDefault();
            
        }
        
     });

      
      $(".rply_description").unbind();
      
      
      $(".rply_description").on('keydown', function(e) {  
        
          if(e.keyCode == 13)  {
              
            var cmnt_text    =  $(this).html();
                   
                   var post_id      =  $(this).attr('post_id');
                   
                   var parent_id    =  $(this).attr('parent_id');
                   
                   var cmnt_id    =  $(this).attr('cmnt_id');
                   
                   var cmnt_user_id    =  $(this).attr('cmnt_user_id');
                   
                   var link    =  $(this).attr('link');
                   
                   $(this).html('');
                   
                    doCmntReply(link,post_id,cmnt_id,parent_id,cmnt_user_id,cmnt_text,this);
                    
                    console.log(e);
                    
                    e.preventDefault();
            
        }
        
     });
      
      
      return false;
      
      
      
      /*$(".cmnt_description").unbind();
      
      $(".cmnt_description").keypress(function(e) {
                 
                if(e.which == 13 ) {
                   
                   var cmnt_text =  $(this).html();
                   var post_id   =  $(this).attr('post_id');
                   var parent_id   =  $(this).attr('parent_id');
                   $(this).html('');
                   
                   doComment(cmnt_text,post_id,parent_id,this);
                    console.log(e);
                    
                 }
            });
            
            
      
      
      $(".rply_description").keypress(function(e) {
                 
                if(e.which == 13 ) {
                   
                   var cmnt_text    =  $(this).html();
                   
                   var post_id      =  $(this).attr('post_id');
                   
                   var parent_id    =  $(this).attr('parent_id');
                   
                   var cmnt_id    =  $(this).attr('cmnt_id');
                   
                   var cmnt_user_id    =  $(this).attr('cmnt_user_id');
                   
                   var link    =  $(this).attr('link');
                   
                   $(this).html('');
                   
                    doCmntReply(link,post_id,cmnt_id,parent_id,cmnt_user_id,cmnt_text,this);
                    
                    console.log(e);
                    
                 }
            });      
            
       */     
            
  }      
  
  
  
  function showLikedUsers(link){
      
      $.get(link,function(data){
          if(data.success){
              
                 var dialog = bootbox.dialog({
                  message: data.users,
                  backdrop: true,
                  size: 'small',
                  closeButton: true
           });
           
           
           $("#flux").unbind();
  
            $('#flux').bind('scroll', function ()
            {
                if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight)
                {
                    bootbox.alert('end reached');
                }
            })
           
           
           
          }else{
              bootbox.alert(data.message);
          }
      });
      
  }
  
  
  function doFollow(link,thisone){
      $.get(link,function(data){
          
          if(data.follow==true)
              $(thisone).html('Following');
          else
              $(thisone).html('Follow');
      });
  }
  
  
  
  function cmntReply(id){
      var item = document.getElementById(id);
          item.style.display = "block";
          item.focus();
          item.scrollIntoView();
          $("#"+id).find("p").focus();
          
          
          
  }
  
  function showEditComment(id){
     
      var thisone = document.getElementById(id);
     
      $(thisone).attr("contenteditable","true");
      
      $(thisone).unbind();
      
      $(thisone).addClass("cmnt_p");

      $(thisone).addClass("form-control");
      
      
      
      $(thisone).on('keydown', function(e) {  
        
          if(e.keyCode == 13)  {
              
            var cmnt_text  =  $(this).html();
                   
             var cmnt_id    =  $(this).attr('cmnt_id');

             var post_id    =  $(this).attr('post_id');  
                  
             updateComment(cmnt_text,cmnt_id,post_id,this);
          
           e.preventDefault();
            
        }
        
     });
      
      
      
  }
  
  
  function showEditReply(id){
     
      var thisone = document.getElementById(id);
     
      $(thisone).attr("contenteditable","true");
      
      $(thisone).unbind();
      
      $(thisone).addClass("cmnt_p");

      $(thisone).addClass("form-control");
      
      $(thisone).keypress(function(e) {
                 
        if(e.which == 13 ) {
                   
             var cmnt_text  =  $(this).html();
                   
             var rply_id    =  $(this).attr('rply_id');
     
             updateReply(cmnt_text,rply_id,this);
                    
             console.log(e);
                    
        }
        
       });
  }
  
  
  
  
  
  function updateReply(cmnt_text,rply_id,thisone){
   
      if(cmnt_text.trim()==""){
         bootbox.alert("Please write something!!");
         return;
        } 
    
        
        $(thisone).attr("disabled","true");
        
        cmntData = new FormData();
        
        cmntData.append("cmnt_text",cmnt_text);
        
        cmntData.append("rply_id",rply_id);
        
        /*cmntData.append("post_id",post_id);*/
        
        /*bootbox.alert(UPDATE_COMMENT);*/
        $.ajax({
                url : UPDATE_REPLY,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data : cmntData,
                success: function(response){
                    
                    if(response.success==false){
                        bootbox.alert(response.message);
                    }
                    /*document.write(JSON.stringify(response));*/
                    
                    if(response.success == true){
                        /*bootbox.alert("<pre>"+JSON.stringify(response)+"</pre>");
                        console.log(JSON.stringify(response));*/
                        $(thisone).removeAttr("disabled");
                        $(thisone).removeAttr("contenteditable","true");
                        /*$(thisone).addClass("show_cmnt");*/
                        $(thisone).removeClass("cmnt_p");
                        $(thisone).removeClass("form-control");
                        $(thisone).html(response.data.cmnt_text.trim());
                        //$(thisone).replaceWith(thisone.html(innerText).clone(true));
                        
                    }
                    
                    
                },
                error: function(e){
                    document.write(e.responseText);
                }
       });
  }
  
  
  
  function updateComment(cmnt_text,cmnt_id,post_id,thisone){
   
      if(cmnt_text.trim()==""){
         bootbox.alert("Please write something!!");
         return;
        } 
    
        
        $(thisone).attr("disabled","true");
        
        cmntData = new FormData();
        
        cmntData.append("cmnt_text",cmnt_text);
        
        cmntData.append("cmnt_id",cmnt_id);
        
        /*cmntData.append("post_id",post_id);*/
        
        /*bootbox.alert(UPDATE_COMMENT);*/
        $.ajax({
                url : UPDATE_COMMENT,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data : cmntData,
                success: function(response){
                    
                    if(response.success==false){
                        bootbox.alert(response.message);
                    }
                    /*document.write(JSON.stringify(response));*/
                    
                    if(response.success == true){
                        /*bootbox.alert("<pre>"+JSON.stringify(response)+"</pre>");
                        console.log(JSON.stringify(response));*/
                        $(thisone).removeAttr("disabled");
                        $(thisone).removeAttr("contenteditable","true");
                        $(thisone).addClass("show_cmnt");
                        $(thisone).removeClass("cmnt_p");
                        $(thisone).removeClass("form-control");
                        $(thisone).html(response.data.cmnt_text.trim());
                        //$(thisone).replaceWith(thisone.html(innerText).clone(true));
                        
                    }
                    
                    
                },
                error: function(e){
                    document.write(e.responseText);
                }
       });
  }
  
  
function loadMoreComments(thisone,link,placeHolder){
    thisone.disbled = true;
    $.get(link,function(response){
        if(response.success){
            
            
            thisone.disbled = false;
            
            thisone.parentNode.parentNode.removeChild(thisone.parentNode);
            
            if(response.more==true){
                
                $("#"+placeHolder).prepend(response.link);
            }
            if(response.exists){
                $("#"+placeHolder).html(response.data);
            }    
        }
    });
} 

function showReplybox(Link,postId,cmntId,parentId,cmntUserId){
        bootbox.prompt({
        title: "Write reply here!",
        inputType: 'text',
        callback: function (result) {
            console.log(result);
            
             var cmnt_text = result;
             
             cmntData = new FormData();
        
             cmntData.append("cmnt_text",cmnt_text);
        
             cmntData.append("post_id",postId);
             
             cmntData.append("cmnt_id",cmntId);
             
             cmntData.append("cmnt_user_id",cmntUserId);
             
             $.ajax({
                url : Link,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data : cmntData,
                success: function(response){
                   
                    if(response.success==false){
                        bootbox.alert(response.message);
                    }
                    /*document.write(JSON.stringify(response));*/
                    document.getElementById(parentId).style.display="block";
                    
                    $("#"+parentId).prepend(response);
                   
                },
                
                error: function(e){
                    document.write(e.responseText);
                }
            });
            
        }
    });
}



function doCommentReplyOld(cmnt_text,post_id,parent_id){
    if(cmnt_text.trim()==""){
       bootbox.alert("Please write something!!");
       return;
    } 
    
        cmntData = new FormData();
        
        cmntData.append("cmnt_text",cmnt_text);
        
        cmntData.append("post_id",post_id);
        
        $(thisone).html('');
        
        $.ajax({
                url : DO_COMMENT,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data : cmntData,
                success: function(response){
                    $(thisone).removeAttr("disabled");
                    if(response.success==false){
                        /*bootbox.alert(response.message);*/
                    }
                    /*document.write(JSON.stringify(response));*/
                    document.getElementById(parent_id).style.display="block";
                    
                    $("#"+parent_id).append(response);
                    console.log("{");
                    /*bootbox.alert($(thisone).html());*/
                    $(thisone).html('');
                    console.log("}");
                    
                    
                },
                
                error: function(e){
                    document.write(e.responseText);
                }
            });
}


function doBookMark(thisone){
    
    $.get(thisone.id,function(response){
        
        if(response.success){
            
            if(response.bookmarked){
                bootbox.alert("Post Bookmarked!!");
                $(thisone).addClass("active_like");
                /*$(thisone).id=response.link;*/
            }else{
                $(thisone).removeClass("active_like");
                /*$(thisone).id=response.link;*/
            }
        }
    });
}

function viewAllReplies(link,parentId){
    
    $.get(link,function(data){
    
        $("#"+parentId).html(data); 
    
    });
    
}



function doCmntReply(Link,postId,cmntId,parentId,cmntUserId,cmnt_text,thisone){
       
    if (cmnt_text.trim() == "" || $(thisone).html().trim()) {
        bootbox.alert("Please write something!!");
        (thisone).innerHTML = "";
        
        return;
    } 
             cmntData = new FormData();
        
             cmntData.append("cmnt_text",cmnt_text);
        
             cmntData.append("post_id",postId);
             
             cmntData.append("cmnt_id",cmntId);
             
             cmntData.append("cmnt_user_id",cmntUserId);
             
             $.ajax({
                url : Link,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data : cmntData,
                success: function(response){
                   
                    if(response.success==false){
                        bootbox.alert(response.message);
                    }
                    /*document.write(JSON.stringify(response));*/
                    document.getElementById(parentId).style.display="block";
                    
                    $("#"+parentId).append(response);
                    $(thisone).html('');
                },
                
                error: function(e){
                    document.write(e.responseText);
                }
            });
     }
     
     function showBoxToReply(boxId,parentId){
         
        document.getElementById(parentId).style.display = "block"; 
        var box =  document.getElementById(boxId);
        box.focus();
        
     }
     
     function focusComment(boxId){
        var box =  document.getElementById(boxId);
        box.focus(); 
     }