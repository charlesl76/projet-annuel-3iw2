<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Yoursite | Admin</title>
    <link rel="stylesheet" href="<?= $final_url ?>./dist/main.css">
    <meta name="description" content="ceci est la description de ma page">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" src="<?= $final_url ?>./dist/src/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?= $final_url ?>./dist/src/js/script.js"></script>
    <script src="https://cdn.tiny.cloud/1/dngik02bbjynezc0xdewv8zjhqxwjqzfc1hq0a8azqg58db9/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    <header id="front-header">
        <div class="header-container">
            <a href="/">
                <img src="../dist/logo-spiral-1.png">
                <h1 class="front-header-title">Sported</h1>
            </a>
            <div id="front-header-nav-container">
                <button id="menu-button"> <img src="<?= $final_url ?>./dist/assets/images/menu-icon.svg"></button>
                <nav id="front-header-site-nav">
                    <ul>
                        <li><a href="#">Fonctionnement</a></li>
                        <li><a href="#">Tarif</a></li>
                        <li><a href="#">A propos</a></li>
                        <li> | </li>
                        <li><a href="/login" class="button" id="login-button">Sign In</a></li>
                        <li><a href="/register" class="button" id="register-button">Sign Up</a></li>
                    </ul>
                </nav>
                <div id="front-color">
                    <button onclick="greenBg()" id="front-color-green"></button>
                    <button onclick="blueBg()" id="front-color-blue"></button>
                </div>
            </div>
        </div>
    </header>