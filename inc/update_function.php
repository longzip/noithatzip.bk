<?php

/**

 * Update Option

 */

function update_option($option_name, $new_value)

{



    if(get_option($option_name) === FALSE )

    {

        $content = array('name'=>$option_name, 'value'=>$new_value);

        $result = models_DB::insert($content, OPTION_TABLE);

        if($result) return TRUE;

        else return FALSE;



    }

    else

    {



        $update_content = array('value'=>$new_value);

        $result = models_DB::update($update_content, OPTION_TABLE, ' WHERE name=\'' . $option_name . '\'');

        if($result) return TRUE;

        else return FALSE;



    }



}



/**

 * Update Option

 */

function update_config($name, $value)

{



    if(get_config($name) === FALSE )

    {

        $content = array('name'=>$name, 'value'=>$value);

        $result = models_DB::insert($content, CONFIG_TABLE);

        if($result) return TRUE;

        else return FALSE;



    }

    else

    {



        $update_content = array('value'=>$value);

        $result = models_DB::update($update_content, CONFIG_TABLE, ' WHERE name=\'' . $name . '\'');

        if($result) return TRUE;

        else return FALSE;



    }



}



/**

 * Update Extension

 */

function update_extension($update_content, $name)

{

    $exist = get_extension($name);



    if($exist === FALSE)

    {

        $update_content['name'] = $name;

        $result = models_DB::insert($update_content, EXTENSION_TABLE );

    }

    else

    {

        $result = models_DB::update($update_content, EXTENSION_TABLE, ' WHERE name=\'' . $name . '\'');

    }



    if($result) return TRUE;

    else return FALSE;



}





function update_comment_count($post_id, $number = 1)

{

    $current_comment_count = models_DB::get('SELECT comment_count FROM '. POST_1_TABLE);

    $update_content = array('comment_count'=> $current_comment_count[0]['comment_count'] + $number);

    models_DB::update($update_content, POST_1_TABLE, ' WHERE id='.$post_id);

}



function reset_notification_count($user_id)

{

    $update_content = array('noti_unread' => 0);

    models_DB::update($update_content, USER_TABLE, ' WHERE id='.$user_id);

}



function reset_admin_notification_count()

{

    $update_content = array('already_read' => 1);

    models_DB::update($update_content, ADMIN_NOTIFICATION_TABLE, ' WHERE 1');

}



function clear_smarty_cache()

{

     //return;

    if( defined('TEMPLATE_TYPE') )

    {

        if(( TEMPLATE_TYPE == 'backend') ) return;

    }





    // $a = scandir(PATH_ROOT . '/tpl/tpl/' . 'cache/');

    // foreach($a as $v)

    // {

    //     if(is_file(PATH_ROOT . '/tpl/tpl/' . 'cache/' . $v)) @unlink(PATH_ROOT . '/tpl/tpl/' . 'cache/' . $v);

    // }

    if(!file_exists(PATH_ROOT . '/tpl/tpl/' . 'templates_c/' . DOMAIN_ID)) return;

    $a = scandir(PATH_ROOT . '/tpl/tpl/' . 'templates_c/' . DOMAIN_ID);

    $a = array_diff($a, array('.', '..'));



    return;

    

    foreach($a as $v)

    {

        $t  = PATH_ROOT . '/tpl/tpl/' . 'templates_c/' . DOMAIN_ID . '/' . $v;

        if(is_file($t)) @unlink($t);

        else

        {

            $a2 = scandir($t);

            $a2 = array_diff($a2, array('.', '..'));

            foreach($a2 as $v2)

            {

                $t2 = $t . '/' . $v2 ;

                //echo $t, '<br />';

                if(is_file( $t2 )) @unlink( $t2 );

                else

                {

                    //echo $t, '<br />';



                }



            }

            @rmdir($t);

        }

    }

}

