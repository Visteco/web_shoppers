<?php $profilepic= empty(Session::get('profilepic')) ? URL::to('images/user.png') : URL::to('public/userimages/user_'.Auth::user()->id."/medium/".Session::get('profilepic'))  ?>
<h2><span><!--img src="./images/edit.png"--><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> Create Post</h2>
<div class="app_user">
  <p class="pro-pic">
    <img src="<?php echo $profilepic;?>">
    <input type="text" id="post_description" class="msg_p" contenteditable="true" onfocus="unsetPlaceHolder(this)" onblur="setPlaceHolder(this)" oninput="searchTagsForUser(this)" placeholder="What's on your mind ?">
    <div class="row" id='external_content'>
    </div> 
    <ul class="pro-list" id="pro_list">
      <!-- starts code for select image -->
      <li id="file_preview"> 
        <img id="imagePreview" class="pro-pic" src=""/>
        <img id="load_image" class="pro-pic" style="display:none;width:20%"  src="{{ URL::to('public/images/postloader.gif') }}"  />
      </li>
    </ul>
  </p>
  <div class="post_edit">
    <div class="post_edit_left"><!--img src="./images/camra.png"--><i class="fa fa-camera" aria-hidden="true"></i>
      <label class="custom-file">Photo/Video
      <input type="file" id="post_file" class="custom-file-input" onchange="validateFile(this)" multiple>
      <span class="custom-file-control"></span> </label>
    </div>
    <div class="post_edit_right">
      <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="publish_status" name='publish_status'>
        <option value="2" class="public_icon">Public</option>
        <option value="1" class="friend_icon">Friends</option>
        <option value="0" class="except_icon">only me</option>
        <option value="3" class="more_icon">private</option>
      </select>
      <button type="button" class="button_red" id="do_post_submit" onclick="doPost(this)">Post</button>
    </div>
  </div>
</div>