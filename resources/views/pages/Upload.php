<div class="container" style="min-height: 100vh;">
    <form action="<?= \Qui\lib\Routes::routes['uploadCollection'] ?>" method="post" enctype="multipart/form-data">
        <?php \Qui\lib\Form::input('Upload collection', 'fa-folder-open',
                    "<input type='file' name='files[]' multiple required>") ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
    <hr>
    <form action="<?= \Qui\lib\Routes::routes['deleteCollection'] ?>" method="post">
        <?php \Qui\lib\Form::input('Delete collection', 'fa-file-excel',
            "<input type=\"hidden\" name=\"collectionId\" value=\"1\">") ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
</div>