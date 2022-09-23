{foreach from=$posts  item=post}
    <div class="box box5 fl {$box5_class} flex-item">
        <div class="v-prl-10">
            <div class="box-content clearfix">
                <div class="fl v-col-lg-4 v-col-md-4 v-col-sm-12 v-col-xs-12 v-col-tx-12">
                    <div class="box-image box5-image">
                        <a href="{$post.link}" class="" title="{$post.title}">
                            <img src="{$g_functions->timthumb_url($post.image, {$box5_thumbnail_width}, {$box5_thumbnail_height}, FALSE)}"
                                 title="{$post.title}" alt="{$post.title}"/>
                        </a>
                    </div>
                </div>

                <div class="fl v-col-lg-8 v-col-md-8 v-col-sm-12 v-col-xs-12 v-col-tx-12">
                    <div class="box-text box5-text">
                        <h3 class="box-content-title box5-content-title">
                            <a href="{$post.link}" title="{$post.title}">{$post.title}</a>
                        </h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
{/foreach}