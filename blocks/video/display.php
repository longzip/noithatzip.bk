<?php
	//$temporary_setting_parameter,$current_block_id
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>

<div class="block-content">
 
    <video autoplay loop >
      <source src="<?php echo $temporary_setting_parameter['src'] ?>" type="video/mp4" />
      <source src="<?php echo $temporary_setting_parameter['src'] ?>" type="video/ogg" />
        Your browser does not support the video tag.
    </video>
</div>