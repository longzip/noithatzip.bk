<?php
	if(isset($_GET['submit']))
    {
        $k = 1;
        $array = array();
        if(!file_exists($_GET['folder'])) mkdir($_GET['folder']);
        $obj = file_get_html($_GET['url']);
       
        foreach($obj->find($_GET['OriginalElement']) as $img)
        {
            $src = $img->src;
            $size = @getimagesize($src);
            if(($size[0] >= 300)&&$size)
            {
                if(!in_array($src, $array))
                {
                    $array[] = $src;
                    $resource = file_get_contents($src);     //van thuc thi duoc
                    file_put_contents($_GET['folder'].'/photoxinh.vn-images-'.$k.'.jpg', $resource);   //van thuc thi duoc
                    ?>
                    <p style="color:rgb(36, 185, 108);font-size: 12px;font-weight:bold"><?php echo $k,'. ', $src ?></p>
                    <?php
                   
                    $k++;
                }
            }
        }
    }
    else
    {
        ?>
        <form action="" method="GET">
        <input type="hidden" name="type" value="single" />
        <input placeholder="URL" type="text" value="" name="url" /><br />
        <input placeholder="Dấu hiệu phần tử (class, id or tag name)" type="text" value="" name="OriginalElement" /><br />
        <input placeholder="Thư mục lưu trữ" type="text" value="" name="folder" /><br /><br />
        <input class="transition" type="submit" name="submit" value="Download" />
        
        </form>
        <?php
    }
?>