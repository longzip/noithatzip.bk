<style>


/* HOTLINE FIEXED */
.hotline-fixed-4 {
    background: url(<?php echo CDN_DOMAIN  ?>/extensions/FixedHotline/images/hotline4_bg.png) 0 no-repeat; 
    /**
    background: -webkit-linear-gradient(left, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>); 
    background: -o-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: -moz-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: linear-gradient(to right, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>);
    */
    color: #fff;
    width: 270px;
    height: 50px;
    line-height:50px;
    position: fixed;
    box-sizing: border-box;
    transition: all 0.4s;
    -webkit-transition: all 0.4s;
    z-index: 9;
    font-weight:bold;    
    padding-left:55px;
    color:#b89c58;
        background-size: 100%;
}



.hotline-fixed-4-text-title{
    float: left;
    margin-right:10px;
}

.hotline-fixed-3-text-hotline{
    margin-bottom:5px;
}
 
.hotline-fixed-4 a {
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    text-decoration: none;
    position:relative;
    top:-2px;
}


.hotline-fixed-4-text-hotline {
    color: #f15f23;
    font-size: 19px;
    font-weight: bold;
    position: relative;
    top: 2px;
    /* left: 5px; */
    width: 50%;
    text-align: left;
    box-sizing: border-box;
    float: left;
}


.hotline-fixed-4-text-hotline a{
    /* Safari 4.0 - 8.0 */
    -webkit-animation-name: hotline-color;
    -webkit-animation-duration: 0.3s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-delay: 1s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-direction: normal;
    /* Standard syntax */
    animation-name: hotline-color;
    animation-duration: 0.3s;
    animation-timing-function: linear;
    animation-delay: 1s;
    animation-iteration-count: infinite;
    animation-direction: normal;
}


.hotline-fixed-4-text-hotline a{
    -webkit-animation-name: hotline-color2;
    animation-name: hotline-color2;
}

/* Safari 4.0 - 8.0 */
@-webkit-keyframes hotline-color {
    0%   {color:#f15f23;}
    100% {color:#b89c58;}
}

/* Standard syntax */
@keyframes hotline-color {
    0%   {color:#f15f23;}
    100% {color:#b89c58;}
}


/* Safari 4.0 - 8.0 */
@-webkit-keyframes hotline-color2 {
    0%   {color:#b89c58;}
    100% {color:#f15f23;}
}

/* Standard syntax */
@keyframes hotline-color2 {
    0%   {color:#b89c58;}
    100% {color:#f15f23;}
}


 
/* end HOTLINE FIEXED */


<?php 
    switch($default_value['hotline_position'])
    {
        case 'bottom_left' :
        {
            ?>
            .hotline-fixed-4 {                 
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-4 {                
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-4 {                 
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-4 {                 
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
    }
?>
</style>