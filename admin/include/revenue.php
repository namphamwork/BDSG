<?php
include "function.php";
$revenue = connect("SELECT order_sold.*, order_status.* FROM order_sold 
    INNER JOIN order_status ON order_sold.order_id = order_status.order_id 
    WHERE month(purchase_time) = month(now())
    and year(purchase_time) = year(now())");
$myJSON = json_encode($revenue);

echo $myJSON;
?>

