<?php
include "function.php";
if (isset($_POST['addToCart']) && $_POST['addToCart'] != '') {
    $id = $_POST['addToCart'];
    $item = array(
        'id' => $id,
        'quantity' => 1,
    );
    $flag = 0;
    if (count($_SESSION['data-cart']) > 0) {
        foreach ($_SESSION['data-cart'] as $x => $product) {
            if (in_array($item['id'], $product)) {
                $_SESSION['data-cart'][$x]['quantity'] += 1;
                $flag = 1;
            }
        }
    }
    if ($flag == 0) {
        array_push($_SESSION['data-cart'], $item);
    }
    
    header('Location: index.php?page=shop');
}
$cart = $_SESSION['data-cart'];

echo json_encode($cart) ;
?>