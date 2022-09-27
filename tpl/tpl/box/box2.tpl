{foreach from=$posts  item=post}

<div class="box box2 fl {$box2_class} flex-item ">
    <div class="box-content box2-content">
        <div class="box-image box2-image">
            <a href="{$post.link}" class="" title="{$post.title}">
               <img src="{$g_functions->timthumb_url($post.image, {$box2_thumbnail_width}, {$box2_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
        </div>
        
        <div class="box-text box2-text">
            <h3 class="box-content-title box2-content-title">
                <a href="{$post.link}" title="{$post.title}">{$post.title}</a>
            </h3>
            
            {if !empty($post.gia)}
                <div class="meta-item gia"> Giá: <span>{$post.gia}</span></div>
            {/if}
            
            {if !empty($post.vi_tri)}
            <div class="meta-item vi-tri">
                Vị trí: <span>{$post.vi_tri}</span>
            </div>
            {/if}
            
            {if !empty($post.tien_do)}
                <div class="meta-item tien-do"> Tiến độ: <span>{$post.tien_do}</span></div>
            {/if}
            
            
            {if !empty($post.description)}
            <div class="meta-item des none">
                {$post.description}
            </div>
            {/if}
            
            <div class="box-readmore box2-readmore none">
                <a href="{$post.link}">Xem thêm</a>
            </div>

        </div>
    </div>
</div>
{/foreach}