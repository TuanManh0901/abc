function startCountdown(duration) {
  var timer = duration,
    minutes,
    seconds;
  countdownTimer = setInterval(function () {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    $("#countdown").html(minutes + ":" + seconds); // Cập nhật đồng hồ đếm ngược

    if (--timer < 0) {
      clearInterval(countdownTimer);
      alert("Thời gian đã hết!"); // Thông báo khi hết thời gian
      CheckResult(); // Gọi hàm kiểm tra kết quả
    }
  }, 1000);
}
