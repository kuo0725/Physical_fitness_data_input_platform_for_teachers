<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>體適能成績</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .search-bar {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function deleteScore(name) {
            if (confirm("確定要刪除這條成績記錄嗎？")) {
                window.location.href = "delete_score.php?name=" + name;
            }
        }

        function goBack() {
            window.location.href = "fitness_input.php";
        }
    </script>
</head>
<body>
    <h2>體適能成績</h2>
    <div class="search-bar">
        <form method="GET" action="view_scores.php">
            <label for="search">搜索名字:</label>
            <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <input type="submit" value="搜索">
        </form>
    </div>
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

    // 檢索資料庫中的體適能成績
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT * FROM fitness_scores WHERE name LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 输出数据
        echo "<table>";
        echo "<tr>
                <th>名字(暱稱)</th>
                <th>漸速折返跑 (趟) <button onclick=\"window.location.href='view_specific_score.php?column=shuttle_run'\">查看</button></th>
                <th>仰臥捲腹 (次) <button onclick=\"window.location.href='view_specific_score.php?column=sit_up'\">查看</button></th>
                <th>立定跳遠 (公分) <button onclick=\"window.location.href='view_specific_score.php?column=standing_long_jump'\">查看</button></th>
                <th>肢體前彎 (公分) <button onclick=\"window.location.href='view_specific_score.php?column=sit_and_reach'\">查看</button></th>
                <th>操作</th>
              </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["shuttle_run"]."</td>
                    <td>".$row["sit_up"]."</td>
                    <td>".$row["standing_long_jump"]."</td>
                    <td>".$row["sit_and_reach"]."</td>
                    <td>
                        <button onclick=\"deleteScore('".$row["name"]."')\">刪除</button>
                        <button onclick=\"window.location.href='edit_score.php?name=".$row["name"]."'\">修改</button>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 結果";
    }
    $conn->close();
    ?>
    <br>
    <button onclick="goBack()">返回體適能成績輸入</button>
</body>
</html>
