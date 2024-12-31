
<?php
include 'db.php';

// 接收用戶輸入
$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// 預設錯誤訊息
$error_message = '';

// 當提交表單時處理登錄邏輯
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id && $password) {
        // 準備和執行參數化查詢
        $stmt = $conn->prepare("SELECT name FROM login WHERE id = ? AND password = ?");
        $stmt->bind_param("ss", $id, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // 登錄成功，提取使用者名稱
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['user_name'] = $row['name'];
            header("Location: page.php");
            exit;
        } else {
            $error_message = '帳號或密碼錯誤';
        }

        $stmt->close();
    } else {
        $error_message = '請輸入帳號和密碼';
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登錄頁面</title>
<style>
    /* 重置样式 */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* 頁面背景 */
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #f4f4f4;
    }

    /* 登入框容器 */
    .login-container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    /* 標題 */
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    /* 輸入框樣式 */
    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1em;
    }

    /* 登入按鈕樣式 */
    .login-container button {
      width: 100%;
      padding: 10px;
      background: #006aa6;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 1em;
      cursor: pointer;
      transition: background 0.3s;
    }

    .login-container button:hover {
      background: #005a90;
    }

  </style>
</head>
<body>
  <div class="login-container">
    <h2>登錄</h2>
    <?php if ($error_message): ?>
      <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>
    <form action="" method="post">
      <input type="text" name="id" placeholder="用戶 ID" required>
      <input type="password" name="password" placeholder="密碼" required>
      <button type="submit">登錄</button>
    </form>
  </div>
</body>
</html>
