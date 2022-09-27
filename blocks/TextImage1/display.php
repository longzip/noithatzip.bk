<?php
	//$temporary_setting_parameter,$current_block_id
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>

<div class="block-content">
	<div class="wrap relative">
        <a class="post-image" href="<?php echo $temporary_setting_parameter['link'] ?>">
            <img class="scale scale-1" alt="<?php echo $temporary_setting_parameter['title2'] ?>"  src="<?php echo timthumb_url($temporary_setting_parameter['src'], $temporary_setting_parameter['image_width'], $temporary_setting_parameter['image_height']) ?>" />
        </a>
        
        <?php
            if(!empty($temporary_setting_parameter['title2']))
            {
                ?>
                <a class="post-title" href="<?php echo $temporary_setting_parameter['link'] ?>">
                    <?php echo $temporary_setting_parameter['title2'] ?>
                </a>
                <?php
            }
        ?>
        
        <?php
            if(!empty($temporary_setting_parameter['category']))
            {
                $cat_info = get_category($temporary_setting_parameter['category']);
                if(!empty($cat_info))
                {
                    ?>
                    <a class="cat-title" href="<?php hcv_url('c', $cat_info['url'], $cat_info['id']) ?>">
                        <?php echo $cat_info['title'] ?>
                    </a>
                    <?php
                }
                ?>
                
                <?php
            }
        ?>
    </div>
</div>