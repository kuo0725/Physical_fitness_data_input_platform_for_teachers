<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改體適能成績</title>
</head>
<body>
    <h2>修改體適能成績</h2>
    <?php
    // 資料庫連接參數
    $servername = "localhost";
    $username = "root";
    $password = "3013856paul";
    $dbname = "fitness_records";

    // 建立連接
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 檢查連接
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 獲取名字
    $name = isset($_GET['name']) ? $_GET['name'] : '';

    if ($name) {
        // 檢索指定記錄的資料
        $sql = "SELECT * FROM fitness_scores WHERE name='$name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form action="edit_score.php" method="POST">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <label for="shuttle_run">漸速折返跑 (趟):</label>
                <input type="number" id="shuttle_run" name="shuttle_run" value="<?php echo $row['shuttle_run']; ?>" required><br><br>
                <label for="sit_up">仰臥捲腹 (次):</label>
                <input type="number" id="sit_up" name="sit_up" value="<?php echo $row['sit_up']; ?>" required><br><br>
                <label for="standing_long_jump">立定跳遠 (公分):</label>
                <input type="number" id="standing_long_jump" name="standing_long_jump" value="<?php echo $row['standing_long_jump']; ?>" required><br><br>
                <label for="sit_and_reach">肢體前彎 (公分):</label>
                <input type="number" id="sit_and_reach" name="sit_and_reach" value="<?php echo $row['sit_and_reach']; ?>" required><br><br>
                <input type="submit" value="保存">
            </form>
            <?php
        } else {
            echo "找不到該記錄。";
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 表單提交處理
        $name = $_POST["name"];
        $shuttle_run = $_POST["shuttle_run"];
        $sit_up = $_POST["sit_up"];
        $standing_long_jump = $_POST["standing_long_jump"];
        $sit_and_reach = $_POST["sit_and_reach"];

        // 更新資料到資料庫
        $sql = "UPDATE fitness_scores SET shuttle_run='$shuttle_run', sit_up='$sit_up', standing_long_jump='$standing_long_jump', sit_and_reach='$sit_and_reach' WHERE name='$name'";

        if ($conn->query($sql) === TRUE) {
            echo "成績更新成功";
        } else {
            echo "錯誤: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>
    <br>
    <button onclick="window.location.href='view_scores.php'">返回資料表格</button>
    <button onclick="window.location.href='fitness_input.php'">返回體適能成績輸入</button>
</body>
</html>
