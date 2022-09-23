<?php
header('Content-Type: text/css');
//$font = urldecode($_GET['font']);
$font = $_GET['font'];

$font_part = explode('.', $font);
$font_extension = $font_part[1];

$font_part = explode('/', $font_part[0]);
$font_name = $font_part[count($font_part) - 1];
 
?>
@font-face {
    font-family: <?php echo $font_name ?>;
    src: url("<?php echo $font ?>"), url("<?php echo $font ?>") format('truetype');
}