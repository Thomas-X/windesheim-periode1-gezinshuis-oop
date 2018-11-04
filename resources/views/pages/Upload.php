<div class="container" style="min-height: 100vh;">
    <form action="<?= \Qui\lib\Routes::$routes['uploadCollection'] ?>" method="post" enctype="multipart/form-data">
        <?php \Qui\lib\Form::input('createPictureCollection', 'fa-folder-open',
                    "<input type=\"file\" name=\"files[]\" multiple required>") ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::$routes['deleteCollection'] ?>" method="post">
        <?php \Qui\lib\Form::input('deletePictureCollection (Delete collection 1)', 'fa-file-excel',
            "<input type=\"hidden\" name=\"collectionId\" value=\"1\">") ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::$routes['deletePicture'] ?>" method="post">
        <?php \Qui\lib\Form::input('deletePicture (Delete image 1 collection 1)', 'fa-file-excel',
            "<input type=\"hidden\" name=\"collectionId\" value=\"1\">") ?>
            <input type="hidden" name="pictureId" value="1">
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::$routes['updatePicture'] ?>" method="post" enctype="multipart/form-data">
        <?php \Qui\lib\Form::input('updatePictureCollection (Update image 1 collection 1)', 'fa-arrow-up',
            "<input type=\"file\" name=\"file\" required>") ?>
        <input type="hidden" name="collectionId" value="1">
        <input type="hidden" name="pictureId" value="1">
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::$routes['getAllPicturesFromCollection'] ?>" method="post">
        <?php \Qui\lib\Form::input('getAllPicturesFromCollection (Get pictures collection 1)', 'fa-arrow-down',
            "<input type=\"hidden\" name=\"collectionId\" value=\"1\">") ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <?php
    if(isset($pictureDirectories))
    {
        var_dump($pictureDirectories);
    }
    ?>
    <hr>
    <form action="<?= \Qui\lib\Routes::$routes['getPictureFromCollection'] ?>" method="post">
        <?php \Qui\lib\Form::input('getPictureFromCollection (Get picture 1 collection 1)', 'fa-arrow-down',
            "<input type=\"hidden\" name=\"collectionId\" value=\"1\">") ?>
        <input type="hidden" name="pictureId" value="1">
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <?php
    if(isset($pictureDirectory))
    {
        var_dump($pictureDirectory);
    }
    ?>
</div>