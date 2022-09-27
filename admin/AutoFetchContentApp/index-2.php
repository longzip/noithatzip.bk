<?php
	require 'simple_html_dom.php';
    $k = 1;
    $array = array();
    for($j=829;$j<=3299;$j++)
    {
        $url = 'http://www.haivl.com/';
        $obj = file_get_html($url);
        $i = 1;
        foreach($obj->find('a') as $element)
        {
            $href = $element->href;
            if(strpos($href, '://'))
            {
                
                $sub_obj = file_get_html($href);
               
                foreach($sub_obj->find('img') as $img)
                {
                    $src = $img->src;
                    $size = @getimagesize($src);
                    if(($size[0] >= 300)&&$size)
                    {
                        if(!in_array($src, $array))
                        {
                            $array[] = $src;
                            $resource = file_get_contents($src);     //van thuc thi duoc
                            file_put_contents('thubodi/'.$k.'.jpg', $resource);   //van thuc thi duoc
                            ?>
                            <p style="font-family: verdana;color:rgb(36, 185, 108);font-size: 12px;font-weight:bold"><?php echo $k,'. ', $src ?></p>
                            <?php
                            $i++;
                            $k++;
                        }
                    }
                }
                
                
            }
            
        }
        
    }
    
?>