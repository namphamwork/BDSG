<?php
// Kết nối tới cơ sở dữ liệu bằng PDO
include "../include/function.php";
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
        // Lấy thông tin đăng nhập từ form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Sử dụng prepared statement để tránh SQL injection
        $query = "SELECT * FROM user WHERE user_nickname = :username AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Kiểm tra số hàng trả về từ truy vấn SELECT
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            // Lấy dữ liệu từ kết quả truy vấn
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // Lưu thông tin đăng nhập vào session
            // $_SESSION['username'] = $username;
            // $id = connect("SELECT user_id FROM user WHERE user_nickname = '$username'")[0]['user_id'];
            setcookie('BDSG_user-name', $username, time() + (86400 * 30), "/"); // 86400 = 1 day

            if ($data['role'] == 1) {
                header('Location: ../../admin/index.php');
            } else {
                header('Location: ../index.php');
            }
        } else {
            $_SESSION['login_error'] = 'Tên đăng nhập hoặc mật khẩu không đúng.';
            header('Location: ../?page=Log-in'); // Chuyển hướng về trang chứa form// Chuyển hướng về trang chứa form
        }
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
