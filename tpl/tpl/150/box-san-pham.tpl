{foreach from=$posts  item=post}

{if empty($post.gia_km)}
    {$real_price = $post.gia}
{else}
    {$real_price = $post.gia_km}
{/if}

<div class="item fl border-box v-col-lg-4 v-col-md-4 v-col-sm-6 v-col-xs-6 v-col-tx-6">
		<div class="img-chi-tiet">
			<div class="img">
				<a href="{$post.link}"><img   src="{$g_functions->timthumb_url($post.image, 300, 200)}" alt="{$post.title}" /></a>
				<p class="item-action add-to-cart inline"   price="{$real_price}" particular="{$post.id}" ><span>Mua ngay</span></p>
                <a href="{$post.link}" class="readmore-button item-action inline"><span>Chi tiết</span></a>
			</div>
			{if !empty($post.gia_km)}
			    {$percent = 100 * ($post.gia - $post.gia_km) / $post.gia }
			    <span class="sale-percent">-  {$g_functions->floor($percent) }%</span>
			{/if}


			<div class="chi-tiet">
				<h3><a href="{$post.link}">{$post.title}</a></h3>
			</div>



            <div class="list-price">
                {if !empty($post.gia_km)}
            		<p class="price inline-block">
            			<span></span>{$g_functions->num_to_price($post.gia_km)}<span>₫</span>
            		</p>
            		{if !empty($post.gia)}
            		    <p class="price-old inline-block">
                			<span></span>{$g_functions->num_to_price($post.gia)}<span>₫</span>
                		</p>
            		{/if}
            	{else}
            	    {if !empty($post.gia)}
                        <p class="price-old inline-block">
                		</p>

                		<p class="price inline-block">
                			<span></span>{$g_functions->num_to_price($post.gia)}<span>₫</span>
                		</p>
                	{/if}
    			{/if}

            </div>
		</div>
	</div>
{/foreach}