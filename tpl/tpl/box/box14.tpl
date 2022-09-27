{foreach from=$posts  item=post}
<div class="box14 box fl {$box14_class} flex-item">
    <div class="box-content box14-content relative v-mrl-15">
        <div class="box-image box14-image">
        	 <a href="{$post.link}" class="" title="{$post.title}">
                <img src="{$g_functions->timthumb_url($post.image, {$box14_thumbnail_width}, {$box14_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
            
            <a class="box-readmore box14-readmore" href="{$post.link}">Chi tiết</a>
        </div>

        <div class="box-text box14-text clearfix">
        	<h3 class="box-content-title box14-content-title"><a href="{$post.link}" title="{$post.title}">{$post.title}</a></h3>
        	<div class="box-list-price box14-list-price">
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
        		        <span class="gia-km"><span>Giá:</span> {$g_functions->num_to_price($post.gia_km)} ₫</span>
        		        <span class="gia line-through">{$g_functions->num_to_price($post.gia)} ₫</span>
        		    {/if}
        		 </p>
        	</div>

        	<div class="box14-add-to-cart box-add-to-cart add-to-cart" price="{$real_price}" particular="{$post.id}"><span class="fa fa-shopping-basket"></span></div>
        </div> <!-- .text -->
    </div>
</div>
{/foreach}
