<div id="tinymce-youtube" class="arial">
    <p>
        <label class="label">Đường dẫn hình ảnh</label>
        <input id="image-url" class="text" value="" />
        <span class="clear"></span>
    </p>
    
    
    <p>
        <label class="label">Chú thích</label>
        <input id="image-des" class="text" value="" />
        <span class="clear"></span>
    </p>
    
    <p>
        <label class="label">Căn lề</label>
        <select id="image-align">
            <option value="center">Giữa</option>
            <option value="left">Trái</option>
            <option value="right">Phải</option>
        </select>
        <span class="clear"></span>
    </p>
    
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
        width: 500px;
    }
    
    select{
        border-radius: 2px;
        border: 1px solid rgb(218, 213, 213);
        padding: 4px 10px;
        width: 100px;
    }
    
    p{
        margin:20px 0;
    }
    
    label {
    margin-bottom: 5px;
    display: block;
    }
</style>