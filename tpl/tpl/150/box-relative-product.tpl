{foreach from=$posts  item=post}
    <div class="SidebarProduct-item">
        <div class="SidebarProduct-item-image fl v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-4 v-col-tx-4">
            <a href="{$post.link}" title="{$post.title}">
                <img src="{$g_functions->cdn_timthumb_url($post.image, 300, 300)}" alt="{$post.title}"
                     title="{$post.title}"/>
            </a>
        </div>
        <div class="SidebarProduct-item-text fl v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-8 v-col-tx-8">
            <a href="{$post.link}" title="{$post.title}">
                {$post.title}
            </a>
            <div class="list-price">
                {if !empty($post.gia_km)}
                    <p class="price inline-block">
                        <span>Giá KM:</span> {$g_functions->num_to_price($post.gia_km)}<span> VNĐ</span>
                    </p>
                    <p class="price-old inline-block">
                        <span>Giá:</span> {$g_functions->num_to_price($post.gia)}<span> VNĐ</span>
                    </p>
                {else}
                    <p class="price-old inline-block">
                    </p>
                    <p class="price inline-block">
                        <span>Giá:</span> {$g_functions->num_to_price($post.gia)}<span> VNĐ</span>
                    </p>
                {/if}
            </div>
        </div>
        <span class="clear"></span>
    </div>
{/foreach}