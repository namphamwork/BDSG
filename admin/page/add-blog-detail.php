<?php
if(isset($_POST['thembaiviet'])&&$_POST['thembaiviet']) {
    add_blog_detail();
};
?>
<form class="more-blog-detail" action=""method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlInput1">Tiêu Đề</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="title"  value=" ">
  </div>
  
   <div class="col-6">
        <label for=""> </label>
        <br>
        <div style="height:240px;">
        <div class="large-img" style="display: block;width: 393px; height: 262px;" >
          <input type="file" class="btn-fullW" name="blogThumb" value=" ">
        </div>
        </div>
        <br>
        <!-- <input type="submit" class="btn btn-primary" name="loadUploadedFile" value="themhinhanh"> -->
        <br>
    </div>
 
  <div class="form-group">
    <label for="exampleFormControlTextarea">Nội Dung :</label>
    <textarea class="form-control" id="exampleFormControlTextarea" rows="10" name="textarea" value=" "></textarea>
     <div class="more-blog"><input type="submit" class="btn btn-primary" name="thembaiviet" value="Thêm bài viết"></div>
  </div>
</form>