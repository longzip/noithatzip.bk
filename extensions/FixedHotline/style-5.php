<style>
/* HOTLINE MOBILE */

 
.site-support {
    position: fixed;
    
    transform: translateX(-50%);
    
    z-index: 10;
}
.site-support .item.toogle-support-item {
    display: none;
    margin-right: 8px;
}
.site-support .item {
    margin: 10px 0;
    height: 40px;
    line-height: 40px;
    text-align: right;
    animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
    -webkit-transform-origin: 50% 50%;
    -moz-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    -o-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    -webkit-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
    -moz-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
    -ms-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
    -o-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
}

.site-support .fa {
    color: #fff;
    float: right;
    font-size: 25px;
    width: 40px;
    height: 40px;
    line-height: 40px;
    background: #<?php echo $default_value['color1'] ?>;
    text-align: center;
    border-radius: 50%;
}
.site-support .item span {
    color: #fff;
    background: #000;
    padding: 5px 10px;
    margin-right: 10px;
    position: relative;
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.4);
}

.contact-fill {
    width: 80px;
    height: 80px;
    top: -12px;
    left: -21px;
    position: absolute;
    background-color: #<?php echo $default_value['color1'] ?>;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    opacity: .1;
    -webkit-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -moz-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -ms-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -o-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
    animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -o-transition: all .5s;
    transition: all .5s;
    -webkit-transform-origin: 50% 50%;
    -moz-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    -o-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
}

@keyframes quick-alo-circle-fill-anim
{
    0%{transform:rotate(0) scale(0.7) skew(1deg);opacity: .2}
    50%{transform:rotate(0) scale(1) skew(1deg);opacity: .2}
    100%{transform:rotate(0) scale(0.7) skew(1deg);opacity: .2}
}

@keyframes quick-alo-circle-img-anim{
    0%{transform:rotate(0) scale(1) skew(1deg)}
    10%{transform:rotate(-25deg) scale(1) skew(1deg)}
    20%{transform:rotate(25deg) scale(1) skew(1deg)}
    30%{transform:rotate(-25deg) scale(1) skew(1deg)}
    40%{transform:rotate(25deg) scale(1) skew(1deg)}
    50%{transform:rotate(0) scale(1) skew(1deg)}
    100%{transform:rotate(0) scale(1) skew(1deg)}
}

/* HOTLINE MOBILE */



<?php 
    switch($default_value['hotline_position'])
    {
        case 'bottom_left' :
        {
            ?>
            .hotline-fixed-5 {                 
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-5 {                
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
                
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-5 {                 
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-5 {                 
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
    }
?>


</style>

<style>
<?php 
    switch($default_value['hotline_position'])
    {
        case 'bottom_left' :
        {
            ?>
            .hotline-fixed-5-mobile {
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-5-mobile {
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-5-mobile {
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-5-mobile {
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
    }
?>
/* HOTLINE FIEXED */
.hotline-fixed-5 {
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

.hotline-fixed-5.active{
    right:0;
}
.hotline-fixed-5 a {
    color: #fff;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    text-indent: 50px;
    display: inline-block;
    letter-spacing:1px;
    font-family: sans-serif;
}
.hotline-fixed-5 img{
    width: 40px;    
    position: absolute;
}
/* end HOTLINE FIEXED */
</style>