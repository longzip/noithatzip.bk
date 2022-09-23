<?php
define('SECURE_CHECK', true);
include dirname(dirname(dirname(__FILE__))) . '/config.php';



/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Insert By Link');    
$tpl->assign('css', array(
    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    SITE_URL . '/admin/' . 'css/admin.css',
    '../uploads.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js',
    '../uploads.js'
));
include 'header.php';
/**
 * END Read template
 */     
?>


<style>
.setting-item {
    width: 500px;
    margin-top: 20px;
}

.attribute_input {
	border:1px solid rgb(215, 208, 208);
    padding: 5px 5px;
    width: 240px;
}

select {
    border: 0;
	border:1px solid rgb(215, 208, 208);
    width: 250px;
}

label {
    display: block;
    float: left;
    width: 100px;
}

textarea{
	border:1px solid silver;
    width: 250px!important;
	padding:5px;
}

</style>

<div class="container">
<?php include 'sidebar.php' ?>

<h1 class="title-font">&nbsp;&nbsp;&nbsp;&nbsp;Chèn link ảnh</h1>
<div class="row">
    <form class="col-xs-12" id="insert_by_link_form"  method="POST">
        <div class="form-item">
            <label class="" for="link_insert">Đường dẫn ảnh : </label>
            <input class="form-control text" id="link_insert" value="" type="text" name="link_insert" /><br />
        
        </div>
        <?php 
            
                ?>
                
                
				
                <?php
            
        ?>
        
    </form>
    <div class="col-xs-12 box active" id="display">	
	<img src="" style="max-width: 100%;" />
	<div class="setting-item">
                <label> Title : </label>
                <input class="attribute_input title form-control"  value="" /><br />
                </div>
			   
				<div class="clear"></div>
				
				<div class="setting-item">
                <label> Alt : </label>
                <input style="boder:1px solid silver" class="attribute_input alt form-control"  value="" />
                <br />
				</div>
				
				<div class="clear"></div>
				
				<div class="setting-item">
                <label> Align : </label>
                <select class="form-control align">                    
                    <option value="none">None</option>
					<option value="center">Center</option>
                    <option value="left">Left</option>
                    <option  value="right">Right</option>
					
                </select>
				 <br />
				</div>
				
				<div class="setting-item">
				<label> Description : </label>
                <textarea class="attribute_input description form-control" ></textarea>
                <br />
                </div>
	</div>
</div>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<?php include 'footer.php' ?>