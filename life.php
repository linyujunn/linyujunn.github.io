<?php
include 'db.php';

// 從資料庫中查詢所有文章，按日期降序排列
$sql = "SELECT name,title, post, date FROM post where post_sort='life' ORDER BY date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TSMR製作</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
	
	/* Body */
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background: #f4f4f4;
    }
    /*=======================top=====================*/
    .top {       
	  display: flex;                    /*橫向排列*/
      justify-content: space-between;   /*等距排列 左右靠邊*/
      align-items: center;              /*不同物件不同大小 中心置中*/
      background: #ffff00;
      color: black;
      padding: 10px 20px;
    }

	.top ul{         /*消除清單 改成中心置中*/
	  list-style: none;
      display: flex;
	}
	
	.top li{
	  margin: 0px 10px;  /*0是上下 10是左右*/
	}
	
	.top a{              /*消除底線*/
	  color:#00ffff;
	  text-decoration: none;
	}
	
	.top a:hover {       /*滑鼠移過去才有底線*/
      text-decoration: underline;
    }
	
	
	/* Main content */
    .content {
      display: flex;
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 20px;
    }
	
	/*======================sidebar=====================*/
	.sidebar {
	  flex: 1;
	  background:#f0f8ff;
	  border-radius: 8px;     /*圓角*/
	  padding: 10px ;
	  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.5);   /*陰影*/
	  margin-right: 20px;
	}
	
	.sidebar h3 {
      margin-bottom: 15px;
    }
	   
	.sidebar ul {
      list-style: none;
    }
	
    .sidebar li {
      margin-bottom: 10px;
    }
	
	.sidebar a {
      text-decoration: none;
      color: #006aa6;
    }
	
	.sidebar a:hover {
      text-decoration: underline;
    }
	
	/*========================post====================*/
	
	
	.post-list {     
	  flex: 3;       /*文章框框伸展性*/
	}
	
	.post {
      background: #a9a9a9;
      margin-bottom:20px;
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
      background: #006aa6;
      color: #fff;
      border: none;
      padding: 8px 12px;
      border-radius: 4px;
      cursor: pointer;

    }
	
	.read-more a{              /*消除底線*/
	  color:#00ffff;
	  background: #005a90;
	  text-decoration: none;
	}
	
    .read-more a:hover {       /*滑鼠移過去才有底線*/
      text-decoration: underline;
    }
	
	/*============================footer=============================*/

    footer {
	  text-align:center;
      padding: 30px;
      background-color: #45a1ff;
      color: #fff;
	  margin-top:50px;
	  
    }
	
	/* ========================Search bar========================== */
    
	.button{
	  width:50px;
	  height:50px;
	  margin-left:10px;
	}
	
	.search-bar {
      margin-bottom:20px;
	  display: flex;	  
    }
	
    .search-bar input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1em;
    }
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

    <section class="post-list">
      <div class="search-bar">
        <form action="search.php" method="GET" style="display: flex; width: 100%;">
          <input type="text" name="keyword" placeholder="搜索文章關鍵字" required style="flex: 2; margin-right: 10px;">
          <select name="post_sort" style="flex: 1; margin-right: 10px;">
            <option value="">全部分類</option>
            <option value="life">生活</option>
            <option value="play">娛樂</option>
            <option value="school">校園</option>
            <option value="tech">科技</option>
          </select>
          <button class="button" type="submit">搜索</button>
        </form>
      </div>

      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <article class="post">
            <h2 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h2>            <!--htmlspecialchars() 用於避免 XSS（跨站腳本攻擊）-->
			<p class="post-content"><?php echo nl2br(htmlspecialchars($row['post'])); ?></p>       <!--nl2br() 將內容中的換行符（\n）轉換為 HTML 的 <br> 標籤-->
            <p>作者: <?php echo htmlspecialchars($row['name']); ?> | 日期: <?php echo htmlspecialchars($row['date']); ?></p>
            <button class="read-more">
              <a href="viewPost.php?name=<?php echo urlencode($row['name']); ?>&title=<?php echo urlencode($row['title']); ?>">閱讀更多</a>
            </button>
          </article>
        <?php endwhile; ?>
      <?php else: ?>
        <p>目前沒有文章。</p>
      <?php endif; ?>
    </section>
  </main>

  <footer>
    <p>TSMR製作</p>
  </footer>
</body>
</html>
