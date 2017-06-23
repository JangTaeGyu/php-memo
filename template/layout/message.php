
<?php if (\Session::exists('success')): ?>
<div class="flash flash_success"><?= \Session::flash('success') ?></div>
<?php endif; ?>

<?php if (\Session::exists('fail')): ?>
<div class="flash flash_error"><?= \Session::flash('fail') ?></div>
<?php endif; ?>
