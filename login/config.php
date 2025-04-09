<?php /*連線資料庫基本檔案 */
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/*define() 函數定義一個常量。
在設定以後，常量的值無法更改
常量名不需要開頭的美元符號 ($)
作用域不影響對常量的訪問
常量值只能是字符串或數字*/
define('DB_SERVER', 'localhost'); // 資料庫主機位置，通常是本機 localhost
define('DB_USERNAME', 'root'); // 資料庫使用者名稱
define('DB_PASSWORD', ''); // 資料庫密碼（這裡預設空白）
define('DB_NAME', 'test'); // 要連接的資料庫名稱

// 嘗試連線到 MySQL 資料庫
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// 輸入中文也OK的編碼
mysqli_query($link, 'SET NAMES UTF8');

// 檢查是否成功連線
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    return $link;
}
