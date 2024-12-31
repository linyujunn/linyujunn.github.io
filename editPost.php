<?php
session_start();

// 檢查用戶是否已登錄
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

// 初始化資料庫連線
include 'db.php';

// 驗證請求參數
if (isset($_GET['title']) && isset($_GET['name'])) {
    $title = $_GET['title'];
    $name = $_GET['name'];

    // 確認當前用戶為文章作者
    $stmt = $conn->prepare("SELECT post FROM post WHERE title = ? AND name = ?");
    $stmt->bind_param("ss", $title, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $original_post = $row['post'];
    } else {
        echo "您無權編輯此文章或文章不存在。";
        exit;
    }

    $stmt->close();
} else {
    echo "請求參數無效。";
    exit;
}

// 處理更新請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated_post = $_POST['post'];

    // 更新文章內容
    $stmt = $conn->prepare("UPDATE post SET post = ? WHERE title = ? AND name = ?");
    $stmt->bind_param("sss", $updated_post, $title, $name);
    if ($stmt->execute()) {
        echo "文章已更新！";
        header("Location: page.php");
        exit;
    } else {
        echo "更新失敗，請稍後再試。";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編輯文章</title>
  <style>
    /* 輕量樣式 */
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    textarea {
      width: 100%;
      height: 200px;
      margin-bottom: 15px;
      padding: 10px;
      font-size: 1em;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background: #28a745;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background: #218838;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>編輯文章</h1>
    <form method="POST">
      <textarea name="post"><?php echo htmlspecialchars($original_post); ?></textarea>
      <button type="submit">更新文章</button>
    </form>
  </div>
</body>
</html>