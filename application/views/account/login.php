<div class="p-3">
    <b>Вход</b><br/><br/>
    <div class="error"><?php echo $errorText; ?></div>

    <?php if ($isAdmin): ?>
        <a href="./logout">Выйти</a><br/><br/>
    <?php else: ?>
        <form action="./login" method="post">
            <p>Логин</p>
            <p><input type="text" name="login"></p>
            <p>Пароль</p>
            <p><input type="text" name="password" type="password"></p>
            <b><button type="submit" name="enter">Вход</button></b>
        </form>
    <?php endif; ?>
</div>
