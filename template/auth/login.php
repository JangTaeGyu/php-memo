<?php echo view('layout/top.php', ['title' => '로그인']); ?>

<div class="content">

    <form class="form" method="POST" action="/auth/login/process">
        <input type="hidden" name="_token" value="<?= token() ?>" />

        <h1 class="form_title">로그인</h1>
        <div class="form_group">
            <label>이메일</label>
            <input type="text" class="form_control" name="email" value="<?= old('email') ?>">
        </div>
        <div class="form_group">
            <label>비밀번호</label>
            <input type="password" class="form_control" name="password">
        </div>
        <div class="form_group">
            <button class="btn btn_primary btn_full_size">로그인</button>
        </div>
    </form>

</div>

<?php echo view('layout/bottom.php'); ?>
