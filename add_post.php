<?php
include 'db.php';

// 檢查是否提交表單
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $title = $conn->real_escape_string($_POST['title']);
    $post = $conn->real_escape_string($_POST['post']);
    $post_sort = $conn->real_escape_string($_POST['post_sort']);

    // 插入資料
    $sql = "INSERT INTO post (name, title, post, date, post_sort) VALUES ('$name', '$title', '$post', NOW(), '$post_sort')";

    if ($conn->query($sql)) {
        $message = "文章新增成功！";
    } else {
        $message = "文章新增失敗：" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增文章</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 600px; margin: auto; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select, button { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc; }
        button { background: #006aa6; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #005a90; }
        .message { text-align: center; margin-bottom: 20px; color: green; }
    </style>
</head>
<body>
    <h1>新增文章</h1>
    <?php if (isset($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form action="add_post.php" method="POST">
        <label for="name">作者</label>
        <input type="text" id="name" name="name" placeholder="輸入作者名稱" required>

        <label for="title">標題</label>
        <input type="text" id="title" name="title" placeholder="輸入文章標題" required>

        <label for="post">內容</label>
        <textarea id="post" name="post" rows="5" placeholder="輸入文章內容" required></textarea>

        <label for="post_sort">分類</label>
        <select id="post_sort" name="post_sort" required>
            <option value="life">生活</option>
            <option value="play">娛樂</option>
            <option value="school">校園</option>
            <option value="tech">科技</option>
        </select>

        <button type="submit">新增文章</button>
    </form>
    <p style="text-align: center; margin-top: 20px;">
        <a href="main.php">返回首頁</a>
    </p>
</body>
</html>
