<style>
.custom-radio:disabled {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid #ccc;
    cursor: not-allowed;
}

.custom-radio:checked {
    background-image: url('../ThemCauHoi/buttonanswer.png');
    background-size: cover;
}
</style>
<div class="modal" tabindex="-1" role="dialog" id="Xem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" id="editQuestionId" name="id">
                <div class="form-group">
                    <label for="txaquestion">Câu hỏi:</label>
                    <textarea class="form-control" id="txaquestion" rows="1"
                        placeholder="Nhập câu hỏi vào đây"></textarea>
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="txaOptionA" rows="1" placeholder="Đáp án A "></textarea>
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="txaOptionB" rows="1" placeholder="Đáp án B "></textarea>
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="txaOptionC" rows="1" placeholder="Đáp án C "></textarea>
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="txaOptionD" rows="1" placeholder="Đáp án D "></textarea>
                </div>
                <br>
                <div class="form-group">
                    <div class="row">
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="rdOptionA" class="custom-radio">Đáp án
                                A</label>
                        </div>
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="rdOptionB" class="custom-radio">Đáp án
                                B</label>
                        </div>
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="rdOptionC" class="custom-radio">Đáp án
                                C</label>
                        </div>
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="rdOptionD" class="custom-radio">Đáp án
                                D</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnSubmitXem">Xác nhận</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="ThemCauHoi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="form-group">
                    <label for="Txaquestion">Câu hỏi:</label>
                    <textarea class="form-control" id="Txaquestion" rows="1"
                        placeholder="Nhập câu hỏi vào đây"></textarea>
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="TxaOptionA" rows="1" placeholder="Đáp án A "></textarea>
                    <!-- Ô nhập đáp án A -->
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="TxaOptionB" rows="1" placeholder="Đáp án B "></textarea>
                    <!-- Ô nhập đáp án B -->
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="TxaOptionC" rows="1" placeholder="Đáp án C "></textarea>
                    <!-- Ô nhập đáp án C -->
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" id="TxaOptionD" rows="1" placeholder="Đáp án D "></textarea>
                </div>
                <br>
                <div class="form-group">
                    <div class="row">
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="RdOptionA" class="custom-radio">Đáp án
                                A</label>
                        </div>
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="RdOptionB" class="custom-radio">Đáp án
                                B</label>
                        </div>
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="RdOptionC" class="custom-radio">Đáp án
                                C</label>
                        </div>
                        <div class="radio col-sm-5">
                            <label><input type="radio" name="optradio" id="RdOptionD" class="custom-radio">Đáp án
                                D</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnSubmitThem">Xác nhận</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCloseThem">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Thêm câu hỏi -->
<script>
$('#ThemCauHoi #btnSubmitThem').click(function() {
    let question = $('#Txaquestion').val().trim();
    let optionA = $('#TxaOptionA').val().trim();
    let optionB = $('#TxaOptionB').val().trim();
    let optionC = $('#TxaOptionC').val().trim();
    let optionD = $('#TxaOptionD').val().trim();
    let answer = $('#RdOptionA').is(':checked') ? 'A' : $('#RdOptionB').is(':checked') ? 'B' : $('#RdOptionC')
        .is(':checked') ? 'C' : $('#RdOptionD').is(':checked') ? 'D' : '';
    // console.log(question, optionA, optionB, optionC, optionD, answer);

    //Ràng buộc dữ liệu
    if (question == '' || optionA == '' || optionB == '' || optionC == '' || optionD == '') {
        alert('Vui lòng nhập đầy đủ thông tin');
        return;
    }

    if (answer == '') {
        alert('Vui lòng chọn đáp án đúng ');
        return;
    }


    $.ajax({
        url: 'addQuestion1.php',
        type: 'POST',
        data: {
            question: question,
            optionA: optionA,
            optionB: optionB,
            optionC: optionC,
            optionD: optionD,
            answer: answer
        },
        success: function(data) {
            alert(data);
            $('#Txaquestion').val('');
            $('#TxaOptionA').val('');
            $('#TxaOptionB').val('');
            $('#TxaOptionC').val('');
            $('#TxaOptionD').val('');
            $('input[type="radio"]').prop('checked', false);
        }
    });




});
</script>


<script>
$('#btnSubmitXem').click(function() {
    let id = $('#editQuestionId').val(); // ID câu hỏi
    let question = $('#txaquestion').val().trim();
    let optionA = $('#txaOptionA').val().trim();
    let optionB = $('#txaOptionB').val().trim();
    let optionC = $('#txaOptionC').val().trim();
    let optionD = $('#txaOptionD').val().trim();
    let answer = $('#rdOptionA').is(':checked') ? 'A' : $('#rdOptionB').is(':checked') ? 'B' : $('#rdOptionC')
        .is(':checked') ? 'C' : $('#rdOptionD').is(':checked') ? 'D' : '';

    // Ràng buộc dữ liệu
    if (question == '' || optionA == '' || optionB == '' || optionC == '' || optionD == '') {
        alert('Vui lòng nhập đầy đủ thông tin');
        return;
    }

    if (answer == '') {
        alert('Vui lòng chọn đáp án đúng');
        return;
    }

    $.ajax({
        url: 'update.php',
        type: 'POST',
        data: {
            id: id,
            question: question,
            optionA: optionA,
            optionB: optionB,
            optionC: optionC,
            optionD: optionD,
            answer: answer
        },
        success: function(data) {
            alert(data);
            $('#Xem').modal('hide'); // Đóng modal sau khi cập nhật thành công
            location.reload(); // Tải lại trang để hiển thị dữ liệu mới
        }
    });
});
$('#txtSearch').on('input', function() {
    let keyword = $(this).val().trim(); // Lấy từ khóa tìm kiếm

    if (keyword === '') {
        // Nếu ô tìm kiếm rỗng, hiển thị lại tất cả câu hỏi
        $.ajax({
            url: 'view.php',
            type: 'GET',
            data: {
                Search: '', // Gửi yêu cầu để lấy tất cả câu hỏi
                page: 1 // Trở về trang đầu tiên
            },
            success: function(data) {
                $('#question').html(data).show(); // Hiển thị tất cả câu hỏi
                $("input[name='view'], input[name='update'], input[name='delete']").click(reButton);
            }
        });
    } else {
        // Nếu có từ khóa, tìm kiếm câu hỏi
        $.ajax({
            url: 'view.php',
            type: 'GET',
            data: {
                Search: keyword,
                page: 1 // Trở về trang đầu tiên
            },
            success: function(data) {
                $('#question').hide(); // Ẩn danh sách câu hỏi ban đầu
                $('#question').html(data).show(); // Hiển thị kết quả tìm kiếm
                $("input[name='view'], input[name='update'], input[name='delete']").click(reButton);
            }
        });
    }
});
</script>