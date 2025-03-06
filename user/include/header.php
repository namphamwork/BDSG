<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop Thời Trang Việt Nam</title>
<link rel="stylesheet" href="css/blog.css">
<link rel="stylesheet" href="css/checkout.css">
<link rel="stylesheet" href="css/chitiet.css">
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/product.css">
<link rel="stylesheet" href="css/shopping-cart.css">
<link rel="stylesheet" href="css/blog_detail.css">


    <!-- ---bootstrap--- -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
    <link rel="shortcut icon" href="logoback.ico" type="image/x-icon">
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- <link rel="stylesheet" href="icon/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">

<!-- ---bootstrap--- -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
<!-- >>>>>>> f4b7bff0b746c684b20ab45978675f44025b9cea -->
</head>

<body>
    <?php

    if(isset($userID) && $userID != ''){
        $user_info = connect("SELECT * FROM user where user_id = '$userID'");
    }else{
            $userID = 0;
        }
        echo  $userID ;
    ?>
    
    <div class="user-id" style=""><?php echo $userID;?></div>
    <header>
        <div class="menu-index">
            <ul class="header-menu" >
                <li>
                    <a href="?page=home">
                        <img src="img/logoback.png" alt="" width="118px" height="33px">
                    </a>
                </li>
                <li>
                    <a href="?page=home">TRANG CHỦ</a>
                </li>
                <li>
                    <a href="?page=shop">NAM</a>
                </li>
                <li>
                    <a href="?page=shop">NỮ</a>
                </li>
                <li>
                    <a href="#">NEW</a>
                </li>
                <li>
                    <a href="#">BEST</a>
                </li>
                <li>
                    <a href="#">SALE</a>
                </li>

               <div class="input-blog-index">
                <input type="text">
                <i class="position-index fa-solid fa-magnifying-glass"></i>
               </div>

                <li  data-header-menu>
            <!-- Small button groups (default and split) -->


                </li>

            </ul>
        </div>
    </header>