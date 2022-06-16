<?php foreach ($tasks as $val): ?>
    <div class="card">
        <h5 class="card-header"><?php echo $val['name'] . $val['edited']; ?></h5>
        <div class="card-body">
            <h5 class="card-title"><?php echo $val['email']; ?></h5>
            <p class="card-text">
                <textarea class="w-100 text-dark p-20 border-0" id="text_<?php echo $val['id']; ?>" data-autoresize<?php echo $disabled; ?>><?php echo $val['task_text']; ?></textarea>
            </p>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="done_<?php echo $val['id']; ?>" <?php echo $val['checked'] . $disabled; ?>>
                <label class="form-check-label" for="done_<?php echo $val['id']; ?>">Выполнено</label>
            </div>

            <?php if ($disabled !== ' disabled'): ?>
                <div class="btn btn-info" id="button_<?php echo $val['id']; ?>" onclick="onChangeTask(this)">Сохранить</div>
            <?php endif; ?>
        </div>
    </div><br/>
<?php endforeach; ?>

<br/>
<div class="p-3">
    <form action="" method="get">
        Сортировка:
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="done">сперва НЕ выполненные</option>
            <option value="done-desc">сперва выполненные</option>
            <option value="name">по имени (A-Z)</option>
            <option value="name-desc">по имени (Z-A)</option>
            <option value="email">по email (A-Z)</option>
            <option value="email-desc">по email (Z-A)</option>
        </select>
        <input name="page" type="hidden" id="page" onchange="this.form.submit()" value="<?php echo $currentPage; ?>">
    </form>

    <br/><br/>
    <nav aria-label="...">
        <ul class="pagination pagination-sm">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i === $currentPage): ?>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link"><?php echo $i; ?></span>
                    </li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="onClickPage(this)"><?php echo $i; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
