 <div class="new-thread-item box">
    <label class="block label">User name</label>
    <input autocomplete="off" name="user_name" required="" class="block text fl" value="<?php return_value('user_name', $default_value['user_name'], FALSE, TRUE) ?>" />
     <span class="clear"></span>
</div>
<span class="clear"></span>

 <div class="new-thread-item box">
    <label class="block label">Password</label>
    <input autocomplete="off"  name="password"   class="block text fl" value="<?php return_value('password', '', FALSE, TRUE) ?>" />
     <span class="clear"></span>
</div>
<span class="clear"></span>

 <div class="new-thread-item box">
    <label class="block label ">Email</label>
    <input autocomplete="off"  type="email" name="email" required="" class="block text fl" value="<?php return_value('email', $default_value['email'], FALSE, TRUE) ?>" />
     <span class="clear"></span>
</div>
<span class="clear"></span>

<?php 
    if($g_user['permission'] == 'admin')
    {
        ?>
        <div class="new-thread-item box">
            <label class="label block">Permission</label>
            <select name="permission">
                <option  <?php  if($default_value['permission'] == 'admin') echo 'selected' ?> value="admin">Admin</option>
                <option  <?php if($default_value['permission'] == 'editor') echo 'selected' ?>  value="editor">Editor</option>
                <option  <?php if($default_value['permission'] == 'author') echo 'selected' ?>  value="author">Author</option>
                <option  <?php if($default_value['permission'] == 'contributor') echo 'selected' ?>  value="contributor">Contributor</option>
                <option  <?php if($default_value['permission'] == 'member') echo 'selected' ?>  value="member">Member</option>
            </select>
        </div>
        <?php
    }
?> 
 

<div class="new-thread-item box">
    <label class="label block">Gửi thông tin quản trị tới Email</label>
    <select name="send-mail-to-user">
        <option   value="0">Không</option>
        <option   value="1">Có</option>
    </select>
</div>
 

 
 <div class="new-thread-item box">
    <label class="block label">Hình ảnh</label>
     
 
	<div class="form-box image" id="form-image">
		<div class="form-field">
			<input style="width: 70%;" class="form-control" id="image"  value="<?php return_value('image', $default_value['image'], FALSE, FALSE) ?>" type="hidden" name="image" />&nbsp;&nbsp;
			<input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="image" /><br /><br />
			
		</div>
		<img id="image_display" style="max-width: 100%;" src="<?php return_value('image', $default_value['image'], FALSE, FALSE) ?>" />
	
	  
	</div>
    		 
    	
    	<span class="clear"></span>
</div>