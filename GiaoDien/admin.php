<?php
// Bắt đầu hoặc tiếp tục phiên làm việc, cho phép sử dụng biến $_SESSION
session_start();

// Kiểm tra xem người dùng có vai trò 'admin' hay không
if ($_SESSION['quyen'] != 'admin') {
    // Nếu không phải admin, chuyển hướng đến trang user_dashboard.php hoặc teacher_dashboard.php
    if ($_SESSION['quyen'] == 'user') {
        header("Location: user.php");
    } elseif ($_SESSION['quyen'] == 'teacher') {
        header("Location: teacher.php");
    } 
    exit();
}

// Nếu là admin, chuyển hướng đến trang chủ Google
header("Location: ../ThemCauHoi/index.php ");

?>