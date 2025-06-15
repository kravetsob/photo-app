<form class="upload" action="<?= \app\core\Route::url('photo','upload')?>" method="post" enctype="multipart/form-data">
    <label for="images">Вибрати файл: </label>
    <input type="file" name="image" id="images">
    <input type="submit" value="Завантажити">

    <?php if (!empty($error)):?>
        <p>Помилка: <?= ($error) ?></p>
    <?php endif; ?>
</form>