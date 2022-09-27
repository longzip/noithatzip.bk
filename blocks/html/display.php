<?php
	//$temporary_setting_parameter,, $current_block_id
?>

<div class="core-block-inner" style="<?php
    if( (!empty($temporary_setting_parameter['block_border_color'])) && ($temporary_setting_parameter['block_border_color'] != 'FFFFFF' ) ) echo 'border-color:#' . $temporary_setting_parameter['block_border_color'] . ';';
    if(!empty($temporary_setting_parameter['block_border_style'])) echo 'border-style:' . $temporary_setting_parameter['block_border_style'] . ';';
    if(!empty($temporary_setting_parameter['block_border_width'])) echo 'border-width:' . $temporary_setting_parameter['block_border_width'] . ';';    
    if( (!empty($temporary_setting_parameter['block_background_color'])) && ($temporary_setting_parameter['block_background_color'] != 'FFFFFF' ) ) echo 'background-color:#' . $temporary_setting_parameter['block_background_color'] . ';';
    if(!empty($temporary_setting_parameter['block_background_image'])) echo 'background-image:url(' . $temporary_setting_parameter['block_background_image'] . ');background-position:0;background-size:100%';
    
    ?> ">
    
    
    
    <?php 
        include PATH_ROOT . '/blocks/default-title.php';
    ?>
    
    <?php 
        if(empty($temporary_setting_parameter['color'])) $temporary_setting_parameter['color'] = 'FFFFFF';
        if(empty($temporary_setting_parameter['background-image'])) $temporary_setting_parameter['background-image'] = '';
        if(empty($temporary_setting_parameter['background-color'])) $temporary_setting_parameter['background-color'] = 'FFFFFF';        
    ?>
    
    <div class="block-content">
        <div class="block-html-content <?php if(($temporary_setting_parameter['color'] != 'FFFFFF') || ( !empty($temporary_setting_parameter['background-image']) )) echo 'have-advanced' ?>" style="<?php if($temporary_setting_parameter['color'] != 'FFFFFF') echo 'color:#', $temporary_setting_parameter['color'], ';' ?> <?php if($temporary_setting_parameter['background-color'] != 'FFFFFF') echo 'background-color:#', $temporary_setting_parameter['background-color'], ';' ?> <?php if($temporary_setting_parameter['background-image'] != '') echo 'background-image:url(', $temporary_setting_parameter['background-image'], ');' ?>">
        <?php 
        	echo $temporary_setting_parameter['content']
        ?>
        </div>
    </div>
</div>