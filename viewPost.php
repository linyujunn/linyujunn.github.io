<?php
include 'db.php';

// 獲取 GET 參數
$name = isset($_GET['name']) ? $conn->real_escape_string($_GET['name']) : '';
$title = isset($_GET['title']) ? $conn->real_escape_string($_GET['title']) : '';

// 查詢文章內容
$sql = "SELECT name, title, post, date FROM post WHERE name = '$name' AND title = '$title'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>文章內容 - TSMR製作</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; }
    .top { display: flex; justify-content: space-between; align-items: center; background: #ffff00; color: black; padding: 10px 20px; }
    .top ul { list-style: none; display: flex; }
    .top li { margin: 0 10px; }
    .top a { color: #00ffff; text-decoration: none; }
    .top a:hover { text-decoration: underline; }
    .content { display: flex; max-width: 1200px; margin: 20px auto; padding: 0 20px; }
    .sidebar { flex: 1; background: #f0f8ff; border-radius: 8px; padding: 10px; box-shadow: 0 10px 10px rgba(0, 0, 0, 0.5); margin-right: 20px; }
    .sidebar ul { list-style: none; }
    .sidebar li { margin-bottom: 10px; }
    .sidebar a { text-decoration: none; color: #006aa6; }
    .sidebar a:hover { text-decoration: underline; }
    .post { flex: 3; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
    .post-title { font-size: 1.5em; margin-bottom: 10px; }
    .post-meta { color: #666; margin-bottom: 20px; }
    .post-content { margin-bottom: 20px; }
    footer { text-align: center; padding: 30px; background-color: #45a1ff; color: #fff; margin-top: 50px; }
  </style>
</head>
<body>
  <header class="top">
    <div>TSMR製作</div>
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
    <aside class="sidebar">
      <h2>分類</h2>
      <ul>
        <li><a href="life.php">生活</a></li>
        <li><a href="school.php">校園</a></li>
        <li><a href="play.php">娛樂</a></li>
        <li><a href="tech.php">科技</a></li>
      </ul>
    </aside>

    <section class="post">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php $row = $result->fetch_assoc(); ?>
        <h1 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h1>
        <p class="post-meta">作者: <?php echo htmlspecialchars($row['name']); ?> | 日期: <?php echo htmlspecialchars($row['date']); ?></p>
        <div class="post-content"><?php echo nl2br(htmlspecialchars($row['post'])); ?></div>
      <?php else: ?>
        <p>未找到文章內容。</p>
      <?php endif; ?>
      <a href="search.php">返回首頁</a>
    </section>
  </main>

  <footer>
    <p>TSMR製作</p>
  </footer>
</body>
</html>
