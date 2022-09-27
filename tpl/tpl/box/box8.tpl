{foreach from=$posts  item=post}

<article class="fl box box8 {$box8_class} flex-item">
    
    <div class="box-content box8-content clearfix">
        <div class="fl box-image box8-image v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
            <a href="{$post.link}" class="" title="{$post.title}">
                <img src="{$g_functions->timthumb_url($post.image, {$box8_thumbnail_width}, {$box8_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
        </div>
        
        <div class="fl box-text box8-text v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
            <h3 class="box-content-title box8-content-title"><a href="{$post.link}" class="news-product-title" title="{$post.title}">{$post.title}</a></h3>
            
            <span class="clear"></span>
            <div class="des">
                {if empty($post.description)}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.content), 150)}
                {else}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.description), 150)}
                {/if}
            </div>
            <span class="clear"></span>
            
            
            <div class="box-readmore box8-readmore none">
                <a href="{$post.link}">Xem thêm</a>
            </div>
                
        </div>
    </div>
    
</article>

{/foreach}

