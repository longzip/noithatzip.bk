<?php

$et = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'FixedHotline\' AND display_position=\'before_close_body\'' );

if(!empty($et))
{
    global $smarty;
    $et = $et[0];
    $et = json_decode($et['attributes'], TRUE);

    if(is_numeric($et['display_style'])) $et['display_style'] = 'style' . $et['display_style'];
    //if(empty($et['content'])) $et['content'] = get_option('fixed-hotline');
    $et['content'] = get_option('fixed-hotline');
    if(empty($et['hotline_title'])) $et['hotline_title'] = get_option('fixed-hotline-title');

  
    $smarty->assign('hotline', $et['content']);
    $smarty->assign('hotline_title', $et['hotline_title']);
    $smarty->assign('hotline_position', $et['hotline_position']);
    $smarty->assign('color1', '' . $et['color1']);
    $smarty->assign('color2', '' . $et['color2']);
    $smarty->assign('top', '' . $et['top']);
    $smarty->assign('left', '' . $et['left']);
    $smarty->assign('right', '' . $et['right']);
    $smarty->assign('bottom', '' . $et['bottom']);



    $file_executive = PATH_ROOT . '/tpl/tpl/extensions/FixedHotline/' . $et['display_style'] . '/index.tpl';

    $smarty->display(  $file_executive );
}

?>
