{foreach from=$posts  item=post}
<div class="box17 box fl {$box17_class} flex-item">
    <div class="box-content box17-content relative clearfix v-mrl-10">
        <div class="box-content-inner box17-content-inner clearfix">
            
            <div class="box-image box17-image">
            	 <a href="{$post.link}" class="" title="{$post.title}">
                    <img src="{$g_functions->timthumb_url($post.image, {$box17_thumbnail_width}, {$box17_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
                </a>
                
                <a class="box-readmore box17-readmore" href="{$post.link}"><i class="fa fa-eye" aria-hidden="true"></i></a>
            </div>
    
            <div class="box-text box17-text">
            	<h3 class="box-content-title box17-content-title"><a href="{$post.link}" title="{$post.title}">{$post.title}</a></h3>
            	
            	<div class="box-list-price box17-list-price clearfix">
            		<p class="price">
            		    {if empty($post.gia) && empty($post.gia_km)}
            		        {$real_price = 0}
            		        <span class="lien-he">Liên hệ</span>
            		    {/if}
            		    
            		    
            		    {if !empty($post.gia) && empty($post.gia_km)}
            		        {$real_price = $post.gia}
            		        <span class="gia-km"><span></span> {$g_functions->num_to_price($post.gia)} ₫</span>
            		    {/if}
            		    
            		    {if empty($post.gia) && !empty($post.gia_km)}
            		        {$real_price = $post.gia_km}
            		        <span class="gia"><span></span> {$g_functions->num_to_price($post.gia_km)} ₫</span>
            		    {/if}
            		    
            		    
            		    {if !empty($post.gia) && !empty($post.gia_km)}
            		        {$real_price = $post.gia_km}
            		        <span class="gia-km"><span></span> {$g_functions->num_to_price($post.gia)} ₫</span>
            		        <span class="gia line-through">{$g_functions->num_to_price($post.gia)} ₫</span>
            		    {/if}
            		 </p>
            		 
            		 <div class="box17-add-to-cart box-add-to-cart" price="{$real_price}" particular="{$post.id}"><i class="fa fa-shopping-bag" aria-hidden="true"></i><span>Thêm giỏ hàng</span></div>
            		 
            	</div>
            	
            </div>
            
        </div>
    </div>
</div>
{/foreach}
