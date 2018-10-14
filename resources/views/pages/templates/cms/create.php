<div class="mainContainer" style="min-height: 100vh;">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><?= $title ?></h1>
        </div>
    </div>
    <form action="<?= $baseUri . '?type=create_post' ?>" method="post">
        <?php
        foreach ($fields as $field) {
            $fieldElem = "";
            switch ($field['html_type']) {
                case 'input':
                    $val = isset($field['create_value']) ? "value='{$field['create_value']}'" : null;
                    $fieldElem = "<input type=\"{$field['type']}\" class=\"form-control\" placeholder=\"{$field['placeholder']}\" name=\"{$field['name']}\" {$val} required >";
                    break;
                case 'textarea':
                    $fieldElem = "<textarea class='form-control' rows='3' name='{$field['name']}' required></textarea>";
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
            Create
        </button>
    </form>
</div>