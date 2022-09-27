<script src="jquery-1.9.1.min.js"></script>
<script src="DownloadImage.js"></script>

<link href="DownloadImage.css" type="text/css" rel="stylesheet" />
<input type="text" value="" id="base" /><br />
<input type="text" value="http://photoxinh.vn/xinh-qua-viet-nam-oi-part-4/" id="resource" />

<input type="button" id="download" value="download" />


<div id="notification">

</div>
<div id="data">

</div>
<?php
	$resource = file_get_contents('http://4.bp.blogspot.com/-tuXmSmqe10I/U0EGKt3h-hI/AAAAAAAACjQ/kg3bwObRlDs/s640/Photoxinh.vn-nu+dien+vien+trung+quoc+xinh+dep+Truong+Ham+Van-16.jpg');
?>