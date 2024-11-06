<?php
session_start();
$dsn = 'pgsql:host=c8m0261h0c7idk.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com;port=5432;dbname=d5f124ds8nupst';
$username = 'u52h1nab8sl1lm';
$password = 'p8951bf1798016e4a70831b39351baec318413962252ab9417c83b4d74ac0d6d7';


try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['username'] = $username;
            $_SESSION['hovaten'] = $user['hovaten'];
            $_SESSION['quyen'] = $user['quyen'];

            if ($user['quyen'] == 'admin') {
                header("Location: admin.php");
            } elseif ($user['quyen'] == 'teacher') {
                header("Location: teacher.php");
            } else {
                header("Location: user.php");
            }
            exit();
        } else {
            echo "Thông tin đăng nhập không hợp lệ";
        }
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>