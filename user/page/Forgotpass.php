<?php
// Bắt đầu session để sử dụng session lưu trữ giữa các trang
// session_start();
$_SESSION['forgotmail'] = $_SESSION['email'];

// Kiểm tra nếu người dùng đã nhập mã xác thực và gửi form đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy mã xác thực từ form nhập
    $userVerificationCode = $_POST['verification_code'];

    // Lấy mã xác thực đã lưu trữ trong session khi gửi email
    $verificationCode = $_SESSION['verification_code'];

    // Kiểm tra xem mã xác thực người dùng nhập có khớp với mã đã lưu trữ không
    if ($userVerificationCode == $verificationCode) {
        header("location: ?page=resetpass");
    } else {
        // Mã xác thực không chính xác, thông báo cho người dùng và yêu cầu nhập lại
        echo "Mã xác thực không đúng vui lòng thử lại.";
    }

    // Xóa mã xác thực đã lưu trữ trong session sau khi kiểm tra
    unset($_SESSION['verification_code']);
}
?>


<div class="login-wraper">
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Quên Mật Khẩu
            </div>
            <div class="title signup">
                Signup Form
            </div>
        </div>
        <div class="form-container">
            <div>

            </div>
            <div class="form-inner">
                <form class="login" method="post">
                    <label for="code">Mã Xác Thực</label>
                    <div class="field">
                        <input type="text" name="verification_code" placeholder="Mã" required>
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Đặt Lại Mật Khẩu">
                    </div>
                    <div class="signup-link">
                        Chưa Nhận Được Thư? <a href="">Gửi Lại</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>