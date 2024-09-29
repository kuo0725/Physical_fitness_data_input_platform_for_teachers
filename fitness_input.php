<?php
session_start();

// 檢查用戶是否已登錄
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>體適能成績輸入</title>
    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var shuttle_run = document.getElementById("shuttle_run").value;
            var sit_up = document.getElementById("sit_up").value;
            var standing_long_jump = document.getElementById("standing_long_jump").value;
            var sit_and_reach = document.getElementById("sit_and_reach").value;

            if (name == "" || shuttle_run == "" || sit_up == "" || standing_long_jump == "" || sit_and_reach == "") {
                alert("請填寫所有必填項目。");
                return false;
            }
            return true;
        }

        function viewScores() {
            window.location.href = "view_scores.php";
        }
    </script>
</head>
<body>
    <h2>體適能成績輸入</h2>
    <form action="fitness_input.php" method="POST" onsubmit="return validateForm()">
        <label for="name">名字 (暱稱):</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="shuttle_run">漸速折返跑 (趟):</label>
        <input type="number" id="shuttle_run" name="shuttle_run" required><br><br>
        <label for="sit_up">仰臥捲腹 (次):</label>
        <input type="number" id="sit_up" name="sit_up" required><br><br>
        <label for="standing_long_jump">立定跳遠 (公分):</label>
        <input type="number" id="standing_long_jump" name="standing_long_jump" required><br><br>
        <label for="sit_and_reach">肢體前彎 (公分):</label>
        <input type="number" id="sit_and_reach" name="sit_and_reach" required><br><br>
        <input type="submit" value="儲存">
        <button type="button" onclick="viewScores()">檢視成績</button>
        <button type="button" onclick="window.location.href='logout.php'">登出</button>
    </form>

    <?php
    // 資料庫連接參數
    $servername = "localhost";
    $username_db = "root";
    $password_db = "3013856paul";
    $dbname = "fitness_records";

    // 創建連接
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // 檢查連接
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 表單提交處理
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $shuttle_run = $_POST["shuttle_run"];
        $sit_up = $_POST["sit_up"];
        $standing_long_jump = $_POST["standing_long_jump"];
        $sit_and_reach = $_POST["sit_and_reach"];

        // 插入資料到資料庫
        $sql = "INSERT INTO fitness_scores (name, shuttle_run, sit_up, standing_long_jump, sit_and_reach) VALUES ('$name', '$shuttle_run', '$sit_up', '$standing_long_jump', '$sit_and_reach')";

        if ($conn->query($sql) === TRUE) {
            echo "體適能成績已成功輸入";
        } else {
            echo "錯誤: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>
</html>
