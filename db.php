<?php
  // Database configuration
  $host = 'localhost'; // 資料庫伺服器
  $user = 'root';      // 資料庫使用者
  $pass = '02110915';  // 資料庫密碼
  $dbname = 'post';    // 資料庫名稱
  
  // Create connection
  $conn = new mysqli($host, $user, $pass, $dbname);
  
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>
