<div id="tinymce-youtube" class="arial">
    <label class="label">Đường dẫn Video</label>
    <input placeholder="Ví dụ : http://www.youtube.com/watch?v=1234567" id="video-url" class="text" value="" />
    <span class="clear"></span><br />
    
	
	<br />
	
	<label class="label">Chiều rộng Video</label>
    <input  style="width:100px"  id="video-width" class="text" type="number" value="600" />
    <span class="clear"></span><br /><br />
	
	<label class="label">Chiều cao video &nbsp;</label>
    <input style="width:100px" id="video-height" class="text" type="number" value="315" />
    <span class="clear"></span><br /><br />
    
    <label class="label">Tự động chạy &nbsp;</label>
    <select id="auto-play" class="text" style="border: 1px solid silver; padding: 5px 10px; margin-left: 13px; width: 100px;">
        <option value="0">Không</option>
        <option value="1">Có</option>
    </select>
    <span class="clear"></span><br /><br />
</div>

<style>

    *{
        font-size:13px;
    }
    .arial{
        font-family:arial;
    }
    
    input.text{
        border-radius: 2px;
        border: 1px solid rgb(218, 213, 213);
        padding: 4px 10px;
        width: 300px;
    }
</style>