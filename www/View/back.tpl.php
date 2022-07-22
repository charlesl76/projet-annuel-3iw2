<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= SITE_NAME ?> | Admin</title>
  <link rel="stylesheet" href="<?= $final_url ?>./dist/main.css">
  <meta name="description" content="ceci est la description de ma page">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.tiny.cloud/1/dngik02bbjynezc0xdewv8zjhqxwjqzfc1hq0a8azqg58db9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="https://cdn.jsdelivr.net/gh/prashantchaudhary/ddslick@master/jquery.ddslick.min.js"></script>
</head>

<body>
  <header>
    <div class="logo-container"></div>
    <div class="header-container">
      <h1 class="title">Sported</h1>
      <a href="/" class="button fix">Back to site</a>
    </div>
  </header>
  <div class="container">
    <nav class="main">
      <a href="<?= $final_url ?>/dashboard" rel="noopener noreferrer">
        <img class="link<?= $active == "dashboard" ? "--active" : "" ?>" src="<?= $final_url ?>./dist/home_black_24dp.svg" alt="Dashboard" />
      </a>
      <a href="/articles" rel="noopener noreferrer">
        <img class="link<?= $active == "articles" ? "--active" : "" ?>" src="<?= $final_url ?>./dist/article_black_24dp.svg" alt="Articles" />
      </a>
      <a href="/pages" rel="noopener noreferrer">
        <img class="link<?= $active == "pages" ? "--active" : "" ?>" src="<?= $final_url ?>./dist/layers_black_24dp.svg" alt="Pages" />
      </a>
      <a href="/comments" rel="noopener noreferrer">
        <img class="link<?= $active == "comments" ? "--active" : "" ?>" src="<?= $final_url ?>./dist/question_answer_black_24dp.svg" alt="Comments" />
      </a>
      <a href="/tags" rel="noopener noreferrer">
        <img class="link<?= $active == "tags" ? "--active" : "" ?>" src="<?= $final_url ?>./dist/perm_media_black_24dp.svg" alt="Tags" />
      </a>
      <a href="/theme" rel="noopener noreferrer">
        <img class="link" src="<?= $final_url ?>./dist/format_color_fill_black_24dp.svg" alt="Theme" />
      </a>
      <a href="/users" rel="noopener noreferrer">
        <img class="link<?= $active == "users" ? "--active" : "" ?>" src="<?= $final_url ?>./dist/supervisor_account_black_24dp.svg" alt="Home" />
      </a>
      <a href="/settings" rel="noopener noreferrer">
        <img class="link" src="<?= $final_url ?>./dist/settings_black_24dp.svg" alt="Home" />
      </a>
      <a href="/logout" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" class="link" fill="#42a5f5" viewBox="0 0 24 24" stroke="#d0d0d2" stroke-width="2" width="50%">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
      </a>
    </nav>
    <div class="content">
      <div class="card">
        <?php include $this->view . ".view.php"; ?>
      </div>
    </div>
  </div>
</body>

</html>