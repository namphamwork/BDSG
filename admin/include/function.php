<?php
// connect database../
function connect($sql){
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
        $kq=$stmt->fetchAll();
        return $kq;
        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
}

// --------------------uploadimg-----------------
function uploadimg(){
    $target_dir = "../user/img/product/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    // echo "Sorry, there was an error uploading your file.";
  }
}


    return basename($_FILES["fileToUpload"]["name"]);
}



$userID;
if(isset($_COOKIE['BDSG_user-name'])){
    $username = $_COOKIE['BDSG_user-name'];
    $userID = $_COOKIE['BDSG_user-name'];
    // connect("SELECT * FROM user WHERE user_nickname = '$username' ")[0]['user_id'];
    // if(connect("SELECT * FROM user WHERE user_nickname = '$username' ")[0]['role'] != 1){
    //     // header('Location: ../user/index.php');
    // }
}else{
    
    // header('Location: ../user/index.php');
}
// ----------------------------------------------------------------------

function uploadimg_1($n){
    if($n == 'blogThumb'){
        $target_dir = "../user/img/blog_thumb/";
    }else{
        $target_dir = "../user/img/product/";
    }
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



$product_list = connect("select*from product");
$product_img = connect("select*from prd_img ");
$category_list = connect("SELECT * FROM category");
// print_r($category_list);


// ------------------------------------- Thịnh ------------------------------------------

function category_list(){
    $category_list = $GLOBALS['category_list'];
    foreach($category_list as $item){
        echo '<div class="bg-primary h-fit m-r-8 color-white pd-8 ">'.$item['category_name'].' 
                <a href="?page=category&del_cate='.$item['category_id'].'"> <i class="fa-light fa-x color-white"></i> </a> </div>';
    }
}



if(isset($_GET['del_cate'])){
    $id = $_GET['del_cate'];
    connect("DELETE FROM category WHERE category_id='$id'"); 
    header('Location: index.php?page=category');
}


if(isset($_POST['add_category']) && ($_POST['add_category'])){
      $name = $_POST['category'];
      $flag = true;
      foreach($category_list as $index=> $item){
          if($item['category_name'] == $name){
              echo 'Danh mục đã tồn tại!!';
              $flag = false;
          }
      }
      if($flag == true){
        connect("INSERT INTO category (category_name) VALUES ('$name')" );
        header('Location: index.php?page=category');
      }
}


function added_img(){
    if(!isset($_SESSION['add-image']) || $_SESSION['add-image'] == ''){
        return;
    }else {
        return($_SESSION['add-image']);
    }
}

if(isset ($_POST['loadUploadedFile']) && ($_POST['loadUploadedFile'])){
    if(uploadimg() != '' && uploadimg() != null){
        $_SESSION['add-image'] = uploadimg();
    }
}

function new_id(){

    if(!isset($GLOBALS['product_list']) || $GLOBALS['product_list'] == null){
        $lasted_id = 0;
    }else{
        $lasted_id = Array_pop($GLOBALS['product_list'])['product_id'];
    }
    return($lasted_id+1);
    
}

// function detail_id(){

//     if(!isset($GLOBALS['product_list']) || $GLOBALS['product_list'] == null){
//         $lasted_id = 0;
//     }else{
//         $lasted_id = Array_pop($GLOBALS['product_list'])['product_id'];
//     }
//     return($lasted_id+1);
    
// }

function showproduct(){
    foreach ($GLOBALS['product_list'] as $product){
        $id = $product['product_id'];
        $product_img = connect("SELECT* FROM prd_img WHERE product_id='$id'");  //$GLOBALS['product_img'];
        
        // print_r($product_img['product_id']);
        echo'<div class="product-block" onclick="expand(this)">
        <div class="prd-row1">
            <div class="sp1">
                <div class="chaaa">
                    <div class="img">

                        <div class="prd_img_bg set-bg" data-bg="'.$product_img[0]['image_0'].'" alt=""
                            width="100px" height="120px">
                        </div>
                    </div>
                    <div class="p">
                        <p>'.$product['name'].'</p>
                    </div>
                </div>
                <div class="cha1">
                    <div class="size">Size: L</div>
                    <div class="sl">Số Lượng: '.$product['qty'].'</div>
                </div>
                <div class="cha2">
                    <i class="fa-regular fa-heart"></i>10
                    <div class="down">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="price">Giá: '.$product['price'].'</div>
                </div>
            </div>
            <div class="chitiet">
                <div class="anh1">
                    <img src="../user/img/product/'.$product_img[0]['image_0'].'" alt="" width="30px" height="40px">
                    <img src="../user/img/product/'.$product_img[0]['image_1'].'" alt="" width="30px" height="40px">
                    <img src="../user/img/product/'.$product_img[0]['image_2'].'" alt="" width="30px" height="40px">
                </div>
                <div class="anh2">
                    <img src="IMG/ao-polo-nam-10s23pol063_evegreen_1__1.jpg" alt="" width="130px"
                        height="150px">
                </div>
                <div class="text">
                    <p>'.$product['decription'].'</p>
                    <div class="nut">
                        <div class="a1"><a href="?page=edit-product ">Cập nhật</a></div>
                        <div class="a2"><a href="?delete='.$id.'">Xóa</a></div>
                        <div class="a3"><a href="">Thống kê</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

    }
}
function category_select(){
    $category_list = connect("select*from category");
    foreach($category_list as $category){
        echo'<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
    }
}

function add_product(){
    if(uploadimg_1('upImg_1') != '' && uploadimg_1('upImg_1') != null){
        $_SESSION['add-image_1'] = uploadimg_1('upImg_1');
    }
    if(uploadimg_1('upImg_2') != '' && uploadimg_1('upImg_2') != null){
        $_SESSION['add-image_2'] = uploadimg_1('upImg_2');
    }
    if(uploadimg_1('upImg_3') != '' && uploadimg_1('upImg_3') != null){
        $_SESSION['add-image_3'] = uploadimg_1('upImg_3');
    }
    $dec = $_POST['decription'];
    $qty = $_POST['qty'];
    $id = new_id();
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $category_id = $_POST['category'];
    $image1 = $_SESSION['add-image_1'];
    $image2 = $_SESSION['add-image_2'];
    $image3 = $_SESSION['add-image_3'];
    // echo $image;
        connect("INSERT INTO product (product_id ,category_id ,name	,price	,decription,qty,sale) VALUES ('$id','$category_id','$name', '$price','$dec','$qty', '$sale')" );
        connect("INSERT INTO prd_img (product_id,image_0,image_1,image_2)VALUE ('$id','$image1','$image2','$image3')");
        session_destroy();
        header('Location: index.php?page=product-list');
}

function add_blog_detail(){
   if(uploadimg_1('blogThumb') != '' && uploadimg_1('blogThumb') != null){
      $_SESSION['add-image'] = uploadimg_1('blogThumb');
    }
    $title = $_POST['title'];
    $image = $_SESSION['add-image'];
    $content = $_POST['textarea'];
    // echo $image;
        connect("INSERT INTO post ( post_title ,post_thumb,post_content) VALUES ('$title','$image', '$content')");
        session_destroy();
        header('Location: index.php?page=blog-list');
}
function editBlog(){
    
   if(uploadimg_1('blogThumb') != '' && uploadimg_1('blogThumb') != null){
    $_SESSION['add-image'] = uploadimg_1('blogThumb');
  }else{
    $_SESSION['add-image'] = $_POST['blogThumb'];
  }
  $id = $_POST['id'];
  $title = $_POST['title'];
  $image = $_SESSION['add-image'];
  $content = $_POST['textarea'];
  // echo $image;
      connect("UPDATE post SET post_title = '$title' ,post_thumb = '$image',post_content = '$content',post_by = 'post_by' WHERE post_id = '$id'");
      session_destroy();
      header('Location: index.php?page=blog-list');
}


if(isset($_GET['del-blog'])){
    $id = $_GET['del-blog'];
    connect("DELETE FROM post WHERE post_id = '$id'");
    header('Location: index.php?page=blog-list');
  }

  

// connect("DELETE FROM sold_item WHERE order_id='0'"); 
// connect("DELETE FROM delivery WHERE order_id='0'"); 
// connect("DELETE FROM order_status WHERE order_id='0'"); 
// connect("DELETE FROM order_sold WHERE order_id='0'"); 


  function show_blog_list(){
    $blog_list = connect("select*from post");
    foreach($blog_list as $index=>$item){
        
         echo '<div class="img-show-blog">
            <div class="blog-bg" style="width:393px; height:262px; background-image: url(../user/img/blog_thumb/'.$item['post_thumb'].')"></div>
            <div class="icon-blog"><a href="?page=blog-list&del-blog='.$item['post_id'].'"><i class="fa-solid fa-trash" style="color: #000000;"></i></div></a>
            <div class="icon-fix-blog"><a href="?page=edit-blog&blog-id='.$item['post_id'].'"><i class="fa-solid fa-wrench" style="color: #000000;"></i></a></div>
            <div class="a-show-blog">
                <a href="#">Khám Phá</a>
                <a href="#">Chất Liệu</a>
            </div>
            <div class="p-show-blog">
             '.$item['post_title'].'
            </div>
            <div class="span-show-blog">
                '.$item['posted_time'].'
            </div>
            <div class="tack-show-blog">
              '.$item['post_content'].'..
            </div>
        </div>';
    
    }
   

  }


if(isset ($_GET['delete'])){
    $id = $_GET['delete'];
    connect("DELETE FROM prd_img WHERE product_id='$id'"); 

        connect("DELETE FROM product WHERE product_id='$id'"); 
        
        header('Location: index.php?page=product-list');
  }

  function edit_product($id){
    
    $product_img = connect("SELECT* FROM prd_img WHERE product_id='$id'")[0];
    
    if(uploadimg_1('upImg_1') != '' && uploadimg_1('upImg_1') != null){
      $_SESSION['add-image_1'] = uploadimg_1('upImg_1');
    }else{
        $_SESSION['add-image_1'] = $product_img['image_0'];
    }
    if(uploadimg_1('upImg_2') != '' && uploadimg_1('upImg_2') != null){
        $_SESSION['add-image_2'] = uploadimg_1('upImg_2');
    }else{
        $_SESSION['add-image_2'] = $product_img['image_1'];
    }
    if(uploadimg_1('upImg_3') != '' && uploadimg_1('upImg_3') != null){
        $_SESSION['add-image_3'] = uploadimg_1('upImg_3');
    }else{
        $_SESSION['add-image_3'] = $product_img['image_2'];
    }
  
      $dec = $_POST['decription'];
      $qty = $_POST['qty'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $sale = $_POST['sale'];
      $category_id = $_POST['category'];
      $image1 = $_SESSION['add-image_1'];
      $image2 = $_SESSION['add-image_2'];
      $image3 = $_SESSION['add-image_3'];
      echo $image1;
          // connect("INSERT INTO product (product_id ,category_id ,name	,price	,decription,qty,sale) VALUES ('$id','$category_id','$name', '$price','$dec','$qty', '$sale')" );
          connect("UPDATE product SET name='$name', category_id='$category_id', price='$price', sale='$sale', qty='$qty', decription='$dec' WHERE product_id='$id'");
          connect("UPDATE prd_img SET image_0 = '$image1', image_1 = '$image2',  image_2 = '$image3'  WHERE product_id='$id'");
          session_destroy();
          header('Location: index.php?page=product-list');
}



function order_list(){
    $order_list = connect("SELECT order_sold.*, order_status.order_time FROM order_sold INNER JOIN order_status ON order_sold.order_id = order_status.order_id ORDER BY order_status.order_time DESC");
    foreach($order_list as $index => $item){
        $id = $item['order_id'];
        $userID = $item['user_id'];
        $userAvatar = connect("SELECT avatar FROM user WHERE user_id = '$userID'")[0]['avatar'];
        $orderItem = connect("SELECT price FROM sold_item WHERE order_id = '$id'");
        $orderItem_price = 0;
        foreach($orderItem as $index => $price){
            // print_r($price['price']);
            $orderItem_price += $price['price'];
        }
        $order_status = connect("SELECT * FROM order_status WHERE order_id = '$id'")[0];
        // print_r($order_status);
        $orderItem_count = count($orderItem);
        $delivery = connect("SELECT * FROM delivery WHERE order_id = '$id'")[0];

        $status ;
        if($order_status['canceled'] != null){
            $status = 4;
        }else{
            if($delivery['delivery_start'] == null){
                $status = 0;
            }else{
                if($delivery['delivery_end'] == null){
                    $status = 1;
                }else{
                    if($order_status['purchase_time']== null){
                        $status = 2;
                    }else{
                        $status = 3;
                    }
                }
            }
        }
        echo '
        <div class="order-show" data-orderStatus data-orderStatus_'.$status.'>
          <div class="order-card" >
            <div class="order-card_top  d-flex justify-content-between">
              <div class="client-info d-flex ">
                <div class="client-avatar set-avatar" data-avatar="'.$userAvatar.'">
                </div>
                <div class="client-info_text">
                    <div class="client-name">Tên: '.$item['client_name'].'</div>
                    <div class="client-phone">Điện thoại: '.$item['client_phone'].'</div>
                    <div class="client-email">Email: '.$item['client_email'].'</div>
                    <div class="client-address">Địa chỉ: '.$delivery['address'].'</div>
                </div>
            </div>
            <div class="order-status">Trạng thái: ';
                                                switch($status){
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
                                                    case 4: 
                                                        echo 'Đã hủy';
                                                        break;
                                                }
        echo '
                <div class="order_time">Bắt đầu: '.$order_status['order_time'].' </div>
            </div>
            </div>
            <div class="order-card_bottom d-flex justify-content-between">
              <div class="total-prd">Số lượng sản phẩm: '.$orderItem_count.'</div>
              <div class="angle-down">
                  <i class="fa-solid fa-angle-down"></i>
              </div>
              <div class="cost-total">Giá trị đơn hàng: '.$orderItem_price.' đ</div>
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
            echo'
                </tbody>
              </table>
              <div class="order-note">
                <a>Ghi chú: </a>
                '.$item['note'].'
              </div>
              <div class="order-progress d-flex">
                <div class="row progress_bar">';
                    if ($status <= 0){
                        echo'
                        <div class="col-2">
                        <i class="fa-solid fa-spinner"></i>
                          <div class="progress-text">Chuẩn bị hàng</div>
                          <a href="?page=order-list&deliveryStart='.$id.'" class="progress-confirm"> Hoàn thành </a>
                        </div>
                        <div class="col-2">
                        <i class="fa-solid fa-circle-notch"></i>
                          <div class="progress-text">Đang giao</div>
                        </div>
                        <div class="col-2">
                          <i class="fa-solid fa-circle-notch"></i>
                          <div class="progress-text">Thanh toán</div>
                        </div>';
                    }elseif($status == 1) {
                        echo'
                        <div class="col-2">
                        <i class="fa-solid fa-circle-check"></i>
                          <div class="progress-text">Chuẩn bị hàng</div>
                        </div>
                        <div class="col-2">
                        <i class="fa-solid fa-spinner"></i>
                          <div class="progress-text">Đang giao</div>
                          <a href="?page=order-list&deliveryEnd='.$id.'" class="progress-confirm"> Hoàn thành </a>
                        </div>
                        <div class="col-2">
                          <i class="fa-solid fa-circle-notch"></i>
                          <div class="progress-text">Thanh toán</div>
                        </div>';
                    }elseif($status == 2){
                        echo'
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
                          <div class="progress-text">Thanh toán</div>
                          <a href="?page=order-list&delivery_confirm='.$id.'" class="progress-confirm"> Hoàn thành </a>
                        </div>';
                    }elseif($status == 3){
                        echo'
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
                          <div class="progress-text">Thanh toán</div>
                        </div>';
                    }
                    echo'
                  </div>
              </div>
          </div>
        </div>';
    }
}

if(isset($_GET['deliveryStart'])){
    $id = $_GET['deliveryStart'];
    connect("UPDATE delivery SET delivery_start = (now()) WHERE order_id = '$id'");
    header('Location: index.php?page=order-list');
}

if(isset($_GET['deliveryEnd'])){
    $id = $_GET['deliveryEnd'];
    connect("UPDATE delivery SET delivery_end = (now()) WHERE order_id = '$id'");
    connect("UPDATE order_status SET delivered = (now()) WHERE order_id = '$id'");
    header('Location: index.php?page=order-list');
}

if (isset($_GET['delivery_confirm'])) {
    $id = $_GET['delivery_confirm'];
    connect("UPDATE order_status SET purchase_time = (now()) WHERE order_id = '$id'");
    header('Location: index.php?page=order-list');
}


function order_item($id){
    $order_item = connect("SELECT * FROM sold_item WHERE order_id = '$id'");
    foreach($order_item as $index => $item){
        echo'
        <tr>
            <th scope="row">'. 1+$index.'</th>
            <td><div class="img"></div></td>
            <td>'.$item['product_name'].'</td>
            <td>'.$item['price'].' đ</td>
            <td>x '.$item['qty'].'</td>
            <td>'.$item['price']*$item['qty'].' đ</td>
        </tr>
        ';
    }
}



// ------------
?>
