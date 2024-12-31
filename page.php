<?php
session_start();

// 檢查用戶是否已登錄
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

// 取得用戶名稱
$user_name = $_SESSION['user_name'];

// 初始化資料庫連線
include 'db.php';

$sql = "SELECT name, title, post, date FROM post WHERE name = ? ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>個人頁面</title>
  <style>
     * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* 網頁背景 */
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background: #f4f4f4;
    }

    /* 導覽列 */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ff69b4;
      color: #fff;
      padding: 10px 20px;
    }

    .navbar .logo {
      font-size: 1.5em;
      font-weight: bold;
    }

    .navbar ul {
      list-style: none;
      display: flex;
    }

    .navbar li {
      margin: 0 15px;
    }

    .navbar a {
      color: #fff;
      text-decoration: none;
    }

    .navbar a:hover {
      text-decoration: underline;
    }

    /* 主要內容區域 */
    .content {
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 20px;
    }

    /* 用戶資訊 */
    .user-info {
      background: #fff;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      text-align: center;
    }

    .user-info h2 {
      font-size: 1.8em;
      margin-bottom: 10px;
    }

    /* 文章列表 */
	.post-list {     
	  flex: 3;       /*文章框框伸展性*/
	}
	
	.post {
      background: #d3d3d3;
      margin-bottom:50px;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
	
	.post-title {
      font-size: 1em;
      margin-bottom: 10px;
    }
	
	.post-content {
      margin-bottom: 10px;
    }
	
	.read-more {
      background: #483d8b;
      color: #00ffff;
      border: none;
      padding: 8px 12px;
	  margin-top: 10px;
      border-radius: 4px;
      cursor: pointer;
    }
	
	.read-more a{              /*消除底線*/
	  color:#00ffff;
	  text-decoration: none;
	}
	
    .read-more a:hover {       /*滑鼠移過去才有底線*/
      text-decoration: underline;
    }

    /* 新增文章按鈕 */
    .add-post {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #28a745;
      color: #fff;
      border: none;
      padding: 15px;
      border-radius: 50%;
      font-size: 1.5em;
      cursor: pointer;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .add-post:hover {
      background: #218838;
    }
  </style>
</head>
<body>
  <header class="navbar">
    <div class="logo">個人頁面</div>
    <nav>
      <ul>
        <li><a href="main.php">首頁</a></li>
        <li><a href="#">熱門</a></li>
        <li><a href="time.php">最新</a></li>
        <li><a href="login.php">個人檔案</a></li>
      </ul>
    </nav>
  </header>
  
  <main class="content">
    <section class="user-info">
      <h1 class="header">歡迎，<?php echo htmlspecialchars($user_name); ?>！</h1>
    </section>
    <section class="post-list">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <article class="post">
            <h2 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h2>
            <p class="post-content"><?php echo nl2br(htmlspecialchars(mb_substr($row['post'], 0, 100)) . '...'); ?></p>
            <p>作者: <?php echo htmlspecialchars($row['name']); ?> | 日期: <?php echo htmlspecialchars($row['date']); ?></p>
			<button class="read-more">
              <a  href="editPost.php?name=<?php echo urlencode($row['name']); ?>&title=<?php echo urlencode($row['title']); ?>">閱讀更多</a>
            </button>
		  </article>
        <?php endwhile; ?>
      <?php else: ?>
        <p>目前沒有文章。</p>
      <?php endif; ?>
    </section>
  </main>
  
  <button class="add-post">+</button>
</body>
</html>
