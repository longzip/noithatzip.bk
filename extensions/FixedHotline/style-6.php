<style>


/* HOTLINE FIEXED */
.hotline-fixed-6 {
    background: #<?php echo $default_value['color1'] ?>; /* For browsers that do not support gradients */
    /**
    background: -webkit-linear-gradient(left, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>); 
    background: -o-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: -moz-linear-gradient(right, #<?php echo $default_value['color1'] ?>, #<?php echo $default_value['color2'] ?>); 
    background: linear-gradient(to right, #<?php echo $default_value['color1'] ?> , #<?php echo $default_value['color2'] ?>);
    */
    color: #fff;
    width: 200px;
    border-radius: 70px; 
    position: fixed;     
    box-sizing: border-box;     
    transition:all 0.4s;
    -webkit-transition:all 0.4s;
    z-index:9;
    
        height: 44px;
    border: 2px solid #fff;
    line-height: 44px;
    background: #E88A25;
    background: -webkit-linear-gradient(left, #E88A25 , #D40000);
    background: -o-linear-gradient(right, #E88A25, #D40000);
    background: -moz-linear-gradient(right, #E88A25, #D40000);
    background: linear-gradient(to right, #E88A25 , #D40000);
}



.hotline-fixed-6-text {
    display: inline-block;
        padding-left: 10px;
        
}


.hotline-fixed-6-icon i {
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

.hotline-fixed-6 a {
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
}
 
 .hotline-fixed-6-text-title{
    display:none
 }
/* end HOTLINE FIEXED */


<?php 
    switch($default_value['hotline_position'])
    {
        case 'bottom_left' :
        {
            ?>
            .hotline-fixed-6 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
                padding-left: 60px;
            }
            .hotline-fixed-6.active {
                left: -45px;
            }
            .hotline-fixed-6-icon {
                float: right;
            }
            .hotline-fixed-6-text {
                float:left;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-6 {
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                padding-left:17px;
            }
            .hotline-fixed-6.active {
                right: -45px;
            }
            .hotline-fixed-6-icon {
                float: left;
            }
            .hotline-fixed-6-text {
                margin-left:15px;
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-6 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                padding-left:17px;
            }
            .hotline-fixed-6.active {
                right: -45px;
            }
            .hotline-fixed-6-icon {
                float: left;
            }
            .hotline-fixed-6-text {
                margin-left:15px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-6 {
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
                padding-left: 60px;
            }
            .hotline-fixed-6.active {
                left: -45px;
            }
            .hotline-fixed-6-icon {
                float: right;
            }
            .hotline-fixed-6-text {
                float:left;
            }
            <?php
            break;
        }
    }
?>

.mypage-alo-phone {
    /* position: fixed; */
    /* right: 221px; */
    /* bottom: 1px; */
    visibility: visible;
    background-color: transparent;
    width: 110px;
    height: 110px;
    cursor: pointer;
    z-index: 200000 !important;
}
.animated.infinite {
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
}
.animated.infinite {
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
}

.animated.infinite {
    animation-iteration-count: infinite;
}

.mypage-alo-ph-circle {
    width: 90px;
    height: 90px;
    top: 12px;
    left: 12px;
    position: absolute; 
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid rgba(30, 30, 30, 0.4);
    opacity: .1; 
    opacity: .5;
    
     background: #f37123;
    border-color: #fff;
    border-width: 3px;
}
 



.mypage-alo-ph-circle-fill {
    width: 60px;
    height: 60px;
    top: 28px;
    left: 28px;
    position: absolute;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -o-transition: all .5s;
    transition: all .5s;
    background-color: #f37123;
    opacity: .75 !important;
}
 
.mypage-alo-ph-img-circle {
    width: 32px;
    height: 32px;
    top: 43px;
    left: 43px;
    position: absolute;
    background: rgba(30, 30, 30, 0.1) url(<?php echo CDN_DOMAIN ?>/extensions/FixedHotline/images/phone.png) no-repeat center center;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    opacity: .7;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    -webkit-transform-origin: 50% 50%;
    -moz-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    -o-transform-origin: 50% 50%;
    transform-origin: 50% 50%; 
    background-size: 70%;
    background-color: #d71921;
}
 

.call-now{
    position:absolute;
    left: -39px;
    top: -41px;
}
 
</style>