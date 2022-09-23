<?php
	//$temporary_setting_parameter,, $current_block_id
?>

<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>

<?php 
    if(!defined('BLOCK_MAT_BANG')) {
        define('BLOCK_MAT_BANG', TRUE);
        ?>
        <script>
            $(document).ready(function(){
                $("body").on( "click", ".svg-map polygon", function(){
                    var data_src = $(this).attr("data-src"); 
                    $(".module-matbang img").attr("src", data_src);
                    $(".module-matbang-opacity, .wrap-module-matbang").addClass("active");                    
                });
                
                $("body").on("click", ".module-matbang-close", function(){
                    $(".module-matbang-opacity, .wrap-module-matbang").removeClass("active");        
                });
                
                $("body").append('<div class="wrap-module wrap-module-matbang">\
                                    <div class="module module-matbang">\
                                        <img src="" />\
                                        <div class="module-matbang-close"><i class="fa fa-close"></i></div>\
                                    </div>\
                                </div>\
                                <div class="module-matbang-opacity"></div>');
            });
        </script>
        <style>
        
            /* M?t b?ng */ 

            .wrap-svg-map polygon {
                fill: transparent!important;
                stroke-width: 0px!important;
                cursor: pointer;
            }
            
            .wrap-svg-map polygon:hover{
                fill: rgba(255, 255, 255, 0.65)!important;
            }
             
            
            .svg-map {
                width: 100%;
            }
            
            
            .module-matbang-opacity {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 999;
                background: #000;
                opacity: 0.7;
                transition: all 0.5s;
                -webkit-transition: all 0.5s;
                display: none;
            }
            
            .module-matbang-opacity.active {
                display: block;
            }
            
            .wrap-module-matbang {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1000;
                display: none;
                text-align: center;
            }
            
            .wrap-module-matbang.active{
                display:block;
            }
            
            .module.module-matbang {
                text-align: center;
                position: relative;
                top:4%;
                height: 92%;
                z-index: 1000;
                display: inline-block;
            }
            
            .module-matbang-close {
                position: absolute;
                width: 40px;
                height: 40px;
                background: #b50641;
                top: 0;
                right: 0;
                z-index: 2;
                background-size: 100%;
                cursor: pointer;
                color: #fff;
                font-weight: normal;
                font-size: 30px;
            }            
            /* END M?t b?ng */
            
        </style>
        <?php
    }
?>

<div class="block-content">
    <div class="wrap-mat-bang-svg">
    <?php 
    	echo $temporary_setting_parameter['content']
    ?>
    </div>
</div>
 
 