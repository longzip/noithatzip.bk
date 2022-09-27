<style>


/* HOTLINE FIEXED */
.hotline-fixed-2 {
    background: #<?php echo $default_value['color1'] ?>; /* For browsers that do not support gradients */
    /**
    background: -webkit-linear-gradient(left, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>); 
    background: -o-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: -moz-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: linear-gradient(to right, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>);
    */
    color: #fff;
    width: 250px;
    border-radius: 70px;
    padding: 7px 17px;    
    position: fixed;     
    box-sizing: border-box;     
    transition:all 0.4s;
    -webkit-transition:all 0.4s;
    z-index:9;
}



.hotline-fixed-2-text {
    display: inline-block;
}


.hotline-fixed-2-icon i {
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

.hotline-fixed-2 a {
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
            .hotline-fixed-2 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
                padding-left: 60px;
            }
            .hotline-fixed-2.active {
                left: -45px;
            }
            .hotline-fixed-2-icon {
                float: right;
            }
            .hotline-fixed-2-text {
                float:left;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-2 {
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                padding-left:17px;
            }
            .hotline-fixed-2.active {
                right: -45px;
            }
            .hotline-fixed-2-icon {
                float: left;
            }
            .hotline-fixed-2-text {
                margin-left:15px;
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-2 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                padding-left:17px;
            }
            .hotline-fixed-2.active {
                right: -45px;
            }
            .hotline-fixed-2-icon {
                float: left;
            }
            .hotline-fixed-2-text {
                margin-left:15px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-2 {
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
                padding-left: 60px;
            }
            .hotline-fixed-2.active {
                left: -45px;
            }
            .hotline-fixed-2-icon {
                float: right;
            }
            .hotline-fixed-2-text {
                float:left;
            }
            <?php
            break;
        }
    }
?>
</style>