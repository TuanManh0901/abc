<?php
try {
    include('connect1.php');
        $question = $_POST['question'];
        $optionA = $_POST['optionA'];
        $optionB = $_POST['optionB'];
        $optionC = $_POST['optionC'];
        $optionD = $_POST['optionD'];
        $answer = $_POST['answer'];
    
    // Kết nối đến cơ sở dữ liệu và lấy id lớn nhất hiện có
    $query = "SELECT MAX(id) AS max_id FROM thitn";
    $result = $conn->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $new_id = $row['max_id'] + 1;

    $sql = "INSERT INTO thitn(id,question, option_a, option_b, option_c, option_d, answer)
    VALUES ('$new_id','$question', '$optionA', '$optionB', '$optionC', '$optionD', '$answer')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Thêm câu hỏi thành công";
    } catch(PDOException $e) {
    echo $sql. "Lỗi". $e->getMessage();
    }
?>