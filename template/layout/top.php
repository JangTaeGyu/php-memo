<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta http-equiv="imagetoolbar" content="no">
        <title>메모장 웹 어플리케이션 :: <?= isset($title) ? $title : '' ?></title>

        <link rel="stylesheet" href="/css/memo.css">
    </head>
    <body>
        <div class="container">

            <?php echo view('layout/navbar.php'); ?>
