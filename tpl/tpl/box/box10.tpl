{foreach from=$posts  item=post}
<div class="box10 box fl {$box10_class} flex-item">
    <div class="box-content box10-content relative clearfix v-mrl-10">
        <div class="box-content-inner box10-content-inner clearfix">
            <div class="box-image box10-image fl">
            	 <a href="{$post.link}" class="" title="{$post.title}">
                    <img src="{$g_functions->timthumb_url($post.image, {$box10_thumbnail_width}, {$box10_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
                </a>
            </div>
    
            <div class="box-text box10-text fl">
            	<h3 class="box-content-title box10-content-title"><a href="{$post.link}" title="{$post.title}">{$post.title}</a></h3>
            	<div class="box-list-price box10-list-price">
            		<p class="price">
            		    {if empty($post.gia) && empty($post.gia_km)}
            		        {$real_price = 0}
            		        <span class="lien-he">Liên hệ</span>
            		    {/if}
            		    
            		    
            		    {if !empty($post.gia) && empty($post.gia_km)}
            		        {$real_price = $post.gia}
            		        <span class="gia-km"><span>Giá:</span> {$g_functions->num_to_price($post.gia)} ₫</span>
            		    {/if}
            		    
            		    {if empty($post.gia) && !empty($post.gia_km)}
            		        {$real_price = $post.gia_km}
            		        <span class="gia"><span>Giá:</span> {$g_functions->num_to_price($post.gia_km)} ₫</span>
            		    {/if}
            		    
            		    
            		    {if !empty($post.gia) && !empty($post.gia_km)}
            		        {$real_price = $post.gia_km}
            		        <span class="gia-km"><span>Giá:</span> {$g_functions->num_to_price($post.gia)} ₫</span>
            		        <span class="gia line-through">{$g_functions->num_to_price($post.gia)} ₫</span>
            		    {/if}
            		 </p>
        		 
            	</div>
    
            	<div class="box10-add-to-cart box-add-to-cart" price="{$real_price}" particular="{$post.id}">Thêm giỏ hàng</div>
    
            	<a class="box-readmore box10-readmore" href="{$post.link}">Chi tiết</a>
            </div> <!-- .text -->
        </div>
    </div>
</div>
{/foreach}
