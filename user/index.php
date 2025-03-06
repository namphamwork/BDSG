<?php
include "./include/function.php";
include "./include/header.php";
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'shop':
            include "./page/shop.php";
            break;
        case 'shopping-cart':
            include "./page/shopping-cart.php";
            break;
        case 'sign-in':
            include "./page/sign-in.php";
            break;
        case 'checkout':
            include "./page/checkout.php";
            break;
        case 'user-setting':
            include "./page/user-setting.php";
            break;
        case 'demo':
            include "./page/form-demo.php";
            break;
        case 'blog':
            include "./page/blog.php";
            break;
        case 'blog_detail':
            include "./page/blog_detail.php";
            break;
        case 'prd_detail':
            include "./page/prd_detail.php";
            break;
        case 'Log-in':
            include "./page/login.php";
            break;
        case 'Forgotpass':
            include "./page/Forgotpass.php";
            break;
        case 'forgotpass-mail':
            include "./page/forgotpass-mail.php";
            break;
        case 'resetpass':
            include "./page/resetpass.php";
            break;
        default:
            include './page/home.php';
    }
} else {
    include './page/home.php';
}

include "./include/footer.php";
