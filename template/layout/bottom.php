
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                if ($('div').hasClass('flash')) {
                    setTimeout(() => {
                        $('.flash').slideUp(400);
                    }, 3000);
                }
            });
        </script>

        <?php if (isset($javascript)): ?>
            <?php foreach ($javascript as $link): ?>
                <script type="text/javascript" src="<?= $link ?>"></script>
            <?php endforeach; ?>
        <?php endif; ?>

    </body>
</html>
