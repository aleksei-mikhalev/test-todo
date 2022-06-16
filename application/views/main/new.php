<div class="p-3">
    <form action="new" method="post">
        <b>Новая задача</b><br/><br/>
        <div class="error"><?php echo $errorText; ?></div>
        Имя:<br/>
        <input name="name"><br/><br/>
        Email:<br/>
        <input name="email"><br/><br/>
        Описание задачи:<br/>
        <textarea name="text" class="w-100" data-autoresize></textarea><br/><br/>
        <button>Создать</button>
    </form>
</div>
