{foreach from=$posts  item=post}

<article class="news-box">
    <div class="fl news-image v-col-lg-3 v-col-md-3 v-col-sm-4 v-col-xs-12 v-col-tx-12">
        <div class="news-content">
            <a href="{$post.link}" class="" title="{$post.title}">
                <img src="{$g_functions->timthumb_url($post.image, 600, 400)}" title="{$post.title}" alt="{$post.title}" />
            </a>
        </div>
    </div>

    <div class="fr text v-col-lg-9 v-col-md-9 v-col-sm-8 v-col-xs-12 v-col-tx-12">
        <a href="{$post.link}" class="news-product-title" title="{$post.title}">{$post.title}</a>
        <!--<div class="meta">( {date('H:i:s A - d/m/Y', $post.time_update)} )</div>-->
        <span class="clear"></span>
        <div class="news-des">
            {if empty($post.description)}
                {$g_functions->the_excerpt_max_charlength(strip_tags($post.content), 330)}
            {else}
                {$g_functions->the_excerpt_max_charlength(strip_tags($post.description), 330)}
            {/if}
        </div>

        <span class="clear"></span>
        <a  href="{$post.link}" class="news-read-more">Xem thêm  »</a>
        <span class="clear"></span>
    </div>

    <span class="clear"></span>
</article>
<span class="clear"></span>

{/foreach}
