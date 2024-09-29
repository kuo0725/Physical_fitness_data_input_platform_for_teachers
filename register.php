<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊頁面</title>
</head>
<body>
    <h2>註冊頁面</h2>
    <form action="register.php" method="POST">
        <label for="username">帳號:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">密碼:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirm_password">確認密碼:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="註冊">
    </form>
    <p>已經有帳號了嗎？<a href="login.php">登入</a></p>

    <?php
    // 資料庫連接參數
    $servername = "localhost";
    $username_db = "root";
    $password_db = "3013856paul";
    $dbname = "user_registration";

    // 創建連接
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // 檢查連接
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 表單提交處理
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // 檢查密碼和確認密碼是否一致
        if ($password != $confirm_password) {
            echo "密碼和確認密碼不一致";
        } else {
            // 插入資料到資料庫
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "註冊成功";
            } else {
                echo "錯誤: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>

