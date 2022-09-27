<?php
	if(isset($_GET['submit']))
    {
        $k = 1;
        if(!file_exists($_GET['folder'])) mkdir($_GET['folder']);
        $array = array();
        for($j=$_GET['StartPage'];$j<=$_GET['EndPage'];$j++)
        {
            $url = $_GET['url'].'?t=3334493&page='.$j;
            $obj = file_get_html($url);
            $i = 1;
            foreach($obj->find('img') as $element)
            {
                $src = $element->src;
                if(strpos($src, '://'))
                {
                    
                        $size = @getimagesize($src);
                        if(($size[0] >= 300)&&$size)
                        {
                            if(!in_array($src, $array))
                            {
                                $array[] = $src;
                                $resource = file_get_contents($src);     //van thuc thi duoc
                                file_put_contents($_GET['folder'].'/photoxinh.vn-page'.$j.'-'.$i.'.jpg', $resource);   //van thuc thi duoc
                                ?>
                                <p style="color:rgb(36, 185, 108);font-size: 12px;font-weight:bold"><?php echo $k,'. ', $src ?></p>
                                <?php
                                $i++;
                                $k++;
                            }
                        }
                    
                }
                
            }
            
        }
    }
    else
    {
        ?>
        <form action="" method="GET">
        <input type="hidden" name="type" value="multi" />
        <input placeholder="URL" type="text" value="" name="url" /><br />
        <input placeholder="Ký hiệu Thread" type="text" value="" name="thread" /><br />
        <input placeholder="Ký hiệu Page" type="text" value="" name="page" /><br />
        <input placeholder="Page bắt đầu" type="text" value="" name="StartPage" /><br />
        <input placeholder="Page kết thúc" type="text" value="" name="EndPage" /><br />
        <input placeholder="Thư mục lưu trữ" type="text" value="" name="folder" /><br /><br />
        <input class="transition" type="submit" name="submit" value="Download" />
        
        </form>
        <?php
    }
?>