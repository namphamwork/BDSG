<?php
// session_start();
// Bước 1: Import các class của PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/src/Exception.php");

// Bước 2: Xử lý yêu cầu quên mật khẩu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy email từ form nhập
    $email = $_POST['email'];


    // Tạo một đoạn mã ngẫu nhiên (ví dụ: mã xác thực)
    $verification_code = rand(100000, 999999);
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['verification_code'] = $verification_code;
    // Lưu đoạn mã này vào cơ sở dữ liệu của người dùng (ví dụ: bảng `password_reset_codes`)

    // Gửi đoạn mã qua email cho người dùng
    $mail = new PHPMailer(true);
    try {
        // Thiết lập thông tin của email

        $mail->IsSMTP(); // enable SMTP

        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "nampham2999@gmail.com"; //mail của mình
        $mail->Password = "hvvlpqpagnhitich";
        $mail->SetFrom("nampham2999@gmail.com");
        $mail->Subject = "VanNam";



        // Thiết lập thông tin người gửi và email người gửi

        $mail->addAddress($email); // Email người nhận

        // Thiết lập tiêu đề và nội dung email
        $mail->Subject = 'Forgot Password Verification Code';
        $mail->Body = "Your verification code is: $verification_code";

        // Gửi email
        $mail->send();
        echo 'Email sent successfully!';
        header("Location: ?page=Forgotpass");
        exit;
    } catch (Exception $e) {
        echo "Email sending failed. Error: {$mail->ErrorInfo}";
    }
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
                    <label for="mail">Mail</label>
                    <div class="field">
                        <input type="text" name="email" placeholder="Email" required>
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Send mail">
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>