<!DOCTYPE html>
<html lang="en">

<head>
    <title>Làm bài thi </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="countdown.js"></script>
</head>

<body>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Làm bài thi</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <select id="subjectSelect"
                            style="font-size: 17px; width: 100px;text-align-last: center; border: 2px ridge;">
                            <option value="van">Văn</option>
                            <option value="toan">Toán</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="button" name="button" style="font-size: 17px;" class="btn btn-success"
                        id="btnStart">Bắt đầu</button>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 id="countdown" style="color: green;"></h2> <!-- Thêm đồng hồ đếm ngược -->
                    </div>
                </div>
            </div>
            <div id="question">
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="button" name="button" style="font-size: 17px; color: black;" class="btn btn-warning"
                        id="btnFinish">Nộp bài</button>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 id='diem' style="color: Magenta;"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>

<script>
$(document).ready(function() {
    $('#btnFinish').hide(); // Ẩn nút nộp bài
});
var question;
var countdownTimer; // Biến để lưu timer
$('#btnStart').click(function() {
    var selectedSubject = $('#subjectSelect').val(); // Lấy giá trị môn học đã chọn
    if (selectedSubject === 'toan') {
        GetQuestion1(); // Gọi hàm GetQuestion1 cho môn Toán
        startCountdown(3600);
    } else {
        GetQuestion(); // Gọi hàm GetQuestion cho môn Văn
        startCountdown(5400);
    }
    $('#btnFinish').show(); // Hiện nút nộp bài
    $('#btnStart').hide(); // Ẩn nút bắt đầu
    $('#subjectSelect').hide();
});

$('#btnFinish').click(function() {
    if (confirm('Bạn có chắc chắn muốn nộp bài không?')) {
        CheckResult();
    }
});

function CheckResult() {
    let diem = 0;
    $('#question .row').each(function(index, value) {
        //Lấy đáp án đúng của câu hỏi
        let id = $(value).find('h4').attr('id');
        let questions = question.find(x => x.id == id);
        let answer = questions['answer'];

        // Lấy đáp án người dùng chọn
        let da = $(value).find('input[type="radio"]:checked').attr('class');
        if (da == answer) {
            diem += 10;
        } else {
            console.log('Câu ' + (index + 1) + ' sai');
        }
    });
    $('#btnFinish').hide(); // Ẩn nút nộp bài
    alert('Điểm của bạn là: ' + diem);
    $('#diem').html('Điểm của bạn là: ' + diem);

}

function CheckResult() {
    let diem = 0;
    $('#question .row').each(function(index, value) {
        //Lấy đáp án đúng của câu hỏi
        let id = $(value).find('h4').attr('id');
        let questions = question.find(x => x.id == id);
        let answer = questions['answer'];

        // Lấy đáp án người dùng chọn
        let da = $(value).find('input[type="radio"]:checked').attr('class');
        if (da == answer) {
            diem += 10;
        } else {
            console.log('Câu ' + (index + 1) + ' sai');
        }
        //Đối chiếu kết quả 
        $(value).find('input[type=radio].' + answer).parent().css("background-color", "GreenYellow");

    });
    $('#btnFinish').hide(); // Ẩn nút nộp bài
    $('#countdown').hide();
    alert('Điểm của bạn là: ' + diem);
    $('#diem').html('Điểm của bạn là: ' + diem);

}

function GetQuestion() {
    $.ajax({
        url: 'question.php',
        type: 'GET',
        dataType: 'json', // Đặt kiểu dữ liệu trả về là JSON
        success: function(data) {
            question = jQuery.parseJSON(JSON.stringify(data));
            let d = '';
            $.each(question, function(index, value) {
                d += '<div class="row" style="margin-left: 5px;">';
                d += '<h4 style="font-weight: bold;" id="' + value['id'] +
                    '"> <span style="color: red">Câu ' + (index + 1) +
                    ': </span>' + value['question'] +
                    '</h4>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="A" name="optradio' + (index + 1) +
                    '"><span style="color: blue">A. </span> ' + value['option_a'] +
                    '</label>';
                d += '</div>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="B" name="optradio' + (index + 1) +
                    '"><span style="color: blue">B. </span> ' +
                    value[
                        'option_b'] +
                    '</label>';
                d += '</div>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="C" name="optradio' + (index + 1) +
                    '"><span style="color: blue">C. </span> ' +
                    value[
                        'option_c'] +
                    '</label>';
                d += '</div>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="D" name="optradio' + (index + 1) +
                    '"><span style="color: blue">D. </span> ' +
                    value[
                        'option_d'] +
                    '</label>';
                d += '</div>';
                d += '</div>';
                index++;
            });
            $('#question').html(d);
        }
    });
}

function GetQuestion1() {
    $.ajax({
        url: 'question1.php',
        type: 'GET',
        dataType: 'json', // Đặt kiểu dữ liệu trả về là JSON
        success: function(data) {
            question = jQuery.parseJSON(JSON.stringify(data));
            let d = '';
            $.each(question, function(index, value) {
                d += '<div class="row" style="margin-left: 5px;">';
                d += '<h4 style="font-weight: bold;" id="' + value['id'] +
                    '"> <span style="color: red">Câu ' + (index + 1) +
                    ': </span>' + value['question'] +
                    '</h4>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="A" name="optradio' + (index + 1) +
                    '"><span style="color: blue">A. </span> ' + value['option_a'] +
                    '</label>';
                d += '</div>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="B" name="optradio' + (index + 1) +
                    '"><span style="color: blue">B. </span> ' +
                    value[
                        'option_b'] +
                    '</label>';
                d += '</div>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="C" name="optradio' + (index + 1) +
                    '"><span style="color: blue">C. </span> ' +
                    value[
                        'option_c'] +
                    '</label>';
                d += '</div>';
                d += '<div class="radio col-sm-12">';
                d += '<label><input type="radio" class="D" name="optradio' + (index + 1) +
                    '"><span style="color: blue">D. </span> ' +
                    value[
                        'option_d'] +
                    '</label>';
                d += '</div>';
                d += '</div>';
                index++;
            });
            $('#question').html(d);
        }
    });
}
</script>