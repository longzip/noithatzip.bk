{foreach from=$posts  item=post}
<div class="box16 box fl {$box16_class} flex-item">
    <div class="box-content box16-content relative clearfix v-mrl-10">
        <div class="box-content-inner box16-content-inner clearfix">
            
            <div class="box-image box16-image">
            	 <a href="{$post.link}" class="" title="{$post.title}">
                    <img src="{$g_functions->timthumb_url($post.image, {$box16_thumbnail_width}, {$box16_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
                </a>
            </div>
    
            <div class="box-text box16-text">
            	<h3 class="box-content-title box16-content-title"><a href="{$post.link}" title="{$post.title}">{$post.title}</a></h3>
            </div>
            
        </div>
    </div>
</div>
{/foreach}
