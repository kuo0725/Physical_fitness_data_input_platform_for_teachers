<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>忘記密碼</title>
</head>
<body>
    <h2>忘記密碼</h2>
    <form action="forgot_password.php" method="POST">
        <label for="username">請輸入您的帳號:</label>
        <input type="text" id="username" name="username" required><br><br>
        <input type="submit" value="找回密碼">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];

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

        // 查找用戶
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 用户存在，生成重置密码链接（此例不实际发送邮件，只展示给用户）
            $reset_link = "http://localhost/reset_password.php?username=" . urlencode($username);
            echo "重置密碼鏈接: <a href='$reset_link'>$reset_link</a>";
        } else {
            echo "用戶不存在";
        }

        $conn->close();
    }
    ?>
</body>
</html>
