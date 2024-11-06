<?php
include('connect1.php');
$sql = $conn->prepare("SELECT * FROM thitn ORDER BY RANDOM() LIMIT 10");
$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$question = [];

foreach ($result as $row) {
    $question[] = [
        'id' => $row['id'],
        'question' => $row['question'],
            'option_a' => $row['option_a'],
            'option_b' => $row['option_b'],
            'option_c' => $row['option_c'],
            'option_d' => $row['option_d'],
            'answer' => $row['answer']
    ];
}
echo json_encode($question);
?>