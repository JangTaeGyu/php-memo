<?php echo view('layout/top.php', ['title' => '메인']); ?>

<div class="content">

    <form method="GET" action="/">
        <input type="text" class="form_search" name="search_word" value="<?= $request['search_word'] ?>" placeholder="검색어를 입력해 주세요.">
    </form>

    <div class="memo_list">

    <?php foreach ($memos as $memo): ?>

        <div class="memo_item">
            <a href="/memo/view?search_word=<?= $request['search_word'] ?>&id=<?= $memo['id'] ?>" class="memo_inner">
                <p class="memo_contents"><?= $memo['memo'] ?></p>
                <p class="memo_writer" style="text-align: center;"><?= $memo['user_email'] ?></p>
            </a>
        </div>

    <?php endforeach; ?>

    </div>
</div>

<?php echo view('layout/bottom.php'); ?>
