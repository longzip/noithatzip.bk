<?php
	//$temporary_setting_parameter,$current_block_id

//h($temporary_setting_parameter)
?>

<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
    
<div class="block-content">

<ul class="clearfix">
    <?php
		
		array_shift($temporary_setting_parameter);
        array_shift($temporary_setting_parameter);
        $count = count($temporary_setting_parameter);
        //echo $count;
        foreach($temporary_setting_parameter as $k=>$v)
        {
            
            if($k < $count-1)
            {
                //echo '1<br />';
                if($temporary_setting_parameter[$k+1]['depth'] == $temporary_setting_parameter[$k]['depth'])
                {
                    ?>
                    <li class="<?php if(CURRENT_URL == $temporary_setting_parameter[$k]['link']) echo 'active ' ?>" ><a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a></li>
                    <?php
                }
                
                if($temporary_setting_parameter[$k+1]['depth'] > $temporary_setting_parameter[$k]['depth'])
                {
                    ?>
                    <li class="<?php if(CURRENT_URL == $temporary_setting_parameter[$k]['link']) echo 'active ' ?>">
                        <a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a>
                        <span class="menu-arrow"></span>
                        <ul class="sub-menu">
                    <?php
                }
                
                if($temporary_setting_parameter[$k+1]['depth'] < $temporary_setting_parameter[$k]['depth'])
                {
                    $volum = $temporary_setting_parameter[$k]['depth'] - $temporary_setting_parameter[$k+1]['depth'];
                    ?>
                    <li class="<?php if(CURRENT_URL == $temporary_setting_parameter[$k]['link']) echo 'active ' ?>"><a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a></li>
                    <?php 
                        for($i=0;$i<$volum;$i++)
                        {
                            ?>
                            </ul></li>
                            <?php
                        }
                    ?>
                    <?php    
                }
            }
            
            else
            {
                ?>
                <li class="<?php if(CURRENT_URL == $temporary_setting_parameter[$k]['link']) echo 'active ' ?>"><a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a></li>
                <?php 
                for($i=0;$i<$temporary_setting_parameter[$k]['depth'];$i++)
                {
                    ?>
                    </ul></li>
                    <?php
                }
                    ?>
                <?php
            }
            ?>

            <?php
        }
    ?>
    
    
</ul>

</div> 