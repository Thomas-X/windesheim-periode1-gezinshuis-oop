<div class="mainContainer" style="min-height: 100vh;">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><?= $title ?></h1>
            <?= $subtitle ? "<p>{$subtitle}</p>" : '' ?>
        </div>
    </div>
    <form action="<?= $baseUri . '?type=create_post' ?>" method="post">
        <?php
        foreach ($fields as $field) {
            if ($field['not_in_update']) {
                continue;
            }

                $fieldElem = "";
            switch ($field['html_type']) {
                case 'input':
                    $fieldElem = "<input type=\"{$field['type']}\" class=\"form-control\" placeholder=\"{$field['placeholder']}\" name=\"{$field['name']}\" required value='{$fieldData[$field['name']]}'>";
                    break;
                case 'textarea':
                    $fieldElem = "<textarea class='form-control' rows='3' name=\"{$field['name']}\" required>" . $fieldData[$field['name']] . "</textarea>";
                    break;
            }

            echo "<div class=\"form-group\">
            <label>{$field['title']}</label>
            {$fieldElem}
        </div>";
        }
        ?>
        <button class="btn btn-success" type="submit">
            Update
        </button>
    </form>
</div>