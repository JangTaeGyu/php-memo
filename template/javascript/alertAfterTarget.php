<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta http-equiv="imagetoolbar" content="no">
        <title>메모장 웹 어플리케이션 :: 경고 메시지</title>
    </head>
    <body>
        <script type="text/javascript">

            <?php if (isset($message)): ?>
            alert("<?= $message ?>")
            <?php endif; ?>

            location.href = "<?= $target ?>";

        </script>
    </body>
</html>
