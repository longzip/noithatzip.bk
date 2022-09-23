<div class="new-thread-item box">
    <label class="block label">Tên  Form</label>
    <input name="name" class="block text fl" value="<?php return_value('name', $default_value['name'], FALSE, TRUE) ?>" />
     <span class="clear"></span>
</div>
<span class="clear"></span>

<div class="new-thread-item box">
    <label class="block label">Email quản trị</label>
    <input name="mail_to" class="block text fl" value="<?php return_value('mail_to', $default_value['mail_to'], FALSE, TRUE) ?>" />
     <span class="clear"></span>
</div>
<span class="clear"></span>

<div class="new-thread-item box">
    <label class="block  label">Miêu tả</label> 
    <textarea class="main-content text" name="other1"><?php return_value('other1', $default_value['other1'], TRUE, TRUE) ?></textarea>
     
     <span class="clear"></span>
</div>
<span class="clear"></span>

<div class="new-thread-item box">
    <label class="block  label">Văn bản hiển thị khi người dùng gửi form</label> 
    <textarea class="main-content text" name="text_after_submit"><?php return_value('text_after_submit', $default_value['text_after_submit'], TRUE, TRUE) ?></textarea>
     
     <span class="clear"></span>
</div>
<span class="clear"></span>


<div class="new-thread-item box">
    <label class="block  label">Đoạn mã chạy khi Form được gửi</label> 
    <textarea style="width: 772px; box-sizing: border-box; margin: 0px; border: 1px solid rgb(202, 202, 202); background: rgb(251, 251, 251); min-height: 150px; height: 162px;" class="  text" name="other2"><?php return_value('other2', $default_value['other2'], TRUE, TRUE) ?></textarea>     
     <span class="clear"></span>
</div>
<span class="clear"></span>


<div class="new-thread-item box">
    <label class="block  label">Tự động trả lời</label> 
    <div class="guider" style="padding: 10px; background: #f1f1f1; margin-bottom: 20px; border-radius: 5px;">
        <p>Sử dụng @ten_filed thay cho tên giá trị người dùng nhập</p>
    </div>
    
    <div class="auto-reply-item"  style="margin-bottom: 20px;">
        <div class="auto-reply-item-title" style="font-weight: bold;">Tiêu đề mail</div>
        <div class="auto-reply-item-content">
            <input name="auto_reply_title" class=" text" value="<?php return_value('auto_reply_title', $default_value['auto_reply_title'], FALSE, TRUE) ?>" />
        </div>
    </div>
    <div class="auto-reply-item">
        <div class="auto-reply-item-title" style="font-weight: bold;">Nội dung mail</div>
        <div class="auto-reply-item-content">
            <textarea style="width: 772px; box-sizing: border-box; margin: 0px; border: 1px solid rgb(202, 202, 202); background: rgb(251, 251, 251); min-height: 150px; height: 162px;" class="main-content  text" name="auto_reply_content"><?php return_value('auto_reply_content', $default_value['auto_reply_content'], TRUE, TRUE) ?></textarea>
        </div>
    </div>
         
    
    <span class="clear"></span>
</div>
<span class="clear"></span>
 