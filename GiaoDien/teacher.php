<?php
// Bắt đầu hoặc tiếp tục phiên làm việc, cho phép sử dụng biến $_SESSION
session_start();

// Kiểm tra xem người dùng có vai trò 'admin' hay không
if ($_SESSION['quyen'] != 'teacher') {
    // Nếu không phải admin, chuyển hướng đến trang user_dashboard.php hoặc teacher_dashboard.php
    if ($_SESSION['quyen'] == 'user') {
        header("Location: user.php");
    } elseif ($_SESSION['quyen'] == 'admin') {
        header("Location: admin.php");
    } 
    exit();
}

// Nếu là , chuyển hướng đến trang chủ Google
header("Location: ../ThemCauHoi/index.php ");

?>