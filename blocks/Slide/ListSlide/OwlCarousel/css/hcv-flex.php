<style>
*{
    margin:0;
    padding:0;
}
 

.clear{
    clear:both;
    display:block;
}




.wrap-<?php echo $slide_name ?> {
    position:relative; 
}

.wrap-<?php echo $slide_name ?>  a:hover {
    background: none!important;
}

.<?php echo $slide_name ?> {
    position:relative;
    left:0;
    height: 100%;
    top:0;
}

.wrap-<?php echo $slide_name ?> img {
    width: 100%;
    height: 100%;
}

.<?php echo $slide_name ?>-item {
    float: left;
    height: 100%;
    position: relative;
}

.<?php echo $slide_name ?>-next, .<?php echo $slide_name ?>-prev {
    cursor:pointer;
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius:5px;
    opacity:0.7;
    z-index: 1;
}

.<?php echo $slide_name ?>-next:hover, .<?php echo $slide_name ?>-prev:hover
{
    opacity:1;
}

.<?php echo $slide_name ?>-next{
    background: url(<?php echo SITE_URL ?>/blocks/Slide/ListSlide/Flex/images/next-icon.gif) center no-repeat #34302d;
    right:10px;    
}

.<?php echo $slide_name ?>-prev{
    background: url(<?php echo SITE_URL ?>/blocks/Slide/ListSlide/Flex/images/prev-icon.gif) center no-repeat #34302d;
    left:10px;    
}

.<?php echo $slide_name ?>-nav {
    position: absolute;
    bottom: 10px;
    text-align: center;
    width: 100%;
    left: 0;
    z-index: 2;
}
.<?php echo $slide_name ?>-nav-inner {
    background: #515151;
    height: 10px!important;
    display: inline;
    width: 20px;
    opacity: 0.5;
    padding: 1px 15px;
    border-radius: 10px;
    line-height: 10px;
}

.<?php echo $slide_name ?>-nav-item.active, .<?php echo $slide_name ?>-nav-item:hover {
    background: #ff8400;
}

.<?php echo $slide_name ?>-nav-item {
    background: #b6b6b6;
    padding: 6px;
    display: inline-block;
    border-radius: 10px;
    /* position: relative; */
    /* bottom: 2px; */
    cursor: pointer;
}

.<?php echo $slide_name ?>-item-info {
    position: absolute;
    top: 25%;
    left: 50%;
    text-transform:uppercase;
     
    z-index: 2;
    padding: 10px 40px;
    border-radius: 0;
    color: #000000;
    font-family: arial;
    opacity: 0.7;
    font-size: 18px;
    min-width: 300px;
}

.<?php echo $slide_name ?>-item-wrap-link {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
	cursor:pointer;
}

.<?php echo $slide_name ?>-item-link {
    color: #F8F4F4;
    font-weight: bold; 
    text-decoration: none;
    font-size: 20px;
    display: block;
    margin-bottom: 10px;
}

.<?php echo $slide_name ?>-item-link:hover {
    /* color: rgb(216, 3, 3); */
    text-decoration: underline;
}
 .hcv_flex-item-wrap-link:hover {
    background: none!important;
}

img{
	max-height:100%;
	max-width:100%
}


.wrap-flex-slide-inner {
    overflow: hidden;
}

.right-left-nav{
	top: calc(50% - 20px)!important;
}

 

</style>