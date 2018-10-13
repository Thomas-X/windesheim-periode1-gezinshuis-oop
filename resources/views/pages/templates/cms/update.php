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
                echo "<input name=\"{$field['name']}\" style=\"display: none;\" value=\"{$fieldData[$field['name']]}\"/>";
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
                case 'select':
                    $options = "";
                    foreach ($field['values'] as $value) {
                        $options = $options . "<option value=\"{$value['value']}\">{$value['title']}</option>";
                    }
                    $fieldElem = "<select name=\"{$field['name']}\" class='form-control'>
            {$options}
</select>";
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