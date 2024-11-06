<?php 
try {
    include('connect1.php');
    
    // Lấy trang hiện tại
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5; // Số bản ghi mỗi trang
    $offset = ($current_page - 1) * $limit;
    
    $Search = isset($_GET['Search']) ? $_GET['Search'] : ''; 
    
    // Tính tổng số bản ghi
    $count_query = $conn->prepare("SELECT COUNT(*) as total FROM ThiTN WHERE question LIKE :search");
    $count_query->execute(['search' => '%'.$Search.'%']);
    $total_records = $count_query->fetch()['total'];
    
    // Tính tổng số trang
    $total_pages = ceil($total_records / $limit);
    
    // Query lấy dữ liệu có phân trang
    $sql = $conn->prepare("SELECT * FROM ThiTN WHERE question LIKE :search LIMIT :limit OFFSET :offset");
    $sql->bindValue(':search', '%'.$Search.'%', PDO::PARAM_STR);
    $sql->bindValue(':limit', $limit, PDO::PARAM_INT);
    $sql->bindValue(':offset', $offset, PDO::PARAM_INT);
    $sql->execute();
    
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    $index = $offset + 1;
    
    // Hiển thị dữ liệu
    foreach ($result as $row) {                                  
        echo '<tr id='.$row['id'].'>';
        echo '<th scope="row">'.$index++.'</th>';
        echo '<td>'.$row['question'].'</td>';
        echo '<td>'.$row['answer'].'</td>';
        echo '<td>';
        echo '<input type="button" class="btn btn-primary btn-info" value="Xem" name="view">&nbsp;';
        echo '<input type="button" class="btn btn-primary btn-warning" value="Sửa" name="update">&nbsp;';
        echo '<input type="button" class="btn btn-primary btn-danger" value="Xoá" name="delete">&nbsp;';
        echo '</td>';
        echo '</tr>';
    }
    
    // Cập nhật nút phân trang
    echo '<script>
        $(document).ready(function() {
            // Xóa nội dung cũ của pagination
            $(".pagination").empty();
            
            // Thêm nút Previous
            $(".pagination").append(`
                <li class="page-item ' . ($current_page <= 1 ? "disabled" : "") . '">
                    <a class="page-link" href="?page=' . ($current_page - 1) . '&Search=' . $Search . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            `);
            
            // Thêm các nút số trang
            for(let i = 1; i <= ' . $total_pages . '; i++) {
                $(".pagination").append(`
                    <li class="page-item ${i == ' . $current_page . ' ? "active" : ""}">
                        <a class="page-link" href="?page=${i}&Search=' . $Search . '">${i}</a>
                    </li>
                `);
            }
            
            // Thêm nút Next
            $(".pagination").append(`
                <li class="page-item ' . ($current_page >= $total_pages ? "disabled" : "") . '">
                    <a class="page-link" href="?page=' . ($current_page + 1) . '&Search=' . $Search . '" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            `);
        });
    </script>';
    
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>