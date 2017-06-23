<?php echo view('layout/top.php', ['title' => '가입하기']); ?>

<div class="content">

    <form class="form" method="POST" action="/join/signup/process">
        <h1 class="form_title">가입하기</h1>
        <div class="form_group">
            <label>이름</label>
            <input type="text" class="form_control" name="name" value="<?= old('name') ?>">
        </div>
        <div class="form_group">
            <label>이메일</label>
            <input type="text" class="form_control" name="email" value="<?= old('email') ?>">
        </div>
        <div class="form_group">
            <label>비밀번호</label>
            <input type="password" class="form_control" name="password">
        </div>
        <div class="form_group">
            <label>비밀번호 확인</label>
            <input type="password" class="form_control" name="password_confirmation">
        </div>
        <div class="form_group">
            <button class="btn btn_primary btn_full_size">가입하기</button>
        </div>
    </form>

</div>

<?php echo view('layout/bottom.php'); ?>
