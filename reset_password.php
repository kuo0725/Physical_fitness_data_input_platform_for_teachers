<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重置密碼</title>
</head>
<body>
    <h2>重置密碼</h2>
    <form action="reset_password.php" method="POST">
        <label for="username">用戶名:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">新密碼:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirm_password">確認新密碼:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="重置密碼">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($password != $confirm_password) {
            echo "密碼和確認密碼不一致";
        } else {
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

            // 更新密碼
            $sql = "UPDATE users SET password='$password' WHERE username='$username'";

            if ($conn->query($sql) === TRUE) {
                echo "密碼已成功重置";
            } else {
                echo "錯誤: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
    ?>

    <br><br>
    <button onclick="location.href='login.php'">返回登入頁面</button>
</body>
</html>

