<?php 
$id = $_GET['id'];
    $product = connect("SELECT * FROM product WHERE product_id = '$id'")[0];
    $product_img = connect("SELECT * FROM prd_img WHERE product_id = '$id'")[0];
?> <main>
        <div class="container">
            <div class="product">
                <div class="con1">
                    <button class="data" data="12"><img src="img/product/<?php echo $product_img['image_0']; ?>" alt="" width="70px" height="100px"></button>
                    <button class="data" data="13"><img src="img/product/<?php echo $product_img['image_1']; ?>" alt="" width="72px" height="108px"></button>
                    <button class="data" data="14"><img src="img/product/<?php echo $product_img['image_1']; ?>" alt="" width="72px" height="108px"></button>
                </div>
                <div class="con2"><img class="igg" src="img/product/<?php echo $product_img['image_1']; ?>" alt=""></div>
            </div>
            <div class="product1">
                <div class="sanpham">
                    <?php echo $product['name']; ?>
                </div>
                <span class="gia"><?php echo $product['price'] - $product['sale']; ?> đ </span><span class="discount"><?php echo $product['price']; ?></span>
                <!-- <div class="p">Chọn Màu :</div>
                <button class="data" data="17"><img src="img/17.jpg" alt="" width="60px" height="90px"></button>
                <button class="data" data="15"><img src="img/15.jpg" alt="" width="60px" height="90px"></button> -->

                <!-- <span class="id5"><img src="img/khuyen-mai-icon.gif" width="180px" height="90px" alt=""></span>
                <div class="p">Chọn Size :</div>
                <button class="size  active" title="size S">S</button>
                <button class="size " title="size M">M</button>
                <button class="size " title="size L">L</button>
                <button class="size " title="size  XL">XL</button> -->
                <div class="p">Chọn Số Lượng :</div>
                <div class="mua">
                    <div class="quannity"><span class="id1">-</span></span>1<span class="id2">+</span> </div>
                    <!-- <div class="id3"><a href="#">MUA NGAY</a></div> -->
                    <div class="id4"><a href="#">THÊM VÀO GIỎ HÀNG</a></div>
                </div>
                <div class="icon8"><img src="img/icon8.png" alt=""></div>
            </div>
        </div>
        <div class="h1">SẢN PHẨM ROUTINE GỢI Ý RIÊNG CHO BẠN</div>
        <div class="noibat">
            <div class="sp1">
                <div class="spnho1">
                    <img src="img/18.jpg" alt="" width="300px" height="450px">
                    <p>Quần Short Jean Nữ Trơn Form Straight - 10S22DPSW001</p>
                    <button data="18"><img src="img/18.jpg" alt="" width="30px" height="30px"></button>
                    <button data="19"><img src="img/19.jpg" alt="" width="30px" height="30px"></button>
                </div>

            </div>
            <div class="sp2">
                <div class="spnho1"><img src="img/19.jpg" alt="" width="300px" height="450px">
                    <p>Quần Short Jean Nữ Trơn Form Straight - 10S22DPSW001</p>
                    <button data="18"><img src="img/18.jpg" alt="" width="30px" height="30px"></button>
                    <button data="19"><img src="img/19.jpg" alt="" width="30px" height="30px"></button>
                </div>
            </div>
            <div class="sp3">
                <div class="spnho1"><img src="img/20.jpg" alt="" width="300px" height="450px">
                    <p>Quần Short Jean Nữ Trơn Form Straight - 10S22DPSW001</p>
                    <button data="18"><img src="img/18.jpg" alt="" width="30px" height="30px"></button>
                    <button data="19"><img src="img/19.jpg" alt="" width="30px" height="30px"></button>
                </div>
            </div>
            <div class="sp4">
                <div class="spnho1"><img src="img/21.jpg" alt="" width="300px" height="450x px">
                    <p>Quần Short Jean Nữ Trơn Form Straight - 10S22DPSW001</p>
                    <button data="18"><img src="img/18.jpg" alt="" width="30px" height="30px"></button>
                    <button data="19"><img src="img/19.jpg" alt="" width="30px" height="30px"></button>
                </div>
            </div>
        </div>

    </main>