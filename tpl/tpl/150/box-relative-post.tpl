{foreach from=$posts  item=post}

<div class="box-blog fl border-box v-col-lg-4 v-col-md-4 v-col-sm-12 v-col-xs-12 v-col-tx-12 ">
    <div class="box-blog-content v-mrl-15 ">
        
        <div class="box-blog-image">
            <a href="{$post.link}" class="" title="{$post.title}">
               <img class="hinh1" src="{$g_functions->timthumb_url($post.image, 350, 210, FALSE)} " title="{$post.title}" alt="{$post.title}" />
            </a>
        </div>
        
        <div class="box-text-tt">
            
        
        <h3 class="box-blog-content-title">
            <div class="blog-title-inner">
                <a href="{$post.link}" title="{$post.title}">{$post.title}</a>
            </div>
        </h3>
        
        
        
        
             <div class="meta-item des">
                {if empty($post.description)}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.content), 100)}
                {else}
                    {$g_functions->the_excerpt_max_charlength(strip_tags($post.description), 100)}
                {/if}
            </div>
            
          
         
        <div class="box-blog-text">
            <!--<div class="by-time">-->
            <!--        <spam class="by-date">-->
            <!--        {date("h", $post.time_update)}<a>h-</a>-->
            <!--        </spam>-->
            <!--         <spam class="by-year">-->
            <!--        {date("d/m/Y", $post.time_update)}-->
            <!--        </spam>-->
            <!--    </div>-->
                <div class="box-readmore">
                    <a href="{$post.link}">Xem thêm</a>
                </div>
             

        </div>
        </div> 
    </div>
   
</div>

{/foreach}