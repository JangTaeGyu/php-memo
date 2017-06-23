
<div class="navbar">
    <div class="navbar_brand">
        <a href="/">메모장 웹 어플리케이션</a>
    </div>
    <ul class="navbar_list">

    <?php if (isLogin()): ?>

        <li class="navbar_item"><a href="/memo/create">메모 작성하기</a></li>
        <li class="navbar_item"><a href="/auth/logout">로그아웃</a></li>

    <?php else: ?>

        <li class="navbar_item"><a href="/auth/login">로그인</a></li>
        <li class="navbar_item"><a href="/join/signup">가입하기</a></li>

    <?php endif; ?>

    </ul>
</div>
