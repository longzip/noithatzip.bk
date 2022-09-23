<style>
    <?php 
     
    $temp = json_decode($extension_info['attributes'], TRUE);
        
    echo  $temp['content'];
    
    
    
    ?>
</style>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/custom/css/custom.css?v=<?php echo FRONT_END_VERSION ?>" />
<?php 

 
?>
