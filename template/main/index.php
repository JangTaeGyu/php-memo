<?php echo view('layout/top.php', ['title' => '메인']); ?>

<div class="content">

    <div class="memo_list">

    <?php for ($i = 0; $i < 10; $i++): ?>

        <div class="memo_item">
            <a href="javascript:void(0)" class="memo_inner">
                <p class="memo_contents">
                    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                    bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
                    cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc
                    dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                </p>
                <p class="memo_writer">작성자 : 장태규</p>
            </a>
        </div>

    <?php endfor; ?>

    </div>
</div>

<?php echo view('layout/bottom.php'); ?>
