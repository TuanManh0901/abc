<?php
// Bắt đầu hoặc tiếp tục phiên làm việc, cho phép sử dụng biến $_SESSION
session_start();

// Kiểm tra xem người dùng có vai trò 'user' hay không
if ($_SESSION['quyen'] != 'user') {
    // Nếu không phải user thông thường, chuyển hướng đến trang admin.php hoặc teacher.php
    if ($_SESSION['quyen'] == 'admin') {
        header("Location: admin.php");
    } elseif ($_SESSION['quyen'] == 'teacher') {
        header("Location: teacher.php");
    }
        // Nếu không có vai trò hợp lệ, có thể chuyển hướng đến trang đăng nhập hoặc thông báo lỗi
    exit();
}


header("Location: ../LamBaiThi/index.php");
?>