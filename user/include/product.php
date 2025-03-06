<?php
include "function.php";
$product = connect("SELECT product.*, prd_img.* FROM product INNER JOIN prd_img ON product.product_id = prd_img.product_id");
$myJSON = json_encode($product);

echo $myJSON;
?>

