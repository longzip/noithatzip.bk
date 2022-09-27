{foreach from=$posts  item=post}
<div class="box box3 fl {$box3_class} flex-item">
    <div class="box-content box3-content">
        <div class="box-image box3-image">
            <a href="{$post.link}" class="" title="{$post.title}">
               <img src="{$g_functions->timthumb_url($post.image, {$box3_thumbnail_width}, {$box3_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
            
            {if !empty($post.gia)}
                <div class="gia"> Giá: <span>{$post.gia}</span></div>
            {/if}
        </div>
        <div class="box-text box3-text">
            <h3 class="box-content-title box3-content-title">
                <a href="{$post.link}" title="{$post.title}">{$post.title}</a>
            </h3>
            
            <div class="des">
                {if empty($post.vi_tri)}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.description), 300)}
                {else}
                    {$post.vi_tri}
                {/if}
            </div>
            
            <div class="box-readmore box3-readmore none">
                <a href="{$post.link}">Xem thêm</a>
            </div>
        </div>
    </div>
</div>
{/foreach}