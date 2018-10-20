<div class="container" style="min-height: 100vh;">
    <form action="<?= \Qui\lib\Routes::routes['uploadCollection'] ?>" method="post" enctype="multipart/form-data">
        <?php \Qui\lib\Form::input('Upload collection', 'fa-folder-open',
                    "<input type=\"file\" name=\"files[]\" multiple required>") ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::routes['deleteCollection'] ?>" method="post">
        <?php \Qui\lib\Form::input('Delete collection 1', 'fa-file-excel',
            "<input type=\"hidden\" name=\"collectionId\" value=\"1\">") ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::routes['deletePicture'] ?>" method="post">
        <?php \Qui\lib\Form::input('Delete image 1 collection 1', 'fa-file-excel',
            "<input type=\"hidden\" name=\"collectionId\" value=\"1\">") ?>
            <input type="hidden" name="pictureId" value="1">
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::routes['updatePicture'] ?>" method="post" enctype="multipart/form-data">
        <?php \Qui\lib\Form::input('Update image 1 collection 1', 'fa-arrow-up',
            "<input type='file' name='file' required>") ?>
        <input type="hidden" name="collectionId" value="1">
        <input type="hidden" name="pictureId" value="1">
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
</div>