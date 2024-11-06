<?php
header('Content-Type: application/json; charset=utf-8');

include('connect1.php');

$response = array();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    $response['error'] = 'Không có ID được cung cấp';
} else {
    try {
        $sql = "SELECT * FROM thitn WHERE id = :id";
        $rs = $conn->prepare($sql);
        $rs->bindParam(':id', $id, PDO::PARAM_INT);
        $rs->execute();
        $result = $rs->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $response = $result;
        } else {
            $response['error'] = 'Không tìm thấy dữ liệu cho ID này';
        }
    } catch (PDOException $e) {
        $response['error'] = 'Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage();
    }
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit; // Thêm dòng này để đảm bảo không có đầu ra nào khác
?>