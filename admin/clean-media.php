<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
    if(isset($_POST['type']))
    {
        if($_POST['type']='delete_media_item')
        {
            unlink(str_replace(SITE_URL, CLIENT_ROOT, $_POST['url']));
        }
        die();
    }
         
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Công cụ lấy media ngoài trên web';
    $g_page_content['meta_des'] = 'Công cụ lấy media ngoài trên web';
?>

<?php  
	include 'header.php'
?>
<script>
    $("document").ready(function(){
        $("#select-all").click(function(){
            
            if( $(this).is(':checked') )
            {   
                $(".checkbox-item").prop("checked", "checked");
            }
            else $(".checkbox-item").prop("checked", false);
        });
        
        $(".clean-submit-action-all").click(function(){
             
            if(confirm(" Bạn có chắc chắn muốn xóa tất cả những file này ? "))
    		{
    		       
    			if($("#action-all select").val() == "del" )
    			{
    				$("body").find(".checkbox-item").each(function(){
    				    
    					if( $(this).is(':checked') )
    					{
    						var url = $(this).attr("value");
    						var parent = $(this).closest(".media-item");
   						    $.ajax({            
    							url:'<?php echo SITE_URL ?>/admin/?page_type=clean-media',
    							type:"POST",
    							data:{type:"delete_media_item", url:url},
    							success:function(data){
    								//alert(data)
    								parent.css("opacity", "0.3");
                                    var current_count = $(".count").text();
                                    current_count = parseInt(current_count);
                                    current_count--;
                                    $(".count").text(current_count);
                                    $(".checkbox-item[value='" + url + "']").remove();
    							}
    						});     						
    					}
    					
    				});
    			}
    		}
            
            
        });
    });
        
    
</script>
<style>
.flex-item.media-item {
    width: 10%;
    padding: 10px;
    text-align: center;
    font-size:12px;
}
.checkall{
    font-size:13px;
    
}
input[type="checkbox"] {
    position: relative;
    top: 2px;
    cursor: pointer;
}

#action-all{
    margin:0;
}
input.clean-submit-action-all {
    padding: 5px;
}
</style>
<br /><br />
<div id="content" class="container">
<?php 
$used = get_used_media_by_database();



$upload_file = get_all_uploads_file();

$t_upload_file = $upload_file;

foreach($t_upload_file as $k=>$v)
{
if(in_array($v, $used)) unset($upload_file[$k]);
}

$remain_files = array();
foreach($upload_file as $k=>$v)
{
$remain_files[] = $v;
}
?>
    <script type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/jquery_lazyload-2.x/lazyload.min.js"></script>
    <script>
        $(document).ready(function(){
            $("img.lazyload").lazyload();
        });         
    </script>
    
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
            <div class="checkall clearfix">
                <div class="fl">
                    Chọn tất cả ( <span class="count"><?php echo count($remain_files) ?></span> ): <input id="select-all" value="" type="checkbox" /> 
                </div>
                <div id="action-all" class="fr" action="" method="">Với các mục đã chọn :    						
    				<select>
    					<option value="0">None</option>
    					<option value="del">Xóa</option>
    				</select>
    				<input type="button" class="clean-submit-action-all" value="Xác nhận">
    				
    			</div>
            </div>
            <form id="fetch-form" action="" method="POST">
                <input name="type" type="hidden" id="type" value="clean-media" />
                <div class="flex-wrap">
                <?php 
                     
                    
                    foreach($remain_files as $k=>$remain_file)
                    {
                        ?>
                        <div class="flex-item media-item">
                            <a href="<?php echo $remain_file ?>" target="_blank">
                                <img class="lazyload" src="<?php echo CDN_DOMAIN ?>/inc/images/loading-lazyloading.gif"  data-src="<?php echo $remain_file ?>" />
                            </a>
                            <p class="center">
                                <?php echo $k + 1 ?> <input class="checkbox-item" name="media-list[]" value="<?php echo $remain_file ?>" type="checkbox" />
                            </p>
                        </div>
                        <?php
                    }
                ?>
                
                </div>
            </form>
        </div>        
    </div>
        
    
    <span class="clear"></span>
</div>

<?php
	include 'footer.php' 
?>