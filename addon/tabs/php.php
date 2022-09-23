<?php
if(!function_exists('addon_tabs'))
{
    function addon_tabs($arr_nav = array(), $arr_content = array(), $arr_attr = array('id'=>'', 'class'=>'', 'other'=>'', 'nav-class'=>'', 'content-class'=>'', 'nav-id'=>'', 'content-id'=>'', 'nav-other'=>'', 'content-other'=>'') )
    {
        ?>
        <div <?php if(!empty($arr_attr['id'])) echo 'id="' . $arr_attr['id'] . '"' ?>  class="v-tabs <?php if(!empty($arr_attr['class'])) $arr_attr['class'] ?> " <?php if(!empty($arr_attr['other'])) $arr_attr['other'] ?> >
            <div <?php if(!empty($arr_attr['nav-id'])) echo 'id="' . $arr_attr['nav-id'] . '"' ?> class="v-tabs-nav <?php if(!empty($arr_attr['nav-class'])) $arr_attr['nav-class'] ?>" <?php if(!empty($arr_attr['nav-other'])) $arr_attr['nav-other'] ?>>
                <div class="v-tabs-nav-inner">
                    <?php
                        foreach($arr_nav as $k=>$v)
                        {
                            ?>
                            <div class="v-tabs-nav-item" >
                                <?php echo $v ?>
                            </div>
                            <?php
                        } 
                        
                    ?>
                    
                </div>
            </div>
            <div <?php if(!empty($arr_attr['content-id'])) echo 'id="' . $arr_attr['content-id'] . '"' ?>  class="v-tabs-content <?php if(!empty($arr_attr['content-class'])) $arr_attr['content-class'] ?>" <?php if(!empty($arr_attr['content-other'])) $arr_attr['content-other'] ?>>
                <?php
                        foreach($arr_content as $k=>$v)
                        {
                            ?>
                            <div class="v-tabs-content-item " >
                                <?php echo $v ?>
                            </div>
                            <?php
                        } 
                    ?>
                
            </div>
        </div>
        <?php
    } 
}
