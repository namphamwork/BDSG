<ul class="nav nav-tabs" >
  <li class="nav-item" onclick="hideDone()">
    <a class="nav-link active" href="#">Đang xử lý</a>
  </li>
  <li class="nav-item" onclick="hidePending()"> 
    <a class="nav-link" href="#">Đã hoàn thành</a>
  </li>
</ul>

<div class="tab-show">
    <div class="order-card">
      <div class="order-card_top  d-flex justify-content-between">
        <div class="client-info d-flex ">
          <div class="client-avatar">
              <img src="" alt="">
          </div>
          <div class="client-info_text">
              <div class="client-name">Tên: abc</div>
              <div class="client-phone">Điện thoại: abc</div>
              <div class="client-email">Email: abc</div>
              <div class="client-address">Địa chỉ: abc</div>
          </div>
      </div>
      <div class="order-status">Trạng thái: Đang vận chuyển</div>
      </div>
      <div class="order-card_bottom d-flex justify-content-between">
        <div class="total-prd">Số lượng sản phẩm: 4</div>
        <div class="angle-down">
            <i class="fa-solid fa-angle-down"></i>
        </div>
        <div class="cost-total">Giá trị đơn hàng: 200000 đ</div>
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
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td><div class="img"></div></td>
              <td>Mark</td>
              <td>120</td>
              <td>x 2</td>
              <td>120000</td>
            </tr>
          </tbody>
        </table>
        <div class="order-note">
          <a>Note: </a>
          shop hứa tặng tui 1 voucher 50% all sản phẩm
        </div>
        <div class="order-progress d-flex">
          <div class="row progress_bar">
              <div class="col-2">
                <i class="fa-solid fa-circle-check"></i>
                <div class="progress-text">Chuẩn bị hàng</div>
                <div class="progress-confirm"> Hoàn thành </div>
              </div>
              <div class="col-2">
                <i class="fa-solid fa-spinner"></i>
                <div class="progress-text">Đang giao</div>
              </div>  
              <div class="col-2">
                <i class="fa-solid fa-circle-notch"></i>
                <div class="progress-text">Đã giao</div>
              </div>
            </div>
        </div>
    </div>
</div>