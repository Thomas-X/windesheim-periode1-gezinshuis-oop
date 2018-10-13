<?php
// @param title
// @param items

?>
<div class="mainContainer" style="min-height: 100vh;">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><?= $title ?></h1>
        </div>
    </div>
    <h6>
        Create new <?= $newItemName ?>
        <span class="margin-1"></span>
        <a href="<?= $baseUri . '?type=' . 'create_get' ?>"
           class="btn btn-success flex1" role="button">
            <i class="fas fa-plus margin-2"></i>
            Create
        </a>
    </h6>
    <br/>
    <ul class="list-group">
        <?php foreach ($items as $item) : ?>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-sm-8 flexCenter"><?= $item[$titleKey] ?><?= '&nbsp;' . $item[$secondTitleKey] ?? '' ?></div>
                    <div class="col-sm-4 buttongrid">
                        <a href="<?= $baseUri . '?id=' . $item['id'] . '&type=' . 'update_get' ?>"
                           class="btn btn-success flex1" role="button">
                            <i class="fas fa-sync margin-2"></i>
                            Update
                        </a>
                        <form action="<?= $baseUri . '?id=' . $item['id'] . '&type=' . 'delete_post' ?>" method="post">
                            <button type="submit"
                               class="btn btn-danger flex1" role="button">
                                <i class="fas fa-trash margin-2"></i>
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>