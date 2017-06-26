<?php echo view('layout/top.php', ['title' => '메인']); ?>

<div class="content">

    <form method="GET" action="/">
        <input type="text" class="form_search" name="search_word" value="<?= $request['search_word'] ?>" placeholder="검색어를 입력해 주세요.">
    </form>

    <div class="memo_list">

    <?php foreach ($memos as $memo): ?>

        <div id="memo_panel" class="memo_item">
            <div class="memo_inner">
                <p class="memo_contents">
                    <a href="/memo/view?search_word=<?= $request['search_word'] ?>&id=<?= $memo['id'] ?>">
                        <?= preg_replace('/\r\n|\r|\n/', '' , $memo['memo']) ?>
                    </a>
                </p>
                <p class="memo_writer">
                    <?= $memo['user_email'] ?>

                <?php if ($memo['user_id'] === session('id')): ?>

                    <a href="javascript:void(0)" class="memo_remove" data-token="<?= token() ?>" data-id="<?= $memo['id'] ?>">X</a>

                <?php endif; ?>

                </p>
            </div>
        </div>

    <?php endforeach; ?>

    </div>
</div>

<?php
    echo view('layout/bottom.php', [
        'javascript' => ['/js/memo_remove.js']
    ]);
?>
