<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <title>Quản lý câu hỏi </title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Câu hỏi</th>
                <th scope="col">Đáp án </th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody id="question">
            <div class="row d-flex align-items-start">
                <div class="col-sm-5 d-flex">
                    <input type="text" class='form-control'
                        style="text-align: left; margin-right: 10px; border: 2px solid #007bff; opacity: 0.5;"
                        placeholder="Nhập nội dung tìm kiếm" id="txtSearch">
                    <button class='btn btn-md btn-primary' id="btnSearch">Search</button>
                </div>
                <div class="col-sm-7" style="text-align: right;">
                    <button id="12" class="btn btn-success">Thêm câu hỏi</button>
                </div>
                <div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php include('view.php')?>
        </tbody>
    </table>
</body>

</html>

<?php include('modal1.php')?>

<script>
$('#12').click(function() {
    $('#ThemCauHoi').modal('show');
});

$('#ThemCauHoi').on('hidden.bs.modal', function() {
    $('#Txaquestion').val('');
    $('#TxaOptionA').val('');
    $('#TxaOptionB').val('');
    $('#TxaOptionC').val('');
    $('#TxaOptionD').val('');
    $('input[name="optradio"]').prop('checked', false);
});
</script>
<!-- view -->
<script type="text/javascript">
function Detail1(id) {
    $.ajax({
        url: 'detail.php',
        type: 'GET',
        data: {
            id: id
        },
        // Thêm dòng này để jQuery tự động parse JSON
        success: function(data) {
            console.log(data); // Kiểm tra dữ liệu nhận được

            // Dữ liệu đã được parse tự động, không cần JSON.parse
            if (data.error) {
                console.error("Error:", data.error);
            } else {
                $('#txaquestion').val(data.question);
                $('#txaOptionA').val(data.option_a);
                $('#txaOptionB').val(data.option_b);
                $('#txaOptionC').val(data.option_c);
                $('#txaOptionD').val(data.option_d);
                $('input[name="optradio"]').prop('checked', false);
                if (data.answer == 'A') {
                    $('#rdOptionA').prop('checked', true);
                } else if (data.answer == 'B') {
                    $('#rdOptionB').prop('checked', true);
                } else if (data.answer == 'C') {
                    $('#rdOptionC').prop('checked', true);
                } else if (data.answer == 'D') {
                    $('#rdOptionD').prop('checked', true);
                }
                $('#Xem').modal('show'); // Hiển thị modal
            }
        }
    });
}
</script>
<!-- update -->
<script type="text/javascript">
$('#btnCloseThem').click(function() {
    location.reload(); // Tải lại trang khi nhấn nút Đóng
});


function reButton() {
    var trid = $(this).closest('tr').attr('id'); // ID của hàng
    var buttonName = $(this).attr('name'); // Tên của nút được click

    if (buttonName === 'view') {
        Detail1(trid);
        $('#txaquestion').attr('readonly', 'readonly');
        $('#txaOptionA').attr('readonly', 'readonly');
        $('#txaOptionB').attr('readonly', 'readonly');
        $('#txaOptionC').attr('readonly', 'readonly');
        $('#txaOptionD').attr('readonly', 'readonly');

        $('#rdOptionA').attr('disabled', 'disabled');
        $('#rdOptionB').attr('disabled', 'disabled');
        $('#rdOptionC').attr('disabled', 'disabled');
        $('#rdOptionD').attr('disabled', 'disabled');

        $('#btnSubmitXem').attr('disabled', 'disabled');
    } else if (buttonName === 'update') {
        Detail1(trid);
        $('#txaquestion').attr('readonly', false);
        $('#txaOptionA').attr('readonly', false);
        $('#txaOptionB').attr('readonly', false);
        $('#txaOptionC').attr('readonly', false);
        $('#txaOptionD').attr('readonly', false);
        $('#rdOptionA').attr('disabled', false);
        $('#rdOptionB').attr('disabled', false);
        $('#rdOptionC').attr('disabled', false);
        $('#rdOptionD').attr('disabled', false);
        $('#editQuestionId').val(trid); // Lưu ID câu hỏi vào hidden input
        $('#btnSubmitXem').attr('disabled', false);
    } else if (buttonName === 'delete') {
        if (confirm("Bạn chắc chắn muốn xoá câu hỏi này không?") == true) { // Xác nhận xoá
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: {
                    id: trid
                },
                success: function(data) {
                    alert(data); // Hiển thị thông báo
                    location.reload(); // Tải lại trang
                }
            });
        }
    }
}

$("input[name='view'], input[name='update'], input[name='delete']").click(reButton);



// Giữ lại giá trị ô tìm kiếm khi chuyển trang
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('txtSearch'); // Giả sử ô input có id là txtSearch
    searchInput.value = '<?= htmlspecialchars($Search) ?>'; // Đặt giá trị ô input
});
</script>