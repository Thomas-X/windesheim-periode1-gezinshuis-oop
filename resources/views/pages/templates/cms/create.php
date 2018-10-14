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
                case 'checkbox':
                    $checked = $field['checked'] == true ? 'checked' : null;
                    $fieldElem = "<div class=\"form-check\">
  <input class=\"form-check-input\" type=\"checkbox\" value=\"{$field['value']}\" name=\"{$field['name']}\" {$checked}>
  <label class=\"form-check-label\" for=\"defaultCheck1\">
    {$field['title']}
  </label>
</div>";
                    break;
                case 'select':
                    $options = "";
                    foreach ($field['values'] as $value) {
                        $options = $options . "<option value=\"{$value['value']}\">{$value['title']}</option>";
                    }
                    $fieldElem = "<select name=\"{$field['name']}\" class='form-control'>
            {$options}
</select>";
                    break;
            }
            $label = $field['html_type'] != 'checkbox' ? "<label>{$field['title']}</label>" : null;
            echo "<div class=\"form-group\">
            {$label}
            {$fieldElem}
        </div>";
        }
        ?>
        <button class="btn btn-success" type="submit">
            Create
        </button>
    </form>
</div>