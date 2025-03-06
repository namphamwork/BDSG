<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdsg";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ báo lỗi cho PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy thông tin đăng ký từ form
        $username = $_POST['usernameregis'];
        $password = $_POST['passwordregis'];
        $email = $_POST['emailregis'];
        $repassword = $_POST['repassword'];

        // Kiểm tra tính hợp lệ của thông tin đăng ký
        if (empty($username) || empty($password) || empty($email) || empty($repassword)) {
            echo 'Vui lòng điền đầy đủ thông tin.';
        } else if ($password != $repassword) {
            $_SESSION['register-err'] = 'Mật khẩu và nhập lại mật khẩu không trùng khớp';
            header('Location: ../?page=Log-in&form=false');
        } else {
            // Sử dụng prepared statement để tránh SQL injection
            $query = "SELECT * FROM user WHERE user_nickname = :username OR email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['register-err2'] = 'Tên đăng nhập hoặc địa chỉ email đã tồn tại.';
                header('Location: ../?page=Log-in&form=false');
            } else {
                // Nếu chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
                $query = "INSERT INTO user (user_nickname, email, password) VALUES (:username, :email, :password)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                $_SESSION['register-success'] = 'Đăng ký thành công';
                header('Location: ../?page=Log-in');
            }
        }
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
// Đóng kết nối PDO
$conn = null;
