<?php
  $id = $_GET['id'];
  $product = connect("SELECT* FROM product WHERE product_id='$id'")[0];
  $product_img = connect("SELECT* FROM prd_img WHERE product_id='$id'")[0];

  if(isset($_POST['editProduct'])&&$_POST['editProduct']) {
    edit_product($id);
};


?>

<form action=""method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" >Tên sản phẩm</label>
                            <input type="text" class="form-control"  name="name" value="<?php echo $product['name'];?>" > 
                            <label class="form-label" >giá</label>
                            <input type="text" class="form-control"  name="price" value="<?php echo $product['price'];?>">
                            <label class="form-label" >số lượng</label>
                            <input type="text" class="form-control"  name="qty" value="<?php echo $product['qty'];?>">
                            <label class="form-label" >danh mục</label>
                            <select id="category" name="category">
                                <?php category_select();?>
                            </select><br>
                            <label class="form-label" >giảm giá</label>
                            <input type="text" class="form-control"  name="sale" value="<?php echo $product['sale'];?>">
                            <label class="form-label" >mô tả</label>
                            <input type="text" class="form-control"  name="decription" value="<?php echo $product['decription'];?>">
                            
                            <br>
                            <input  type="submit" class="btn btn-primary" name="editProduct" value="cập nhật">
                        </div>
                        <div class="col-6">
                            <label for=""> </label>
                            <br>
                            <div class="add-prd_img d-flex " style="">
                                <div class="mini-img d-flex flex-column">
                                    <div class="mini-img_block set-bg" data-bg="<?php echo $product_img['image_0'];?>" onclick="showImage(this)"> </div>
                                    <div class="mini-img_block set-bg" data-bg="<?php echo $product_img['image_1'];?>" onclick="showImage(this)"> </div>
                                    <div class="mini-img_block set-bg" data-bg="<?php echo $product_img['image_2'];?>" onclick="showImage(this)"> </div>
                                </div>
                                <div class="large-img set-bg" data-bg="<?php echo $product_img['image_0'];?>">
                                    <input type="file" class="btn-fullW" name="upImg_1" value=" ">
                                </div>
                                <div class="large-img set-bg" data-bg="<?php echo $product_img['image_1'];?>">

                                <input type="file" class="btn-fullW" name="upImg_2" value=" ">
                                </div>
                                <div class="large-img set-bg" data-bg="<?php echo $product_img['image_2'];?>">
                                    <input type="file" class="btn-fullW" name="upImg_3" value=" ">
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </form>