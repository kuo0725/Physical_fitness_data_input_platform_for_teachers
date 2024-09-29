<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
</head>
<body>
    <h2>登入</h2>
    <form action="login.php" method="POST">
        <label for="username">帳號:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">密碼:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="登入">
    </form>
    <button onclick="window.location.href='register.php'">註冊帳號</button>
    <button onclick="window.location.href='forgot_password.php'">忘記密碼</button>
	 <a href="home.html" class="button">返回主畫面</a>

   <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 資料庫連接參數
    $servername = "localhost";
    $username_db = "root";
    $password_db = "3013856paul";
    $dbname = "user_registration";

    // 建立連接
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // 檢查連接
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 檢查用戶名和密碼
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: fitness_input.php");
        exit();
    } else {
        echo "帳號或密碼錯誤";
    }

    $conn->close();
}
?>
</body>
</html>



