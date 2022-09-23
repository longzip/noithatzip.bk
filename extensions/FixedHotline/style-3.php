<style>


/* HOTLINE FIEXED */
.hotline-fixed-3 {
    
    /**
    background: -webkit-linear-gradient(left, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>); 
    background: -o-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: -moz-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: linear-gradient(to right, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>);
    */
    color: #fff;
    width: 195px;
    padding: 10px 20px;
    position: fixed;
    box-sizing: border-box;
    transition: all 0.4s;
    -webkit-transition: all 0.4s;
    z-index: 9;
    background-size:100% 100%!important;
}



.hotline-fixed-3-text {
    display: inline-block;
}

.hotline-fixed-3-text-hotline{
    margin-bottom:5px;
}


.hotline-fixed-3-icon i {
    font-size: 28px;
    display: inline-block;
    border: 2px solid;
    border-radius: 50%;
    width: 42px;
    height: 42px;
    text-align: center;
    line-height: 42px;
    cursor: pointer;
}

.hotline-fixed-3 a {
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
}
 
/* end HOTLINE FIEXED */


<?php 
    switch($default_value['hotline_position'])
    {
        case 'bottom_left' :
        {
            ?>
            .hotline-fixed-3 {
                background: url(<?php echo CDN_DOMAIN  ?>/extensions/FixedHotline/images/hotline3_bg_left.png) 0 no-repeat;
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
                padding-left: 45px;
            }
            .hotline-fixed-3.active {
                left: -45px;
            }
            .hotline-fixed-3-icon {
                float: right;
            }
            .hotline-fixed-3-text {
                float:left;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-3 {
                background: url(<?php echo CDN_DOMAIN  ?>/extensions/FixedHotline/images/hotline3_bg.png) 0 no-repeat; /* For browsers that do not support gradients */
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                padding-left:17px;
            }
            .hotline-fixed-3.active {
                right: -45px;
            }
            .hotline-fixed-3-icon {
                float: left;
            }
            .hotline-fixed-3-text {
                margin-left:15px;
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-3 {
                background: url(<?php echo CDN_DOMAIN  ?>/extensions/FixedHotline/images/hotline3_bg.png) 0 no-repeat; /* For browsers that do not support gradients */
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                padding-left:17px;
            }
            .hotline-fixed-3.active {
                right: -45px;
            }
            .hotline-fixed-3-icon {
                float: left;
            }
            .hotline-fixed-3-text {
                margin-left:15px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-3 {
                background: url(<?php echo CDN_DOMAIN  ?>/extensions/FixedHotline/images/hotline3_bg_left.png) 0 no-repeat; /* For browsers that do not support gradients */
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
                padding-left: 45px;
            }
            .hotline-fixed-3.active {
                left: -45px;
            }
            .hotline-fixed-3-icon {
                float: right;
            }
            .hotline-fixed-3-text {
                float:left;
            }
            <?php
            break;
        }
    }
?>
</style>