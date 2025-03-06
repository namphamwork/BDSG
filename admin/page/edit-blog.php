<?php
if(isset($_POST['editBlog'])&&$_POST['editBlog']) {
    editBlog();
};
if(isset($_GET['blog-id'])){
    $id = $_GET['blog-id'];
    $blog = connect("SELECT * FROM post WHERE post_id = '$id' ")[0];
    // print_r($blog);
}
?>
<form class="more-blog-detail" action=""method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlInput1">Tiêu Đề</label>
    <input type="hidden" class="" id="" name="id"  value="<?php echo $blog['post_id']; ?>" >
    <input type="text" class="form-control" id="exampleFormControlInput1" name="title"  value="<?php echo $blog['post_title']; ?>">
  </div>
  
   <div class="col-6">
        <label for=""> </label>
        <br>
        <div style="height:240px;">
        <div class="large-img" style="display: block; width: 393px; height: 262px; background-image: url(../user/img/blog_thumb/<?php echo $blog['post_thumb']; ?>);" >
          <input type="file" class="btn-fullW" name="blogThumb" value="<?php echo $blog['post_thumb']; ?>">
        </div>
        </div>
        <br>
        <!-- <input type="submit" class="btn btn-primary" name="loadUploadedFile" value="themhinhanh"> -->
        <br>
    </div>
 
  <div class="form-group">
    <label for="exampleFormControlTextarea">Nội Dung :</label>
    <textarea class="form-control" id="exampleFormControlTextarea" rows="10" name="textarea" value=" "><?php echo $blog['post_content']; ?></textarea>
     <div class="more-blog"><input type="submit" class="btn btn-primary" name="editBlog" value="Cập nhật"></div>
  </div>
</form>