{foreach from=$posts  item=post}
    <div class="showroom-box  animated slideInLeft delay-500 go fl v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-6 v-col-tx-6">
        <div class="showroom-wr">
            <div class="showroom-wr-inner">
                <div class="box-border">
                    <div class=" showroom-image1">
                        <a href="{$post.link}" class="" title="{$post.title}">
                            <img src="{$g_functions->timthumb_url($post.image, 640,380)}" title="{$post.title}"
                                 alt="{$post.title}"/>
                        </a>
                    </div>
                    <div class="showroom-tt">
                        <div class="title-box">
                            <a href="{$post.link}" class="news-product-title" title="{$post.title}">{$post.title}</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>

    </div>
{/foreach}
