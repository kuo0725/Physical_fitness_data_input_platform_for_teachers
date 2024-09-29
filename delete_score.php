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

// 獲取要刪除的用戶名稱
$name = $_GET["name"];

// 刪除資料庫中的記錄
$sql = "DELETE FROM fitness_scores WHERE name='$name'";

if ($conn->query($sql) === TRUE) {
    echo "記錄刪除成功";
} else {
    echo "錯誤: " . $conn->error;
}

$conn->close();

// 返回到體適能成績查看頁面
header("Location: view_scores.php");
exit();
?>
