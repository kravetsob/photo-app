<?php foreach ($photos as $photo):?>
    <div class="photo" id="photo<?= $photo['id'] ?>">
        <img src="<?= PHOTO_UPLOAD_URL . $photo['name']?>" alt="<?= $photo['name']?>">
    </div>

    <div class="likes">
        <form action="<?= \app\core\Route::url('like', 'like') ?>#photo<?= $photo['id']?>" method="post">
            <input type="hidden" name="imageId" value="<?= $photo['id']?>">
            <div>
                <button type="submit" style="color: <?=((int)$photo['likes'] > 0) ? 'red' : 'gray'?>">❤</button><?= $photo['likes']?>
            </div>
        </form>
    </div>
<?php endforeach;?>

<div class="add-photo"><a href="<?= \app\core\Route::url('photo', 'upload')?>">+</a></div>

<div class="pagination">
    <?php if ($prevPage > 0): ?>
        <a href="<?= \app\core\Route::url('photo', 'index') ?>page=<?= $prevPage ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
        <a href="<?= \app\core\Route::url('photo', 'index') ?>page=<?= $i ?>"
           class="<?= ($i == $page) ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($nextPage <= $pageCount): ?>
        <a href="<?= \app\core\Route::url('photo', 'index') ?>page=<?= $nextPage ?>">&raquo;</a>
    <?php endif; ?>
</div>