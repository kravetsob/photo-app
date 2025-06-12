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
                    <li><a href="<?= \app\core\Route::url()?>">Home</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php include_once $this->getViewPath($viewName);?>
        </main>
        <footer>JanTeam &copy;2025</footer>
    </body>
</html>
