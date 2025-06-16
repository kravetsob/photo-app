<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/style.css">
        <title><?= (isset($title) ? $title . ' | ' : '') . SITE_NAME ?></title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="<?= \app\core\Route::url()?>"><img src="images/logo.png" alt="logo" class="logo"></a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="content">
                <?php include_once $this->getViewPath($viewName);?>
            </div>
        </main>
        <footer><div class="footer">JanTeam &copy;2025</div></footer>
    </body>
</html>
