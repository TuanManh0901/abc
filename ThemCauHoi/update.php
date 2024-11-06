<?php
include('connect1.php');

try {
    // Kiểm tra sự tồn tại của các biến POST
    if (isset($_POST['id'], $_POST['question'], $_POST['optionA'], $_POST['optionB'], $_POST['optionC'], $_POST['optionD'], $_POST['answer'])) {
        // Lấy dữ liệu từ yêu cầu POST
        $id = $_POST['id'];
        $question = $_POST['question'];
        $optionA = $_POST['optionA'];
        $optionB = $_POST['optionB'];
        $optionC = $_POST['optionC'];
        $optionD = $_POST['optionD'];
        $answer = $_POST['answer'];

        // Chuẩn bị câu lệnh SQL
        $sql = "UPDATE ThiTN SET 
                question = :question, 
                option_a = :optionA, 
                option_b = :optionB, 
                option_c = :optionC, 
                option_d = :optionD, 
                answer = :answer 
                WHERE id = :id";

        // Chuẩn bị và thực thi câu lệnh
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':optionA', $optionA);
        $stmt->bindParam(':optionB', $optionB);
        $stmt->bindParam(':optionC', $optionC);
        $stmt->bindParam(':optionD', $optionD);
        $stmt->bindParam(':answer', $answer);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        // Kiểm tra xem có dòng nào bị ảnh hưởng không
        if ($stmt->rowCount() > 0) {
            echo "Cập nhật câu hỏi thành công";
        } else {
            echo "Không có thay đổi hoặc không tìm thấy câu hỏi";
        }
    } else {
        echo "Thiếu dữ liệu POST.";
    }
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

$conn = null;
?>