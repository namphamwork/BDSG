<?php
// include "cart.php";
ob_start();
session_start();
function connect($sql)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=bdsg", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}


function uploadAvatar($n){
    $target_dir = "./img/avatar/";
    $target_file = $target_dir . basename($_FILES[$n]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    //   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //   if($check !== false) {
    //     // echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    //   } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    //   }
    

    // Allow certain file formats
    if($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only WEBP, JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

        // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES[$n]["tmp_name"], $target_file)) {
        // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
    }


    return basename($_FILES[$n]["name"]);
}


$userID;
$delivery_info;
if(isset($_COOKIE['BDSG_user-name'])){
    $username = $_COOKIE['BDSG_user-name'];
    $userID = connect("SELECT * from user where user_nickname = '$username' ")[0]['user_id'];
    $delivery_info = connect("SELECT * FROM delivery_info WHERE user_id = $userID ");
}else{
    $userID = 0;
}

if(isset($userID) && $userID != null && $delivery_info == null){
    connect("INSERT INTO delivery_info (user_id ) VALUES ('$userID')");
}

$product_list = connect("select*from product");
$product_img = connect("select*from prd_img ");



//-------- session -----------

if (!isset($_SESSION['data-cart'])) {
    $_SESSION['data-cart'] = array();
}

if(!isset($_SESSION['disscount'])){
    $_SESSION['disscount'] = 0;
}


//-----------------------------------------------------------------------------Thuận---------------------------------------------------------------------------------------//


//-------- show giỏ hàng -----------//
// session_destroy();
function shoppingCart()
{
    $subTotal = 0;
    $discount = 0;
    foreach ($_SESSION['data-cart'] as $index => $item) {
        $id = $item['id'];
        $product = connect("select*from product WHERE product_id = $id");
        $prd_img = connect("select*from prd_img WHERE product_id = $id");
        $subTotal += $product[0]['price'] * $item['quantity'];
        if ($item['quantity'] > 0) {
            echo '
            <tr>
              <td>
                  <div class="cart-item d-flex ">
                      <div class="cart-prd-img-pd">
                          <div class="cart-prd-img set-bg" data-bg="' . $prd_img[0]['image_0'] . '" >
                          </div>
                      </div>
                      <div class="cart-text content-box d-flex flex-column justify-content-center">
                          <a class="cart-prd-name">' . $product[0]['name'] . '</a>
                          <a class="cart-prd-price">' . $product[0]['price'] . '</a>
                      </div> 
                  </div>
              </td>
              <td>
                  <div class="quantity content-box d-flex justify-content-between align-items-center">
                        <a href="?page=shopping-cart&decrease=' . $index . '"><i class="fa-solid fa-angle-left"></i></a>
                        <input type="text" value="' . $item['quantity'] . '">
                        <a href="?page=shopping-cart&increase=' . $index . '"><i class="fa-solid fa-angle-right"></i></a>
                  </div>
              </td>
              <td>
                  <div class="cart-prd-total content-box d-flex align-items-center">
                      <a>' . $product[0]['price'] * $item['quantity'] . '</a>
                  </div>
              </td>
              <td>
                  <div class="cart-prd-del content-box d-flex justify-content-center align-items-center">
                      <a href="?page=shopping-cart&del=' . $index . '"><i class="fa-solid fa-xmark"></i></a>
                  </div>
              </td>
            </tr>';
        }
    }
    if(isset($_SESSION['disscount']))
    $discount = $subTotal * $_SESSION['disscount'];
    echo '
            </tbody>
        </table>
        <button class="continue-btn">
            <a href="?page=shop">
                Tiếp tục mua hàng
            </a>
        </button>
        </div>
        <div class="col-1" style="width: calc(25% / 3);"></div>
            
                <div class="col-3">
                    <div class="cart-calc d-flex flex-column">
                        <div class="coupon-use d-flex flex-column">
                            <a>mã giảm giá</a>
                            <form action="" method="post" class="coupon-code d-flex justify-content-between">
                                <input type="text" name="coupon_code" value=" ">
                                <button type="submit" class="coupon-apply-btn" name="coupon_use" value=" " >dùng</button>
                            </form>
                        </div>
                        <div class="price-total">
                            <a class="calc-title">Tổng giá</a>
                            <div class="cart-calc-text d-flex justify-content-between">
                                <a>Tạm tính</a>
                                <a>' . $subTotal . ' đ</a>
                            </div>
                            <div class="cart-calc-text  d-flex justify-content-between">
                                <a >Giảm giá</a>
                                <a>'.$discount.' đ</a>
                            </div>
                            <div class="cart-calc-text d-flex justify-content-between">
                                <a>Tổng cộng</a>
                                <a >' . $subTotal - $discount. ' đ</a>
                            </div>
                            <button  class="to-checkout-btn"><a href="?page=checkout">đặt hàng</a></button>
                        </div>
                    </div>
                </div>
    ';
}

if(isset($_POST['coupon_code'])){
    $coupon_code = trim($_POST['coupon_code']);
    $discount = 0;
    $coupon = connect("SELECT * FROM coupons WHERE coupon_code ='$coupon_code'")[0];
    if($coupon['coupon_type'] == 0){
        $_SESSION['disscount']  = $coupon['coupon_value'] /100;
    }else{
        $_SESSION['disscount'] = $coupon['coupon_value'];
    }
}
//-------- --------------- -----------//


//-------- xóa khỏi giỏ hàng -----------//
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    foreach ($_SESSION['data-cart'] as $index => $item) {
        if ($index == $id) {
            unset($_SESSION['data-cart'][$index]);
            header('Location: index.php?page=shopping-cart');
        }
    }
}
//-------- -------------- -----------

//-------- sl tăng giỏ hàng -----------//

if (isset($_GET['increase'])) {
    $id = $_GET['increase'];
    $_SESSION['data-cart'][$id]['quantity'] += 1;
    header('Location: index.php?page=shopping-cart');
}

//-------- sl giảm giỏ hàng -----------//
if (isset($_GET['decrease'])) {
    $id = $_GET['decrease'];
    if($_SESSION['data-cart'][$id]['quantity'] > 1)
    $_SESSION['data-cart'][$id]['quantity'] -= 1;
    header('Location: index.php?page=shopping-cart');
}

// -------------checkout---------------

function checkout_cart()
{
    if ($_SESSION['data-cart']) {
        $subTotal = 0;
        foreach ($_SESSION['data-cart'] as $index => $item) {
            $id = $item['id'];
            $product = connect("select*from product WHERE product_id = $id");

            echo '<div class="text-2-check">
            <div class="sp-check">' . $product[0]['name'] . '</div>
            <div class="tt-check">' . $product[0]['price'] * $item['quantity'] . ' đ</div>
          </div>
          <div class="x2-check">x' . $item['quantity'] . '</div>';

            $subTotal += $product[0]['price'] * $item['quantity'];
        }
        if(isset($_SESSION['disscount'])){
            $disscount = $_SESSION['disscount']*$subTotal;
        }else{
            $disscount = 0;
        }

        $totalCost = $subTotal - $disscount;
        echo '
        <div class="text-4-check">
          <div class="sp-check">Tổng Giá</div>
          <div class="tt-check">' . $subTotal . ' đ</div>
        </div>  
        <div class="text-4-check">
          <div class="sp-check">Giảm Giá</div>
          <div class="tt-check">'.$disscount.' đ</div>
        </div>
        <div class="text-5-check">
          <div class="sp-check">Tổng Cộng</div>
          <div class="tt-check">' . $totalCost . ' đ</div>
        </div>';
    }
}


// $x=  connect("select*from order_sold");
// $itemName  = Array_pop($x)['order_id'] +1;
// print_r($itemName);

if(isset($_POST['checkout'])&& $_POST['checkout']){
    $fullName = $_POST['full-name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phoneNum = $_POST['phone'];
    $userID ;
    $subTotal =0;
    foreach($_SESSION['data-cart'] as $index => $item){
        $itemID = $item['id'];
        $itemPrice = connect("SELECT price from product WHERE product_id = '$itemID' ")[0]['price'];
        $subTotal += $itemPrice * $item['quantity'];
    }
    $discount = $_SESSION['disscount']*$subTotal;
    $totalCost = $subTotal - $discount;
    if(isset($GLOBALS['userID']) && $GLOBALS['userID'] != ''){
        $userID = $GLOBALS['userID'];

    }else{
        $userID = ' ';
    }
    $note;
    if(isset($_POST['user-note']) &&  $_POST['user-note'] != ''){
        $note = $_POST['user-note'];
    }else{
        $note = ' ';
    }

    $id;
    $x = connect("select*from order_sold");
    if(!isset($x) || $x == null){
        $id = 0;
    }else{
        $id = Array_pop($x)['order_id'] + 1;
    }
    print_r($id. $fullName . $phoneNum . $email . $note . $userID);
    connect("INSERT INTO order_sold (order_id , client_name, client_phone, client_email, note, user_id, order_price, coupons_used, discount, total_cost) 
                VALUES ('$id', '$fullName', '$phoneNum', '$email', '$note', '$userID', '$subTotal', '', '$discount', '$totalCost')" );
    connect("INSERT INTO delivery (order_id, address ) VALUES ('$id', '$address')" );
    connect("INSERT INTO order_status (order_id, order_time) VALUES ('$id', now())" );
    
    
    foreach($_SESSION['data-cart'] as $index => $item){
        $itemID = $item['id'];
        $itemName = connect("SELECT name from product WHERE product_id = '$itemID' ")[0]['name'];
        $itemImg = connect("SELECT image_0 from prd_img WHERE product_id = '$itemID' ")[0]['image_0'];
        $itemQty = $item['quantity'];
        $itemPrice = connect("SELECT price from product WHERE product_id = '$itemID' ")[0]['price'];
        connect("INSERT INTO sold_item (order_id , product_name, prd_img, price, qty ) VALUES ('$id', '$itemName', '$itemImg' ,  '$itemPrice', '$itemQty')");
    }

    check_order($id);
}

function check_order($id){
    $order = connect("SELECT * FROM order_sold WHERE order_id = $id");
    if(count($order) == 1){

    echo'<script> alert("Đặt hàng thành công")</script>';
    session_destroy();
    
    header('Location: index.php?page=shopping-cart');

    }else{
        print_r ($order);
    }
}


// session_destroy();
//-------- -------------- -----------


function order_list()
{   
    $userID = $GLOBALS['userID'];
    $order_list = connect("SELECT * FROM order_sold WHERE user_id = $userID ");
    if($order_list != '')
    foreach ($order_list as $index => $item) {
        $id = $item['order_id'];
        $orderItem = connect("SELECT price FROM sold_item WHERE order_id = '$id'");
        $orderItem_price = 0.0;
        foreach ($orderItem as $index => $price) {
            // print_r($price['price']);
            $orderItem_price += $price['price'];
        }
        $order_status = connect("SELECT * FROM order_status WHERE order_id = '$id'")[0];
        // print_r(connect("SELECT * FROM order_status WHERE order_id = '$id'"));
        $orderItem_count = count($orderItem);
        $delivery = connect("SELECT * FROM delivery WHERE order_id = '$id'")[0];

        $status;
        if ($delivery['delivery_start'] == null) {
            $status = 0;
        } else {
            if ($delivery['delivery_end'] == null) {
                $status = 1;
            } else {
                if ($order_status['purchase_time'] == null) {
                    $status = 2;
                } else {
                    $status = 3;
                }
            }
        }
        echo '
        <div class="order-show">
          <div class="order-card" data-orderStatus_'.$status.'>
            <div class="order-card_top  d-flex justify-content-between">
              <div class="client-info d-flex ">
                <div class="client-info_text">
                    <div class="client-name">Tên: ' . $item['client_name'] . '</div>
                    <div class="client-phone">Điện thoại: ' . $item['client_phone'] . '</div>
                    <div class="client-email">Email: ' . $item['client_email'] . '</div>
                    <div class="client-address">Địa chỉ: ' . $delivery['address'] . '</div>
                </div>
            </div>
            <div class="order-status">Trạng thái: ';
        switch ($status) {
            case 0:
                echo 'Chuẩn bị hàng';
                break;
            case 1:
                echo 'Đang vận chuyển';
                break;
            case 2:
                echo 'Chờ thanh toán';
                break;
            case 3:
                echo 'Đã hoàn thành';
                break;
        }
        echo '
                <div class="order_time">Bắt đầu: ' . $order_status['order_time'] . ' </div>
                <div class="order_time">Hoàn thành: ' . $order_status['purchase_time'] . ' </div>
            </div>
            </div>
            <div class="order-card_bottom d-flex justify-content-between">
              <div class="total-prd">Số lượng sản phẩm: ' . $orderItem_count . '</div>
              <div class="angle-down">
                  <i class="fa-solid fa-angle-down"></i>
              </div>
              <div class="cost-total">Giá trị đơn hàng: ' . $orderItem_price . ' đ</div>
            </div>
          </div>
          <div class="order-expand">
              <a>Đơn hàng: </a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" colspan="3">Tên</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng</th>
                  </tr>
                </thead>
                <tbody>';
        order_item($id);
        echo '
                </tbody>
              </table>
              <div class="order-note">
                <a>Ghi chú: </a>
                ' . $item['note'] . '
              </div>
              <div class="order-progress d-flex">
                <div class="row progress_bar">';
        if ($status <= 0) {
            echo '
                        <div class="col-2">
                        <i class="fa-solid fa-spinner"></i>
                          <div class="progress-text">Chuẩn bị hàng</div>
                        </div>
                        <div class="col-2">
                        <i class="fa-solid fa-circle-notch"></i>
                          <div class="progress-text">Đang giao</div>
                        </div>
                        <div class="col-2">
                          <i class="fa-solid fa-circle-notch"></i>
                          <div class="progress-text">Đã giao</div>
                        </div>';
        } elseif ($status == 1) {
            echo '
                        <div class="col-2">
                        <i class="fa-solid fa-circle-check"></i>
                          <div class="progress-text">Chuẩn bị hàng</div>
                        </div>
                        <div class="col-2">
                        <i class="fa-solid fa-spinner"></i>
                          <div class="progress-text">Đang giao</div>
                        </div>
                        <div class="col-2">
                          <i class="fa-solid fa-circle-notch"></i>
                          <div class="progress-text">Đã giao</div>
                        </div>';
        } elseif ($status == 2) {
            echo '
                        <div class="col-2">
                        <i class="fa-solid fa-circle-check"></i>
                          <div class="progress-text">Chuẩn bị hàng</div>
                        </div>
                        <div class="col-2">
                        <i class="fa-solid fa-circle-check"></i>
                          <div class="progress-text">Đang giao</div>
                        </div>
                        <div class="col-2">
                            <i class="fa-solid fa-spinner"></i>
                          <div class="progress-text">Đã giao</div>
                          <a href="?page=user-setting&delivery_confirm=' . $id . '" class="progress-confirm"> Đã nhận </a>
                        </div>';
        } elseif ($status == 3) {
            echo '
                        <div class="col-2">
                        <i class="fa-solid fa-circle-check"></i>
                          <div class="progress-text">Chuẩn bị hàng</div>
                        </div>
                        <div class="col-2">
                        <i class="fa-solid fa-circle-check"></i>
                          <div class="progress-text">Đang giao</div>
                        </div>
                        <div class="col-2">
                        <i class="fa-solid fa-circle-check"></i>
                          <div class="progress-text">Đã giao</div>
                        </div>';
        }
        echo '
                  </div>
              </div>
          </div>
        </div>';
    }
}

if (isset($_GET['logout'])){
    if (isset($_COOKIE['BDSG_user-name'])) {
    // unset($_COOKIE['BDSG_user-name']); 
    setcookie('BDSG_user-name', '', -1, '/'); 
}
    header('Location: index.php?page=home');
}

if (isset($_GET['delivery_confirm'])) {
    $id = $_GET['delivery_confirm'];
    connect("UPDATE order_status SET purchase_time = (now()) WHERE order_id = '$id'");
    header('Location: index.php?page=user-setting');
}

function echox($var){
    if($var != '')
    echo $var;
    else
    echo '';
}

function order_item($id)
{
    $order_item = connect("SELECT * FROM sold_item WHERE order_id = '$id'");
    foreach ($order_item as $index => $item) {
        echo '
        <tr>
            <th scope="row">' . 1 + $index . '</th>
            <td><div class="orderItem-img set-bg" data-bg="'.$item['prd_img'].'"></div></td>
            <td>' . $item['product_name'] . '</td>
            <td>' . $item['price'] . ' đ</td>
            <td>x ' . $item['qty'] . '</td>
            <td>' . $item['price'] * $item['qty'] . ' đ</td>
        </tr>
        ';
    }
}


if(isset($_POST['updateUserInfo']) && $_POST['updateUserInfo']){
    $phoneNum = $_POST['phone'];
    $fullName = $_POST['fullName'];
    $address = $_POST['address'];

    connect("UPDATE delivery_info SET client_name = '$fullName', client_phone = '$phoneNum', address = '$address' WHERE user_id = '$userID'");
}


if(isset($_POST['avaChange']) && $_POST['avaChange']){
    $avatar = uploadAvatar('avatar');
    connect("UPDATE user SET avatar = '$avatar' WHERE user_id = '$userID'");
}
//-------- -------------- -----------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//-----------------------------------------------------------------------------Tín----------------------------------------------------------------------------------------//




//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------Nam----------------------------------------------------------------------------------------//






//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------Trầm---------------------------------------------------------------------------------------//




//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------Thịnh---------------------------------------------------------------------------------------//






//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
