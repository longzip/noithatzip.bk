<!-- Box tin -->
{foreach from=$posts  item=post}
 
<article class="box box6 {$box6_class}">
    <div class="fl box6-item img v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-5 v-col-tx-12">
        <div class="box6-item-inner">
            <a href="{$post.link}" class="" title="{$post.title}">
                <img src="{$g_functions->timthumb_url($post.image, {$box6_thumbnail_width}, {$box6_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
            </a>
        </div>
    </div>
    
    <div class="fr box6-item text v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-7 v-col-tx-12">
        <div class="box6-item-inner">
            <h3 class="title"><a href="{$post.link}" class="news-product-title" title="{$post.title}">{$post.title}</a></h3>
        
            <span class="clear"></span>
            <div class="des">
                {if empty($post.description)}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.content), 300)}
                {else}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.description), 300)}
                {/if}
            </div>
            
            <div class="meta"> {date('H:i:s A - d/m/Y', $post.time_update)}</div>
            
            <span class="clear"></span>
            
            <div class="box-readmore box6-readmore none">
                <a href="{$post.link}">Xem thêm</a>
            </div>
            
        </div>
        <span class="clear"></span>
    </div>
    
    <span class="clear"></span>
</article>
<span class="clear"></span>

{/foreach}

