<?php
	//$temporary_setting_parameter,, $current_block_id
?>

<?php 
    include PATH_ROOT . '/blocks/default-title.php';
    $default = $temporary_setting_parameter;
?>



<div class="block-content">
<?php 

 

	switch($default['left_div_right'])
{
    case '1' :
    {
        $left_class = ' v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12 ';
        $right_class = ' v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12 ';
        break;
    }
    case '1/2' :
    {
        $left_class = ' v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-12 v-col-tx-12 ';
        $right_class = ' v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-12 v-col-tx-12 ';
        break;
    }
    case '2' :
    {
        $left_class = ' v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-12 v-col-tx-12 ';
        $right_class = ' v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-12 v-col-tx-12 ';
        break;
    }
    case '1/3' :
    {
        $left_class = ' v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-12 v-col-tx-12 ';
        $right_class = ' v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-12 v-col-tx-12 ';
        break;
    }
    case '3' :
    {
        $left_class = ' v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-12 v-col-tx-12 ';
        $right_class = ' v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-12 v-col-tx-12 ';
        break;
    }
}

?>
<div class="v-TextImage clearfix" style="background-image: url(<?php echo $default['bg_image'] ?>);background-color:<?php echo $default['bg_color'] ?>">
    <span class="clear"></span>
    <div class="v-TextImage-col v-TextImage-col-left v-col border-box fl <?php echo $left_class ?>">
        <?php 
            if(!empty($default['left_title']))
            {
                ?>
                <h3 class="v-TextImage-col-title v-TextImage-col-title-left"><?php echo $default['left_title'] ?></h3>
                <?php
            }
        ?>
        
        <div class="v-TextImage-col-content v-TextImage-col-content-left"><?php echo $default['left_content'] ?></div>
    </div>
    
    <div class="v-TextImage-col v-TextImage-col-right v-col border-box fl <?php echo $right_class ?>">
        <?php 
            if(!empty($default['right_title']))
            {
                ?>
                <h3 class="v-TextImage-col-title v-TextImage-col-title-right"><?php echo $default['right_title'] ?></h3>
                <?php
            }
        ?>
        
        <div class="v-TextImage-col-content v-TextImage-col-content-right"><?php echo $default['right_content'] ?></div>
    </div>
    <span class="clear"></span>
</div>
</div>
 