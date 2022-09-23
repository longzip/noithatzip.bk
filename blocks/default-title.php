<?php

if(!empty($temporary_setting_parameter['title'])) 
{
    ?>
    <<?php echo $block_title_wrap ?> class="block-title">
        <?php 
            if(!empty($temporary_setting_parameter['title_link'])) 
            {
                ?>
                <a  title="<?php echo $temporary_setting_parameter['title'] ?>" href="<?php echo $temporary_setting_parameter['title_link'] ?>">
                <?php
            }
            ?>
            <span  class="block-title-inner"><?php echo $temporary_setting_parameter['title']; ?></span>
            <?php                   
            if(!empty($temporary_setting_parameter['title_link'])) 
            {
                ?>
                </a>
                <?php
            }
        ?>
    </<?php echo $block_title_wrap ?>>
    <?php
    if(!empty($temporary_setting_parameter['block_sub_title'])) 
    {
        ?>
        <div class="block-sub-title">
            <?php echo $temporary_setting_parameter['block_sub_title'] ?>
        </div>
        <?php
    }
    ?>
    <?php
}