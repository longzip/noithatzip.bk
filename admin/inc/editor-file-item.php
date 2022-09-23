<?php

if( is_file( $current_dir ) )
{
    $path_info = pathinfo($current_dir);  
     
    //echo $path_info['extension'];
    if( in_array($path_info['extension'], $exclude_extensions) ) continue;
}
else
{
    if(in_array($current_dir, $exclude_folders)) continue;
}
 
 $image_size = @getimagesize($current_dir);
 
?>
<div class="wrap-file-item">
    <div class="clearfix file-item file-item-<?php echo '' ?> <?php if( is_file( $current_dir ) ) echo 'type-file';else echo 'type-dir' ?>">
        <a class="fl" dir_name="<?php echo $list_dir ?>" dir="<?php echo urlencode(  $current_dir) ?>" href="<?php echo SITE_URL ?>/admin/?page_type=editor&dir=<?php echo urlencode(  $current_dir) ?>">
        <?php 
             if(!empty($image_size))
            {
                ?>
                <img class="image-thumb" src="<?php echo cdn_timthumb_url(str_replace(PATH_ROOT, CDN_DOMAIN, $current_dir), 15, 15) ?>" />
                <?php
            }
            else
            {
                if( is_file( $current_dir ) )
                {
                    ?>
                    <i class="fa fa-file-code-o" aria-hidden="true"></i>                                    
                    <?php                                     
                 }
                else
                {
                    ?>
                    <i class="fa fa-folder-o" aria-hidden="true"></i>
                    <?php                     
                }  
            }
            ?>
            
         
        <?php echo $list_dir ?>  
        </a>
        <?php 
            if( !is_file( $current_dir ) )
            {
                ?>
                <div class="fr none folder-action">
                    <i class="new-dir fa fa-folder-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                    <i class="new-file fa fa-file-code-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                    <i class="new-upload fa fa-cloud-upload" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                    <i class="delete-dir fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                </div>
                <?php
            }
            else
            {
                ?>
                <div class="fr none folder-action">
                    <i class="delete-file fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                </div>
                <?php
            }
        ?>
        
    </div>
</div> 