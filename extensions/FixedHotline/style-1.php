<style>
<?php 
    switch($default_value['hotline_position'])
    {
        case 'bottom_left' :
        {
            ?>
            .hotline-fixed-1 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-1 {
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-1 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-1 {
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
    }
?>
/* HOTLINE FIEXED */
.hotline-fixed-1 {
    position: fixed;
    
    background: #<?php echo $default_value['color1'] ?>;
    
    background: -webkit-linear-gradient(left, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>);
    background: -o-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>);
    background: -moz-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>);
    background: linear-gradient(to right, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>);
    
    height: 40px;
    width: 200px;
    line-height: 40px;
    border-radius: 3px;
    padding: 0 10px;
    background-size:100%;
    cursor:pointer;
    transition: all 0.8s;
    -webkit-transition: all 0.8s;
    z-index: 9;
}

.hotline-fixed-1.active{
    right:0;
}
.hotline-fixed-1 a {
    color: #fff;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    text-indent: 50px;
    display: inline-block;
    letter-spacing:1px;
    font-family: sans-serif;
}
.hotline-fixed-1 img{
    width: 40px;    
    position: absolute;
}
/* end HOTLINE FIEXED */
</style>