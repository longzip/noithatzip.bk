{foreach from=$posts  item=post}
<div class="box13 box fl {$box13_class} flex-item">
    <div class="box-content box13-content relative v-mrl-15">
        <div class="box-image box13-image">
        	 <a href="{$post.link}" class="" title="{$post.title}">
                <img src="{$g_functions->timthumb_url($post.image, {$box13_thumbnail_width}, {$box13_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
        </div>

        <div class="box-text box13-text clearfix">
        	<h3 class="box-content-title box13-content-title"><a href="{$post.link}" title="{$post.title}">{$post.title}</a></h3>
        	<div class="box-list-price box13-list-price">
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
        	
        	<div class="des">
                {if empty($post.description)}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.content), 70)}
                {else}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.description), 70)}
                {/if}
            </div>

        	<div class="box13-add-to-cart box-add-to-cart" price="{$real_price}" particular="{$post.id}">Thêm giỏ hàng</div>

        	<a class="box-readmore box13-readmore" href="{$post.link}">Chi tiết</a>
        </div> <!-- .text -->
    </div>
</div>
{/foreach}
