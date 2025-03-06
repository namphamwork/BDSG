<div class="login-wraper">
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Đăng Nhập
            </div>
            <div class="title signup">
                Đăng Ký
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Đăng Nhập</label>
                <label for="signup" class="slide signup">Đăng Ký</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="page/login_process.php" class="login" method="post">
                    <div class="field">
                        <input type="text" name="username" placeholder="Tên Tài Khoản" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Mật Khẩu" required>
                    </div>
                    <div class="pass-link">
                        <a href="?page=forgotpass-mail">Quên Mật Khẩu?</a>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Đăng Nhập">
                    </div>
                    <?php

                    // Kiểm tra xem có thông báo lỗi không
                    if (isset($_SESSION['login_error'])) {
                        echo $_SESSION['login_error']; // Hiển thị thông báo lỗi (nếu có)
                        unset($_SESSION['login_error']); // Xóa thông báo lỗi sau khi đã hiển thị
                    }
                    // Kiểm tra xem có thông báo lỗi không
                    if (isset($_SESSION['register-success'])) {
                        echo $_SESSION['register-success']; // Hiển thị thông báo lỗi (nếu có)
                        unset($_SESSION['register-success']); // Xóa thông báo lỗi sau khi đã hiển thị
                    }
                    if (isset($_SESSION['resetpass-success'])) {
                        echo $_SESSION['resetpass-success']; // Hiển thị thông báo lỗi (nếu có)
                        unset($_SESSION['resetpass-success']); // Xóa thông báo lỗi sau khi đã hiển thị
                    }
                    ?>
                    <div class="signup-link">
                        Chưa Có Tài Khoản? <a href="">Đăng ký ngay</a>
                    </div>
                </form>
                <form action="page/register_process.php" method="post" class="signup">
                    <div class="field">
                        <input type="text" placeholder="Email" name='emailregis' required>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Tên Tài khoản" name='usernameregis' required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Mật Khẩu" name='passwordregis' required>
                    </div>
                    <div class="field">
                        <input type="password" name="repassword" placeholder="Nhập Lại Mật Khẩu" required>
                    </div>
                    <?php
                    if (isset($_SESSION['register-err'])) {
                        echo $_SESSION['register-err']; // Hiển thị thông báo lỗi (nếu có)
                        unset($_SESSION['register-err']); // Xóa thông báo lỗi sau khi đã hiển thị
                    }
                    if (isset($_SESSION['register-err2'])) {
                        echo $_SESSION['register-err2']; // Hiển thị thông báo lỗi (nếu có)
                        unset($_SESSION['register-err2']); // Xóa thông báo lỗi sau khi đã hiển thị
                    }
                    ?>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Đăng Ký">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const formValue = urlParams.get('form');
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("form .signup-link a");

    signupBtn.onclick = (() => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    });
    loginBtn.onclick = (() => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
    });
    signupLink.onclick = (() => {
        signupBtn.click();
        return false;
    });

    function handleFormClick() {
        if (formValue === "false") {
            signupBtn.click();
        }
    }

    // Sử dụng setTimeout để gọi hàm handleFormClick sau khi trang đã tải xong
    setTimeout(handleFormClick, 10);
</script>