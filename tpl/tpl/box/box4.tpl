{foreach from=$posts  item=post}
<div class="box box4 fl {$box4_class} flex-item">
    <div class="v-prl-10">
    <div class="box-content box4-content">
        <div class="box-image box4-image">
            <a href="{$post.link}" class="" title="{$post.title}">
               <img src="{$g_functions->timthumb_url($post.image, {$box4_thumbnail_width}, {$box4_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
        </div>
        
        <div class="box-text box4-text">
            <h3 class="box-content-title box4-content-title">
                <a href="{$post.link}" title="{$post.title}">{$post.title}</a>
            </h3>
            
            {if !empty($post.gia)}
                <div class="meta-item gia"> Giá: <span>{$post.gia}</span></div>
            {/if}
            
            {if !empty($post.vi_tri)}
                <div class="meta-item vi-tri"> Vị trí: <span>{$post.vi_tri}</span></div>
            {/if}
            
            {if !empty($post.tien_do)}
                <div class="meta-item tien-do"> Tiến độ: <span>{$post.tien_do}</span></div>
            {/if}
            
            <div class="meta-item des">
                {if empty($post.description)}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.content), 300)}
                {else}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.description), 300)}
                {/if}
            </div>
            
            <div class="box-readmore box4-readmore none">
                <a href="{$post.link}">Xem thêm</a>
            </div>
        </div>
    </div>
    </div>
</div>
{/foreach}