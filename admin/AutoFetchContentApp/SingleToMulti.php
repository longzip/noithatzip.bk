<?php
if(!defined('SECURE_CHECK')) die('Stop');
?>

<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/admin/AutoFetchContentApp/DownloadImage.css" />
<script src="<?php echo SITE_URL ?>/admin/AutoFetchContentApp/js/js.js"></script>



<div class="fl" style="width: 1000px;margin-left: 15px;">
<a href="<?php echo SITE_URL ?>/admin/AutoFetchContent">Home</a><br /><br />


<label>Chọn nhanh</label>
<select id="select_domain">
    <option value="">Chọn</option>
    <option value="rongbay">Rongbay.com</option>
    <option value="chothaivn">Chothai.vn</option>
</select>
<br /><br />

<label>Chuyên mục</label>
<select id="select_category">
        
        <?php 
            $categories = models_query::query_terms(array('term_parent_category'=>'0'));
            
            foreach($categories as $option_value)
            {
                ?>
                <option value="<?php echo $option_value['term_id'] ?>"><?php echo $option_value['term_title'] ?></option>
                <?php 
                    $categories_1 = models_query::query_terms(array('term_parent_category'=>$option_value['term_id']));
                    foreach($categories_1 as $v_categories_1)
                    {
                        
                        ?>
                        <option value="<?php echo $v_categories_1['term_id'] ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?php echo $v_categories_1['term_title'] ?></option>
                        <br />
                        <?php
                    }
                ?>
                <?php
            }

        ?>
    </select>
    <br /><br />
    
<label>Nhu cầu</label>
<select id="select_nhu_cau">
    <option value="can-ban">Cần bán</option>
    <option value="can-mua">Cần mua</option>
</select>
<br /><br /><br /><br />
<form>
    <label>Cấu trúc URL</label>
    <span class="clear"></span>
    <input id="main-url" type="text" placeholder="URL chính" />
    <input id="group-url" type="text" placeholder="Dấu hiệu nhận biết URL nhánh" />
    <input id="detail-url" type="text" placeholder="Dấu hiệu nhận biết URL bài chi tiết" />
    
    
    
    <br /><br /><br /><br /><br />
    <label>Cấu trúc Bài viết</label>
    <span class="clear"></span>
    <input id="url-base" type="text" placeholder="Base url" />
    
    <input id="p-title" type="text" placeholder="Dấu hiệu nhận biết tiêu đề" />
    <input id="p-author"type="text" placeholder="Dấu hiệu nhận biết tên người đăng" />
    <input id="p-phone"type="text" placeholder="Dấu hiệu nhận biết số điện thoại" />
    <input id="p-email"type="text" placeholder="Dấu hiệu nhận biết email" />
    <input id="p-content"type="text" placeholder="Dấu hiệu nhận biết nội dung bài viết" />
    <input id="p-image"type="text" placeholder="Dấu hiệu nhận biết hình ảnh" />
    <input id="p-price"type="text" placeholder="Dấu hiệu nhận biết giá" />
    
    <span class="clear"></span><br />
    <input type="button" value="Lấy nội dung" id="get_content" />
</form>

<span class="clear"></span><br />
<div id="noti"></div>
</div>