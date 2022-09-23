<?php
$default = array(
    'title'     => '',
    'title_link'    => '',
    '0'     => array(
        'link'      => '',
        'anchor'    => '',
        'depth'     => '0'
    )
);


if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;

 

?>

<script>
    $(document).ready(function(){
        var menu_item_count = $(".menu-item").size();
        
        $("body").on("click", ".add_child", function(){
            var parent = $(this).parent().parent();
            var depth = parseInt(parent.attr("depth")) + 1;
            var margin_left = depth*20
             
            
            
            var add = '<div style="margin-left:' + margin_left + 'px" id="menu-item-' + menu_item_count + '" class="menu-item array_form" depth="' + depth + '">\
                            <div class="anchor-title new represent pointer fl">New Menu</div> <div class="fr"><div class="fl action expand pointer">Mở / đóng</div> <div class="fl action add_child pointer">Thêm Menu con</div><div class="fl action delete pointer">Xóa</div></div>\
                            <span class="clear"></span>\
                            <div class="inner" style="display: none;">\
                                <div class="menu-item-item text">\
								<input placeholder="Url" style="" class="link form-control parameter-depth-1" parameter="link" type="text" value="" />\
                                </div>\
								<div class="menu-item-item text">\
									<input placeholder="Anchor Text" particular="' + menu_item_count + '" class="anchor-text form-control parameter-depth-1" parameter="anchor" type="text" value="" />\
									<div class="search-result"></div>\
								</div>\
								<div class="menu-item-item depth">\
								<input placeholder="Depth" class="form-control parameter-depth-1 depth" parameter="depth" type="number" value="' + depth + '" />\
								 </div>\
								<span class="clear"></span>\
							</div>\
                        </div>';
            parent.after(add);
            menu_item_count++;
            
        })
        
        $("body").on("click", ".expand", function(){
                var parent = $(this).parent().parent();
                parent.find('.inner').each(function(){
                $(this).slideToggle();
            });
        });
        
        $("body").on("click", ".delete", function(){
                var parent = $(this).parent().parent();
                parent.remove();
        });
        
        $("body").on("change", ".depth", function(){
                var parent = $(this).parent().parent();
                parent.css("margin-left", 20*$(this).val() + "px");
        });
        
        $("body").on("click", ".add", function(){
            var depth = 0;
            var margin_left = depth*20
            var add = '<div style="margin-left:' + margin_left + 'px" id="menu-item-' + menu_item_count + '" class="menu-item array_form" depth="' + depth + '">\
                            <div class="anchor-title new represent pointer fl">New Menu</div> <div class="fr"><div class="fl action expand pointer">Mở / đóng</div> <div class="fl action add_child pointer">Thêm Menu con</div><div class="fl action delete pointer">Xóa</div></div>\
                            <span class="clear"></span>\
                            <div class="inner" style="display: none;">\
                                <div class="menu-item-item text">\
								<input placeholder="Url" style="" class="link form-control parameter-depth-1" parameter="link" type="text" value="" />\
                                </div>\
								<div class="menu-item-item text">\
									<input placeholder="Anchor Text" particular="' + menu_item_count + '" class="anchor-text form-control parameter-depth-1" parameter="anchor" type="text" value="" />\
									<div class="search-result"></div>\
								</div>\
								<div class="menu-item-item depth">\
								<input placeholder="Depth" class="form-control parameter-depth-1 depth" parameter="depth" type="number" value="' + depth + '" />\
								 </div>\
								<span class="clear"></span>\
							</div>\
                        </div>';
            //$("#begin-menu").after(add);
            $("#wrap-menu .sortable ").append(add);
            menu_item_count++;
        });
        
		
		
		$("body").on("click", ".link-item", function(){
            var link = $(this).attr("link");
            var title = $(this).attr("title");
            
            var depth = 0;
            var margin_left = depth*20
            var add = '<div style="margin-left:' + margin_left + 'px" id="menu-item-' + menu_item_count + '" class="menu-item array_form" depth="' + depth + '">\
                            <div class="anchor-title  new represent pointer fl">New Menu</div> <div class="fr"><div class="fl action expand pointer">Mở / đóng</div> <div class="fl action add_child pointer">Thêm Menu con</div><div class="fl action delete pointer">Xóa</div></div>\
                            <span class="clear"></span>\
                            <div class="inner"  >\
                                <div class="menu-item-item text">\
								<input placeholder="Url" style="" class="link form-control parameter-depth-1" parameter="link" type="text" value="' + link + '" />\
                                </div>\
								<div class="menu-item-item text">\
									<input placeholder="Anchor Text" particular="' + menu_item_count + '" class="anchor-text form-control parameter-depth-1" parameter="anchor" type="text" value="' + title + '" />\
									<div class="search-result"></div>\
								</div>\
								<div class="menu-item-item depth">\
								<input placeholder="Depth" class="form-control parameter-depth-1 depth" parameter="depth" type="number" value="' + depth + '" />\
								 </div>\
								<span class="clear"></span>\
							</div>\
                        </div>';
            $("#begin-menu").after(add);
            menu_item_count++;
        });
		
        $(".sortable").sortable();
    
    })
</script>

<style>

    
</style>
<script>
	$(document).ready(function(e){
		$("body").on("keyup", ".anchor-text", function(e){
		
			var count_search_item = 0;
			var key_code = e.keyCode;
			var parent = $(this).parent().parent().parent();
			var anchor_text = $(this).val();
			
			var particular = $(this).attr("particular");
			
			var active_item = 1;
			
			parent.find(".anchor-title").each(function(){
				$(this).empty().append(anchor_text);
				$(this).removeClass("new");
			});
			 
			switch(key_code)
			{
				
				case 13 : //enter
				{
					count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()
					
					if(count_search_item>0)
					{
						var link = $(".search-result .active .serch-result-link").text();
						var anchor = $(".search-result .active .serch-result-title").text();
						 
						$("#menu-item-" + particular + " .link").val(link);
						$("#menu-item-" + particular + " .anchor-text").val(anchor);
						
						$("#menu-item-" + particular + " .anchor-title").empty().append(anchor);
						
						$(".search-result").empty();
					}
				}
				break;
				
				case 40 : //xuong
				{	
					count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()
					
					var active_item =  $("#menu-item-" + particular + " .menu-search-item.active").attr("stt")
					
					if(active_item < count_search_item)
					{
						active_item++;
						vcount_search_item = $("#menu-item-" + particular + " .menu-search-item").size()
						$(".menu-search-item").removeClass("active")
						$("#menu-search-item-" + active_item).addClass("active");
					}
					
					count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()
					
					if(count_search_item>0)
					{
						var link = $(".search-result .active .serch-result-link").text();
						var anchor = $(".search-result .active .serch-result-title").text();
						 
						$("#menu-item-" + particular + " .link").val(link);
						$("#menu-item-" + particular + " .anchor-text").val(anchor);
						
						$("#menu-item-" + particular + " .anchor-title").empty().append(anchor);
						
					}
					 
				}
				break;
				
				case 38 : //len
				{
					var active_item =  $("#menu-item-" + particular + " .menu-search-item.active").attr("stt")
					if(active_item > 1)
					{
						active_item--;
						$(".menu-search-item").removeClass("active")
						$("#menu-search-item-" + active_item).addClass("active");
					}
					
					count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()
					
					if(count_search_item>0)
					{
						var link = $(".search-result .active .serch-result-link").text();
						var anchor = $(".search-result .active .serch-result-title").text();
						 
						$("#menu-item-" + particular + " .link").val(link);
						$("#menu-item-" + particular + " .anchor-text").val(anchor);
						
						$("#menu-item-" + particular + " .anchor-title").empty().append(anchor);
						
					}
				}
				break;
				
				default :
				{
					if(anchor_text.length>0)
					{
						$.ajax({
							url:"<?php echo SITE_URL ?>/admin/?page_type=handle-ajax",
							type:"post",
							data:{
								type:"load_menu_block",
								s:anchor_text
							},
							success:function(data){               
								$("#menu-item-" + particular + " .search-result").empty().append(data);
							
							}
							//error:alert("error")
						}) 
					}
					else
					{
						$(".search-result").empty();
					}
					
				}
			}
		})
		
		$("body").on("mouseenter", ".menu-search-item", function(){
			
			$(".menu-search-item").removeClass("active");
			$(this).addClass("active")
			
			active_item = $(this).attr("stt")
			
			var parent = $(this).parent().parent().parent().parent().parent();
			var parent_id = parent.attr("id")
            
             
			 
			 
			var link = $(".search-result .active .serch-result-link").text();
			var anchor = $(".search-result .active .serch-result-title").text();
				 
			$("#" + parent_id + " .link").val(link);
			$("#" + parent_id + " .anchor-text").val(anchor);
			
			$("#" + parent_id + " .anchor-title").empty().append(anchor);
		})
		
		$("body").on("click", ".menu-search-item", function(){
			$(".search-result").empty();
		})
			
		$("body").on("hover", ".anchor-text", function(){
			$(".search-result").empty()
		})
		
		$("body").on("focusout", ".anchor-text", function(){
			setTimeout(function(){
				$(".search-result").empty();
			},200)
		});
        
        $(".list-link-item-title").click(function(){
            var parent = $(this).closest(".list-link-item");
            $(".list-link-item-content").slideUp();
            parent.find(".list-link-item-content").each(function(){
                $(this).slideToggle();
            });
            
            $(".list-link-item-title i").removeClass("fa-caret-up").addClass("fa-caret-down");
            $(this).find("i").each(function(){
                $(this).addClass("fa-caret-up").removeClass("fa-caret-down");;
            });
        });
	
        
    });
</script>

<form id="menu_form_setting"  class="block_form " block_id="0" type="array">
<?php  display_block_setting_default($default);  ?>
<div id="wrap-menu" class="border-box clearfix">
    <div class="fl col1 v-col-lg-4 v-col-md-6 v-col-sm-6">
        <div class="col1-inner">
            <h2 class="col-title">Chọn nhanh</h2>
            <div class="col-content">
                <?php
                
                $post_types = get_post_types();
                 
                foreach($post_types as $k=>$post_type)
                {
                    ?>
                    <div class="list-link-item">
                        <h3 class="list-link-item-title"><?php echo $post_type['name'] ?><i class="fr fa fa-caret-<?php if($k==0) echo 'up';else echo 'down' ?>" aria-hidden="true"></i></h3>
                        <div class="list-link-item-content" <?php if($k==0) : ?> style="display: block;" <?php endif; ?> >
                            <?php 
                                $arg = array(
                                    'post_type'     => $post_type['id'],
                                    'limit'         => ' LIMIT 999 ',
                                    'order'         => ' ORDER BY view_count DESC ',
                                    'field'         => 'title,url,id'
                                );
                                $posts = get_posts($arg);
                                foreach($posts as $post)
                                {
                                    ?>
                                    <div class="link-item" title="<?php echo $post['title'] ?>" link="<?php hcv_url('p', $post['url'], $post['id']) ?>">
                                        <?php echo $post['title'] ?>
                                        <i class="fr fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                
                ?>
                <div class="list-link-item">
                    <h3 class="list-link-item-title">Chuyên mục<i class="fr fa fa-caret-down" aria-hidden="true"></i></h3>
                    <div class="list-link-item-content"   >
                        <?php 
                             
                            $categories = get_categories();
                            foreach($categories as $category)
                            {
                                ?>
                                <div class="link-item" title="<?php echo $category['title'] ?>" link="<?php hcv_url('c', $category['url'], $category['id']) ?>">
                                    <?php echo $category['title'] ?>
                                    <i class="fr fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                
                <div class="list-link-item">
                    <h3 class="list-link-item-title">Tags<i class="fr fa fa-caret-down" aria-hidden="true"></i></h3>
                    <div class="list-link-item-content"   >
                        <?php 
                             
                            $tags = get_tags();
                            foreach($tags as $tag)
                            {
                                ?>
                                <div class="link-item" title="<?php echo $tag['title'] ?>" link="<?php hcv_url('t', $tag['url'], $tag['id']) ?>">
                                    <?php echo $tag['title'] ?>
                                    <i class="fr fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fr col2 v-col-lg-8 v-col-md-6 v-col-sm-6">
        <h2 class="col-title">Danh sách menu <span class="fr add pointer">(+)</span></h2>
        <div class="col2-inner sortable">                
                <span class="clear"></span><br />
                
                <div id="begin-menu"></div>
                <?php 
                	unset($default['title']);
                    unset($default['title_link']);
                    foreach($default as $k=>$v)
                    {
                        ?>
                
                        <div style="margin-left:<?php echo $v['depth']*20 ?>px" id="menu-item-<?php echo $k ?>" class="menu-item array_form" depth="<?php echo $v['depth'] ?>">
                            <div class="anchor-title represent pointer fl"><?php echo $v['anchor'] ?></div> <div class="fr"><div class="fl action expand pointer">Mở / đóng</div> <div class="fl action add_child pointer">Thêm Menu con</div><div class="fl action delete pointer">Xóa</div></div>
                            <span class="clear"></span>
                            <div class="inner" style="display: none;">
                                <div class="menu-item-item text">
                					<input placeholder="Url" class="link form-control parameter-depth-1" parameter="link" type="text" value="<?php echo $v['link'] ?>" />
                                </div>
                				
                				<div class="menu-item-item text">
                					<input placeholder="Anchor Text" particular="<?php echo $k ?>" class="anchor-text anchor-text form-control parameter-depth-1" parameter="anchor" type="text" value="<?php echo htmlspecialchars($v['anchor']) ?>" />
                					<div class="search-result"></div>
                				</div>
                				
                				<div class="menu-item-item depth">
                					<input placeholder="Depth" class="form-control parameter-depth-1 depth" parameter="depth" type="number" value="<?php echo $v['depth'] ?>" />
                				</div>
                				<span class="clear"></span>
                			</div>
                        </div>
                        <?php
                    }
                ?> 
        </div>
    </div>
</div>
</form>

