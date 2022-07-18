<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titleSeo ?? "Template du front" ?></title>
    <link rel="stylesheet" href="<?= $final_url ?>./dist/main.css">
    <meta name="description" content="ceci est la description de ma page">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://cdn.tiny.cloud/1/dngik02bbjynezc0xdewv8zjhqxwjqzfc1hq0a8azqg58db9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>

    <?php include $this->view . ".view.php"; ?>

</body>

</html>