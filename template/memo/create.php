<?php echo view('layout/top.php', ['title' => '메모 작성하기']); ?>

<div class="content">

    <form class="form_memo" method="POST" action="/memo/store">
        <input type="hidden" name="_token" value="<?= token() ?>" />

        <h1 class="form_title">메모 작성하기</h1>
        <div class="form_group">
            <label>메모</label>
            <textarea name="memo" class="form_control" style="height: 300px;"></textarea>
        </div>
        <div class="form_group">
            <button class="btn btn_primary btn_full_size">작성하기</button>
        </div>
    </form>

</div>

<?php echo view('layout/bottom.php'); ?>
