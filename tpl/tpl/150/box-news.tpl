{foreach from=$posts  item=post}
    <div class="news-box1  animated slideInLeft delay-500 go fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
        <div class="new-wr">
            <div class="new-wr-inner">
                <div class="box-border">
                    <div class=" news-image1">
                        <a href="{$post.link}" class="" title="{$post.title}">
                            <img src="{$g_functions->timthumb_url($post.image, 500, 400)}" title="{$post.title}"
                                 alt="{$post.title}"/>
                        </a>
                    </div>
                    <div class="new-tt">
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