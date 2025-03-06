<?php
if(isset($_POST['addProduct'])&&$_POST['addProduct']) {
    add_product();
};
?>

<form action=""method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" >Tên sản phẩm</label>
                            <input type="text" class="form-control"  name="name">
                            <label class="form-label" >giá</label>
                            <input type="text" class="form-control"  name="price">
                            <label class="form-label" >số lượng</label>
                            <input type="text" class="form-control"  name="qty">
                            <label class="form-label" >danh mục</label>
                            <select id="category" name="category">
                                <?php category_select();?>
                            </select><br>
                            <label class="form-label" >giảm giá</label>
                            <input type="text" class="form-control"  name="sale">
                            <label class="form-label" >mô tả</label>
                            <input type="text" class="form-control"  name="decription">
                            <!-- <?php
                   
                            ?> -->
                            <br>
                            <input  type="submit" class="btn btn-primary" name="addProduct" value="ADD">
                        </div>
                        <div class="col-6">
                            <label for=""> </label>
                            <br>
                            <div class="add-prd_img d-flex " style="">
                                <div class="mini-img d-flex flex-column">
                                    <div class="mini-img_block set-bg" data-bg="" onclick="showImage(this)"> </div>
                                    <div class="mini-img_block set-bg" data-bg="" onclick="showImage(this)"> </div>
                                    <div class="mini-img_block set-bg" data-bg="" onclick="showImage(this)"> </div>
                                </div>
                                <div class="large-img set-bg" data-bg="<?php if(isset($_SESSION['add-image_1'])) {echo $_SESSION['add-image_1'];}?>">
                                    <input type="file" class="btn-fullW" name="upImg_1" value=" ">
                                </div>
                                <div class="large-img set-bg" data-bg="<?php if(isset($_SESSION['add-image_2'])) {echo $_SESSION['add-image_2'];}?>">
                                    <input type="file" class="btn-fullW" name="upImg_2" value=" ">
                                </div>
                                <div class="large-img set-bg" data-bg="<?php if(isset($_SESSION['add-image_3'])) {echo $_SESSION['add-image_3'];}?>">
                                    <input type="file" class="btn-fullW" name="upImg_3" value=" ">
                                </div>
                            </div>
                            <br>
                            <!-- <input type="file" class="btn btn-primary my-3" name="fileToUpload" value="Choose an image"> -->
                            <!-- <input type="submit" class="btn btn-primary" name="loadUploadedFile" value="Load image"> -->
                            <br>
                            <!-- <label class="form-label" >Image will be save as:</label>
                            <input type="text" disabled class="form-control" value='<?php if(isset($_SESSION['add-image'])) {echo $_SESSION['add-image'];}?>' name="image"> -->
                            <!-- <?php
                            ?> -->
                        </div>
                    </div>
                </form>