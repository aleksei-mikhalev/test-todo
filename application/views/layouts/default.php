<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./public/css/styles.css">
        <script src="./public/scripts/scripts.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="./" class="nav-link">На главную</a>
                </li>
                <li class="nav-item">
                    <a href="new" class="nav-link">Создать задачу</a>
                </li>
                <li class="nav-item">
                    <a href="login" class="nav-link">Администратор</a>
                </li>
            </ul>
        </nav>

        <div class="p-3">
            <div class="error"><?php echo $flashMessage; ?></div>
            <?php echo $content; ?>
        </div>
    </body>
</html>
