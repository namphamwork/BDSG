
    <!-- ---bootstrap--- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<div class="user-page container">
    <!-- <div class="row">
        <div class="col-3">
        </div> -->
        <?php 
        if(isset($userID) && $userID != ''){
        $userInfor = connect("SELECT * FROM user WHERE user_id = '$userID'")[0]; 
        $delivery_info = connect("SELECT * FROM delivery_info WHERE user_id = '$userID'")[0]; 
         ?>
        <div class="row">
            <div class="user-base_info col-4">
                <form class="user-avatar" action="" method="post" enctype="multipart/form-data">
                    <input type="file" id="avatar-change" class="btn-fullW" name="avatar" >
                    <input type="submit" id="submitAva" name="avaChange" value=" ">
                    <div class="set-avatar" data-avatar="<?php echo $userInfor['avatar'] ?>"></div>
                    <i class="fa-solid fa-pen-to-square"></i>
                </form>
                <div class="sidebar">
                    <div class="user-info">
                        <div class="user-name"><?php echo $delivery_info['client_name'] ?></div>
                        <div class="user-favorite"><i class="fa-regular fa-heart"></i><a> 0 <?php  ?></a></div> 
                    </div>
                    
                    <ul class="user-sidebar">
                        <li class="sideBarTab actived" onclick="openTab(this)" ><i class="fa-regular fa-user"></i> <a>Thông tin cá nhân</a></li>
                        <li class="sideBarTab" onclick="openTab(this)"><i class="fa-regular fa-heart"></i> <a >Sản phẩm yêu thích</a></li>
                        <li class="sideBarTab" onclick="openTab(this)"><i class="fa-solid fa-clock-rotate-left"></i> <a >Lịch sử đơn hàng</a></li>
                        <li></li>
                    </ul>
                </div>
            </div>
            <form action="" method="post" class="userPage_content user-infor_details col-8  gap-4" >
                <div class="user-contact d-flex justify-content-between">
                    <label for="">Email
                        <input type="text" class="form-control" name="email" value="<?php echo $userInfor['email']?>" disabled>
                    </label>
                    <label for="">Điện thoại
                        <input type="text" class="form-control" name="phone" value="<?php echox($delivery_info['client_phone']) ?>">
                    </label>
                </div>
                <label for="">Họ và tên
                    <input type="text" class="form-control" name="fullName" value="<?php echox($delivery_info['client_name']) ?>">
                </label>
                <div class="user-contact d-flex justify-content-between">
                    <label for="">Tên đăng nhập
                        <input type="text" class="form-control" name="fullName" value="<?php echox($userInfor['user_nickname']) ?>" disabled>
                    </label>
                    <label for="">Mật khẩu
                        <input type="password" class="form-control" name="password" value="<?php echox($userInfor['password']) ?>" disabled>
                    </label>
                </div>
                <label for="">Địa chỉ
                    <input type="text" class="form-control" name="address" value="<?php echox($delivery_info['address']) ?>">
                </label>
                
                <input class="updtInfo btn btn-primary w-25" type="submit" name="updateUserInfo" value="CẬP NHẬT" disabled>
            </form>

            <div class="userPage_content order-history col-8">
                 
            </div>
            <form class="userPage_content order-history col-8">
                <div>
                    Danh sách đơn hàng
                </div>
                <ul class="nav nav-tabs" >
                    <li class="nav-item" onclick="hideDone()">
                        <a class="nav-link active" href="#">Đang xử lý</a>
                    </li>
                    <li class="nav-item" onclick="hidePending()"> 
                        <a class="nav-link" href="#">Đã hoàn thành</a>
                    </li>
                </ul>
                <?php order_list(); ?>
            </form>
        </div>
    </div>
    <?php }?>
</div>