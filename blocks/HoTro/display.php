<?php
	//$temporary_setting_parameter,, $current_block_id
?>

<?php 
    include PATH_ROOT . '/blocks/default-title.php';
   
?>



<div class="block-content">

    <div class="clearfix HoTro">
        <div class="HoTro-avatar fl">
            <img alt="<?php echo $temporary_setting_parameter['name'] ?>" src="<?php echo $temporary_setting_parameter['image'] ?>" />
        </div>
        <div class="HoTro-text fl">
            <div class="HoTro-name HoTro-item">
                <i class="fa fa-user"></i> <?php echo $temporary_setting_parameter['name'] ?>
            </div>
            <div class="HoTro-other clearfix">
                <?php
                    if(!empty($temporary_setting_parameter['sdt']))
                    {
                        ?>
                        <div class="HoTro-sdt HoTro-item">
                            <i class="fa fa-phone"></i> <?php echo $temporary_setting_parameter['sdt'] ?>
                        </div>
                        <?php
                    }
                ?>
                
                <?php
                    if(!empty($temporary_setting_parameter['email']))
                    {
                        ?>
                        <div class="HoTro-email HoTro-item">
                            <i class="fa fa-envelope"></i> <?php echo $temporary_setting_parameter['email'] ?>
                        </div>
                        <?php
                    }
                ?>
                
                <?php
                    if(!empty($temporary_setting_parameter['skype']))
                    {
                        ?>
                        <div class="HoTro-skype HoTro-item">
                            <i class="fa fa-skype"></i> <?php echo $temporary_setting_parameter['skype'] ?>
                        </div>
                        <?php
                    }
                ?>
                
                <?php
                    if(!empty($temporary_setting_parameter['zalo']))
                    {
                        ?>
                        <div class="HoTro-zalo HoTro-item">
                            <i class="fa fa-houzz"></i> <?php echo $temporary_setting_parameter['zalo'] ?>
                        </div>
                        <?php
                    }
                ?>
                
                <?php
                    if(!empty($temporary_setting_parameter['viber']))
                    {
                        ?>
                        <div class="HoTro-viber HoTro-item">
                            <i class="fa fa-phone-square"></i> <?php echo $temporary_setting_parameter['viber'] ?>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

</div>
 