
blogList = document.getElementsByClassName('product-blog')[0]
if (blogList) {
  const post = new XMLHttpRequest();
  post.onload = function () {
    let blogEL = JSON.parse(this.responseText);
    for (let i = 0; i < blogEL.length; i++) {
      blogList.innerHTML += `
            <div class="con-1-blog col-6">
              <a>
                <div class="backgroud" style="background-image: url('img/blog_thumb/${blogEL[i].post_thumb}'); 
                            height: 320px; background-size: cover;" alt=""   />
                  <a href="?page=blog_detail&post_id=${blogEL[i].post_id}" class="btn-full-w"> </a>
                </div>
              </a>
              <div class="km-blog">
                <a href="#">Khuyến Mãi</a>
              </div>
              <p class="post-title">${blogEL[i].post_title}</p>
              <span>${blogEL[i].posted_time}</span>
              <div>
                 <p class="post-content">${blogEL[i].post_content}</p>
              </div>
            </div>`

    }

  }
  post.open("GET", "./include/blog.php");
  post.send();
}

const postId = document.getElementsByClassName('id-blog')[0]
if (postId) {
  const postdetail = new XMLHttpRequest();
  postdetail.onload = function () {
    let blogdetail = JSON.parse(this.responseText);
    const blogdetailEl = document.querySelector('.blofcolleft-blog')
    blogdetailEl.innerHTML += `<div class="h1-blog-detail">
          <h1>${blogdetail.post_title}</h1>
        </div>
        <div class="day-blog-detail">${blogdetail.posted_time}</div>
        <div class="img-blog-detail"><img src="IMG/blog_thumb/${blogdetail.post_thumb}" alt="" width="876px"></div>
        <div class="p-blog-detail">
          <p>${blogdetail.post_content}</p>
        </div>
        
        <div class="commen-blog">Bình Luận : </div>
        <div class="input-blog-detail">
          <div class="input-coment-blog"><input type="text" placeholder="Bình Luận Của Bạn">
            <div class="send-blog-deltail"><a href="#"><i class="fa-solid fa-paper-plane"></i> send</a></div>
          </div>

          <div class="coment-new-blog-detail">
            Bình Luận Mới Nhất
          </div>

          <div class="yourcommen-blog">
            <div class="your-picture">T</div>
            <div class="your-comment"><b>THinh@ĐẹpTrai</b> Chất liệu của quần sao thật mềm mại và co giãn tốt. Tôi yêu
              thiết kế và độ bền của nó!</div>
          </div>
          <div class="comment">
            <div class="like-blog-detail"><i class="fa-regular fa-thumbs-up"></i><a href="#">Thích</a></div>
            <div class="like-blog-detail1"><i class="fa-regular fa-thumbs-up"></i><a href="#">10K</a></div>
            <div class="date-submit-blog"><span>10:47</span> <span>25.07.2023</span></div>
          </div>

          <div class="yourcommen-blog">
            <div class="your-picture">T</div>
            <div class="your-comment"><b>ZiCham@23</b> Đã lâu tôi không tìm thấy một chiếc quần phù hợp như vậy.
              Không gây cảm giác khó chịu.</div>
          </div>
          <div class="comment">
            <div class="like-blog-detail"><i class="fa-regular fa-thumbs-up"></i><a href="#">Thích</a></div>
            <div class="like-blog-detail1"><i class="fa-regular fa-thumbs-up"></i><a href="#">10K</a></div>
            <div class="date-submit-blog"><span>10:47</span> <span>25.07.2023</span></div>
          </div>

          <div class="yourcommen-blog">
            <div class="your-picture">T</div>
            <div class="your-comment"><b>Nam Wibu Chúa</b> Đẹp từng centimet! Tôi rất hài lòng với chất lượng và giá cả
              của sản phẩm này. </div>
          </div>
          <div class="comment">
            <div class="like-blog-detail"><i class="fa-regular fa-thumbs-up"></i><a href="#">Thích</a></div>
            <div class="like-blog-detail1"><i class="fa-regular fa-thumbs-up"></i><a href="#">10K</a></div>
            <div class="date-submit-blog"><span>10:47</span> <span>25.07.2023</span></div>
          </div>

          <div class="yourcommen-blog">
            <div class="your-picture">T</div>
            <div class="your-comment"><b>Thuận Wibu Tổ</b> Áo rất đẹp giao hàng nhanh chuẩn form </div>
          </div>
          <div class="comment">
            <div class="like-blog-detail"><i class="fa-regular fa-thumbs-up"></i><a href="#">Thích</a></div>
            <div class="like-blog-detail1"><i class="fa-regular fa-thumbs-up"></i><a href="#">10K</a></div>
            <div class="date-submit-blog"><span>10:47</span> <span>25.07.2023</span></div>
          </div>

          <div class="yourcommen-blog">
            <div class="your-picture">T</div>
            <div class="your-comment"><b>9Tos</b> Sản phẩm hoàn hảo cho mùa hè! </div>
          </div>
          <div class="comment">
            <div class="like-blog-detail"><i class="fa-regular fa-thumbs-up"></i><a href="#">Thích</a></div>
            <div class="like-blog-detail1"><i class="fa-regular fa-thumbs-up"></i><a href="#">10K</a></div>
            <div class="date-submit-blog"><span>10:47</span> <span>25.07.2023</span></div>
          </div>

        </div>`
    console.log(blogdetail)
  }
  postdetail.open("GET", "./include/blog.php?q=" + postId.innerHTML);
  postdetail.send();
}