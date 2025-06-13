<form class="upload" action="<?= \app\core\Route::url('photo','upload')?>" method="post" enctype="multipart/form-data">
    <label for="images">Вибрати файл: </label>
    <input type="file" name="image" id="images">
    <input type="submit" value="Завантажити">

    <div class="errors">
        <p>Помилки</p>
    </div>
</form>