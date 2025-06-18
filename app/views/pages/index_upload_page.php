<form class="upload" action="<?= \app\core\Route::url('photo','upload')?>" method="post" enctype="multipart/form-data">
    <label for="images">Вибрати файл: </label>
    <input type="file" name="image" id="images">
    <input type="submit" value="Завантажити">

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</form>