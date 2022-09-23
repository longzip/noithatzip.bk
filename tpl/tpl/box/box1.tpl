{foreach from=$posts  item=post}
<div class="box1 box fl {$box1_class} flex-item">
    <div class="box-content box1-content">
        <div class="relative">
	        <div class="box-image box1-image">
	            <a href="{$post.link}" class="" title="{$post.title}">
	                <img src="{$g_functions->timthumb_url($post.image, {$box1_thumbnail_width}, {$box1_thumbnail_height}, FALSE)}" title="{$post.title}" alt="{$post.title}" />
	            </a>
	        </div>
	        <div class="box-text box1-text">
		        <h3 class="box-content-title box1-content-title">
		            <a href="{$post.link}" title="{$post.title}">{$post.title}</a>
		        </h3>
		        
		         <div class="box-readmore box1-readmore none">
                    <a href="{$post.link}">Xem thêm</a>
                </div>
	        </div>
        </div>
    </div>
</div>
{/foreach}