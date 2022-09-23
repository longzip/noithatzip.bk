<?php

if(empty($extension_info)) $list_option = array();

$list_option = json_decode($extension_info['attributes'], TRUE);

if( USER_PERMISSION != 'admin' )
{
    if(in_array('coppy', $list_option))
    {
        ?>
        <script>
            $("document").ready(function(){
                 document.oncopy = function(e){
                     e.preventDefault();
            		var bodyEl = document.body;
            		var selection = window.getSelection();
            		selection.selectAllChildren( document.createElement( 'div' ) );
            	}; 
            })
        </script>
        <?php
    }
    
    if(in_array('save-image', $list_option))
    {
        ?>
        <script>
            $("document").ready(function(){
                 $('img').bind('contextmenu', function(e) {
                    return false;
                }); 
            })
        </script>
        <?php
    }
    
    if(in_array('right-click-body', $list_option))
    {
        ?>
        <script>
            $("document").ready(function(){
                 $('body').bind('contextmenu', function(e) {
                    return false;
                }); 
            })
        </script>
        <?php
    }
}



?>