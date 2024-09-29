<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查看體適能成績</title>
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
    </style>
</head>
<body>
    <h2>查看體適能成績</h2>
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

    // 獲取列名
    $column = isset($_GET['column']) ? $_GET['column'] : '';

    if ($column) {
        // 檢索資料庫中的特定列成績
        $sql = "SELECT name, $column FROM fitness_scores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 输出数据
            echo "<table>";
            echo "<tr><th>名字(暱稱)</th><th>成績</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row[$column]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 結果";
        }
    } else {
        echo "未指定列名";
    }

    $conn->close();
    ?>
    <br>
    <button onclick="window.location.href='view_scores.php'">返回體適能成績資料表格</button>
    <button onclick="window.location.href='fitness_input.php'">返回體適能成績輸入</button>
</body>
</html>
