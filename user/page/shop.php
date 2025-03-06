<?php
$tim_kiem = "";
if (isset($_GET['tim_kiem'])) {
  $tim_kiem = $_GET['tim_kiem'];
}
$category_list = connect("SELECT CATEGORY_NAME FROM category");



// phan trang
$trang = 1;
if (isset($_GET['trang'])) {
  $trang = $_GET['trang'];
}
$sap_xep = isset($_GET['sap_xep']) ? $_GET['sap_xep'] : 'asc'; // Mặc định là sắp xếp tăng dần

$sql_so_san_pham = "SELECT COUNT(*) FROM product
WHERE product.name LIKE '%$tim_kiem%'";



$so_san_pham = connect($sql_so_san_pham)[0]['COUNT(*)'];

$so_san_pham_tren_1_trang = 12;
$so_trang = ceil($so_san_pham / $so_san_pham_tren_1_trang);

$bo_qua = $so_san_pham_tren_1_trang * ($trang - 1);

$sql_lay_san_pham = "SELECT * FROM product ";

if ($sap_xep === 'asc') {
  $sql_lay_san_pham .= "ORDER BY price ASC ";
} elseif ($sap_xep === 'desc') {
  $sql_lay_san_pham .= "ORDER BY price DESC ";
} elseif ($sap_xep === 'hot') {
  $sql_lay_san_pham .= "ORDER BY views DESC ";
} elseif ($sap_xep === 'moi') {
  $sql_lay_san_pham .= "ORDER BY add_time DESC ";
}

$sql_lay_san_pham .= "LIMIT $so_san_pham_tren_1_trang OFFSET $bo_qua";
$ket_qua = connect($sql_lay_san_pham);



?>

<main>
  <div class="banner-product">
    <img src="img/bannerproduct.jpg" alt="" width="100%" />
  </div>
  <div class="h1-product">
    <h1>Thời Trang Nam</h1>
  </div>
  <div class="dmuc-product">
    <div class="h3-product">
      <h3>Danh Mục</h3>
    </div>
    <!-- <?php foreach ($category_list as $cate) {
          ?>

      <div class="aonam-product"><input type="radio" name="#" /><?php echo ($cate['CATEGORY_NAME']) ?></div>

    <?php } ?> -->
  </div>
  <div class="product-cha-product">
    <div class="product-left-product">
      <div class="menu-row-product">
        <ul>
          <li>
            <a href="?page=shop&trang=1&sap_xep=asc"> Giá Tiền Từ Thấp </a>
          </li>

          <li>
            <a href="?page=shop&trang=1&sap_xep=desc"> Giá Tiền Từ Cao </a>
          </li>
          <li>
            <a href="?page=shop&trang=1&sap_xep=hot">Sản Phẩm Hot</a>
          </li>
          <li>
            <a href="?page=shop&trang=1&sap_xep=moi">Sản Phẩm Mới</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="product-right-product">

      <div class="prd_list row">
        <!-------------- product list ----------------->
        <?php
        foreach ($ket_qua as $product) {
          $product_id = $product['product_id'];
          $sql1 = "SELECT * FROM prd_img WHERE product_id = $product_id";
          $img_url = connect($sql1);

        ?>
          <div class="prd-item d-flex flex-column col-3">
            <div class="prd-img set-bg " data-bg="<?php echo $img_url[0]['image_0'] ?>">
              <a class="btn-full-w" style="position: relative;" href="?page=prd_detail&id=<?php echo $product_id; ?>"></a>
            </div>
            <div class="prd-text">
              <div class="prd-name">
                <a class="prd-name-text"><?php echo $product['name'] ?></a>
                <div class="add-cart">
                  <a onclick="addToCart(this)">+ Thêm vào giỏ hàng
                    <form action="" method="post" style="display: none;">
                      <input type="text" name="id" value="<?php echo $product_id; ?>">
                      <button class="addCart-btn" type="button" name="addToCart" value="<?php echo $product_id; ?>"></button>
                    </form>
                  </a>
                </div>
                <i class="fa-regular fa-heart"></i>
              </div>
              <div class="prd-price">
                <a><?php echo $product['price'] ?> đ</a>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-------------- product list end ----------------->
      </div>
      <div class="page-num">
        <?php for ($i = 1; $i <= $so_trang; $i++) { ?>
          <a href="?page=shop&trang=<?php echo $i ?> ">
            <?php echo $i ?>
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
</main>