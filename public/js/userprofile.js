


var elementinput = {};

function getSuggestions(thisone,placeholder){


  try{
    $("#"+placeholder).html('');
    if($(thisone).text().trim()=='')
      return;

      var str = $(thisone).text();
      var val = str.replace("%", " ");

      $.get(ajax_suggestion+val,function(data,status){

        $("#"+placeholder).html(data['info']);
      });

     /*$("#"+placeholder).load(ajax_suggestion+val);*/
  }

  catch(err){
    alert(err);
  }

}

function setSuggestion(thisone){

  $('#autocompletearea').html($(thisone).attr('name'));
  $('#suggestionss').html('');

}

function submitForm(className,formClass){

  var formData=$("."+formClass).serializeArray();

  var textElements = $("."+formClass).find(".text_p");

  var allFields   = document.getElementsByClassName(className);

    for(var j=0;j<allFields.length;j++){

      ele_name    =   $(allFields[j]).attr('name');/*$("."+className).attr('name');*/

      ele_value   =   $(allFields[j]).text();/*$("."+className).text();*/
	  
	  $(allFields[j]).removeClass('custom_error');
	  
	  //if(ele_value.strlen ==0){
		  //$(allFields[j]).addClass('has-error');
		   //(allFields[j]).focus();
		   //bootbox.alert(" is empty");
	  //}

      formData[formData.length] = { name: ele_name, value: ele_value };
	   if( formData[(formData.length)-1]['value'].trim() =='' ){
		   
			//bootbox.alert(formData[i]['name']+" is empty");
			$(allFields[j]).addClass('custom_error');
			(allFields[j]).focus();
			return;
		}

    }







  for(var i=0;i<formData.length;i++){

    if( formData[i]['value'].trim() =='' ){
      //bootbox.alert(formData[i]['name']+" is empty");
      return;
    }
  }
    var dialog = bootbox.dialog({
           message: '<p class="text-center">Please wait ...</p>',
           closeButton: false
    });

       $.ajax({

          url  :  $("."+formClass).attr("action"),

          data :  formData,

          type : 'post',

          success : function(data,status){

                bootbox.alert(data.message);


              dialog.modal('hide');

              if(data.success){
                  switchToSpan(className);
                  document.getElementById(className+'_revert').style.visibility='hide';
                  document.getElementById(className+'_save').style.visibility='hide';
              }





          },
          error : function(err){
              document.write(err.responseText);
          }

      });
  }







function switchToInput(className){





  var elements =  $("."+className);

  for(var i=0 ; i < elements.length; i++){

      var ele = elements[i];

       $(ele).addClass("form-control");
       $(ele).addClass("text_p");
	   $(ele).removeClass('custom_error');
       $(ele).attr('contenteditable','true');
       elementinput[$(ele).attr('name')] = $(ele).text();
}


    var  elementOne = document.getElementsByClassName(className+'_revert');

    for(var k=0;k<elementOne.length;k++){

      elementOne[k].style.visibility='visible';


    }

  var elementTwo = document.getElementsByClassName(className+'_save');

  for(var j=0;j<elementTwo.length;j++){

    elementTwo[j].style.visibility='visible';


  }







}


function revert(className){

  var elements =  $("."+className);

  for(var i=0 ; i < elements.length; i++){

      var ele = elements[i];

       $(ele).removeClass("form-control");
       $(ele).removeClass("text_p");
       $(ele).removeAttr('contenteditable');
       $(ele).html(elementinput[$(ele).attr('name')]);
 }

 var  elementOne = document.getElementsByClassName(className+'_revert');

 for(var k=0;k<elementOne.length;k++){

   elementOne[k].style.visibility='hidden';


 }

 var elementTwo = document.getElementsByClassName(className+'_save');

 for(var j=0;j<elementTwo.length;j++){

 elementTwo[j].style.visibility='hidden';


 }

}

function switchToSpan(className){

  var elements =  $("."+className);

  for(var i=0 ; i < elements.length; i++){

      var ele = elements[i];

       $(ele).removeClass("form-control");
       $(ele).removeClass("text_p");
       $(ele).removeAttr('contenteditable');
 }

 var  elementOne = document.getElementsByClassName(className+'_revert');

 for(var k=0;k<elementOne.length;k++){

   elementOne[k].style.visibility='hidden';


 }

 var elementTwo = document.getElementsByClassName(className+'_save');

 for(var j=0;j<elementTwo.length;j++){

 elementTwo[j].style.visibility='hidden';


 }





}


$(document).ready(function()
{


/* Uploading Profile BackGround Image */
$('body').on('change','#bgphotoimg', function()
{

$("#bgimageform").ajaxForm({target: '#timelineBackground',
beforeSubmit:function(){},
success:function(){

$("#timelineShade").hide();
$("#bgimageform").hide();
},
error:function(){

} }).submit();
});



/* Banner position drag */
$("body").on('mouseover','.headerimage',function ()
{
    
var y1 = $('#timelineBackground').height();
var y2 =  $('.headerimage').height();
//alert(y1+y2);
$(this).draggable({
scroll: false,
axis: "y",

drag: function(event, ui) {
if(ui.position.top >= 0)
{
ui.position.top = 0;
}
else if(ui.position.top <= y1 - y2)
{
ui.position.top = y1 - y2;
}
},
stop: function(event, ui)
{
}
});
//alert('body');
});


/* Bannert Position Save*/
$("body").on('click','.bgSave',function ()
{
    //alert('in alert');
var id = $(this).attr("id");
//alert(id);
var p = $("#timelineBGload").attr("style");
//alert(p);
var Y =p.split("top:");
var Z=Y[1].split(";");
var dataString ='position='+Z[0];
//alert(dataString);
$.ajax({
type: "POST",
url: "image_saveBG_ajax.php",
data: dataString,
cache: false,
beforeSend: function(){ },
success: function(html)
{
if(html)
{
$(".bgImage").fadeOut('slow');
$(".bgSave").fadeOut('slow');
$("#timelineShade").fadeIn("slow");
$("#timelineBGload").removeClass("headerimage");
$("#timelineBGload").css({'margin-top':html});
return false;
}
}
});
return false;
});



});






$(document).ready(function(){


  $("#eraze").click(function(){

    var info=$("#myid").val();

    //alert(info);
        $.ajax({
          url: 'myurl2/{id}',
          type: "get",
          data: {id:info},
          success: function(result)
          {
            //console.log(result);
          //alert('got it');
          var model = $('#box1');
          model.empty();
          $.each(result, function(index, element)
          {
          //model.append("<ul><li>"+ element.id +""+"</li>"+"<li>" + element.name + "<li/><ul/>");

          //alert("type is"+ strg);


            model.append("<label for='prevorg'>Previous-Company:</label><span style='margin-left:20px;'><input type='text' name='prevorg' class='orgnz' value='"+element.prev_org+"' size='20' /></span>");
            model.append("<p><label for='prevdesg'  >Designation:</label><span style='margin-left:70px;'><input type='text' name='prevdesg' class='orgnz2' value='"+element.prev_desg+"' placeholder='Previous Designation' /></span>"+"&nbsp;&nbsp;"+"<label for='duraon'>Start_Year-End_Year:&nbsp;&nbsp;</label><input type='text' name='duraon' class='orgnz3' value='"+element.start_year+"-"+element.end_year+"'/></p>");
            //model.append("<input type='submit' name='btn' value='update'/>");
            model.append("<a href='' onclick='return (upInfo({{Auth::user()->id}}));'>Update</a>");
          });



          },
          error: function ()
          {
            alert("wait...");

          }
        });



  });

});
function upInfo(uinfo)
{

var me=uinfo;
var vl1=$(".orgnz").val();
var vl2=$(".orgnz2").val();
var vl3=$(".orgnz3").val();
if(vl1=='' || vl2=='' || vl3=='')
{
alert("Please fill all fields.");
}
//alert(vl1+" "+vl2+" "+vl3);
/*info = [];
info[0] = me;
info[1] = vl1;
info[2] = vl2;
info[3] = vl3;

for(i=0;i<info.length;i++)
{
alert(info[i]);

}*/
else
{
        $.ajax({
          url: 'updtinfo/{id1}/{id2}/{id3}/{id4}',
          type: "get",
          data: {id1:me,id2:vl1,id3:vl2,id4:vl3},
          success: function(result)
          {
            console.log(result);
           // alert('got it');
          //alert('got it');

          var model = $('#box1');
          model.empty();
          $.each(result, function(index, element)
          {
          //model.append("<ul><li>"+ element.id +""+"</li>"+"<li>" + element.name + "<li/><ul/>");

          //alert("type is"+ strg);


            model.append("<h2>"+element.prev_org+"</h2>");
            model.append("<p>"+element.prev_desg+""+"&nbsp;&nbsp;"+""+element.start_year+"-"+element.end_year+"</p>");

          });




          },
          error: function ()
          {
            alert("wait...");

          }
        });
}
return false;
}

$(document).ready(function(){
  $("#edit2").click(function(){
    //alert("clicked here");

    var info=$("#myid").val();
    var usrdesg;
    var summry;
    //alert(info);
        $.ajax({
          url: 'myurl2/{id}',
          type: "get",
          data: {id:info},
          success: function(result)
          {
            //console.log(result);


          //var model = $('.co-box2');
          //model.empty();
          $.each(result, function(index, element)
          {
          //model.append("<ul><li>"+ element.id +""+"</li>"+"<li>" + element.name + "<li/><ul/>");

          //alert("type is"+ strg);
            usrdesg=element.pres_desg;
            summry=element.sumry;
            dutyy=element.duty;

            //model.append("<h2><input type='text' class='orgnz' value='"+element.prev_org+"'/></h2>");
            //model.append("<p><input type='text' class='orgnz2' value='"+element.designation+"'/>"+"&nbsp;&nbsp;"+"<input type='text' class='orgnz3' value='"+element.start_year+"-"+element.end_year+"'/></p>");
            //model.append("<input type='submit' name='btn' value='update'/>");

          });
            //alert(usrdesg);
            //$("#head4").html("<strong>"+usrdesg+"</strong>");
            $("#head4").html("<label for='desgn'>Designation</label><input type='text' name='desgn' class='org1' value='"+usrdesg+"' placeholder='Present Designation'/>");
            $("#sumree").html("<label for='pfsmry'>Profile Summry</label><textarea name='pfsmry' class='org2' rows='10' cols='40' >"+summry+"</textarea>");
            //$("#dutii").before("<label for='dutii' id='dute'>Duty<label>");
            $("#dutii").html("<label for='dutii' id='dute' style='display:block;'>Duty</label><textarea name='dutii' class='org3' rows='5' cols='30' >"+dutyy+"</textarea>");
            $("#updte").empty();
            $("#updte").append("<a href='' onclick='return (upInfo2({{Auth::user()->id}}));'>Update</a>");
            //$("#updte").append("<h2><u><span onclick='window.alert();'>Update</span></u></h2>");
          },
          error: function ()
          {
            alert("wait...");

          }
        });

  });
});

function upInfo2(strz)
{
  //var idd=strz;
  //alert("see this");
  var me=strz;
   var vl1=$(".org1").val();
   var vl2=$(".org2").val();
   var vl3=$(".org3").val();
  //alert(vl1+vl2+vl3);
  if(vl1=='' || vl2=='' || vl3=='')
  {
    alert("Please fill all fields.");
  }
  else
  {
    $.ajax({
          url: 'updtinfo2/{id1}/{id2}/{id3}/{id4}',
          type: "get",
          data: {id1:me,id2:vl1,id3:vl2,id4:vl3},
          success: function(receve)
          {
            //console.log(result);
           // alert('got it');
          //alert('got it');


          $.each(receve, function(index, element)
          {
            usrdesg=element.pres_desg;
            summry=element.sumry;
            dutyy=element.duty;
          });
          $("#dute").empty();
            $("#head4").html(usrdesg);
            //$("#desg").remove();
            //$("#desg").html(usrdesg);
            $("#sumree").html(summry);
            $("#dutii").html(dutyy);
            $("#updte").empty();
          },
          error: function ()
          {
            alert("wait...");

          }
        });
  }
  return false;
}

function readPicURL(input)
{
if (input.files && input.files[0])
{
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}
document.getElementById('picc').style.display='block';
}



$("#image_src").change(function(e){
  readPicURL(this);
});


function myPic(e){
  e.preventDefault();

  /*$(".img-para").append("<img src='{{url::to('images/loading.gif')}}' style='width:40%;' id='ldimg'/>");*/
  var formData = new FormData(document.getElementById("uploadimage"));

  document.getElementById('picc').style.display='none';

  $('#profile_pic_place').addClass('banner');

  document.getElementById('load_profile').style.display='block';

  $.ajax({
  url: PROJECT_URL +"/user/myprofilepic",      // Url to which the request is send
  type: "POST",             // Type of request to be send, called as method
  data: formData,           // Data sent to server, a set of key/value pairs (i.e. form fields and values)
  contentType: false,       // The content type used when sending data to the server.
  cache: false,             // To unable request pages to be cached
  processData:false,        // To send DOMDocument or non processed data file it is set to false
  success: function(data)   // A function to be called if request succeeds
  {
  //document.write(data);
    document.getElementById('picc').style.display='none';

    $('#profile_pic_place').removeClass('banner');
    document.getElementById('load_profile').style.display='none';
  },
  error: function(xhr)
  {
    document.write(xhr.responseText);
  }
  });

}

$(document).ready(function(){

//$(".infoz2").hide();
$(".shmropt").hide();

$("#shwmr").click(function()
{
//alert("u click");

$(".shmropt").show();
$(".shmropt").after("<div class='infoz2'><a id='shwls' href='' onclick='return (doHide());'>Show Less</a></div>");
$(".infoz1").hide();
return false;
});

});
function doHide()
{
//alert("again cliked");
$(".infoz2").hide();
$(".shmropt").hide();
$(".infoz1").show();
return false;
}


$(document).ready(function(){
$("#eraze2").click(function(){

var vr1,vr2,vr3;
var info=$("#myid").val();
$.ajax({
          url: 'wrkinfo/{id}',
          type: "get",
          data: {id:info},
          success: function(result)
          {
            console.log(result);
          //alert('got it');
          var model = $('#box2');
          model.empty();
          $.each(result, function(index, element)
          {

            model.append("<label for='pastorg1'>Past-Company-1:</label><span style='margin-left:40px;'><input type='text' name='pastorg1' class='porgnz1' value='"+element.past_org1+"' size='20' /></span>");
            model.append("<p><label for='pastdesg1'  >Designation:</label><span style='margin-left:70px;'><input type='text' name='pastdesg1' class='porgnz2' value='"+element.job_profile1+"' placeholder='Past Designation' /></span>"+"&nbsp;&nbsp;"+"<label for='duraon'>Start_Year-End_Year:&nbsp;&nbsp;</label><input type='text' name='duraon1' class='porgnz3' value='"+element.duration1+"'/></p>");
            //model.append("<input type='submit' name='btn' value='update'/>");
            model.append("<a href='' onclick='return (updInfo({{Auth::user()->id}}));'>Update</a>");
          });



          },
          error: function ()
          {
            alert("wait...");

          }
        });

});
$("#eraze3").click(function(){
//alert("bingo");
var var1,var2,var3;
var info=$("#myid").val();
$.ajax({
url: 'wrkinfo2/{id}',
type: "get",
data: {id:info},
success: function(result)
{
  console.log(result);
//alert('got it');
var model = $('#box3');
model.empty();
$.each(result, function(index, element)
{

  model.append("<label for='pastorg2'>Past-Company-2:</label><span style='margin-left:40px;'><input type='text' name='pastorg2' class='pstorgnz1' value='"+element.past_org2+"' size='20' /></span>");
  model.append("<p><label for='pastdesg1'  >Designation:</label><span style='margin-left:70px;'><input type='text' name='pastdesg2' class='pstorgnz2' value='"+element.job_profile2+"' placeholder='Past Designation' /></span>"+"&nbsp;&nbsp;"+"<label for='duraon'>Start_Year-End_Year:&nbsp;&nbsp;</label><input type='text' name='duraon2' class='pstorgnz3' value='"+element.duration2+"'/></p>");
  //model.append("<input type='submit' name='btn' value='update'/>");
  model.append("<a href='' onclick='return (updInfo2({{Auth::user()->id}}));'>Update</a>");
});



},
error: function ()
{
  alert("wait...");

}
});
});
});
function updInfo(uinfo)
{

var me=uinfo;
var vl1=$(".porgnz1").val();
var vl2=$(".porgnz2").val();
var vl3=$(".porgnz3").val();
if(vl1=='' || vl2=='' || vl3=='')
{
alert("Please fill all fields.");
}

else
{
        $.ajax({
          url: 'updteinfo/{id1}/{id2}/{id3}/{id4}',
          type: "get",
          data: {id1:me,id2:vl1,id3:vl2,id4:vl3},
          success: function(result)
          {
            //console.log(result);
          var model = $('#box2');
          model.empty();
          $.each(result, function(index, element)
          {
            model.append("<h2>"+element.past_org1+"</h2>");
            model.append("<p>"+element.job_profile1+""+"&nbsp;&nbsp;"+""+element.duration1+"</p>");

          });
          },
          error: function ()
          {
            alert("wait...");

          }
        });
}
return false;
}
function updInfo2(uinfo)
{

var me=uinfo;
var vl1=$(".pstorgnz1").val();
var vl2=$(".pstorgnz2").val();
var vl3=$(".pstorgnz3").val();
if(vl1=='' || vl2=='' || vl3=='')
{
alert("Please fill all fields.");
}

else
{
        $.ajax({
          url: 'updteinfo2/{id1}/{id2}/{id3}/{id4}',
          type: "get",
          data: {id1:me,id2:vl1,id3:vl2,id4:vl3},
          success: function(result)
          {
            //console.log(result);
          var model = $('#box3');
          model.empty();
          $.each(result, function(index, element)
          {
            model.append("<h2>"+element.past_org2+"</h2>");
            model.append("<p>"+element.job_profile2+""+"&nbsp;&nbsp;"+""+element.duration2+"</p>");

          });
          },
          error: function ()
          {
            alert("wait...");

          }
        });
}
return false;
}






function showPreview(preview_place,thisone){
    

try {
var files = !!thisone.files ? thisone.files : [];

if (!files.length || !window.FileReader){
  alert("No file selected");
  return;
}
     // no file selected, or no FileReader support

if (/^image/.test(files[0].type)) {// only image file
    var reader = new FileReader(); // instance of the FileReader
    reader.readAsDataURL(files[0]); // read the local file

    reader.onloadend = function () { // set image data as background of div
        //$("#imagePreview").css("background-image", "url("+this.result+")");
        $("#"+preview_place).attr("src", this.result);
        $("#"+preview_place).addClass('headerimage ui-corner-all ui-draggable');
        //$('#'+preview_place).attr('css','margin-top:0px;');
        
        document.getElementById(preview_place).style.marginTop='0px';
        $(document.getElementById(preview_place).parentNode).append('<a id="uX1" onclick="updateImage()" class="bgSave wallbutton blackButton">Save Cover</a>');
    }
 }

} catch (e) {
alert(e);
}



}

function updateImage(){
$('#timelineBackground').addClass('banner');
document.getElementById('load_banner').style.display='block';
var position = $('#timelineBGload1').css('top');
var file = document.getElementById('bgphotoimg1').files[0];

var formData = new FormData();
formData.append('bgimage', file);
formData.append('position',position);
formData.append('_token',$('.token').val());

document.getElementById('uX1').parentNode.removeChild(document.getElementById('uX1'));

var action=$("#bgimageform").attr('action');


//$(document.getElementById('timelineContainer')).append('<img style="max-height:100px; max-width:500px;" src="<?php echo URL::to('images/loading.gif') ?>" id="loading_image" >');

$.ajax({

  url : action,
  type: "POST",
  cache: false,
  contentType: false,
  processData: false,
  data : formData,
  success: function(response){
      
    $('#timelineBackground').removeClass('banner');

    document.getElementById('load_banner').style.display='none';


  },
  error: function(e){
      
          document.write(e.responseText);
  }
});



}



function toggleHireMe(){

$.get("<?php echo URL('hireme') ?>", function(data, status){

  if(data.status==true){

    $("#hire_me_id").addClass("hireMe");

  }else{

    $("#hire_me_id").removeClass("hireMe");

  }

});

}
function rearrangePic(){
   
  $("#timelineBGload1").addClass('headerimage ui-corner-all ui-draggable');
  document.getElementById("timelineBGload1").style.marginTop='0px';
  $(document.getElementById("timelineBGload1").parentNode).append('<a id="uX1" onclick="updatePosition()" class="bgSave wallbutton blackButton">Save Cover</a>');
}
function updatePosition(){
    // alert('rearrangedd');

  $('#timelineBackground').addClass('banner');

  document.getElementById('load_banner').style.display='block';


  var position = $('#timelineBGload1').css('top');

  var file = document.getElementById('bgphotoimg1').files[0];

  var formData = new FormData();

  formData.append('position',position);

  formData.append('_token',$('.token').val());

  document.getElementById('uX1').parentNode.removeChild(document.getElementById('uX1'));

  //$(document.getElementById('timelineContainer')).append('<img style="max-height:100px; max-width:500px;" src="<?php echo URL::to('images/loading.gif') ?>" id="loading_image" >');
   action = PROJECT_URL+"userprofile/updateposition";

  $.ajax({

    url : action,
    type: "POST",
    cache: false,
    contentType: false,
    processData: false,
    data : formData,
    success: function(response){

      $('#timelineBackground').removeClass('banner');

      document.getElementById('load_banner').style.display='none';

      if(response.success==false){
        bootbox.alert(response.message);
      }



    },
    error: function(e){

          document.write(e.responseText);
    }
  });


}


function updateExperience(link,id){
  var dialog = bootbox.dialog({
      title: 'please wait',
      message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
  });
  $.get(link,function(data,status){
      $('#'+id).html(data);
      dialog.modal('hide');
  });

}


function deleteExperience(link){
      bootbox.confirm("Are you sure to delete this experience",
          function(result){
                if(result==true){
                    $.get(link,function(data,status){
                      bootbox.alert(data.message);
                    });
                }
        });
}

//SHOW MORE LINK

$(document).ready(function() {
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});

// SHOW MORE LINK SCRIPT END

