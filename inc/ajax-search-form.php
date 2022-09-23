<?php
if(isset($_POST['type']) && $_POST['type']=='search-form-keyup')
{
    $param = array('s'=>$_POST['keyword'], 'limit'=>' LIMIT 7 ');
    $posts = get_posts($param);
    if(empty($posts))
    {
        ?>
        <div class="v-search-form-suggest-inner">
            <div class="v-search-form-suggest-empty">Không tìm thấy kết quả nào</div>
        </div>
        <?php
        die();
    }
    ?>
    <div class="v-search-form-suggest-inner">
    <?php
    foreach($posts as $post)
    {
        $link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
        if(!empty($post['gia'])) $price = price_to_num($post['gia']);
        if(!empty($post['gia_km'])) $sale_price = price_to_num($post['gia_km']);
        ?>
        <div class="v-search-form-suggest-item clearfix" href="<?php echo $link ?>" title="<?php echo $link ?>"> 
            <div class="fl suggest-item-image">
                <a href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <img src="<?php echo $post['image'] ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" />
                </a>
            </div>
            <div class="fl suggest-item-text">
                <a class="item-text-title" href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <?php echo $title ?>
                </a>
                <?php 
                    if( (!empty($price)) || (!empty($sale_price)) ) 
                    {
                        ?>
                        <div class="item-text-price clearfix">
                            <?php 
                                if( (!empty($price)) && (!empty($sale_price)) )
                                {
                                    ?>
                                    <div class="item-text-price-main">
                                        <?php echo num_to_price($price) ?> <span>vnđ</span>
                                    </div>
                                    <div class="item-text-price-other">
                                        <?php echo num_to_price($sale_price) ?> <span>vnđ</span>
                                    </div>
                                    <?php
                                }
                                if( (empty($price)) && (!empty($sale_price)) )
                                {
                                    ?>
                                    <div class="item-text-price-main">
                                        <?php echo num_to_price($sale_price) ?> <span>vnđ</span>
                                    </div>
                                    <?php
                                }
                                if( !(empty($price)) && (empty($sale_price)) )
                                {
                                    ?>
                                    <div class="item-text-price-main">
                                        <?php echo num_to_price($price) ?> <span>vnđ</span>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                    }   
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
    <?php
}