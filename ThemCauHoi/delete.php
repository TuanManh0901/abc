<?php
try {
    include('connect1.php');
    $id = $_POST['id'];

    // Chuẩn bị câu lệnh SQL để xóa câu hỏi
    $sql = "DELETE FROM thitn WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Xóa câu hỏi thành công";
    } else {
        echo "Không tìm thấy câu hỏi để xóa";
    }
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>