{foreach from=$posts  item=post}
<div class="box15 box fl {$box15_class} flex-item">
    <div class="box-content box15-content relative v-mrl-15">
        <div class="box-image box15-image">
        	 <a href="{$post.link}" class="" title="{$post.title}">
                <img src="{$g_functions->timthumb_url($post.image, {$box15_thumbnail_width}, {$box15_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
            
            <div class="box-add-to-cart-wrap box15-add-to-cart-wrap">
                <a class="box15-add-to-cart box-add-to-cart" price="{$real_price}" particular="{$post.id}"><span class="fa fa-shopping-basket"></span>Mua ngay</a>
                <a class="box-readmore box15-readmore" href="{$post.link}">Chi tiết</a>
            </div>
        </div>

        <div class="box-text box15-text clearfix">
        	<h3 class="box-content-title box15-content-title"><a href="{$post.link}" title="{$post.title}">{$post.title}</a></h3>
        	<div class="box-list-price box15-list-price">
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

        </div> <!-- .text -->
    </div>
</div>
{/foreach}
