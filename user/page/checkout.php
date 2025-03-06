<main>
  <?php 
  if($userID){
          $userInfor = connect("SELECT * FROM user WHERE user_id = '$userID'")[0]; 
          $delivery_info = connect("SELECT * FROM delivery_info WHERE user_id = '$userID'")[0];}
           ?>
  <div class="container">
      <form class="container-check" action="" method="post">
        <div class="form-dk-check">
          <p>
        <?php if(!$userID || $userID <= 0){
          echo '
            A Bạn chưa có tài khoản? Đăng ký tài khoản để lưu thông tin của bạn
            cho các lần mua hàng sau
            <?php ';} ?>
          </p>
          <div class="h2-check">chi tiết hóa đơn</div>
          <div class="id1-check">
            <label for="username">Họ và Tên<span>*</span></label
            ><br />
            <input class="ip-check" type="text" id="username" name="full-name" value="<?php echo $delivery_info['client_name'] ?>"required/>
          </div>
          <div class="id2-check">
            <label for="diachi">Địa Chỉ<span>*</span></label
            ><br />
            <input class="ip-check" type="text" id="diachi" name="address" value="<?php echo $delivery_info['address'] ?>"required/>
          </div>
          <div class="id4-check">
            <div class="email-check">
              <label for="email-check">Email<span>*</span></label
              ><br />
              <input class="ip-check" type="email" id="email" name="email" value="<?php echo $userInfor['email'] ?>"required/>
            </div>
            <div class="sdt-check">
              <label for="number">Số điện thoại<span>*</span></label
              ><br />
              <input class="ip-check" type="number" id="number" placeholder="+84" name="phone" value="<?php echo $delivery_info['client_phone'] ?>"required/>
            </div>
          </div>
          <!-- <div class="chebook-check">
            <input type="checkbox" />
            <spam class="spam-check">Thêm ghi chú</spam>
          </div> -->
          <div class="id7-check">
            <label for="password">Ghi chú<span></span></label
            ><br />
            <textarea name="user-note" value=" " id="" cols="30" rows="12"></textarea>
          </div>
        </div>
      
        <div class="hoadon-check">
          <div class="hd-check">Hóa đơn</div>
          <div class="text-1-check">
            <div class="sp-check">Sản phẩm</div>
            <div class="tt-check">Thành tiền</div>
          </div>
              <?php checkout_cart(); ?>

          <div class="chek-check">
            <div class="chek1-check">
              <input type="checkbox" name="t[]" /> Thanh toán khi nhận hàng
            </div>
            <div class="chek2-check"><input type="checkbox" name="t[]" /> Visa</div>
          </div>
          <input class="a-check" type="submit" name="checkout" value="Đặt Hàng">
        </div>
  </form>
  </div>
    </main>