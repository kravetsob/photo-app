<?php foreach ($photos as $photo):?>
    <div class="photo">
        <div class="id"><?= $photo['id']?></div>
        <img src="/storage/<?= $photo['name'] ?>" alt="img_name">
    </div>

    <div class="likes">
        <div><?= $photo['likes']?></div>
        <form action="<?=\app\core\Route::url('like', 'like')?>" method="post">
            <input type="hidden" name="imageId" value="<?= $photo['id']?>">
            <input type="submit" value="Like">
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