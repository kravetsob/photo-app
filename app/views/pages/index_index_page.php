<div class="photo">Photo</div>
<div class="likes">
    <img src="" alt="heart"/>Likes
    <form action="#" method="post">
        <input type="hidden" name="imageId" value="id">
        <input type="submit" value="Like">
    </form>
</div>
<div class="add-photo"><a href="<?= \app\core\Route::url('photo', 'upload')?>">Add Photo</a></div>
<div class="pagination">
    <a href="#">&laquo;</a>
    <a href="#">1</a>
    <a class="active" href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">&raquo;</a>
</div>