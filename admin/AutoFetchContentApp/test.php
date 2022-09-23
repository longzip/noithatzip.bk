<?php
    $a = 'http://k14.vcmedia.vn/thumb_w/600/G1Jv1ccccccccccccsoL5ly9WD81F5/Image/2013/09/110906cineElly12-7ae0c.jpg';
	$resource = file_get_contents($a);     //van thuc thi duoc
    file_put_contents('1.jpg', $resource);   //van thuc thi duoc
    
    
?>