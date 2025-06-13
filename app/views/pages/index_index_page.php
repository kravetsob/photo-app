<?php foreach ($photos as $photo):?>
    <div class="photo">
        <p><?= $photo['id']?></p>
        <img src="<?= $photo['path']?>" alt="img_name">
    </div>

    <div class="likes">
        <div><?= $photo['likes']?></div>
        <form action="<?=\app\core\Route::url('like', 'like')?>" method="post">
            <input type="hidden" name="imageId" value="<?= $photo['id']?>">
            <input type="submit" value="Like">
        </form>
    </div>
<?php endforeach;?>

<div class="add-photo"><a href="<?= \app\core\Route::url('photo', 'upload')?>">Add Photo</a></div>

<div class="pagination">
    <a href="#">&laquo;</a>
    <a href="#">1</a>
    <a class="active" href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">&raquo;</a>
</div>